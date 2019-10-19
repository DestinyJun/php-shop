<?php
namespace Admin\Model;
final class CategoryModel extends CommonModel
{
  // 建议每次创建模型就自定义表字段，提高性能
  protected $fields = array('id','cname','parent_id','isrec');
  // 创建自动验证插入的表字段，提高数据安全 ,1,'regex',3
  protected $_validate = array(
    array('cname','require','分类名称必填')
  );
}
