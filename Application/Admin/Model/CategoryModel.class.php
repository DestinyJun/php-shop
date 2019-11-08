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

  // 获取无限级分类格式化数据方法，此方法获取子分类还是有点问题
  public function getCateTree($id=0){
    // 获取所有分类信息
    $data = $this->select();
    // 在对获取的信息进行格式化
    $list = $this->getTree($data,$id);
    return $list;
  }

  // 真正获取子分类的方法
  public function getChildren($id){
    // 获取所有分类信息
    $data = $this->select();
    // 在对获取的信息进行格式化
    $list = $this->getTree($data,$id,0,false);
    foreach ($list as $value) {
      $tree[] = $value['id'];
    }
    return $tree;
  }

  /** 格式化分类信息
   * @param $arrs
   * @param int $id
   * @param int $level
   * @param bool $is_catch 是否缓存
   * @return array
   */
  public function getTree($arrs,$id=0,$level=0,$is_catch=true)
  {
    static $tree = array();
    if (!$is_catch) {
      // 根据参数决定是否需要重置格式化的数据
      $tree = array();
    }
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

  // 返回分类楼层
  public function getFloors() {
    // （1）获取所有的顶级分类
    $data = $this->where("parent_id=0")->select();
    // （2）获取顶层分类下的二级分类以及二级分类中标识为推荐的分类
    foreach ($data as $key=>$value) {
      $data[$key]['son'] = $this->where("parent_id={$value['id']}")->select(); // 得到顶级分类下的二级分类
      $data[$key]['recson'] = $this->where("isrec=1 AND parent_id={$value['id']}")->select(); // 得到顶级分类下的二级分类
      // 获取推荐的二级分类下的商品（包括其子分类下的商品）
      foreach ($data[$key]['recson'] as $k=>$v) {
        $data[$key]['recson'][$k]['goods'] = $this->getGoodsByCateId($v['id']);
      }
    }
    return $data;
  }

  public function getGoodsByCateId($cate_id,$limit=8) {
    // 获取当前分类下的子分类
    $children = $this->getChildren($cate_id);
    $children[] = $cate_id;
    $children = implode(',',$children);
    return D('Goods')->where("is_sale=1 AND category_id in ($children)")->limit($limit)->select();
  }
}
