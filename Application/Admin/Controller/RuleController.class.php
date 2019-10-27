<?php
namespace Admin\Controller;

final class RuleController extends CommonController
{
  public function add(){
    $model =  D('Rule');
    if (IS_GET) {
      $rule = $model->getCateTree();
      $this->assign('rule',$rule);
      $this->display();
    } else {
      // 创建数据
      $data = $model->create();
      if (!$data) {
        $this->error($model->getError());
      }
      $res = $model->add($data);
      if(!$res) {
        $this->error($model->getError());
      } else {
        $this->success('插入成功');
      }
    }
  }

  public function index(){
    $model =  D('Rule');
    $rule = $model->getCateTree();
    $this->assign('rule',$rule);
    $this->display();
  }

  public function del(){
    $id = intval(I('get.id'));
    if ($id<0){
      $this->error('参数不对！');
    }
    $model =  D('Rule');
    $res = $model->dels($id);
    if (!$res){
      $this->error('删除失败');
    }
    $this->success('删除成功');
  }

  public function edit(){
    $model =  D('Rule');
    if (IS_GET) {
      $id = intval(I('get.id'));
      if ($id<0){
        $this->error('参数不对');
      }
      $rule = $model->getCateTree();
      $info = $model->where("id = {$id}")->find();
      $this->assign(array(
        'rule'=>$rule,
        'info'=>$info
      ));
      $this->display();
    } else {
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
