<?php
namespace Admin\Model;
class GoodsAttrModel extends CommonModel
{
  protected $fields = array('id','goods_id','attr_id','attr_values');
  // 插入商品属性属性值
  public function insertAttr($attr,$goods_id) {
    foreach ($attr as $key=>$value) {
      foreach ($value as $v) {
        $attr_list[] = array(
          'goods_id'     => $goods_id,
          'attr_id'      => $key,
          'attr_values'  => $v,
        );
      }
    }
    $this->addAll($attr_list);
  }
  // 联查商品属性
  public function getSingleAttr($goods_id) {
    $data = $this->alias('a')->
    join("left join wj_attribute b on a.attr_id=b.id")->
    field("a.*,b.attr_name,attr_type,attr_input_type,attr_value")->
    where("a.goods_id={$goods_id} AND b.attr_type=2")->select();
    foreach ($data as $value){
      $list[$value['attr_id']][] = $value;
    }
    return $list;
  }
}
