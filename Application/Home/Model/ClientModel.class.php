<?php
namespace Home\Model;
use Think\Model;

final class ClientModel extends Model
{
  public function regist($username,$password) {
    // （1）判断用户名是否存在
    $info = $this->where("username='{$username}'")->find();
    if ($info) {
      $this->error = '用户名重复';
      return false;
    }
    // （2）生成密码盐
    $salt = rand(100000,999999);
    // （3）生成双重MD5之后密码
    $db_password = md5(md5($password).$salt);
    // （4）写入数据库
    $data = array(
      'username'=>$username,
      'password'=>$db_password,
      'salt'=>$salt
    );
    return $this->add($data);
  }

  public function login ($username,$password) {
    // （1）判断用户名是否存在
    $info = $this->where("username='{$username}'")->find();
    if (!$info) {
      $this->error = '用户名或密码错误';
      return false;
    }
    // （2）加密密码进行比对
    $db_password = md5(md5($password).$info['salt']);
    if ($db_password != $info['password']) {
      $this->error = '用户名或密码错误';
      return false;
    }
   // 验证成功，保存用户状态
    session('client',$info);
    session('client_id',$info['id']);
    // 登陆成功后转移购物车中的数据
    D('Cart')->cookie2db();
    return true;
  }
}
