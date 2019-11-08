<?php
namespace Home\Controller;
use Think\Controller;

abstract class CommonController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    // 由于前台很多页面都可能用到商品分类，因此我们直接在公共方法里面获取分类
    $cate = D('Admin/Category')->getCateTree();
    $this->assign('cate',$cate);
  }
  // 判读用户是否登陆
  public function checkLogin() {
    $client_id = session('client_id');
    if (!$client_id) {
      $this->error('请先登陆！',U('Client/login'));
    }
  }
}
