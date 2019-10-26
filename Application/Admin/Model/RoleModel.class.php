<?php
namespace Admin\Model;
use Admin\Common\MyPage;

class RoleModel extends CommonModel
{
  protected $fields = array('id','role_name');
  protected $_validate = array(
    array('role_name','require','角色名称是必填项'),
    array('role_name','','角色名称已存在',1,'unique'),
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

  public function remove($role_id) {
    return $this->where("id={$role_id}")->delete();
  }
}
