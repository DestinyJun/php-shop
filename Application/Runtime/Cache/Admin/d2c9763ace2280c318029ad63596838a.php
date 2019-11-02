<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>
    产品分类管理
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
            分类编辑
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
            
  <form class="form-horizontal" action="<?php echo U('edit');?>" method="post">
    <!--分类名称-->
    <div class="form-group">
      <label for="cname" class="col-xs-12 col-sm-3 control-label no-padding-right">分类名称</label>
      <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <input type="text" id="cname" class="width-100" name="cname" value="<?php echo ($category["cname"]); ?>">
          <i class="ace-icon fa fa-leaf"></i>
        </span>
      </div>
      <div class="help-block col-xs-12 col-sm-reset inline">
        <span class="text-danger">*</span>
        长度为5-15位（字母、数字），不能含有特殊符号
      </div>
    </div>
    <!--父分类-->
    <div class="form-group">
      <label for="parent_id" class="col-xs-12 col-sm-3 control-label no-padding-right">父分类</label>
      <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <select class="chosen-select form-control" id="parent_id" name="parent_id" style="cursor: pointer">
            <option value="" >无</option>
            <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>"<?php if($category["parent_id"] == $item['id']): ?>selected<?php endif; ?>>
                |<?php echo (str_repeat("----",$item["level"])); ?>
                <?php echo ($item["cname"]); ?>
              </option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span>
      </div>
    </div>
    <!--是否推荐-->
    <div class="form-group">
      <span class="col-xs-12 col-sm-3 control-label no-padding-right">是否推荐</span>
      <div class="col-xs-12 col-sm-5">
        <label>
          <input name="isrec" type="radio" class="ace" value="1"<?php if($category["isrec"] == '1'): ?>checked<?php endif; ?>/>
          <span class="lbl">是</span>
        </label>
        <label>
          <input name="isrec" type="radio" class="ace" value="0"<?php if($category["isrec"] == '0'): ?>checked<?php endif; ?>/>
          <span class="lbl">否</span>
        </label>
      </div>
    </div>
    <!--提交-->
    <div class="form-group text-center">
      <input type="hidden" name="id" value="<?php echo ($category["id"]); ?>">
      <button class="btn btn-info" type="submit">提交</button>
      <a class="btn btn-warning" href="">返回</a>
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

  <script>
    $("#button").on('click', function () {
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
    })
  </script>

</html>