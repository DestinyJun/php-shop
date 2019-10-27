<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>
    角色管理
  </title>
  <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
  <link rel="stylesheet" href="/Public/Admin/css/font-awesome.min.css">
  <link rel="stylesheet" href="/Public/Admin/css/fonts.googleapis.com.css">
  <link rel="stylesheet" href="/Public/Admin/css/ace.css">
</head>
<body>
<div class="main-container ace-save-state" id="main-container">
  <div class="main-content">
    <div class="main-content-inner">
      <!--内容导航-->
      <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
          <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="<?php echo U('Index/right');?>">主页</a>
          </li>
          <li class="active">
            
  <a href="<?php echo U('index');?>">角色管理</a>

          </li>
          <li class="active">
            角色权限配置
          </li>
        </ul>
        <div class="nav-search" id="nav-search">
          <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off">
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
          </form>
        </div>
      </div>
      <!--主体内容-->
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            
  <form action="" method="post">
    <table id="simple-table" class="table  table-bordered table-hover">
      <thead>
        <tr>
          <th>操作</th>
          <th>权限名称</th>
        </tr>
      </thead>
      <tbody>
        <?php if(is_array($rule)): $k = 0; $__LIST__ = $rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><tr>
            <td class="center">
              <label class="pos-rel">
                <input type="checkbox" class="ace" name="rule[]" value="<?php echo ($item["id"]); ?>" <?php if(in_array(($item["id"]), is_array($has_rule_id)?$has_rule_id:explode(',',$has_rule_id))): ?>checked<?php endif; ?>>
                <span class="lbl"></span>
              </label>
            </td>
            <td>
              |<?php echo (str_repeat('----',$item["level"])); ?>
              <?php echo ($item["rule_name"]); ?>
            </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
    <input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>">
    <button type="submit" class="btn btn-sm btn-danger">提交</button>
  </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script src="/Public/Admin/Js/jquery-2.1.4.min.js"></script>
<script src="/Public/Admin/Js/bootstrap.min.js"></script>
<script src="/Public/Admin/Js/ace.min.js"></script>

</html>