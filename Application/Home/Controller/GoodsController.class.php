<?php
namespace Home\Controller;
final class GoodsController extends CommonController
{
  public function index(){
    // 获取商品详情
    $goods_id = intval(I('get.id'));
    if ($goods_id<=0) {
      $this->redirect('Errors/errors',array('message'=>'参数错误'));
    }
    $goodsModel = D('Goods');
    $good = $goodsModel->where("is_sale=1 AND id={$goods_id}")->find();
    if(!$good) {
      $this->redirect('Errors/errors',array('message'=>'商品不存在'));
    }

    // 设置促销价格
    if ($good['cx_price']>0 && $good['start'] < time() && $good['end'] > time()) {
      $good['shop_price'] = $good['cx_price'];
    }

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

    // 获取商品的评论数据
    $modelComment = D('Comment');
    $commentList = $modelComment->getCommentList($goods_id);

    // 获取商品印象
    $imModel = M('impression');
    // 印象很多，需要进行排序赛选
    $impression = $imModel->where("goods_id={$goods_id}")->
    order('count desc')->limit(8)->select();

    // 显示模板并赋值
    $this->assign(array(
      'good'=>$good,
      'goods_imgs'=>$goods_imgs,
      'unique'=>$unique,
      'single'=>$single,
      'impression'=>$impression,
      $commentList
    ));
    $this->display();
  }
  
  // 商品评论
  public function comment() {
    // 评论之前需要登陆
    $this->checkLogin();
    $model = D('Comment');
    $data = $model->create();
    if (!$data) {
      $this->error('参数错误');
    }
    $model->add($data);
    $this->success('评论成功');
  }

  // 商品点赞
  public function good() {
    $comment_id = I('post.id');
    $model = D('Comment');
    $info = $model->where("id={$comment_id}")->find();
    if (!$info) {
      $this->ajaxReturn(array('status'=>1004,'message'=>'查无评论！'));
    }
    $model->where("id={$comment_id}")->setField('goods_number',$info['goods_number']+1);
    $this->ajaxReturn(array('status'=>1000,'message'=>'点赞成功！','goods_number'=>$info['goods_number']+1));
  }
}
