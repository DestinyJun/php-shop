<?php
namespace Home\Model;
use Admin\Common\MyPage;
use Think\Model;

class CommentModel extends Model
{
  // 数据模型字段自定义
  protected $fields = array('id','client_id','goods_id','addtime','content','star','goods_number');

  // 数据自动化校验

  //数据插入之前补全参数
  protected function _before_insert(&$data,$option)
  {
    $data['addtime'] = time();
    $data['client_id'] = session('client_id');
  }

  // 评论入库后武库商品印象
  public function _after_insert($data,$option)
  {
    $imModel = M('impression');
    $name = I('post.name');
    $name = explode(',',$name); // 将字符串转为数组
    $name =array_unique($name); // 去除数组中重复的数据
    // 实现勾选印象入库
    $old = I('post.old');
    foreach ($old as $key=>$value) {
      $imModel->where("id={$value}")->setInc('count'); // 给字段做加法，不填第二个参数默认+1
    }
    // 直接输入印象入库
    foreach ($name as $key=>$value) {
      // 还需要判断下用户是否输入有印象，为空时处理
      if (!$value) {
        continue;
      }
      // 还要判断当前印象是否存在，存在就更新数值，不存在才添加新的
      $info = $imModel->where("goods_id={$data['goods_id']} AND name='{$value}'")->find();
      if ($info) {
        $imModel->where("id={$info['id']}")->setInc('count'); // 给字段做加法，不填第二个参数默认+1
      } else {
        $data[] = array(
          'goods_id'=>$data['goods_id'],
          'name'=>$value,
          'count'=>1,
        );
      }
    }
    // 实现评论总数的增加
    M('goods')->where("id={$data['goods_id']}")->setInc('plcount');
    if ($data) {
      $imModel->addAll($data);
    }
  }

  public function getCommentList($goods_id) {
    // 分页
    $count = $this->where("goods_id={$goods_id}")->count();
    $pagesize = 5;
    $page = new MyPage($count,$pagesize);
    $page->setConfig('is_anchor',true); // 启动锚点功能
    $str = $page->show();
    $p = I('get.p');
    $data = $this->alias('a')->
    field('a.*,b.username')->
    join("left join wj_client b on a.client_id=b.id")->
    where("a.goods_id={$goods_id}")->
    page($p,$pagesize)->select();
    return array(
      'comment'=>$data,
      'page'=>$str
    );
  }
}
