<?php
namespace Admin\Controller;

final class OrderController extends CommonController
{
  public function index() {
    $model = D('Order');
    $data = $model->select();
    $this->assign('data',$data);
    $this->display();
  }

  // 实现订单发货功能
  public function send() {
    if (IS_GET) {
      $order_id = I('get.id');
      $info = M('order')->alias('a')->
      field("a.*,b.username")->
      join("left join wj_client b on a.client_id=b.id")->
      where("a.id={$order_id}")->find();
      $this->assign('info',$info);
      $this->display();
    } else {
      $order_id = I('post.id');
      $info = M('order')->where("id={$order_id}")->find();
      if (!$info || $info['pay_status'] !=1 ) {
        $this->error('参数错误');
      }
      $data = array(
        'com'=> I('post.com'),
        'no'=> I('post.no'),
        'order_status'=> 2, // 设置订单状态为已发货
      );
      M('order')->where("id={$order_id}")->save($data);
      $this->success('发货成功');
    }
  }
}
