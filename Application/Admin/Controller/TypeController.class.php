<?php
namespace Admin\Controller;
class TypeController extends CommonController
{
  public function add() {
    if (IS_GET){
      $this->display();
    } else {
      $model = D('Type');
      $data = $model->create();
      if(!$data) {
        $this->error($model->getError());
      }
      $res = $model->add($data);
      if (!$res) {
        $this->error($model->getError());
      }
      S('attribute_type',null);
      $this->success('添加成功',U('index'));
    }
  }

  public function index() {
    $model = D('Type');
    $data = $model->listData();
    if (!$data) {
      $this->error($model->getError());
    }
    $this->assign($data);
    $this->display();
  }

  public function del() {
    $id = intval(I('get.id'));
    if ($id < 0) {
      $this->error('参数错误');
    }
    $res = D('Type')->remove($id);
    if (!$res) {
      $this->error('删除失败');
    }
    $this->success('删除成功');
  }

  public function edit() {
    $model = D('Type');
    if (IS_GET){
      $id = intval(I('get.id'));
      $info = $model->where("id={$id}")->find();
      $this->assign('info',$info);
      $this->display();
    } else {
      $data = $model->create();
      if(!$data) {
        $this->error($model->getError());
      }
      if ($data['id']<0) {
        $this->error('参数错误');
      }
      $res = $model->save($data);
      if (!$res) {
        $this->error($model->getError());
      }
      $this->success('修改成功',U('index'));
    }
  }
}
