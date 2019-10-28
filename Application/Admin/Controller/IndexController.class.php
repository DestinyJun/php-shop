<?php

namespace Admin\Controller;

class IndexController extends CommonController
{
  public function index()
  {
    $this->display();
  }
  public function top()
  {
    $this->display();
  }
  public function left()
  {
    $menus = $this->user['menus'];
    $this->assign('menus',$menus);
    $this->display();
  }
  public function right()
  {
    $this->display();
  }
}
