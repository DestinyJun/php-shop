<?php
namespace Home\Model;
use Think\Model;

final class OrderModel extends Model
{
  // 下单
  public function order() {
    // （1）获取购物车中的信息
    $cartModel = D('Cart');
    $data = $cartModel->getList();
    if (!$data) {
      $this->error = '购物车中无数据！';
      return false;
    }
    // （2）根据每一个商品及商品属性组合检查库存
    foreach ($data as $key=>$value) {
      $status = $cartModel->checkGoodsNumber($value['goods_id'],$value['goods_count'],$value['goods_attr_ids']);
      if (!$status) {
        $this->error = '库存不足！';
        return false;
      }
    }
    // （3）向订单总表写入数据
    $total = $cartModel->getTotal($data); // 计算订单总价格
    $order = array(
      // 拼接下单数据
      'client_id' => session('client_id'),
      'total_price' => $total['price'],
      'name' => I('post.name'),
      'address' => I('post.address'),
      'tel' => I('post.tel'),
      'addtime' => time(),
    );
    $order_id = $this->add($order);
    // （4）向订单商品详情表写入具体数据
    foreach ($data as $key=>$value) {
      $goods_order[] = array(
        'order_id'=>$order_id,
        'goods_id'=>$value['goods_id'],
        'goods_attr_ids'=>$value['goods_attr_ids'],
        'price'=>$value['goods']['shop_price'],
        'goods_count'=>$value['goods_count'],
      );
      M('order_goods')->addAll($goods_order);
    }
    // （5）减少商品对应的库存量
    foreach ($data as $key=>$value) {
      // ①减少总库存
      M('goods')->where("id={$value['goods_id']}")->setDec('goods_number',$value['goods_count']);
      // ②减少商品属性组合的库存
      $where = "goods_id={$value['goods_id']} AND goods_attr_ids='{$value['goods_attr_ids']}'";
      if ($value['goods_attr_ids']) {
        M('goods_number')->where($where)->setDec('goods_number',$value['goods_count']);
      }
    }
    // （6）清空购物车中的数据
    $client_id = session('client_id');
    $cartModel->where("client_id={$client_id}")->delete();
    $order['id'] = $order_id;
    return $order;
  }
}
