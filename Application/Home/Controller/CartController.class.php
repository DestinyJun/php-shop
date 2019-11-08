<?php
namespace Home\Controller;
final class CartController extends CommonController
{
  public function addCart() {
    $goods_id = intval(I('post.goods_id'));
    $goods_count = I('post.goods_count');
    $attr = I('post.attr');
    $model = D('Cart');
    $res = $model->addCart($goods_id,$goods_count,$attr);
    if (!$res) {
      $this->error($model->getError());
    }
    $this->success('写入成功');
  }

  public function index() {
    // 获取数据并显示购物车
    $model = D('Cart');
    $data = $model->getList();
    $total = $model->getTotal($data);
    $total['data'] = $data;
    $this->assign('total',$total);
    $this->display();
  }

  public function del() {
    $goods_id = I('get.goods_id');
    $goods_attr_ids = I('get.goods_attr_ids');
    D('Cart')->dels($goods_id,$goods_attr_ids);
    $this->success('删除成功');
  }
  public function test() {
    dump(unserialize(cookie('cart')));
  }
}
