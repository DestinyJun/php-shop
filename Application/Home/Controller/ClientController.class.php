<?php

namespace Home\Controller;

use Think\Verify;

final class ClientController extends CommonController
{
  public function register()
  {
    if (IS_GET) {
      $this->display();
    } else {
      $username = I('post.username');
      $password = I('post.password');
      $fireword = I('post.fireword');
      $tel = I('post.tel');
      $verification = I('post.verification');
      $email = I('post.email');
      $emailcode = I('post.emailcode');

      // 检查手机验证码是否存在
      if (!$verification) {
        $this->ajaxReturn(array(
          'status' => 1007,
          'message' => '请输入手机验证码',
        ));
      }
      $telcode = session('telcode');
      if (!$telcode) {
        $this->ajaxReturn(array(
          'status' => 1007,
          'message' => '手机验证码没发送',
        ));
      }

      // 判断验证码是否过期以及是否错误
      if ($telcode['time']+$telcode['limit'] < time()) {
        $this->ajaxReturn(array(
          'status' => 1008,
          'message' => '手机验证码过期',
        ));
      }
      if ($telcode['code'] != $verification) {
        $this->ajaxReturn(array(
          'status' => 1009,
          'message' => '手机验证码错误',
        ));
      }

      // 判断邮箱验证码是否正确
      $emailcode = session('telcode');
      if ($emailcode['code'] != $emailcode) {
        $this->ajaxReturn(array(
          'status' => 1009,
          'message' => '邮箱验证码错误',
        ));
      }

      // 验证码
      $code = I('post.code');
      $codeObj = new Verify();
      if (!$codeObj->check($code)) {
        $this->ajaxReturn(array(
          'status' => 1001,
          'message' => '验证码错误',
        ));
      }
      if ($password != $fireword) {
        $this->ajaxReturn(array(
          'status' => 1002,
          'message' => '两次输入的密码不一致！',
        ));
      }
      $model = D('Client');
      $res = $model->regist($username,$password,$tel,$email);
      if (!$res) {
        $this->ajaxReturn(array(
          'status' => 1003,
          'message' => $model->getError(),
        ));
      }
      $this->ajaxReturn(array(
        'status' => 1000,
        'message' => '注册成功！',
      ));
    }
  }

  public function code()
  {
    $config = array(
      'length' => 4,
      'imageH' => 40,
      'imageW' => 90,
      'fontSize' => 14,
    );
    $code = new Verify($config);
    $code->entry();
  }

  public function login()
  {
    if (IS_GET) {
      $this->display();
    } else {
      $username = I('post.username');
      $password = I('post.password');
      $code = I('post.code');
      $codeObj = new Verify();
      if (!$codeObj->check($code)) {
        $this->ajaxReturn(array(
          'status' => 1001,
          'message' => '验证码错误',
        ));
      }
      $model = D('Client');
      $res = $model->login($username, $password);
      if (!$res) {
        $this->ajaxReturn(array(
          'status' => 1003,
          'message' => $model->getError(),
        ));
      }
      $this->ajaxReturn(array(
        'status' => 1000,
        'message' => '登陆成功！',
      ));
    }
  }

  public function logout()
  {
    session('client', null);
    session('client_id', null);
    $this->redirect('/');
  }

  public function verification()
  {
    $tel = I('post.tel'); // 接收手机号
    $code = rand(1000,9999); // 生成四位验证码
    $res = sendTemplateSMS($tel,array($code,'60'),"1");
    if (!$res) {
      $this->ajaxReturn(array('status'=>1006,'message'=>'发送失败！'));
    }
    // 保存验证码及过期时间
    $data = array(
      'tel'=>$tel,
      'code'=>$code,
      'time'=>time(),
      'limit'=>3600
    );
    session('telcode',$data);
    $this->ajaxReturn(array('status'=>1000,'message'=>'发送成功！'));
  }

  public function email()
  {
    $email = I('post.email');
    $code = rand(1000,9999); // 生成四位验证码
    $res = sendEmail($code,$email);
    if (!$res) {
      $this->ajaxReturn(array('status'=>1006,'message'=>'发送失败！'));
    }
    // 保存验证码及过期时间
    $data = array(
      'email'=>$email,
      'code'=>$code,
      'time'=>time(),
      'limit'=>3600
    );
    session('emailcode',$data);
    $this->ajaxReturn(array('status'=>1000,'message'=>'发送成功！'));
  }

  public function test() {
    $res = sendEmail('1234','wxmwsw0858@163.com');
    dump($res);
  }
}
