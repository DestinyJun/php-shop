<?php
namespace Admin\Controller;
class RoleController extends CommonController
{
  public function add() {
    if (IS_GET){
      $this->display();
    } else {
      $model = D('Role');
      $data = $model->create();
      if(!$data) {
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
    $model = D('Role');
    $data = $model->listData();
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
    $res = D('Role')->remove($id);
    if (!$res) {
      $this->error('删除失败');
    }
    $this->success('删除成功');
  }

  public function edit() {
    $model = D('Role');
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
      if ($data['id']<=1) {
        $this->error('参数错误');
      }
      $res = $model->save($data);
      if (!$res) {
        $this->error($model->getError());
      }
      $this->success('修改成功',U('index'));
    }
  }

  // 配置权限
  public function disfetch(){
    if (IS_GET) {
      $ruleModel = D('Rule');
      $rule = $ruleModel->getCateTree();
      $role_id = intval(I('get.id'));
      if ($role_id<=1) {
        $this->error('参数错误');
      }
      $has_rule = D('RoleRule')->getRules($role_id);
      foreach ($has_rule as $value) {
        $has_rule_id[] = $value['rule_id'];
      }
      $this->assign(array(
        'rule'=>$rule,
        'has_rule_id'=>$has_rule_id,
      ));
      $this->display();
    } else {
      $role_id = intval(I('post.id'));
      if ($role_id<=1) {
        $this->error('参数错误');
      }
      $rules = I('post.rule');
      $res = D('RoleRule')->disfetch($role_id,$rules);
      if (!$res) {
        $this->error('权限配置失败');
      }
      $this->success('权限配置成功！',U('index'));
    }
  }
}
