<?php
namespace Admin\Controller;
use Think\Controller;

abstract class CommonController extends Controller
{
  public function __construct()
  {
    parent::__construct();
//    echo '我是控制器';
  }
}
