<?php
namespace Admin\Model;
use Admin\Common\MyPage;

class AttributeModel extends CommonModel
{
  protected $fields = array('id','attr_name','type_id','attr_type','attr_input_type','attr_value');
  protected $_validate = array(
    array('attr_name','require','类型名称是必填项'),
    array('attr_name','','类型名称已存在',1,'unique'),
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
