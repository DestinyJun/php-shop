<?php
namespace Admin\Model;
use Admin\Common\MyPage;

class UserModel extends CommonModel
{
  protected $fields = array('id','username','password');
  protected $_validate = array(
    array('username','require','用户名是必填项'),
    array('username','','用户名已存在',1,'unique'),
    array('password','require','密码是必填项'),
  );
  protected $_auto = array(
    array('password','md5',3,'function')
  );

  protected function _after_insert($data, $options)
  {
    $model  = D('UserRole');
    $role_id = I('post.role_id');
    $data = array(
      'user_id'=>$data['id'],
      'role_id'=>$role_id,
    );
    $model->add($data);
  }

  public function listDate() {
    $pagesize = 3;
    $count = $this->count();
    $page = new MyPage($count,$pagesize);
    $pagestr = $page->show();
    $p = I('get.p');
    $data = $this->alias('a')->field("a.*,c.role_name")
      ->join("left join wj_user_role b on a.id = b.user_id")
      ->join("left join wj_role c on b.role_id = c.id")
      ->page($p,$pagesize)->select();
    return array(
      'data' => $data,
      'page' => $pagestr
    );
  }

  public function remove($user_id) {
    $this->startTrans();
    // （1）删除用户
    $admin_res = $this->where("id={$user_id}")->delete();
    if (!$admin_res){
      $this->rollback();
      $this->error = '删除用户失败';
      return false;
    }
    // （2）删除用户对应的角色
    $role_res = D('UserRole')->where("user_id={$user_id}")->delete();
    if (!$role_res){
      $this->rollback();
      $this->error = '删除用户角色失败';
      return false;
    }
    $this->commit();
    return true;
  }

  public function findOne($user_id) {
    $data = $this->alias('a')
      ->field('a.*,b.role_id')
      ->join("left join wj_user_role b on b.user_id=a.id")
      ->where("a.id={$user_id}")
      ->find();
    return $data;
  }

  public function update($data){
    $this->startTrans();
    //（1）修改用户
    $user_update = $this->save($data);
    if (!$user_update) {
      $this->rollback();
      $this->error = '修改用户失败';
      return false;
    }
    //（2）修改用户对应的角色id
    $role_id = I('post.role_id');
    $role_update = D('UserRole')->where("user_id={$data['id']}")->save(array(
      'role_id'=>$role_id
    ));
    if (!$role_update) {
      $this->rollback();
      $this->error = '修改用户角色失败';
      return false;
    }
    $this->commit();
    return true;
  }

  public function login($username,$password) {
    // （1）验证用户名
    $user_info = $this->where("username='{$username}'")->find();
    if (!$user_info) {
      $this->error='用户名或密码不正确';
      return false;
    }
    // （2）验证密码
    if ($user_info['password'] != md5($password)) {
      $this->error='用户名或密码不正确';
      return false;
    }
    // 用户名密码验证成功，保存用户状态
    session('user',$user_info);
    return true;
  }
}
