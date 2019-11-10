<?php
// 定义项目使用的公共函数，此文件下的函数会自动载入到项目中，并且所有函数可以在项目的任何模块下使用
/**
 * 生成商品列表中的链接地址函数
 * @param $name string
 * @param $value string 需要排序字段
 */
function myU($name,$value) {
  $attr = I('get.attr');
  if($name=='sort') {
    // 将排序字段保存到$sort中
    $sort = $value;
    $price = I('get.price');
  } elseif ($name == 'price') {
    $price = $value;
    $sort = I('get.sort');
  } elseif ($name == 'attr') {
    // 这里需要注意：实现多个属性值进行筛选查询的情况
    if(!$attr) {
      $attr = $value;
    } else {
      $attr = explode(',',$attr);
      $attr[] = $value;
      $attr = array_unique($attr);
      $attr = implode(',',$attr);
    }
  }
  return U("Category/index").'?id='.I('get.id').'&sort='.$sort.'price='.$price.'attr='.$attr;
}
