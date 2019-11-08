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
}
