<?php
namespace Admin\Controller;
use Think\Controller;

final class GoodsController extends Controller
{
  // 商品添加
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

  // 商品列表
  public function index(){
    $model = D('goods');
    $data =$model->listData();
    $cate  = D('category')->getCateTree();
    $data['cate'] = $cate;
    $this->assign($data);
    $this->display();
  }

  // 伪删除操作
  public function del() {
    $model = D('goods');
    $id = intval(I('get.id'));
    $res = $model->where("id = {$id}")->setField('is_del',0);
    if (!$res) {
      $this->error($model->getError());
    }
    $this->success('删除成功');
  }

  // 商品编辑
  public function edit() {
    $model = D('goods');
    if (IS_GET) {
      $id = I('get.id');
      // 获取数据
      $data =$model->where("id = {$id}")->find();
      if (!$data) {
        $this->error($model->getError());
      }
      // 获取分类
      $cate  = D('category')->getCateTree();
      $data['cate'] = $cate;
      // 获取扩展分类
      $ext_cate = M('goods_cate')->where("goods_id={$id}")->select();
      $this->assign(array(
        'data'=>$data,
        'cate'=>$cate,
        'ext_cate'=>$ext_cate,
      ));
      $this->display();
    } else {
      $data = $model->create();
      if (!$data) {
        $this->error($model->getError());
      }
      $res = $model->update($data);
      if (!$res) {
        $this->error($model->getError());
      }
      $this->success('修改成功',U('index'));
    }
  }

  // 商品回收站
  public function trash() {
    $model = D('goods');
    $data =$model->listData(0);
    $cate  = D('category')->getCateTree();
    $data['cate'] = $cate;
    $this->assign($data);
    $this->display();
  }

  // 商品还原
  public function recover(){
    $model = D('goods');
    $id = intval(I('get.id'));
    $res = $model->where("id={$id}")->setField('is_del',1);
    if (!$res) {
      $this->error('还原失败！');
    }
    $this->success('还原成功！');
  }

  // 彻底删除商品
  public function remove(){
    $model = D('goods');
    $id = intval(I('get.id'));
    $res = $model->remove($id);
    if (!$res) {
      $this->error('删除失败！');
    }
    $this->success('删除成功！');
  }
}
