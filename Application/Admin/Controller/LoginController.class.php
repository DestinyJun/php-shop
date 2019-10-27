<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;

class LoginController extends Controller
{
  public function login() {
    if (IS_GET){
      $this->display();
    } else {
      $captcha = I('post.captcha');
      // 验证验证码
      $code = new Verify();
      $res = $code->check($captcha);
      if(!$res) {
        $this->error('验证码不正确');
      }
      // 验证用户名密码
      $username = I('post.username');
      $password = I('post.password');
      $userModel = D('User');
      $res = $userModel->login($username,$password);
      if (!$res) {
        $this->error($userModel->getError());
      }
      $this->success('登陆成功！',U('Index/index'));
    }
  }
  public function verify() {
    // 验证码配置,如果GD库开启了也不能生成验证码，可以先调用ob_clean()函数在生成验证码
    $config = array(
      'length'    =>4,
      'imageH'    =>34,
      'imageW'    =>130,
      'fontSize'  =>18,
    );
    $code = new Verify($config);
    $code->entry();
  }
}
