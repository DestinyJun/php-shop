<?php if (!defined('THINK_PATH')) exit();?><div class="form-group">
  <?php if(is_array($attribute)): $i = 0; $__LIST__ = $attribute;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; if(($item["attr_input_type"]) == "1"): ?><div class="row">
        <label for="{'input'.$item.id}" class="col-xs-12 col-sm-3 control-label no-padding-right">
          <?php echo ($item["attr_name"]); ?>
        </label>
        <div class="col-xs-12 col-sm-6">
      <span class="block input-icon input-icon-right">
        <input type="text" id="{'input'.$item.id}" class="width-100" name="attr[<?php echo ($item["id"]); ?>][]">
        <i class="ace-icon fa fa-leaf"></i>
      </span>
        </div>
      </div>
      <?php else: ?>
      <div class="row">
        <label for="{'select'.$item.id}" class="col-xs-12 col-sm-3 control-label no-padding-right">
          <?php if(($item["attr_type"]) == "2"): ?><a href="javascript:void(0)" onclick="cloneThis(this)">[+]</a><?php endif; ?>
          <?php echo ($item["attr_name"]); ?>
        </label>
        <div class="col-xs-12 col-sm-6">
          <span class="block input-icon input-icon-right">
                  <select class="chosen-select form-control" id="{'select'.$item.id}" name="attr[<?php echo ($item["id"]); ?>][]" style="cursor: pointer">
                    <?php if(is_array($item["attr_value"])): $i = 0; $__LIST__ = $item["attr_value"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>" <?php if(($item["attr_values"]) == $vo): endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </span>
        </div>
      </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</div>