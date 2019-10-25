<?php
namespace Admin\Model;
class GoodsCateModel extends CommonModel
{
  // 插入扩展分类
  public function insertExtCate($ext_cate_id,$goods_id) {
    $ext_cate_id = array_unique($ext_cate_id); // 去除数组中重复的元素
    foreach ($ext_cate_id as $key => $value) {
      if($value) {
        $list[] = array(
          'goods_id' => $goods_id,
          'category_id' => $value,
        );
      }
    }
    // 使用模型的addAll必须注意，首先是二维数组，其次下标必须是索引数组且从0开始
    $this->addAll($list); // 实例化扩展分类表的基类，并多条一起存入数据
  }
}
