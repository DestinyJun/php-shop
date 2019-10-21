<?php
namespace Admin\Controller;

final class CategoryController extends CommonController
{
  public function index(){
    $model =  D('Category');
    $cate = $model->getCateTree();
    $this->assign('cate',$cate);
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
  public function delete(){
    $id = intval(I('get.id'));
    if ($id<0){
      $this->error('参数不对！');
    }
    $model =  D('Category');
    $res = $model->dels($id);
    if (!$res){
      $this->error('删除失败');
    }
    $this->success('删除成功');
  }
  public function edit(){
    if (IS_GET) {
      $id = intval(I('get.id'));
      if ($id<0){
        $this->error('参数不对');
      }
      $model =  D('Category');
      $cate = $model->getCateTree();
      $category = $model->where("id = {$id}")->find();
      $this->assign(array(
        'cate'=>$cate,
        'category'=>$category
      ));
      $this->display();
    } else {
      $model =  D('Category');
      // 创建数据
      $data = $model->create();
      if (!$data){
        $this->error($model->getError());
      }
      $res = $model->update($data);
      if (!$res) {
        $this->error($model->getError());
      }
      $this->success('修改成功',U('index'));
    }
  }

}
