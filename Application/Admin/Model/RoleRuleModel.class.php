<?php
namespace Admin\Model;

class RoleRuleModel extends CommonModel
{
  protected $fields = array('id','role_id','rule_id');

  public function disfetch($role_id,$rules) {
    // （1）清空原来角色所对应的权限
    $this->where("role_id={$role_id}")->delete();
    // （2）给角色添加新的权限
    foreach ($rules as $value) {
      $list[] = array(
        'role_id'=>$role_id,
        'rule_id'=>$value,
      );
    }
    return $this->addAll($list);
  }

  public function getRules($role_id){
    return $this->where("role_id={$role_id}")->select();
  }
}
