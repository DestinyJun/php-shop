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
}
