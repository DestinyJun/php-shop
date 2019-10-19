<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>侧边导航栏</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
  <link rel="stylesheet" href="/Public/Admin/css/font-awesome.min.css">
  <link rel="stylesheet" href="/Public/Admin/css/fonts.googleapis.com.css">
  <link rel="stylesheet" href="/Public/Admin/css/ace.css">
</head>
<body class="no-skin">
<div id="sidebar" class="sidebar responsive ace-save-state" data-sidebar="true" data-sidebar-scroll="true" data-sidebar-hover="true">
  <ul class="nav nav-list" style="top: 0;" id="navList">
    <li class="active">
      <a href="<?php echo U('Index/right');?>" target="rightFrame">
        <i class="menu-icon fa fa-tachometer"></i>
        <span class="menu-text">系统首页</span>
      </a>
      <b class="arrow"></b>
    </li>
    <li>
      <a href="<?php echo U('Category/index');?>" target="rightFrame">
        <i class="menu-icon fa fa-desktop"></i>
        <span class="menu-text">分类管理</span>
      </a>
      <b class="arrow"></b>
    </li>
    <li>
      <a href="javascript:void(0)">
        <i class="menu-icon fa fa-list"></i>
        <span class="menu-text">新闻管理</span>
      </a>
      <b class="arrow"></b>
    </li>
    <li>
      <a href="javascript:void(0)">
        <i class="menu-icon fa fa-pencil-square-o"></i>
        <span class="menu-text">分类管理</span>
      </a>
      <b class="arrow"></b>
    </li>
    <li>
      <a href="javascript:void(0)">
        <i class="menu-icon fa fa-calendar"></i>
        <span class="menu-text">友情链接</span>
      </a>
      <b class="arrow"></b>
    </li>
  </ul>
</div>
</body>
<script src="/Public/Admin/Js/jquery-2.1.4.min.js"></script>
<script src="/Public/Admin/Js/bootstrap.min.js"></script>
<script src="/Public/Admin/Js/ace.min.js"></script>
<script>
  $("#navList > li").on('click',function () {
    $("#navList > li").removeClass('active');
    $(this).addClass('active');
  })
  // var controller = location.href.split('?')[1].split('&')[0].split('=')[1];
  /*for (let i =0;i<$("#navList > li").length;i++) {
    if ($($("#navList > li")[i]).data().c === controller) {
      $($("#navList > li")[i]).addClass('active')
    }
  }*/
</script>
</html>