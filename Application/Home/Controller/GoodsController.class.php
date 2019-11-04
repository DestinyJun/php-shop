<?php
namespace Home\Controller;
final class GoodsController extends CommonController
{
  public function index(){
    $goods_id = intval(I('get.id'));
    if ($goods_id<=0) {
      $this->redirect('Errors/errors',array('message'=>'参数错误'));
    }
    $goodsModel = D('Goods');
    $good = $goodsModel->where("is_sale=1 AND id={$goods_id}")->find();
    // 将商品描述进行html标签反序列化
    $good['goods_body'] = htmlspecialchars_decode($good['goods_body']);
    // 获取商品相册
    $goods_imgs = M('goods_img')->where("goods_id={$goods_id}")->select();
    // 获取商品属性
    $attr = D('GoodsAttr')->alias('a')->
      field('a.*,b.attr_name,b.attr_type')->
      join('left join wj_attribute b on a.attr_id=b.id')->
      where("a.goods_id={$goods_id}")->select();
    // 根据单选和唯一拆分属性
    foreach ($attr as $value) {
      if ($value['attr_type'] == 1) {
        // 唯一属性
        $unique[] = $value;
      } else {
        // 单例属性
        $single[$value['attr_id']][] = $value;
      }
    }
    // 显示模板并赋值
    $this->assign(array(
      'good'=>$good,
      'goods_imgs'=>$goods_imgs,
      'unique'=>$unique,
      'single'=>$single,
    ));
    $this->display();
  }
}
