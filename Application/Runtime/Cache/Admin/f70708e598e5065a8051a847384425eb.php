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
            商品列表
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
            
  <div class="row">
    <div class="col-sm-4">
      <a href="<?php echo U('add');?>" class="btn btn-sm btn-warning">商品添加</a>
    </div>
    <div class="col-sm-8">
      <form action="<?php echo U('index');?>" method="get">
        <label for="category_id" class="col-xs-12 col-sm-2 control-label no-padding-right">
          <span class="block input-icon input-icon-right">
          <select class="chosen-select form-control" id="category_id" name="category_id" style="cursor: pointer">
            <option value="" selected>|--请选择--</option>
            <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>" <?php if(($_GET['category_id']) == $item["id"]): ?>selected<?php endif; ?>>
                |<?php echo (str_repeat("----",$item["level"])); ?>
                <?php echo ($item["cname"]); ?>
              </option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span>
        </label>
        <label for="intro_type" class="col-xs-12 col-sm-2 control-label no-padding-right">
          <span class="block input-icon input-icon-right">
          <select class="chosen-select form-control" id="intro_type" name="intro_type" style="cursor: pointer">
            <option value="0">全部</option>
            <option value="is_rec" <?php if(($_GET['intro_type']) == "is_rec"): ?>selected<?php endif; ?>>推荐</option>
            <option value="is_new" <?php if(($_GET['intro_type']) == "is_new"): ?>selected<?php endif; ?>>新品</option>
            <option value="is_hot" <?php if(($_GET['intro_type']) == "is_hot"): ?>selected<?php endif; ?>>热销</option>
          </select>
        </span>
        </label>
        <label for="is_sale" class="col-xs-12 col-sm-2 control-label no-padding-right">
          <span class="block input-icon input-icon-right">
          <select class="chosen-select form-control" id="is_sale" name="is_sale" style="cursor: pointer">
            <option value="0">全部</option>
            <option value="1" <?php if(($_GET['is_sale']) == "1"): ?>selected<?php endif; ?>>上架</option>
            <option value="2" <?php if(($_GET['is_sale']) == "2"): ?>selected<?php endif; ?>>下架</option>
          </select>
        </span>
        </label>
        <label for="keyword" class="col-xs-12 col-sm-4 control-label no-padding-right">
          <span class="block input-icon input-icon-right">
            <input type="text" id="keyword" class="width-100" name="keyword" placeholder="请输入关键字" value="<?php echo ($_GET['keyword']); ?>">
            <i class="ace-icon fa fa-leaf"></i>
          </span>
        </label>
        <div class="help-block col-xs-12 col-sm-reset inline" style="margin-top: 0;margin-left: 10px">
          <button class="btn btn-sm btn-info" type="submit">搜索</button>
        </div>
      </form>
    </div>
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
      <th width="30%">商品名称</th>
      <th>货号</th>
      <th>市场价</th>
      <th>本店价</th>
      <th>上架</th>
      <th>推荐</th>
      <th>新品</th>
      <th>热销</th>
      <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><tr>
        <td class="center">
          <label class="pos-rel">
            <input type="checkbox" class="ace">
            <span class="lbl"></span>
          </label>
        </td>
        <td class="center"><?php echo ($k); ?></td>
        <td><?php echo ($item["goods_name"]); ?></td>
        <td><?php echo ($item["goods_sn"]); ?></td>
        <td><?php echo ($item["market_price"]); ?></td>
        <td><?php echo ($item["shop_price"]); ?></td>
        <td><?php if($item["is_sale"] == 1 ): ?>是<?php else: ?>否<?php endif; ?></td>
        <td><?php if($item["is_rec"] == 1 ): ?>是<?php else: ?>否<?php endif; ?></td>
        <td><?php if($item["is_new"] == 1 ): ?>是<?php else: ?>否<?php endif; ?></td>
        <td><?php if($item["is_hot"] == 1 ): ?>是<?php else: ?>否<?php endif; ?></td>
        <td>
          <div class="hidden-sm hidden-xs btn-group">
            <a class="btn btn-xs btn-success" href="<?php echo U('edit','id='.$item['id']);?>">
              编辑
            </a>
            <a class="btn btn-xs btn-primary" href="<?php echo U('setNumber','id='.$item['id']);?>">
              库存
            </a>
            <button class="btn btn-xs btn-danger" onclick="deleteItem('<?php echo ($item["id"]); ?>')" type="button">
              删除
            </button>
          </div>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
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
    function deleteItem(id) {
      if (window.confirm('确定要删除吗？')) {
        location.href = "/goods/del/id/"+id;
      }
    }
  </script>

</html>