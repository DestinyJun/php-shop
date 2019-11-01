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
            
  <form action="" method="post">
    <table id="simple-table" class="table  table-bordered table-hover">
      <thead>
      <tr>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><th><?php echo ($item[0]['attr_name']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
        <th>数量</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><td>
            <select class="chosen-select form-control" name="attr[<?php echo ($item["0"]["attr_id"]); ?>][]" style="cursor: pointer">
              <?php if(is_array($item)): $i = 0; $__LIST__ = $item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["attr_values"]); ?>"><?php echo ($vo["attr_values"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </td><?php endforeach; endif; else: echo "" ;endif; ?>
        <td>
          <label>
            <input type="text" class="form-control" name="goods_number[]">
          </label>
        </td>
        <td>
          <div class="hidden-sm hidden-xs btn-group">
            <input type="hidden" name="goods_id" value="<?php echo ($_GET['id']); ?>">
            <a class="btn btn-xs btn-danger" type="button" onclick="cloneThis(this)">增加</a>
          </div>
        </td>
      </tr>
      </tbody>
    </table>
    <div class="row">
      <div class="col-xs-12">
        <button class="btn btn-sm btn-success">提交</button>
        <button class="btn btn-sm btn-warning">返回</button>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col-xs-12">
      <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
        <?php echo ($page); ?>
      </div>
    </div>
  </div>

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
    function cloneThis(obj){
      var current = $(obj).parent().parent().parent();
      var newDom = current.clone();
      if ($(obj).html() === '增加') {
        newDom.find('a').html('减少');
        current.after(newDom);
      } else {
        current.remove();
      }
    }
  </script>

</html>