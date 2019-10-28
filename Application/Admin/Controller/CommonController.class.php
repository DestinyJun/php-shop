<?php
namespace Admin\Controller;
use Think\Controller;

abstract class CommonController extends Controller
{
  public $is_check_rule = true; // 判断账号是否需要查询权限
  public $user = array(); // 判断账号是否需要查询权限
  public function __construct()
  {
    parent::__construct();
    // 验证用户是否登陆状态
    $user = session('user');
    if (!$user) {
      $this->error('您还没有登陆！',U('Login/login'));
    }
    $this->user = S('user_'.$user['id']); // 先从文件中读取用户信息，看是否有
    if (!$this->user) {
      /**
       * 如果缓存中没有就读取数据库写入用户信息
       * ————保存用户信息开始————
       */
      $this->user = $user;
      // 根据用户id查询角色
      $role_info = D('UserRole')->where("user_id={$this->user['id']}")->find();
      // 将角色id保存到用户信息中
      $this->user['role_id'] = $role_info['role_id'];
      // 根据角色id判断用户是否是超级管理员,并保存权限信息
      if ($this->user['role_id']<=1) {
        $rules = D('Rule')->select(); // 超级管理员直接查询所有的权限信息
      } else {
        // 普通管理员，根据角色id拿到权限id
        $role_rule = D('RoleRule')->where("role_id={$this->user['role_id']}")->select();
        foreach ($role_rule as $value) {
          $rule_ids[] = $value['rule_id'];
        }
        $rule_ids = implode(',',$rule_ids);
        // 在根据权限id查出权限信息
        $rules = D('Rule')->where("id in ({$rule_ids})")->select();
      }
      foreach ($rules as $value) {
        // 将权限信息按照模块->控制器->方法的格式保存到用户信息中
        $this->user['rules'][] = $value['module_name'].'/'.$value['controller_name'].'/'.$value['action_name'];
        // 将导航菜单保存到用户信息中
        if ($value['is_show'] == 1){
          $this->user['menus'][] = $value;
        }
      }
      S('user_'.$user['id'],$this->user);
      /**
       * 把最后得到的用户信息写入到缓存（默认使用的缓存类型是文件的方式）
       * ————保存用户信息结束————
       */
    }
    // 超级管理员不验证权限
    if ($this->user['role_id']<=1) {
      $this->is_check_rule = false;
    }
    // 权限认证
    if($this->is_check_rule){
      // 需要注意一下，后台首页是每个账号都需要访问的界面
      $this->user['rules'][] = 'admin/index/index';
      $this->user['rules'][] = 'admin/index/top';
      $this->user['rules'][] = 'admin/index/left';
      $this->user['rules'][] = 'admin/index/right';
      $url = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
      if (!in_array($url,$this->user['rules'])) {
        if (IS_AJAX) {
          $this->ajaxReturn(array(
            'status'=>0,
            'msg'=> '没有权限'
          ));
        }else {
          echo '没有权限';
          exit();
        }
      }
    }
  }
}
