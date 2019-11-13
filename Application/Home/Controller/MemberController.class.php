<?php
namespace Home\Controller;
class MemberController extends  CommonController
{
  public function __construct()
  {
    parent::__construct();
    $this->checkLogin();
  }

  public function order() {
    $model = D('Order');
    $client_id = session('client_id');
    $data = $model->where("client_id={$client_id}")->select();
    $this->assign('data',$data);
    $this->display();
  }

  // 查看快递信息
  public function express() {
    $order_id = I('get.id');
    $info = M('order')->where("id={$order_id}")->find();
    if (!$info|| $info['order_status'] != 2) {
      $this->error('参数错误');
    }
    // 根据快递公司及运单号查询快递信息
    // 组装物流查询地址
    $url = "http://v.juhe.cn/exp/index?key=221c21114351a4609c1e98d89782e50a&com={$info['com']}&no={$info['no']}";
    // 模拟get请求直接使用file_get_contents
    $res = file_get_contents($url);
    $res = json_decode($res,true);
    $this->assign('data',$res);
    $this->display();
  }
}
