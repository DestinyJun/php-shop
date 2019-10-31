<?php
namespace Admin\Controller;

final class GoodsController extends CommonController
{
  // 商品添加
  public function add(){
    if (IS_GET){
      $cate = D('category')->getCateTree();
      $types = D('Type')->select();
      $this->assign(array(
        'cate'=>$cate,
        'types'=>$types,
      ));
      $this->display();
    } else {
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

  // 显示商品属性
  public function showAttr(){
    $type_id = intval(I('post.type_id'));
    if ($type_id<=0){
      $this->error('参数错误');
    }
    $attributes = D('Attribute')->where("type_id={$type_id}")->select();
    foreach ($attributes as $key=>$value) {
      if ($value['attr_input_type'] == 2) {
        $attributes[$key]['attr_value'] = explode(',',$value['attr_value']);
      }
    }
    $this->assign('attribute',$attributes);
    $this->display();
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
      // 获取商品类型
      $types = D('Type')->select();
      // 取商品属性及属性值
      $goodsAttrModel = M('goods_attr');
      $goodsAttrs = $goodsAttrModel->alias('a')->
      field('a.*,b.attr_name,b.attr_type,b.attr_input_type,b.attr_value')->
      join("join wj_attribute b on a.attr_id=b.id")->
      where("goods_id={$id}")->select();
      foreach ($goodsAttrs as $key=>$value) {
        if ($value['attr_input_type'] == 2) {
          $goodsAttrs[$key]['attr_value'] = explode(',',$value['attr_value']);
        }
      }
      // 把$goodsAttrs再次根据attr_id相同的数据进行分组
      foreach ($goodsAttrs as $key=>$value) {
        $attr_list[$value['attr_id']][] = $value;
      }
      // 获取商品相册图片
      $imgs = M('goods_img')->where("goods_id={$id}")->select();
      // 给模板赋值并显示模板
      $this->assign(array(
        'data'=>$data,
        'cate'=>$cate,
        'types'=>$types,
        'imgs'=>$imgs,
        'goodsAttrs'=>$attr_list,
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

  // 删除商品相册图片
  public function delImg() {
    $id = intval(I('post.img_id'));
    if ($id<=0) {
      $this->ajaxReturn(array('status'=>'1001','msg'=>'参数错误！'));
    }
    $imgModel = M('goods_img');
    $info = $imgModel->where("id={$id}")->find();
    if (!$info){
      $this->ajaxReturn(array('status'=>'1002','msg'=>'查无此数据！'));
    }
    // 删除图片
    unlink($info['goods_img']);
    unlink($info['goods_thumb']);
    // 删除数据库记录
    $info = $imgModel->where("id={$id}")->delete();
    if (!$info){
      $this->ajaxReturn(array('status'=>'1002','msg'=>'删除失败！'));
    }
    $this->ajaxReturn(array('status'=>'1000','msg'=>'删除成功！'));
  }
}
