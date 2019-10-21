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

  // 实现删除方法，如果其有子分类不允许删除
  public function dels($id){
    $res = $this->where("parent_id = {$id}")->find();
    if ($res) {
      return false;
    }
    return $this->where("id = {$id}")->delete();
  }

  // 获取无限级分类格式化数据方法
  // 此方法还可以根据指定ID找出其自己及所有子分类
  public function getCateTree($id=0){
    // 获取所有分类信息
    $data = $this->select();
    // 在对获取的信息进行格式化
    $list = $this->getTree($data,$id);
    return $list;
  }

  // 格式化分类信息
  public function getTree($arrs,$id=0,$level=0)
  {
    static $tree = array();
    foreach ($arrs as $arr) {
      if ($arr['parent_id'] == $id) {
        $arr['level'] = $level;
        $tree[] = $arr;
        // 递归调用
        $this->getTree($arrs,$arr['id'],$level+1);
      }
    }
    return $tree;
  }

  // 实现无线级编辑方法
  public function update($data){
    // 为了避免修改出现无线级分类的BUG，需要避免将自己的父分类设置为自己及自己下的所有的子分类，步骤如下：
    // （1）根据需要修改的分类的标识，获取到自己下的所有子分类
    $tree = $this->getCateTree($data['id']);
    $tree[]= $data;
    // （2）根据提交的parent_id的值，判断如果等于当前修改的分类ID或时当前分类下的所有子分类的ID，就不允许修改
    foreach ($tree as $value) {
      if ($value['id'] === $data['parent_id']){
        $this->error = '不能设置自己为自己的父分类或者子分类';
        return false;
      }
    }
    return $this->save($data);
  }
}
