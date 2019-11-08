<?php
namespace Home\Controller;
class IndexController extends CommonController
{
  public function index()
  {
    $goodModel = D('Admin/Goods');
    $hot   = $goodModel->getRecGoods('is_hot'); // 获取热卖商品
    $rec   = $goodModel->getRecGoods('is_rec'); // 获取推荐商品
    $new   = $goodModel->getRecGoods('is_new'); // 获取最新商品
    $crazy = $goodModel->getCrazyGoods();  // 获取促销中的商品
    $floor = D('Admin/Category')->getFloors(); // 获取分类楼层
    $this->assign(array(
      'is_show'=>1,
      'hot'=>$hot,
      'rec'=>$rec,
      'new'=>$new,
      'crazy'=>$crazy,
      'floor'=>$floor,
    ));
    $this->display();
  }
}
