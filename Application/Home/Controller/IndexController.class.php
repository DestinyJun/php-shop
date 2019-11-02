<?php
namespace Home\Controller;
class IndexController extends CommonController
{
  public function index()
  {
    $this->assign('is_show',1);
    $this->display();
  }
}
