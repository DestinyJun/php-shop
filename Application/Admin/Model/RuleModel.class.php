<?php
namespace Admin\Model;
final class RuleModel extends CommonModel
{
  protected $fields = array('id','rule_name','module_name','controller_name','action_name','parent_id','is_show');
  protected $_validate = array(
    array('rule_name','require','权限名称必填'),
    array('module_name','require','模块名称必填'),
    array('controller_name','require','控制器名称必填'),
    array('action_name','require','方法名称必填'),
  );

  // 获取权限列表
  public function listData() {
   /* // 分页实现
    $count = $this->count(); // 数据总条数
    $pagesize = 3; // 每页显示多少条
    $page = new MyPage($count,$pagesize); // 实例化分页类
    $pageStr = $page->show(); // 拿到分页html
    $p = I('get.p'); // 接收当前处于第几页，p参数的分页类定死的，不能改
    $data = $this->where($where)->page($p,$pagesize)->select();// 根据当前页以及查询多少条查询数据，TP基础数据模型提供
    return  array(
      'data'=>$data,
      'page'=>$pageStr
    );*/
  }

  // 实现删除方法，如果其有子分类不允许删除
  public function dels($id){
    $res = $this->where("parent_id = {$id}")->find();
    if ($res) {
      return false;
    }
    return $this->where("id = {$id}")->delete();
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

  /**
   * 获取无限级分类格式化数据方法
   * @param int $id
   * @return array 返回一个树结构的二维数组
   */
  public function getCateTree($id=0){
    // 获取所有分类信息
    $data = $this->select();
    // 在对获取的信息进行格式化
    $list = $this->getTree($data,$id);
    return $list;
  }

  /**
   * 真正获取子分类的方法
   * @param int $id 父级id
   * @return array 返回一个树结构的二维数组
   */
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
   * @param array $arrs 需要格式化的数组
   * @param int $id 起始id
   * @param int $level 层级
   * @param bool $is_catch 是否缓存
   * @return array 返回一个树结构的二维数组
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
}
