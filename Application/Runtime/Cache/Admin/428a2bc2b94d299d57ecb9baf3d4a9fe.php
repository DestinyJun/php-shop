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
            商品修改
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
            
  <form class="form-horizontal" role="form" action="<?php echo U('edit');?>" method="post" enctype="multipart/form-data">
    <div class="widget-box transparent" id="recent-box">
      <div class="widget-header">
        <div class="widget-toolbar no-border" style="float: left;">
          <ul class="nav nav-tabs" id="recent-tab">
            <li><a data-toggle="tab" href="#task-tab">通用属性</a></li>
            <li><a data-toggle="tab" href="#member-tab">商品属性</a></li>
            <li class="active"><a data-toggle="tab" href="#member-img">商品相册</a></li>
          </ul>
        </div>
      </div>
      <div class="widget-body">
        <div class="widget-main padding-4">
          <div class="tab-content padding-8">
            <div id="task-tab" class="tab-pane">
              <!--商品名称-->
              <div class="form-group">
                <label for="goods_name" class="col-xs-12 col-sm-3 control-label no-padding-right">商品名称</label>
                <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <input type="text" id="goods_name" class="width-100" name="goods_name" value="<?php echo ($data["goods_name"]); ?>">
          <i class="ace-icon fa fa-leaf"></i>
        </span>
                </div>
                <div class="help-block col-xs-12 col-sm-reset inline">
                  <span class="text-danger">*</span>
                  字母、数字、汉字，不能含有特殊符号
                </div>
              </div>
              <!--商品货号-->
              <div class="form-group">
                <label for="goods_sn" class="col-xs-12 col-sm-3 control-label no-padding-right">商品货号</label>
                <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <input type="text" id="goods_sn" class="width-100" name="goods_sn" value="<?php echo ($data["goods_sn"]); ?>">
          <i class="ace-icon fa fa-leaf"></i>
        </span>
                </div>
                <div class="help-block col-xs-12 col-sm-reset inline">
                  <span class="text-danger">*</span>
                  <span>只能为数字（如果您不输入，系统将自动生成一个唯一的货号）</span>
                </div>
              </div>
              <!--商品分类-->
              <div class="form-group">
                <label for="category_id" class="col-xs-12 col-sm-3 control-label no-padding-right">商品分类</label>
                <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <select class="chosen-select form-control" id="category_id" name="category_id" style="cursor: pointer">
            <option value="" selected>|--请选择--</option>
            <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>" <?php if(($data["category_id"]) == $item["id"]): ?>selected<?php endif; ?>>
                |<?php echo (str_repeat("----",$item["level"])); ?>
                <?php echo ($item["cname"]); ?>
              </option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span>
                </div>
                <div class="help-block col-xs-12 col-sm-reset inline">
                  <span class="text-danger">*</span>
                  <span>商品分类必填</span>
                </div>
              </div>
              <!--扩展分类-->
              <div class="form-group" id="cate_exm">
                <label for="cate_id" class="col-xs-12 col-sm-3 control-label no-padding-right">扩展分类</label>
                <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <select class="chosen-select form-control" id="cate_id" name="cate_id[]" style="cursor: pointer">
            <option value="" selected>|--请选择--</option>
            <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>">
                |<?php echo (str_repeat("----",$item["level"])); ?>
                <?php echo ($item["cname"]); ?>
              </option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span>
                </div>
                <div class="help-block col-xs-12 col-sm-reset inline" style="margin-top: 0">
                  <button type="button" class="btn btn-sm btn-warning" id="addCate">增加扩展分类</button>
                </div>
              </div>
              <?php if(is_array($ext_cate)): $i = 0; $__LIST__ = $ext_cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="form-group">
                  <label class="col-xs-12 col-sm-3 control-label no-padding-right"></label>
                  <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <select class="chosen-select form-control" name="cate_id[]" style="cursor: pointer">
            <option value="" selected>|--请选择--</option>
            <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>" <?php if(($item["id"]) == $vo["category_id"]): ?>selected<?php endif; ?>>
                |<?php echo (str_repeat("----",$item["level"])); ?>
                <?php echo ($item["cname"]); ?>
              </option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span>
                  </div>
                  <div class="help-block col-xs-12 col-sm-reset inline" style="margin-top: 0">
                    <button type="button" class="btn btn-sm btn-danger" onclick="delCate(event)">删除扩展分类</button>
                  </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
              <!--本店售价-->
              <div class="form-group">
                <label for="shop_price" class="col-xs-12 col-sm-3 control-label no-padding-right">本店售价</label>
                <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <input type="number" id="shop_price" class="width-100" name="shop_price" value="<?php echo ($data["shop_price"]); ?>">
          <i class="ace-icon fa fa-leaf"></i>
        </span>
                </div>
                <div class="help-block col-xs-12 col-sm-reset inline">
                  <span class="text-danger">*</span>
                  <span>只能为数字</span>
                </div>
              </div>
              <!--是否上架-->
              <div class="form-group">
                <span class="col-xs-12 col-sm-3 control-label no-padding-right">是否上架</span>
                <div class="col-xs-12 col-sm-5">
                  <label>
                    <input name="is_sale" type="radio" class="ace" value="1" <?php if(($data["is_sale"]) == "1"): ?>checked<?php endif; ?>>
                    <span class="lbl">是</span>
                  </label>
                  <label>
                    <input name="is_sale" type="radio" class="ace" value="0" <?php if(($data["is_sale"]) == "0"): ?>checked<?php endif; ?>>
                    <span class="lbl">否</span>
                  </label>
                </div>
              </div>
              <!--加入推荐-->
              <div class="form-group">
                <span class="col-xs-12 col-sm-3 control-label no-padding-right">加入推荐</span>
                <div class="col-xs-12 col-sm-5">
                  <label>
                    <input name="is_hot" type="checkbox" class="ace" value="1" <?php if(($data["is_hot"]) == "1"): ?>checked<?php endif; ?>>
                    <span class="lbl">热卖</span>
                  </label>
                  <label>
                    <input name="is_new" type="checkbox" class="ace" value="1" <?php if(($data["is_new"]) == "1"): ?>checked<?php endif; ?>>
                    <span class="lbl">新品</span>
                  </label>
                  <label>
                    <input name="is_rec" type="checkbox" class="ace" value="1" <?php if(($data["is_rec"]) == "1"): ?>checked<?php endif; ?>>
                    <span class="lbl">推荐</span>
                  </label>
                </div>
              </div>
              <!--市场售价-->
              <div class="form-group">
                <label for="market_price" class="col-xs-12 col-sm-3 control-label no-padding-right">市场售价</label>
                <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <input type="number" id="market_price" class="width-100" name="market_price" value="<?php echo ($data["market_price"]); ?>">
          <i class="ace-icon fa fa-leaf"></i>
        </span>
                </div>
                <div class="help-block col-xs-12 col-sm-reset inline">
                  <span class="text-danger">*</span>
                  <span>只能为数字</span>
                </div>
              </div>
              <!--商品图片-->
              <div class="form-group">
                <span class="col-xs-12 col-sm-3 control-label no-padding-right">商品图片</span>
                <div class="col-xs-12 col-sm-5">
                  <label for="goods_img">
                    <input type="file" id="goods_img" name="goods_img">
                  </label>
                </div>
              </div>
              <!--商品详情-->
              <div class="form-group">
                <label for="editor" class="col-xs-12 col-sm-3 control-label no-padding-right">商品详情</label>
                <div class="col-xs-12 col-sm-7">
                  <script src="/Public/Ueditor/ueditor.config.js"></script>
                  <script src="/Public/Ueditor/ueditor.all.min.js"></script>
                  <script src="/Public/Ueditor/lang/zh-cn/zh-cn.js"></script>
                  <textarea id="editor" type="text/plain" style="width:100%;height:500px;" name="goods_body">
          <?php echo ($data["goods_body"]); ?>
        </textarea>
                  <script>
                    //实例化编辑器
                    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                    var ue = UE.getEditor('editor');
                  </script>
                  <!--<textarea class="form-control" id="goods_body" placeholder="商品详情" name="goods_body"></textarea>-->
                </div>
                <div class="help-block col-xs-12 col-sm-reset inline">
                  <span class="text-danger">*</span>
                  文字描述
                </div>
              </div>
            </div>
            <div id="member-tab" class="tab-pane">
              <!--商品分类-->
              <div class="form-group">
                <label for="type_id" class="col-xs-12 col-sm-3 control-label no-padding-right">商品分类</label>
                <div class="col-xs-12 col-sm-5">
                  <span class="block input-icon input-icon-right">
                  <select class="chosen-select form-control" id="type_id" name="type_id" style="cursor: pointer">
                    <option value="" selected>|--请选择商品类型--</option>
                    <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>" <?php if(($data["type_id"]) == $item["id"]): ?>selected<?php endif; ?>>
                        <?php echo ($item["type_name"]); ?>
                      </option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </span>
                </div>
                <div class="help-block col-xs-12 col-sm-reset inline">
                  <span class="text-danger">*</span>
                  <span>商品分类必填</span>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-3"></div>
                  <div class="col-xs-12 col-sm-6" id="showinfo">
                    <div class="form-group">
                      <?php if(is_array($goodsAttrs)): $i = 0; $__LIST__ = $goodsAttrs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; if(($item["attr_input_type"]) == "1"): ?><div class="row">
                              <label for="{'input'.$item.id}" class="col-xs-12 col-sm-3 control-label no-padding-right">
                                <?php echo ($item["attr_name"]); ?>
                              </label>
                              <div class="col-xs-12 col-sm-6">
                              <span class="block input-icon input-icon-right">
                                <input type="text" id="{'input'.$item.id}" class="width-100" name="attr[<?php echo ($item["attr_id"]); ?>][]" value="<?php echo ($item["attr_values"]); ?>">
                                <i class="ace-icon fa fa-leaf"></i>
                              </span>
                              </div>
                            </div>
                            <?php else: ?>
                            <div class="row">
                              <label for="{'select'.$item.id}" class="col-xs-12 col-sm-3 control-label no-padding-right">
                                <?php if(($item["attr_type"]) == "2"): ?><a href="javascript:void(0)" onclick="cloneThis(this)"><?php if(($i) == "1"): ?>[+]<?php else: ?>[-]<?php endif; ?></a><?php endif; ?>
                                <?php echo ($item["attr_name"]); ?>
                              </label>
                              <div class="col-xs-12 col-sm-6">
                              <span class="block input-icon input-icon-right">
                                <select class="chosen-select form-control" id="{'select'.$item.id}" name="attr[<?php echo ($item["attr_id"]); ?>][]" style="cursor: pointer">
                                  <?php if(is_array($item["attr_value"])): $i = 0; $__LIST__ = $item["attr_value"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if(($item["attr_values"]) == $vo): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                              </span>
                              </div>
                            </div><?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="member-img" class="tab-pane active">
              <table class="table pic">
                <tr>
                  <td colspan="2">
                    <?php if(is_array($imgs)): $i = 0; $__LIST__ = $imgs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div style="float: left;margin-left: 10px;height: 140px;width: auto;">
                        <img src="/<?php echo ($item["goods_img"]); ?>" style="height: 100px;width: auto;display: block">
                        <button class="btn btn-sm btn-danger btnDel" data-img-id="<?php echo ($item["id"]); ?>" type="button">删除</button>
                      </div><?php endforeach; endif; else: echo "" ;endif; ?>
                  </td>
                </tr>
                <tr>
                  <td><button id="addImg" class="btn btn-sm btn-info" type="button">新增图片</button></td>
                  <td></td>
                </tr>
                <tr>
                  <td>相册图片：</td>
                  <td><input type="file" name="pic[]"></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--提交-->
    <div class="form-group text-center">
      <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
      <button class="btn btn-info" type="submit" id="button">提交</button>
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
    $("#addCate").on('click', function () {
      var str = `
      <div class="form-group">
      <label class="col-xs-12 col-sm-3 control-label no-padding-right"></label>
      <div class="col-xs-12 col-sm-5">
        <span class="block input-icon input-icon-right">
          <select class="chosen-select form-control" name="cate_id[]" style="cursor: pointer">
            <option value="" selected>|--请选择--</option>
            <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>">
                |<?php echo (str_repeat("----",$item["level"])); ?>
                <?php echo ($item["cname"]); ?>
              </option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </span>
      </div>
      <div class="help-block col-xs-12 col-sm-reset inline" style="margin-top: 0">
        <button type="button" class="btn btn-sm btn-danger" onclick="delCate(event)">删除扩展分类</button>
      </div>
    </div>
      `;
      $("#cate_exm").after(str);
    });
    $('#addImg').click(function () {
      var newImg = $(this).parent().parent().next().clone();
      $('.pic').append(newImg);
    });
    $('.btnDel').click(function () {
      var img_dom = $(this).parent();
      var img_id = $(this).attr('data-img-id');
      $.ajax({
        url: "<?php echo U('delImg');?>",
        type: 'post',
        data: {img_id:img_id},
        success: function (data) {
          if (data.status == '1000') {
            img_dom.remove();
            window.alert(data.msg);
          }
        }
      })
    });
    function delCate(event) {
      $(event.target).parent().parent('.form-group').remove()
    }
    function cloneThis(obj){
      var current = $(obj).parent().parent();
      var newDom = current.clone();
      if ($(obj).html() == '[+]') {
        newDom.find('a').html('[-]');
        current.after(newDom);
      } else {
        current.remove();
      }
    }
  </script>

</html>