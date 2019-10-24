<?php

namespace Admin\Model;

use Admin\Common\MyPage;
use Think\Image;
use Think\Model;
use Think\Upload;

final class GoodsModel extends Model
{
  // 自定义字段
  protected $fields = array(
    'id', 'goods_name', 'goods_sn', 'category_id', 'market_price', 'shop_price', 'goods_body',
    'goods_img', 'goods_thumb', 'is_hot', 'is_rec', 'is_new', 'is_del', 'is_sale', 'addtime');
  // 定义字段自动校验
  protected $_validate = array(
    array('goods_name', 'require', '商品名称必填', 1, 'regex', 3),
    array('category_id', 'checkCategory', '分类名称必填', 1, 'callback', 3),
    array('market_price', 'currency', '市场价格格式不对', 1, 'regex', 3),
    array('shop_price', 'currency', '本店价格格式不对', 1, 'regex', 3),
  );

  // 校验商品分类的回调函数
  public function checkCategory($category_id)
  {
    $category_id = intval($category_id);
    if ($category_id > 0) {
      return true;
    }
    return false;
  }

  // 在模型中使用钩子函数补齐参数
  public function _before_insert(&$data, $options)
  {
    // 补全参数
    $data['addtime'] = time();
    if ($data['goods_sn']) {
      $res = $this->where("goods_sn = {$data['goods_sn']}")->find();
      if ($res) {
        $this->error = '商品货号已存在，请从新输入';
        return false;
      }
    } else {
      $data['goods_sn'] = 'wj' . uniqid();
    }

    // 实现图片上传
    $fileConfig = array(
      'exts' => array('jpg', 'gif', 'png'), // 配置文件上传的文件后缀名
      'maxSize' => 3145728, //上传的文件大小限制 (0-不做限制)
      'savePath' => 'goods/', //保存路径
    );
    $upload = new Upload($fileConfig);
    $info = $upload->uploadOne($_FILES['file']);
    if (!$info) {
      $this->error = $upload->getError();
      return false;
    }
    $data['goods_img'] = 'Uploads/' . $info['savepath'] . $info['savename'];
    // 实现缩略图处理
    $data['goods_thumb'] = 'Uploads/' . $info['savepath'] . 'thumb' . $info['savename'];
    $img = new Image(); // 实例化缩略图对象
    $img->open($data['goods_img']); // 打开需要制作的图片蓝本
    $img->thumb(450, 450)->save($data['goods_thumb']); // 制作缩略图并保存
  }

  // 使用钩子函数写入商品的扩展分类，在商品添加成功操作
  public function _after_insert($data, $options)
  {
    // $data是数据插入后返回来的插入的数据的一维数组，里面携带了ID,相当于插入后在数据库里面查出来的
    $goods_id = $data['id']; // 获取$goods_id
    $data = I('post.cate_id'); // 这里接收到的是一个cate_id的数组
    $data = array_unique($data); // 去除数组中重复的元素
    foreach ($data as $key => $value) {
      $list[] = array(
        'goods_id' => $goods_id,
        'cate_id' => $value,
      );
    }
    // 使用模型的addAll必须注意，首先是二维数组，其次下标必须是索引数组且从0开始
    M('goods_cate')->addAll($list); // 实例化扩展分类表的基类，并多条一起存入数据
  }

  // 获取文章列表
  public function listData() {
    // 按条件搜索查询
    $where = "is_del=1"; // 只查询没有伪删除的商品
    // 根据商品分类查询
    $category_id = intval(I('get.category_id'));
    if ($category_id) {
      /**
       * 这里有三种情况
       * （1）根据提交的分类ID标识查询出商品表中的category_id值等于该ID标识的即可
       * （2）根据提交的分类ID标识先查询出该分类下的所有子分类，然后在将提交的的分类
       * id与该分类所对应的子分类进行组合作为条件进行查询，此时可以使用MySQL中的in语法进行查询
       * （3）查询出商品的扩展分类的id等于当前分类或者是当前分类所对应的子分类，此时能够得到商品ID，
       * 然后再根据商品ID获取对应的商品信息
       */
      // 根据分类提交额分类id查询子id
      $tree_cate_id = D('category')->getChildren($category_id);
      $tree_cate_id[] = $category_id; // 追加当前接收到的分类ID
      $tree_cate_id = implode(',',$tree_cate_id); // 将$tree_id转化为字符串形式，拼接sql语句要用
      // 获取扩展分类的商品id
      $ext_goods_ids = M('goods_cate')->group('goods_id')->where("cate_id in ($tree_cate_id)")->select();
      if ($ext_goods_ids) {
        foreach ($ext_goods_ids as $value) {
          $goods_ids[] = $value['goods_id'];
        }
        $goods_ids = implode(',',$goods_ids);
      }
      // 这筛选查询的where语句
      if (!$goods_ids) {
        // 没有商品的扩展分类满足条件
        $where .= " AND category_id in ($tree_cate_id)";
      } else {
        // 有商品满足扩展分类的条件
        $where .= " AND (category_id in ($tree_cate_id) OR id in ($goods_ids))";
      }
    }
    // 根据是否推荐查询
    $intro_type = I('get.intro_type');
    if ($intro_type){
      if($intro_type == 'is_rec' || $intro_type == 'is_new' || $intro_type == 'is_hot') {
        $where .= " AND `{$intro_type}` =1";
      }
    }
    // 根据是否上架查询
    $is_sale = intval(I('get.is_sale'));
    if ($is_sale) {
      if ($is_sale == 1) {
        $where .= " AND is_sale =1";
      } else {
        $where .= " AND is_sale =0";
      }
    }
    // 根据关键字查询
    $keyword = I('get.keyword');
    if ($keyword) {
      $where .= " AND goods_name LIKE '%{$keyword}%'";
    }
    // 分页实现
    $count = $this->where($where)->count(); // 数据总条数
    $pagesize = 3; // 每页显示多少条
    $page = new MyPage($count,$pagesize); // 实例化分页类
    $pageStr = $page->show(); // 拿到分页html
    $p = I('get.p'); // 接收当前处于第几页，p参数的分页类定死的，不能改
    $data = $this->where($where)->page($p,$pagesize)->select();// 根据当前页以及查询多少条查询数据，TP基础数据模型提供
    return  array(
      'data'=>$data,
      'page'=>$pageStr
    );
  }

  // 商品信息修改
  public function update($data){
    // 在数据修改之前要解决修改的三个问题
    // （1）解决货号唯一的问题
    $goods_id = $data['id'];
    $goods_sn = $data['goods_sn'];
    if(!$goods_sn) {
      // 没有输入sn的情况
      $data['goods_sn'] = 'wj' . uniqid();
    }
    else {
      // 解决有输入sn检查sn是否重复
      // 解决sn是原来的没有发生变化
      $res = $this->where("goods_sn='{$goods_sn} AND id != {$goods_id}'")->find();
      if ($res) {
        $this->error = '货号货号';
        return false;
      }
    }
    // （2）解决扩展分类的问题
    // 删除之前的扩展分类
    $extCateModel = M('goods_cate');
    $extCateModel->where("goods_id={$goods_id}")->delete();
    // 将最新的扩展分类写入扩展分类表
    $ext_cate = I('post.cate_id'); // 这里接收到的是一个cate_id的数组
    $ext_cate = array_unique($ext_cate); // 去除数组中重复的元素
    foreach ($ext_cate as $key => $value) {
      if ($value) {
        $list[] = array(
          'goods_id' => $goods_id,
          'category_id' => $value,
        );
      }
    }
    // 使用模型的addAll必须注意，首先是二维数组，其次下标必须是索引数组且从0开始
    M('goods_cate')->addAll($list); // 实例化扩展分类表的基类，并多条一起存入数据

    // （3）解决商品图片修改问题
    // 实现图片上传
    $fileConfig = array(
      'exts' => array('jpg', 'gif', 'png'), // 配置文件上传的文件后缀名
      'maxSize' => 3145728, //上传的文件大小限制 (0-不做限制)
      'savePath' => 'goods/', //保存路径
    );
    $upload = new Upload($fileConfig);
    $info = $upload->uploadOne($_FILES['file']);
    if (!$info) {
      dump('图片上传失败');
      $this->error = $upload->getError();
      return false;
    }
    $data['goods_img'] = 'Uploads/' . $info['savepath'] . $info['savename'];
    // 实现缩略图处理
    $data['goods_thumb'] = 'Uploads/' . $info['savepath'] . 'thumb' . $info['savename'];
    $img = new Image(); // 实例化缩略图对象
    $img->open($data['goods_img']); // 打开需要制作的图片蓝本
    $img->thumb(450, 450)->save($data['goods_thumb']); // 制作缩略图并保存
    return $this->save($data);
  }

  // 使用自动完成规则补齐参数
  /* protected $_auto = array(
     array('goods_sn','goodsSnComplete',3,'callback'),
     array('addtime','time',3,'function')
   );*/

  // 自动完成商品货号
  /* public function goodsSnComplete(){
     $goods_sn = mt_rand(10,10000);
     return $goods_sn;
   }*/
}
