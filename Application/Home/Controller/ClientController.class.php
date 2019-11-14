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
      // 发送激活邮件
      // 拼接激活链接
      $link = "//www.wshop.com".U('active')."?client_id={$res['client_id']}&active_code={$res['active_code']}";
      $content = "<p>点击连接激活：<a>$link</a></p>";
      $result = sendEmail($email,'文君电商',"$content");

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

  public function active() {
    $client_id = I('get.client_id');
    $active_code = I('get.active_code');
    $model = D('Client');
    $info = $model->where("id=$client_id")->find();
    if (!$info) {
      $this->error('参数错误',U('login'));
    }
    if ($info['status'] == 1) {
      $this->error('该用户已经激活',U('login'));
    }
    if ($info['active_code'] != $active_code) {
      $this->error('激活码错误',U('login'));
    }
    $model->where("id=$client_id")->setField('status',1);
    $this->success('激活成功！',U('login'));
  }

  // QQ登陆
  public function oauth() {
    require_once("qq/API/qqConnectAPI.php");
    $qc = new \QC();
    $qc->qq_login();
  }

  // QQ授权登陆后的回调
  public function callback() {
    require_once("qq/API/qqConnectAPI.php");
    $qc = new \QC();
    $access_token = $qc->qq_callback(); // 拿到access_token
    $openid       = $qc->get_openid(); // 拿到qq用户的openid,是某一个用户的唯一标识

    // 在获取用户信息之前，再次实例化QC对象可以防止网络已经修改了QQ信息的报错问题报错问题,此时需要把$access_token跟$openid传入
    $qc = new \QC($access_token,$openid);
    $client = $qc->get_user_info(); // 拿到qq用户的基本信息
    // 把QQ授权后的详细信息写入数据库
    $model = D('Client');
    $model->qqLogin($client,$openid);
    $this->success('操作成功！',U('Index/index'));
  }

  public function test() {
    $data = array(
      'username'=>'wwj',
      'password'=>'1',
      'c'=>'user', // 指定api接口中的具体控制器
      'a'=>'login',// 指定api接口中的具体方法
    );
    $res = get_data($data,'get');
    $this->ajaxReturn($res);
  }
}
