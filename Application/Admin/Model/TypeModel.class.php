<?php
namespace Admin\Model;
use Admin\Common\MyPage;

class TypeModel extends CommonModel
{
  protected $fields = array('id','type_name');
  protected $_validate = array(
    array('type_name','require','类型名称是必填项'),
    array('type_name','','类型名称已存在',1,'unique'),
  );

  public function listData() {
    $pagesize = 3;
    $count = $this->count();
    $page = new MyPage($count,$pagesize);
    $pageStr = $page->show();
    $p = intval(I('get.p'));
    if ($p<0) {
      $this->error = '分页参数错误';
      return false;
    }
    $data = $this->page($p,$pagesize)->select();
    return array(
      'data' => $data,
      'page' => $pageStr
    );
  }

  public function remove($id) {
    return $this->where("id={$id}")->delete();
  }
}
