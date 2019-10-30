<?php
namespace Admin\Controller;

final class AttributeController extends CommonController
{
  public function add(){
    if (IS_GET) {
      $type = D('Type')->select();
      $this->assign('type',$type);
      $this->display();
    } else {
      // 创建数据
      $model =  D('Attribute');
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
    $model =  D('Attribute');
    $data = $model->listData();
    $this->assign($data);
    $this->display();
  }

  public function del(){
    $id = intval(I('get.id'));
    if ($id<0){
      $this->error('参数不对！');
    }
    $model =  D('Attribute');
    $res = $model->dels($id);
    if (!$res){
      $this->error('删除失败');
    }
    $this->success('删除成功');
  }

  public function edit(){
    $model =  D('Attribute');
    if (IS_GET) {
      $id = intval(I('get.id'));
      if ($id<0){
        $this->error('参数不对');
      }
      $type = D('Type')->select();
      $info = $model->where("id = {$id}")->find();
      $this->assign(array(
        'type'=>$type,
        'info'=>$info
      ));
      $this->display();
    } else {
      // 创建数据
      $data = $model->create();
      if (!$data){
        $this->error($model->getError());
      }
      $res = $model->save($data);
      if (!$res) {
        $this->error($model->getError());
      }
      $this->success('修改成功',U('index'));
    }
  }

}
