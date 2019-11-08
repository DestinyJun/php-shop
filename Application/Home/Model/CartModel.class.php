<?php
namespace Home\Model;
use Think\Model;

final class CartModel extends Model
{
  protected $fields = array('id','client_id','goods_id','goods_attr_ids','goods_count');
  // 购物车操作
  public function addCart($goods_id,$goods_count,$attr) {
    // 将属性信息从小到大排序，为了后期库存量检查方便？
    sort($attr);
    $goods_attr_ids = $attr?implode(',',$attr):'';
    // 再添加购物车的时候，肯定需要检查下库存量的
    $res = $this->checkGoodsNumber($goods_id,$goods_count,$goods_attr_ids);
    if (!$res) {
      $this->error = '库存量不足';
      return false;
    }
    // 获取用户的额ID标识
    $client_id = session('client_id');
    if ($client_id) {
      // 用户已经登陆的情况,需要去数据库校验是否存在，存在就加数量，不存在就新增
      $map = array(
        'client_id'=>$client_id,
        'goods_id'=>$goods_id,
        'goods_attr_ids'=>$goods_attr_ids,
      );
      $info = $this->where($map)->find();
      if ($info) {
        // 数据已经存在，更新数量就行
        return $this->where($map)->setField('goods_count',$goods_count+$info['goods_count']);
      } else {
        // 如果数据不存在
        $map['goods_count'] = $goods_count;
        return $this->add($map);
      }
    }
    else {
      // 用户没有登陆，对应应该操作cookie中的数据
      // 规定关于商品加入购物车cookie中记录的数据，使用cart的名称，对于数据从php中的数组转换为字符串时通过
      // php的序列化操作完成
      // （1）先读取cookie中的数据
      $cart = unserialize(cookie('cart'));
      // （2）判断商品是否存在
      // 拼接下标
      $key = $goods_id.'-'.$goods_attr_ids;
      if (array_key_exists($key,$cart)) {
        $cart[$key] += $goods_count;
      } else {
        // 商品信息不存在，拼接字符串存储数据
        $cart[$key] = $goods_count;
      }
      // 最后把处理后的数据重新写入cookie
      cookie('cart',serialize($cart));
    }
    return true;
  }

  // 检查库存量
  public function checkGoodsNumber($goods_id,$goods_count,$goods_attr_ids) {
    // 第一：检查总库存量
    $goods = D('Admin/Goods')->where("id={$goods_id}")->find();
    if ($goods['goods_number'] < $goods_count) {
      return false;
    }
    // 第二：检查属性库存量
    if ($goods_attr_ids) {
      // 库存不足
      $number = M('goods_number')->where("goods_id={$goods_id} AND goods_attr_ids='{$goods_attr_ids}'")->find();
      if (!$number || $number['goods_number']<$goods_count) {
        // 库存不足
        return false;
      }
    }
    return true;
  }

  // 用户登陆后将cookie中的额购物车数据转移到数据库
  public function cookie2db() {
    $cart = unserialize(cookie('cart')); // 读取cookie中的购物车数据并反序列化
    $client_id = session('client_id'); // 获取用户的登陆ID
    if (!$client_id) {
      // 用户未登录
      return false;
    }
    foreach ($cart as $key=>$value) {
      dump($value);
      $tmp = explode('-',$key); // 拆分出goods_id跟goods_attr_ids
      // 拼接购物车数据的查询条件
      $map = array(
        'client_id'=>$client_id,
        'goods_id'=>$tmp[0],
        'goods_attr_ids'=>$tmp[1],
      );
      $info = $this->where($map)->find();
      if ($info) {
        // 数据已经存在，更新数量就行
        $this->where($map)->setField('goods_count',$value+$info['goods_count']);
      } else {
        // 如果数据不存在
        $map['goods_count'] = $value;
        $this->add($map);
      }
    }
    // 转移后需要清空cookie中购物车的数据
    cookie('cart',null);
    return true;
  }

  // 获取购物车数据
  public function getList() {
     // （1）获取当前购物车中对应的信息
    $client_id = session('client_id');
    if ($client_id) {
      // 用户已经登陆，直接从数据库中取数据
      $data = $this->where("client_id={$client_id}")->select();
    }
    else {
      // 用户没登陆，从cookie中取数据
      $cart = unserialize(cookie('cart'));
      foreach ($cart as $key=>$value) {
        // 把cookie中的数据格式化为数据库中的数据格式
        $tem = explode('-',$key);
        $data[] = array(
          'goods_id'=>$tem[0],
          'goods_attr_ids'=>$tem[1]?$tem[1]:'',
          'goods_count'=>$value,
        );
      }
    }
    $goodsModel = D('Admin/Goods');
    foreach ($data as $key=>$value) {
      // （2）根据购物车中的商品ID获取商品信息
      // 一旦涉及到商品价格，就需要判断当前商品是否正在促销
      $goods = $goodsModel->where("id={$value['goods_id']}")->find();
      if ($goods['cx_price']>0 && $goods['start']<time() && $goods['end']>time()) {
        // 商品正在做促销
        $goods['shop_price'] = $goods['cx_price'];
      }
      $data[$key]['goods'] = $goods;
      // （3）根据属性ID拿到属性名称及对应的值
      if ($value['goods_attr_ids']) {
        $attr = D('GoodsAttr')->alias('a')->
        join("left join wj_attribute b on a.attr_id=b.id")->
        field("a.attr_values,b.attr_name")->
        where("a.id in ({$value['goods_attr_ids']})")->
        select();
        $data[$key]['attr'] = $attr;
      }
    }
    return $data;
  }

  // 计算总数
  public function getTotal($data) {
    $count = $price = 0;
    foreach ($data as $key=>$value) {
      $count += $value['goods_count'];
      $price += $value['goods_count']*$value['goods']['shop_price'];
    }
    return array(
      'count'=>$count,
      'price'=>$price
    );
  }

  // 删除购物车
  public function dels($goods_id,$goods_attr_ids) {
    $client_id = session('client_id');
    $goods_attr_ids = $goods_attr_ids?$goods_attr_ids:'';
    if ($client_id) {
      // 用户已经登陆
      $where = "client_id={$client_id} AND goods_id={$goods_id} AND goods_attr_ids='{$goods_attr_ids}'";
      $this->where($where)->delete();
    } else {
      // 用户未登录
      $key = $goods_id.'-'.$goods_attr_ids;
      $cart = unserialize(cookie('cart'));
      unset($cart[$key]);
      cookie('cart',serialize($cart));
    }
  }
}
