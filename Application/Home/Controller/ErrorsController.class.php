<?php
namespace Home\Controller;
class ErrorsController extends CommonController
{
  public function errors() {
    $message = I('get.message');
    $this->assign('message',$message);
    $this->display();
  }
}
