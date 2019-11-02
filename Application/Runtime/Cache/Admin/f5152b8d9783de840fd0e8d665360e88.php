<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>
    商品管理
  </title>
  <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
  <link rel="stylesheet" href="/Public/Admin/css/font-awesome.min.css">
  <link rel="stylesheet" href="/Public/Admin/css/fonts.googleapis.com.css">
  <link rel="stylesheet" href="/Public/Admin/css/ace.css">
  <script src="/Public/Admin/Js/jquery-2.1.4.min.js"></script>
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
            商品库存管理
          </li>
          <li class="active">
            
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
      <div class="page-content overflow-scroll" style="height: 90vh">
        <div class="row">
          <div class="col-xs-12">
            
  <form action="" method="post" class="form-horizontal">
    <!--商品名称-->
    <div class="form-group">
      <label for="goods_number" class="col-xs-12 col-sm-3 control-label no-padding-right">请输入库存：</label>
      <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <input type="text" id="goods_number" class="width-100" name="goods_number" value="<?php echo ($data["goods_number"]); ?>">
          <i class="ace-icon fa fa-leaf"></i>
        </span>
      </div>
      <div class="help-block col-xs-12 col-sm-reset inline">
        <span class="text-danger">*</span>
        只能是数字，不能是汉字，不能含有特殊符号
      </div>
    </div>
    <div class="form-group text-center">
      <input type="hidden" name="goods_id" value="<?php echo ($_GET['id']); ?>">
      <button class="btn btn-sm btn-success" type="submit">提交</button>
      <a class="btn btn-sm btn-warning" href="<?php echo U('index');?>">返回</a>
    </div>
  </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script src="/Public/Admin/Js/bootstrap.min.js"></script>
<script src="/Public/Admin/Js/ace.min.js"></script>

</html>