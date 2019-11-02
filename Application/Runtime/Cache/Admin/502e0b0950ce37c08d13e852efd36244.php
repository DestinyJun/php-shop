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
<div class="main-container ace-save-state" id="main-container">
  <div id="sidebar" class="sidebar responsive ace-save-state" data-sidebar="true" data-sidebar-scroll="true" data-sidebar-hover="true">
    <ul class="nav nav-list" style="top: 0;">
      <li class="active">
        <a href="<?php echo U('Index/right');?>" target="rightFrame">
          <i class="menu-icon fa fa-tachometer"></i>
          <span class="menu-text">系统首页</span>
        </a>
        <b class="arrow"></b>
      </li>
      <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; if(($item["parent_id"]) == "0"): ?><li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-desktop"></i>
              <span class="menu-text"><?php echo ($item["rule_name"]); ?></span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
              <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["parent_id"]) == $item["id"]): ?><li class="">
                    <a href="<?php echo U($vo['controller_name'].'/'.$vo['action_name']);?>" target="rightFrame">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <?php echo ($vo["rule_name"]); ?>
                    </a>
                    <b class="arrow"></b>
                  </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
</div>
</body>
<!--<body class="no-skin">
<div id="sidebar" class="sidebar responsive ace-save-state" data-sidebar="true" data-sidebar-scroll="true" data-sidebar-hover="true">
  <ul class="nav nav-list" style="top: 0;" id="navList">
    <li class="active">
      <a href="<?php echo U('Index/right');?>" target="rightFrame">
        <i class="menu-icon fa fa-tachometer"></i>
        <span class="menu-text">系统首页</span>
      </a>
      <b class="arrow"></b>
      <ul class="submenu nav-hide" style="display: none;">
        <li class="">
          <a href="tables.html">
            <i class="menu-icon fa fa-caret-right"></i>
            Simple &amp; Dynamic
          </a>

          <b class="arrow"></b>
        </li>

        <li class="">
          <a href="jqgrid.html">
            <i class="menu-icon fa fa-caret-right"></i>
            jqGrid plugin
          </a>
          <b class="arrow"></b>
        </li>
      </ul>
    </li>
    <li>
      <a href="<?php echo U('Category/index');?>" target="rightFrame">
        <i class="menu-icon fa fa-desktop"></i>
        <span class="menu-text">分类管理</span>
      </a>
      <b class="arrow"></b>
    </li>
    <li>
      <a href="<?php echo U('Goods/index');?>" target="rightFrame">
        <i class="menu-icon fa fa-list"></i>
        <span class="menu-text">商品管理</span>
      </a>
      <b class="arrow"></b>
    </li>
    <li>
      <a href="<?php echo U('User/index');?>" target="rightFrame">
        <i class="menu-icon fa fa-pencil-square-o"></i>
        <span class="menu-text">用户管理</span>
      </a>
      <b class="arrow"></b>
    </li>
    <li>
      <a href="<?php echo U('Role/index');?>" target="rightFrame">
        <i class="menu-icon fa fa-pencil-square-o"></i>
        <span class="menu-text">角色管理</span>
      </a>
      <b class="arrow"></b>
    </li>
    <li>
      <a href="<?php echo U('Rule/index');?>" target="rightFrame">
        <i class="menu-icon fa fa-calendar"></i>
        <span class="menu-text">权限管理</span>
      </a>
      <b class="arrow"></b>
    </li>
  </ul>
</div>
</body>-->
<script src="/Public/Admin/Js/jquery-2.1.4.min.js"></script>
<script src="/Public/Admin/Js/bootstrap.min.js"></script>
<script src="/Public/Admin/Js/ace.min.js"></script>
<script>
  $(".nav li").on('click',function (event) {
    // event.stopPropagation();
    $(".nav li").removeClass('active');
    $(this).addClass('active');
  })
</script>
</html>