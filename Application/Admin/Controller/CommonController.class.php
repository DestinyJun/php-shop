<?php
namespace Admin\Controller;
use Think\Controller;

abstract class CommonController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    // 验证用户是否登陆状态
    if (!session('user')) {
      $this->error('您还没有登陆！',U('Login/login'));
    }
  }
}
