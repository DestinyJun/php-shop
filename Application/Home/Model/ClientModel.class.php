<?php
namespace Home\Model;
use Think\Model;

final class ClientModel extends Model
{
  protected $fields = array('id','username','password','tel','email','active_code','status','salt','openid');
  public function regist($username,$password, $tel, $email) {
    // （1）判断用户名是否存在
    $info = $this->where("username='{$username}'")->find();
    if ($info) {
      $this->error = '用户名重复';
      return false;
    }
    // 判断手机号是否重复
    $info = $this->where("tel='{$tel}'")->find();
    if ($info) {
      $this->error = '手机号重复';
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
      'tel'=>$tel,
      'email'=>$email,
      'active_code'=>uniqid(), // 生成唯一激活码
      'status'=>1,
      'salt'=>$salt
    );
    $client_id =  $this->add($data);
    $data['client_id'] = $client_id;
    return $data;
  }

  public function login ($username,$password) {
    // （1）判断用户名是否存在
    $info = $this->where("username='{$username}'")->find();
    if (!$info) {
      $this->error = '用户名或密码错误';
      return false;
    }
    // （2）检查用户是否激活
    if ($info['status'] != 1) {
      $this->error = '该用户没有激活';
      return false;
    }
    // （3）加密密码进行比对
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

  public function qqLogin($client,$openid) {
    // 生成密码盐
    $salt = rand(100000,999999);
    // 生成双重MD5之后密码
    $db_password = md5(md5('123456').$salt);
    // 先判断此QQ号是否已经注册
    $data = $this->where("openid={$openid}")->find();
    if (!$data) {
      // 没有注册，就给注册
      $data = array(
        'username'=>"qquser_".rand(1000,9999),"{$client['nikename']}", // 随机生成用户名
        'password'=>$db_password,
        'salt'=>$salt,
        'status'=>1,
        'openid'=>$openid
      );
      $data['id'] = $this->add($data);
    }
    // 验证成功，保存用户状态
    session('client',$data);
    session('client_id',$data['id']);
    // 登陆成功后转移购物车中的数据
    D('Cart')->cookie2db();
  }
}
