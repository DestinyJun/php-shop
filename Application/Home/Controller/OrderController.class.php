<?php
namespace Home\Controller;

final class OrderController extends CommonController
{
  public function check() {
    // 结算之前，必须先登陆
    $this->checkLogin();
    // 登陆后显示结算页，获取数据并显示购物车
    $model = D('Cart');
    $data = $model->getList();
    $total = $model->getTotal($data);
    $total['data'] = $data;
    $this->assign('total',$total);
    $this->display();
  }

  public function order() {
    // 下单之前，必须先登陆
    $this->checkLogin();
    $model = D('Order');
    $res = $model->order();
    if (!$res) {
      $this->error($model->getError());
    }
    $this->success('下单成功');
  }
}
