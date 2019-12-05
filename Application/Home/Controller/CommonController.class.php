<?php
namespace Home\Controller;
use Think\Controller;

abstract class CommonController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    /* 商品分类读取优化 */
    //（1）取缓存（内存缓存memcache）
    $memcache_obj = new \Memcache();
    $memcache_obj->connect('127.0.0.1',11211);
    $cate = $memcache_obj->get('cate');
    //（2）没有缓存取数据库
    if (empty($cate)) {
      $cate = D('Admin/Category')->getCateTree();
      //（3）再把从数据库中取出的数据写入缓存
      $memcache_obj->set('cate',$cate,0,3600*2);
    }
    // 由于前台很多页面都可能用到商品分类，因此我们直接在公共方法里面获取分类

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
