<?php
namespace Admin\Controller;
class UserController extends CommonController
{
  public function add() {
    if (IS_GET) {
      $roleModel = D('Role');
      $this->assign('role',$roleModel->select());
      $this->display();
    } else {
      $model = D('User');
      $data = $model->create();
      if (!$data) {
        $this->error($model->getError());
      }
      $res = $model->add($data);
      if (!$res) {
        $this->error($model->getError());
      }
      $this->success('添加成功',U('index'));
    }
  }

  public function index() {
    $model = D('User');
    $data = $model->listDate();
    if (!$data) {
      $this->error($model->getError());
    }
    $this->assign($data);
    $this->display();
  }

  public function del() {
    $id = intval(I('get.id'));
    if ($id <= 1) {
      $this->error('参数错误');
    }
    $model = D('User');
    $res = $model->remove($id);
    if (!$res) {
      $this->error($model->getError());
    }
    $this->success('删除成功');
  }

  public function edit() {
    $model = D('User');
    if (IS_GET){
      $id = intval(I('get.id'));
      $info = $model->findOne($id);
      $role = D('Role')->select();
      $this->assign(array(
        'info'=>$info,
        'role'=>$role,
      ));
      $this->display();
    } else {
      $data = $model->create();
      if(!$data) {
        $this->error($model->getError());
      }
      if ($data['id']<=1) {
        $this->error('参数错误');
      }
      $res = $model->update($data);
      if (!$res) {
        $this->error($model->getError());
      }
      $this->success('修改成功',U('index'));
    }
  }
}
