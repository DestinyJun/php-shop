<?php
namespace Admin\Controller;
use Think\Controller;

final class GoodsController extends Controller
{
  public function add(){
    if (IS_GET){
      $cate = D('category')->getCateTree();
      $this->assign('cate',$cate);
      $this->display();
      exit();
    }
    $model = D('goods');
    $data = $model->create();
    if (!$data) {
      $this->error($model->getError());
    }
    $res = $model->add($data);
    if (!$res) {
      $this->error($model->getError());
    }
    $this->success('添加成功');
  }
}
