<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>
    用户管理
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
            用户添加
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
            
  <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
    <!--用户名-->
    <div class="form-group">
      <label for="username" class="col-xs-12 col-sm-3 control-label no-padding-right">用户名</label>
      <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <input type="text" id="username" class="width-100" name="username">
          <i class="ace-icon fa fa-leaf"></i>
        </span>
      </div>
      <div class="help-block col-xs-12 col-sm-reset inline">
        <span class="text-danger">*</span>
        用户名必填
      </div>
    </div>
    <!--密码-->
    <div class="form-group">
      <label for="password" class="col-xs-12 col-sm-3 control-label no-padding-right">密码</label>
      <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <input type="password" id="password" class="width-100" name="password">
          <i class="ace-icon fa fa-leaf"></i>
        </span>
      </div>
      <div class="help-block col-xs-12 col-sm-reset inline">
        <span class="text-danger">*</span>
        <span>密码是必填项</span>
      </div>
    </div>
    <!--角色选择-->
    <div class="form-group">
      <label for="role_id" class="col-xs-12 col-sm-3 control-label no-padding-right">角色选择</label>
      <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <select class="chosen-select form-control" id="role_id" name="role_id" style="cursor: pointer">
            <option value="" selected>|--请选择角色--</option>
            <?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>">
                <?php echo ($item["role_name"]); ?>
              </option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span>
      </div>
      <div class="help-block col-xs-12 col-sm-reset inline">
        <span class="text-danger">*</span>
        <span>请选择角色</span>
      </div>
    </div>
    <!--提交-->
    <div class="form-group text-center">
      <button class="btn btn-info" type="submit" id="button">提交</button>
      <a class="btn btn-warning" href="<?php echo U('index');?>">返回</a>
    </div>
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

  <script>
    /*$("#button").on('click', function () {
      $.ajax({
        url: "<?php echo U('add');?>",
        type: "POST",
        dataType: "JSON",
        data: {
          cname: $("#cname").val(),
          parent_id: $("#parent_id").val(),
          isrec: $("input[name='isrec']:checked").val(),
        },
        success: function (data) {
          console.log(data);
        }
      })
    })*/
  </script>

</html>