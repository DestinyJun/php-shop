<?php
namespace Home\Controller;
use Think\Verify;

final class ClientController extends CommonController
{
  public function register() {
    if(IS_GET) {
      $this->display();
    } else {
      $username = I('post.username');
      $password = I('post.password');
      $fireword = I('post.fireword');
      $code     = I('post.code');
      $codeObj = new Verify();
      if (!$codeObj->check($code)) {
        $this->ajaxReturn(array(
          'status'=> 1001,
          'message'=>'验证码错误',
        ));
      }
      if ($password != $fireword) {
        $this->ajaxReturn(array(
          'status'=> 1002,
          'message'=>'两次输入的密码不一致！',
        ));
      }
      $model = D('Client');
      $res = $model->regist($username,$password);
      if(!$res){
        $this->ajaxReturn(array(
          'status'=> 1003,
          'message'=>$model->getError(),
        ));
      }
      $this->ajaxReturn(array(
        'status'=> 1000,
        'message'=>'注册成功！',
      ));
    }
  }

  public function code() {
    $config = array(
      'length'    =>4,
      'imageH'    =>40,
      'imageW'    =>90,
      'fontSize'  =>14,
    );
    $code = new Verify($config);
    $code->entry();
  }

  public function login() {
    if (IS_GET) {
      $this->display();
    } else {
      $username = I('post.username');
      $password = I('post.password');
      $code     = I('post.code');
      $codeObj = new Verify();
      if (!$codeObj->check($code)) {
        $this->ajaxReturn(array(
          'status'=> 1001,
          'message'=>'验证码错误',
        ));
      }
      $model = D('Client');
      $res = $model->login($username,$password);
      if(!$res){
        $this->ajaxReturn(array(
          'status'=> 1003,
          'message'=>$model->getError(),
        ));
      }
      $this->ajaxReturn(array(
        'status'=> 1000,
        'message'=>'登陆成功！',
      ));
    }
  }

  public function logout() {
    session('client',null);
    session('client_id',null);
    $this->redirect('/');
  }
}
