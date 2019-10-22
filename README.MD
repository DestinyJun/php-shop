# ThinkPHP电商项目（2019-10-17 — 2019-10-*）
### 1、项目状态码定义
#####（1）1001：该字段是必填项
### 2、项目部署
#####（1）配置apache虚拟主机，指向项目根目录下的wwwroot文件夹
#####（2）把项目的入口文件放在wwwroot目录下
#####（3）重要的核心代码（如TP框架的核心代码）放在跟wwwroot目录同级部署，会让项目安全性更高
#####（4）修改TP框架的入口文件的相关目录：
``` php
  // 定义应用存储目录
  define('APP_PATH','../Application'.DS);
  // 引入ThinkPHP入口文件
  require '../ThinkPHP/ThinkPHP.php';
```
#####（5）运行项目，初始化项目目录，项目本地环境搭建完成
### 3、项目URL访问地址优化
#####（1）隐藏项目的入口文件，借助apache的重写机制实现（已开启），并修改TP的URL访问模式为重写模式（好像不能限制访问模式）
``` php
'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
  // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  重写模式); 3 (兼容模式)  默认为PATHINFO 模式
```
#####（2）隐藏项目的Home(或者admin)模块,直接修改配置项即可
``` php
  // 这样配置以后，U函数生成的地址也会自动隐藏入口文件及默认模块名称
  'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
  'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
  'DEFAULT_ACTION'        =>  'index', // 默认操作名称
  'MODULE_ALLOW_LIST'     =>  array('Admin','Home'), // 设置容许访问的模块（好像主配置文件里面没有,但是配置有效）
```
### 4、数据表创建的常用原则
#####（1）每张表都需要有一个主键标识
#####（2）每个字段尽量设置为不允许为空然后给上默认值
#####（3）每个字段的数据类型根据业务逻辑尽量选择小的类型
### 5、扩展TP中的类
#####（1）用链式继承的方式实现扩展
### 6、创建数据模型
#####（1）每次创建模型类建议在模型中自定义表字段，提高性能
#####（2）创建自动验证插入的表字段，提高数据安全
### 7、修改无限级分类出现的BUG
#####（1）如果将自己设置为自己的父分类
#####（2）将父分类设置为自己的子分类
#####（3）将自己的父分类设置为自己及自己下的所有的子分类
### 8、商品入库中常见的问题
#####（1）商品写入时没有自定生成时间
  > * 使用模型的自动完成及钩子函数解决
  ``` php
    // 在模型中使用钩子函数补齐参数
      public function _before_insert(&$data, $options)
      {
        $data['addtime'] = time();
        if ($data['goods_sn']) {
          $res = $this->where("goods_sn = {$data['goods_sn']}")->find();
          if ($res) {
            $this->error = '商品货号已存在，请从新输入';
            return false;
          }
        } else {
          $data['goods_sn'] = 'wj'.uniqid();
        }
        dump($data);
      }
  ```
#####（2）没有对货号进行处理，货号不能重复以及用户不输入货号时自动生成唯一的货号
  > * 使用模型的自动完成及钩子函数解决
``` php
    // 在模型中使用钩子函数补齐参数
      public function _before_insert(&$data, $options)
      {
        $data['addtime'] = time();
        if ($data['goods_sn']) {
          $res = $this->where("goods_sn = {$data['goods_sn']}")->find();
          if ($res) {
            $this->error = '商品货号已存在，请从新输入';
            return false;
          }
        } else {
          $data['goods_sn'] = 'wj'.uniqid();
        }
        dump($data);
      }
  ```
### 9、商品扩展分类
* 商品分类的作用就是为了帮助用户快速的找到自己想要购买的商品，因此一个商品都归属于某一个分类，有时有些商品希望在多个分类下显示，因此都可以给商品设置扩展分类来实现

