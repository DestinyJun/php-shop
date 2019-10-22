<?php

namespace Admin\Model;

use Think\Image;
use Think\Model;
use Think\Upload;

final class GoodsModel extends Model
{
  // 自定义字段
  protected $fields = array(
    'id', 'goods_name', 'goods_sn', 'category_id', 'market_price', 'shop_price', 'goods_body',
    'goods_img', 'goods_thumb', 'is_hot', 'is_rec', 'is_new', 'is_del', 'is_sale', 'addtime');
  // 定义字段自动校验
  protected $_validate = array(
    array('goods_name', 'require', '商品名称必填', 1, 'regex', 3),
    array('category_id', 'checkCategory', '分类名称必填', 1, 'callback', 3),
    array('market_price', 'currency', '市场价格格式不对', 1, 'regex', 3),
    array('shop_price', 'currency', '本店价格格式不对', 1, 'regex', 3),
  );

  // 在模型中使用钩子函数补齐参数
  public function _before_insert(&$data, $options)
  {
    // 补全参数
    $data['addtime'] = time();
    if ($data['goods_sn']) {
      $res = $this->where("goods_sn = {$data['goods_sn']}")->find();
      if ($res) {
        $this->error = '商品货号已存在，请从新输入';
        return false;
      }
    } else {
      $data['goods_sn'] = 'wj' . uniqid();
    }

    // 实现图片上传
    $fileConfig = array(
      'exts' => array('jpg', 'gif', 'png'), // 配置文件上传的文件后缀名
      'maxSize' => 3145728, //上传的文件大小限制 (0-不做限制)
      'savePath' => 'goods/', //保存路径
    );
    $upload = new Upload($fileConfig);
    $info = $upload->uploadOne($_FILES['file']);
    if (!$info) {
      $this->error = $upload->getError();
      return false;
    }
    $data['goods_img'] = 'Uploads/' . $info['savepath'] . $info['savename'];
    // 实现缩略图处理
    $data['goods_thumb'] = 'Uploads/' . $info['savepath'] . 'thumb' . $info['savename'];
    $img = new Image(); // 实例化缩略图对象
    $img->open($data['goods_img']); // 打开需要制作的图片蓝本
    $img->thumb(450, 450)->save($data['goods_thumb']); // 制作缩略图并保存
  }

  // 使用钩子函数写入商品的扩展分类，在商品添加成功操作
  public function _after_insert($data, $options)
  {
    // $data是数据插入后返回来的插入的数据的一维数组，里面携带了ID,相当于插入后在数据库里面查出来的
    $goods_id = $data['id']; // 获取$goods_id
    $data = I('post.cate_id'); // 这里接收到的是一个cate_id的数组
    $data = array_unique($data); // 去除数组中重复的元素
    foreach ($data as $key => $value) {
      $list[] = array(
        'goods_id' => $goods_id,
        'cate_id' => $value,
      );
    }
    // 使用模型的addAll必须注意，首先是二维数组，其次下标必须是索引数组且从0开始
    M('goods_cate')->addAll($list); // 实例化扩展分类表的基类，并多条一起存入数据
  }

  // 使用自动完成规则补齐参数
  /* protected $_auto = array(
     array('goods_sn','goodsSnComplete',3,'callback'),
     array('addtime','time',3,'function')
   );*/

  // 校验商品分类的回调函数
  public function checkCategory($category_id)
  {
    $category_id = intval($category_id);
    if ($category_id > 0) {
      return true;
    }
    return false;
  }

  // 自动完成商品货号
  /* public function goodsSnComplete(){
     $goods_sn = mt_rand(10,10000);
     return $goods_sn;
   }*/
}
