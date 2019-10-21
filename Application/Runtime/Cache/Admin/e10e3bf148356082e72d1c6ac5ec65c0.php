<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>header</title>
  <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
  <link rel="stylesheet" href="/Public/Admin/css/font-awesome.min.css">
  <link rel="stylesheet" href="/Public/Admin/css/fonts.googleapis.com.css">
  <link rel="stylesheet" href="/Public/Admin/css/ace.css">
</head>
<body>
<div id="navbar" class="navbar navbar-default ace-save-state">
  <div class="navbar-container ace-save-state" id="navbar-container">
    <div class="navbar-header pull-left">
      <a href="<?php echo U('index');?>" class="navbar-brand">
        <small>
          <i class="fa fa-leaf"></i>
          数据管理
        </small>
      </a>
    </div>
    <div class="navbar-buttons navbar-header pull-right" role="navigation">
      <ul class="nav ace-nav">
        <li class="grey dropdown-modal">
          <a href="<?php echo U('Login/login');?>" class="btn btn-danger">退出</a>
          <!--<a data-toggle="dropdown" class="dropdown-toggle" href="http://ace.jeka.by/index.html#">
            &lt;!&ndash;<i class="ace-icon fa fa-tasks"></i>&ndash;&gt;
            <span class="badge badge-grey">退出</span>
          </a>-->
        </li>
        <!-- <li class="purple dropdown-modal">
           <a data-toggle="dropdown" class="dropdown-toggle" href="http://ace.jeka.by/index.html#">
             <i class="ace-icon fa fa-bell icon-animated-bell"></i>
             <span class="badge badge-important">8</span>
           </a>
         </li>
         <li class="green dropdown-modal">
           <a data-toggle="dropdown" class="dropdown-toggle" href="http://ace.jeka.by/index.html#">
             <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
             <span class="badge badge-success">5</span>
           </a>
         </li>-->
        <li class="light-blue dropdown-modal">
          <a data-toggle="dropdown" href="javascript:void(0)" class="dropdown-toggle">
            <img class="nav-user-photo" src="/Public/Admin/Images/user.jpg" alt="Jason&#39;s Photo">
            <span class="user-info">
                    <small>欢迎您！</small>
                    admin
                  </span>

            <i class="ace-icon fa fa-caret-down"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
</body>
</html>