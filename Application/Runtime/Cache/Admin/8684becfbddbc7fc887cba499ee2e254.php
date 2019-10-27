<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>
    权限管理
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
            权限列表
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
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            
  <div class="add-btn">
    <a href="<?php echo U('add');?>" class="btn btn-warning">权限添加</a>
  </div>
  <table id="simple-table" class="table  table-bordered table-hover">
    <thead>
    <tr>
      <th class="center">
        <label class="pos-rel">
          <input type="checkbox" class="ace">
          <span class="lbl"></span>
        </label>
      </th>
      <th class="detail-col">#</th>
      <th>权限名称</th>
      <th>模块名称</th>
      <th>控制器名称</th>
      <th>方法名称</th>
      <th>是否导航显示</th>
      <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($rule)): $k = 0; $__LIST__ = $rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><tr>
        <td class="center">
          <label class="pos-rel">
            <input type="checkbox" class="ace">
            <span class="lbl"></span>
          </label>
        </td>
        <td class="center"><?php echo ($k); ?></td>
        <td>
          |<?php echo (str_repeat('----',$item["level"])); ?>
          <?php echo ($item["rule_name"]); ?>
        </td>
        <td><?php echo ($item["module_name"]); ?></td>
        <td><?php echo ($item["controller_name"]); ?></td>
        <td><?php echo ($item["action_name"]); ?></td>
        <td>
          <?php if($item["is_show"] == 1 ): ?>是
          <?php else: ?>
            否<?php endif; ?>
        </td>
        <td>
          <div class="hidden-sm hidden-xs btn-group">
            <a class="btn btn-xs btn-info" href="<?php echo U('edit','id='.$item['id']);?>">
              <i class="ace-icon fa fa-pencil bigger-120"></i>
            </a>
            <button class="btn btn-xs btn-danger" onclick="deleteItem('<?php echo ($item["id"]); ?>')">
              <i class="ace-icon fa fa-trash-o bigger-120"></i>
            </button>
          </div>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>

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
    function deleteItem(id) {
      if (window.confirm('确定要删除吗？')) {
        location.href = "/rule/del/id/"+id;
      }
    }
  </script>

</html>