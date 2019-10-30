<?php
namespace Admin\Model;
use Admin\Common\MyPage;

class AttributeModel extends CommonModel
{
  protected $fields = array('id','attr_name','type_id','attr_type','attr_input_type','attr_value');
  protected $_validate = array(
    array('attr_name','require','属性名称是必填项'),
    array('type_id','require','所属类型必填项'),
    array('attr_type','1,2','属性类型只能为单选或者唯一',1,'in'),
    array('attr_input_type','1,2','属性录入方式只能为手工或者列表',1,'in'),
  );

  public function listData() {
    $pagesize = 3;
    $count = $this->count();
    $page = new MyPage($count,$pagesize);
    $pageStr = $page->show();
    $p = intval(I('get.p'));
    if ($p<0) {
      $this->error = '分页参数错误';
      return false;
    }
    /**
     * 实现将类型ID转化为类型名称的方法有两种
     * （1）常见的就是使用连表查询，但是有点损耗MySQL性能
     * （2）可以使用替换的方式实现，节约数据库性能（可以使用缓存实现）
     */
    $data = $this->page($p,$pagesize)->select();
    //* 实现步骤：
    //  * （1）先获取所有的类型信息
    $types = D('Type')->select();
    // * （2）再将类型信息转换为使用主键ID作为索引的数组
    $type_list = S('attribute_type');
    if (!$type_list){
      foreach ($types as $value) {
        $type_list[$value['id']] = $value;
      }
      S('attribute_type',$type_list);
    }
    foreach ($data as $key=>$value) {
      $data[$key]['type_id'] = $type_list[$value['type_id']]['type_name'];
    }
    // * （3）循环具体的数据，在根据type_id进行一个替换操作即可
    return array(
      'data' => $data,
      'page' => $pageStr
    );
  }

  public function dels($id) {
    return $this->where("id={$id}")->delete();
  }
}
