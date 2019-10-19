<?php
namespace Admin\Model;
use Think\Model;

abstract class CommonModel extends Model
{
  public function __construct($name = '', $tablePrefix = '', $connection = '')
  {
    parent::__construct($name, $tablePrefix, $connection);
  }
  // 无限级分类方法
  public function getCateTree($arrs,$level=0,$parent_id=0)
  {
    static $tree = array();
    foreach ($arrs as $arr) {
      if ($arr['parent_id'] == $parent_id) {
        $arr['level'] = $level;
        $tree[] = $arr;
        // 递归调用
        $this->getCateTree($arrs,$level+1,$arr['id']);
      }
    }
    return $tree;
  }
}
