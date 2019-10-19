<?php
namespace Admin\Controller;

final class CategoryController extends CommonController
{
  public function index(){
    $this->display();
  }
  public function add(){
    if (IS_GET) {
      $model =  D('Category');
      $cate = $model->getCateTree($model->select());
      $this->assign('cate',$cate);
      $this->display();
    } else {
      $model = D('Category');
      // 创建数据
      $data = $model->create();
      if (!$data) {
        $this->ajaxReturn(array(
          'status'=>1001,
          'msg'=>$model->getError(),
        ));
      }
      $res = $model->add($data);
      if(!$res) {
        $this->error($model->getError());
      } else {
        $this->success('插入成功');
      }
    }
  }
}
