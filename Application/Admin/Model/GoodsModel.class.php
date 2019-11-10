<?php

namespace Admin\Model;

use Admin\Common\MyPage;
use Think\Image;
use Think\Upload;

final class GoodsModel extends CommonModel
{
  // 自定义字段
  protected $fields = array(
    'id', 'goods_name', 'goods_sn', 'category_id', 'market_price', 'shop_price', 'goods_body',
    'goods_img', 'goods_thumb', 'is_hot', 'is_rec', 'is_new', 'is_del', 'is_sale', 'addtime','type_id','goods_number',
    'cx_price','start','end','plcount','sale_number'
  );

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
    // 促销商品时间格式化操作
    if ($data['cx_price']>0) {
      $data['start'] = strtotime($data['start']);
      $data['end'] = strtotime($data['end']);
    } else {
      $data['cx_price'] = 0.00;
      $data['start'] = 0;
      $data['end'] = 0;
    }
    // 补全参数
    $data['addtime'] = time();
    if ($data['goods_sn']) {
      $res = $this->where("goods_sn = {$data['goods_sn']}")->find();
      if ($res) {
        $this->error = '商品货号已存在，请从新输入';
        return false;
      }
    }
    else {
      $data['goods_sn'] = 'wj' . uniqid();
    }
    $imagePath = $this->uploadImg();
    if ($imagePath) {
      $data['goods_img'] = $imagePath['goods_img'];
      $data['goods_thumb'] = $imagePath['goods_thumb'];
    }
  }

  // 使用钩子函数写入商品的扩展分类，在商品添加成功操作
  public function _after_insert($data, $options)
  {
    // $data是数据插入后返回来的插入的数据的一维数组，里面携带了ID,相当于插入后在数据库里面查出来的
    // 商品扩展分类入库
    $goods_id = $data['id']; // 获取$goods_id
    $data = I('post.cate_id'); // 这里接收到的是一个cate_id的数组
    D('goods_cate')->insertExtCate($data,$goods_id);
    // 商品属性入库
    $attr = I('post.attr');
    $goodsAttrModel = D('GoodsAttr');
    $goodsAttrModel->where("goods_id={$goods_id}")->delete();
    $goodsAttrModel->insertAttr($attr,$goods_id);

    // 商品相册图片入库
    $fileConfig = array(
      'exts' => array('jpg', 'gif', 'png'), // 配置文件上传的文件后缀名
      'maxSize' => 3145728, //上传的文件大小限制 (0-不做限制)
      'savePath' => 'goods/photo/', //保存路径
    );
    $upload = new Upload($fileConfig);
    unset($_FILES['goods_img']);  // 需要把商品的图片排除在外
    $info = $upload->upload();
    // 由于上传的图片不止一张，因此需要循环拼接图片地址
    foreach ($info as $value) {
      $goods_img = 'Uploads/' . $value['savepath'] . $value['savename']; //上传成功后拼接图片地址
      // 制作缩略图
      $img = new Image(); // 第一步，实例化图片操作的对象
      $img->open($goods_img); // 第二步，打开需要操作的图片
      $goods_thumb = 'Uploads/' . $value['savepath'] . 'thumb' . $value['savename']; // 第三步：拼接缩略图的保存路径
      $img->thumb(100,100)->save($goods_thumb); // 第四步，制作缩略图并保存
      $list[] = array(
        'goods_id'=>$goods_id,
        'goods_img'=>$goods_img,
        'goods_thumb'=>$goods_thumb,
      );
    }
    // 相册图片入库
    if ($list) {
      M('goods_img')->addAll($list);
    }
  }

  // 获取商品列表
  public function listData($is_del=1) {
    // 按条件搜索查询
    $where = "is_del={$is_del}"; // 只查询没有伪删除的商品
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
    // 促销商品时间格式化操作
    if ($data['cx_price']>0) {
      $data['start'] = strtotime($data['start']);
      $data['end'] = strtotime($data['end']);
    } else {
      $data['cx_price'] = 0.00;
      $data['start'] = 0;
      $data['end'] = 0;
    }

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
        $this->error = '货号已存在，请重新输入！';
        return false;
      }
    }

    // （2）解决扩展分类的问题,删除之前的扩展分类
    $extCateModel = D('GoodsCate');
    $extCateModel->where("goods_id={$goods_id}")->delete();
    // 将最新的扩展分类写入扩展分类表
    $ext_cate = I('post.cate_id'); // 这里接收到的是一个cate_id的数组
    $ext_cate = array_unique($ext_cate); // 去除数组中重复的元素
    $extCateModel->insertExtCate($ext_cate,$goods_id);

    // （3）解决商品图片修改问题
    $imagePath = $this->uploadImg($data);
    if ($imagePath) {
      $data['goods_img'] = $imagePath['goods_img'];
      $data['goods_thumb'] = $imagePath['goods_thumb'];
    }

    // （4）解决商品属性的问题，删除原来的所有商品属性，然后重新写入
    $attr = I('post.attr');
    $goodsAttrModel = D('GoodsAttr');
    $goodsAttrModel->where("goods_id={$goods_id}")->delete();
    $goodsAttrModel->insertAttr($attr,$goods_id);

    // （5）给商品追加相册图片
    $fileConfig = array(
      'exts' => array('jpg', 'gif', 'png'), // 配置文件上传的文件后缀名
      'maxSize' => 3145728, //上传的文件大小限制 (0-不做限制)
      'savePath' => 'goods/photo/', //保存路径
    );
    $upload = new Upload($fileConfig);
    unset($_FILES['goods_img']);  // 需要把商品的图片排除在外
    $info = $upload->upload();
    // 由于上传的图片不止一张，因此需要循环拼接图片地址
    foreach ($info as $value) {
      $goods_img = 'Uploads/' . $value['savepath'] . $value['savename']; //上传成功后拼接图片地址
      // 制作缩略图
      $img = new Image(); // 第一步，实例化图片操作的对象
      $img->open($goods_img); // 第二步，打开需要操作的图片
      $goods_thumb = 'Uploads/' . $value['savepath'] . 'thumb' . $value['savename']; // 第三步：拼接缩略图的保存路径
      $img->thumb(100,100)->save($goods_thumb); // 第四步，制作缩略图并保存
      $list[] = array(
        'goods_id'=>$goods_id,
        'goods_img'=>$goods_img,
        'goods_thumb'=>$goods_thumb,
      );
    }
    // 相册图片入库
    if ($list) {
      M('goods_img')->addAll($list);
    }
    // 修改入库
    return $this->save($data);
  }

  // 公共的图片上传方法
  public function uploadImg($goods_info=null){
    // 首先判断是否有图片上传
    if (!isset($_FILES['goods_img']) || $_FILES['goods_img']['error'] != 0) {
      return false;
    }
    // 如果有图片上传，就先删除原来的图片
    if ($goods_info) {
      $info = $this->where("id={$goods_info['id']}")->find();
      unlink($info['goods_img']);
      unlink($info['goods_thumb']);
    }
    // 实现图片上传
    $fileConfig = array(
      'exts' => array('jpg', 'gif', 'png'), // 配置文件上传的文件后缀名
      'maxSize' => 3145728, //上传的文件大小限制 (0-不做限制)
      'savePath' => 'goods/', //保存路径
    );
    $upload = new Upload($fileConfig);
    $info = $upload->uploadOne($_FILES['goods_img']);
    if (!$info) {
      $this->error = $upload->getError();
      return false;
    }
    $goods_img = 'Uploads/' . $info['savepath'] . $info['savename']; //上传成功后拼接图片地址
    // 制作上传图片的缩略图
    $img = new Image(); // 实例化缩略图对象
    $img->open($goods_img); // 打开需要制作的图片蓝本
    $goods_thumb = 'Uploads/' . $info['savepath'] . 'thumb' . $info['savename']; // 拼接制作缩略图的地址
    $img->thumb(450, 450)->save($goods_thumb); // 制作缩略图并保存
    // 返回图片的保存地址
    return array(
      'goods_img'=>$goods_img,
      'goods_thumb'=>$goods_thumb,
    );
  }

  // 彻底删除商品
  public function remove($id){
    // （1）删除商品的图片
    $goods_info = $this->where("id=$id")->find();
    if (!$goods_info) {
      $this->error = '查找信息失败';
      return false;
    }
    unlink($goods_info['goods_img']);
    unlink($goods_info['goods_thumb']);
    // （2）删除商品的扩展分类
    D('GoodsCate')->where("goods_id={$id}")->delete();
    // （3）删除商品的基本信息
    return $res = $this->where("id={$id}")->delete();
  }

  // 根据类型获取商品
  public function getRecGoods($type) {
    return $this->where("is_sale=1 AND {$type}=1")-> limit(5)->select();
  }

  // 获取促销中的商品
  public function getCrazyGoods() {
    // 获取促销商品的查询条件
    // 1、当前商品正在销售 2、当前时间处于促销的开始时间跟结束时间之间 3、促销价格大于0
    return $this->
    where("is_sale=1 AND cx_price>0 AND start<".time()." AND end>".time())->
    limit(5)->select();
  }

  // 获取某一个分类下的商品
  public function getList() {
    // 获取当前分类ID
    $category_id = I('get.id');
    // 获取当前分类下的所有子ID
    $children = D('Admin/Category')->getChildren($category_id);
    // 把当前ID加入$children中
    $children[] = $category_id;
    // 为了使用MySQL的in语法，把数组转为字符串
    $children = implode(',',$children);
    // 查询条件
    $where = "is_sale=1 AND category_id in ({$children})";

    // 计算当前分类下的价格筛选条件，
    //第一步：获取当前分类下的商品的最大价格以及最小价格
    $goods_info = $this->field("max(shop_price) max_price,min(shop_price) min_price,count(id) goods_count,group_concat(id) goods_ids")->where($where)->find();
    // 第二步：根据当前商品的个数判断是否需要显示出价格区间
    if ($goods_info['goods_count']>1) {
      $cha = $goods_info['max_price'] - $goods_info['min_price'];
      if ($cha<100) {
        $sec = 1; // 具体显示的价格区间的个数
      } elseif ($cha<500) {
        $sec = 2;
      } elseif ($cha<1000) {
        $sec = 3;
      } elseif ($cha<5000) {
        $sec = 4;
      } elseif ($cha<10000) {
        $sec = 5;
      }else{
        $sec = 6;
      }
      $price = array(); // 保存具体的每一个价格区间对应的值
      $first = ceil($goods_info['min_price']); // 开始价格
      $zl = ceil($cha/$sec); // 每个价格区间增加的数量
      // 第三步：运算具体的价格区间
      for ($i=0;$i<$sec;$i++) {
        $price[] = $first.'-'.($first+$zl);
        $first += $zl;
      }
    }
    // 第四步：增加价格查询条件
    if (I('get.price')) {
      $price_list = explode('-',I('get.price'));
      $where .= " AND shop_price>{$price_list[0]} AND shop_price<{$price_list[1]}";
    }

    //根据属性赛选条件查询
    $attr = M('goods_attr')->alias('a')->field('distinct a.attr_id,a.attr_values,b.attr_name')->
    join("left join wj_attribute b on a.attr_id=b.id")->
    where("a.goods_id in ({$goods_info['goods_ids']})")->select();
    foreach ($attr as $key=>$value) {
      $attr_list[$value['attr_id']][] = $value;
    }
    // 根据属性值查询商品id
    if (I('get.attr')) {
      // 为了方便使用，把attr转为数组
      $tem = explode(',',I('get.attr')); // 得到属性的数组
      // 根据属性数组查询商品id
      $goods_ids = M('goods_attr')->field("group_concat(goods_id) as goods_ids")->where(array('attr_values'=>array('in'=>$tem)))->find();
      if ($goods_ids) {
        $where .= " AND id in ({$goods_ids})";
      }
    }

    // 分页查询
    $p = I('get.p');
    $count = $this->where($where)->count();
    $pagesize = 5;
    $page = new MyPage($count,$pagesize);
    $pageStr = $page->show();
    // 商品数据排序
    $sort = I('get.sort')?I('get.sort'):'sale_number';
    $data = $this->where($where)->page($p,$pagesize)->order("$sort desc")->select();
    return array(
      'goods'     =>$data,
      'price'     =>$price,
      'attr_list' =>$attr_list,
      'page'      =>$pageStr
    );
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
