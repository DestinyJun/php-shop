<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>分类列表页</title>
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/base.css"/>
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css"/>
  <link rel="stylesheet" href="/Public/Home/css/slide.css"/>
  
</head>
<body>
<!--头部-->
<div class="top_banner">
  <div class="module w1200">
    <a href="javascript:">
      <img src="/Public/Home/images/active.jpg"/>
      <i class="icon-close"><img src="/Public/Home/images/close.png"/></i>
    </a>
  </div>
</div>
<div class="site-nav" id="site-nav">
  <div class="w w1200">
    <div class="fl">
      <div class="city-choice" id="city-choice" data-ectype="dorpdown">
        <div class="dsc-choie dsc-cm" ectype="dsc-choie">
          <img src="/Public/Home/images/place.png" class="place" />
          <input type="text" value="北京" class="search" />
        </div>

      </div>
      <div class="txt-info" id="ECS_MEMBERZONE">
        <a href="login.html" class="link-login red">请登录</a>
        <a href="register.html" class="link-regist">免费注册</a>
      </div>
    </div>
    <ul class="quick-menu fr">
      <li>
        <div class="dt">
          <a href="#">我的订单</a>
        </div>
      </li>
      <li class="spacer"></li>
      <li>
        <div class="dt">
          <a href="#">我的浏览</a>
        </div>
      </li>
      <li class="spacer"></li>
      <li>
        <div class="dt">
          <a href="#">我的收藏</a>
        </div>
      </li>
      <li class="spacer"></li>
      <li>
        <div class="dt">
          <a href="#">客户服务</a>
        </div>
      </li>
      <li class="spacer"></li>
      <li class="li_dorpdown" data-ectype="dorpdown">
        <div class="dt dsc-cm">网站导航</div>
        <div class="dd dorpdown-layer" style="z-index: 10000000;">
          <dl class="fore1">
            <dt>特色主题</dt>
            <dd>
              <div class="item">
                <a href="#" target="_blank">家用电器</a>
              </div>
              <div class="item">
                <a href="#" target="_blank">手机数码</a>
              </div>
              <div class="item">
                <a href="#" target="_blank">电脑办公</a>
              </div>
            </dd>
          </dl>
          <dl class="fore2">
            <dt>促销活动</dt>
            <dd>
              <div class="item">
                <a href="#">拍卖活动</a>
              </div>
              <div class="item">
                <a href="#">共创商品</a>
              </div>
              <div class="item">
                <a href="#">优惠活动</a>
              </div>
              <div class="item">
                <a href="#">批发市场</a>
              </div>
              <div class="item">
                <a href="#">超值礼包</a>
              </div>
              <div class="item">
                <a href="#">优惠券</a>
              </div>
            </dd>
          </dl>
        </div>
      </li>
    </ul>
  </div>
</div>
<div class="clear"></div>
<div class="header">
  <div class="header_container">
    <div class="logo fl">
      <img src="/Public/Home/images/logo.png"/>
      <a href="#"><img src="/Public/Home/images/ecsc-join.gif"/></a>
    </div>
    <div class="dsc-search">
      <div class="form">
        <form class="search-form">
          <input name="keywords" type="text" id="keyword" value="" class="search-text"
                 style="color: rgb(153, 153, 153);">
          <button type="submit" class="button button-goods">搜商品</button>
          <button type="submit" class="button button-store">搜店铺</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
<!--主体内容-->

  <!--商品分类-->
  <!--商品分类-->
<div class="nav" ectype="dscNav">
  <div class="w w1200">
    <div class='categorys <?php if(($is_show) == "1"): else: ?>site_mast<?php endif; ?>'>
      <div class="categorys-type">
        <a href="categoryall.php" target="_blank">全部商品分类</a>
      </div>
      <div class="categorys-tab-content">
        <div class="categorys-items" id="cata-nav">
          <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; if(($item["parent_id"]) == "0"): ?><div class="categorys-item">
                <div class="item item-content">
                  <i class="iconfont icon-ele"><img src="/Public/Home/images/icon/elece.png"></i>
                  <div class="categorys-title">
                    <strong>
                      <a href="<?php echo U('Category/index','id='.$item['id']);?>" target="_blank"><?php echo ($item["cname"]); ?></a>
                    </strong>
                    <span>
                  <!--<a href="#" target="_blank">大家电</a>
                  <a href="#" target="_blank">生活电器</a>-->
                </span>
                  </div>
                </div>
                <div class="categorys-items-layer">
                  <div class="cate-layer-con clearfix">
                    <div class="cate-layer-left">
                      <div class="cate_channel">
                        <a href="#" target="_blank">品牌日</a>
                        <a href="#" target="_blank">家电城</a>
                        <a href="#" target="_blank">智能生活馆</a>
                        <a href="#" target="_blank">京东净化馆</a>
                        <a href="#" target="_blank">京东帮服务店</a>
                        <a href="#" target="_blank">值得买精选</a>
                      </div>
                      <div class="cate_detail">
                        <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["parent_id"]) == $item["id"]): ?><dl class="dl_fore1">
                            <dt><a href="<?php echo U('Category/index','id='.$vo['id']);?>" target="_blank"><?php echo ($vo["cname"]); ?></a></dt>
                            <dd>
                              <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; if(($list["parent_id"]) == $vo["id"]): ?><a href="<?php echo U('Category/index','id='.$list['id']);?>" target="_blank"><?php echo ($list["cname"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </dd>
                          </dl><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                      </div>
                    </div>
                    <div class="cate-layer-rihgt">
                      <h3>猜你喜欢</h3>
                      <div class="cate-layer-right-slide">
                        <img src="/Public/Home/images/elec1.jpg"/>
                      </div>
                      <div class="cate-layer-right-slide">
                        <img src="/Public/Home/images/elec1.jpg"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clear"></div>
              </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </div>
    </div>
    <div class="nav-main" id="nav">
      <ul class="navitems">
        <li>
          <a href="#" class="curr">首页</a>
        </li>
        <li>
          <a href="#">食品特产</a>
        </li>
        <li>
          <a href="#">服装城</a>
        </li>
        <li>
          <a href="#">大家电</a>
        </li>
        <li>
          <a href="#">鞋靴箱包</a>
        </li>
        <li>
          <a href="#">品牌专区</a>
        </li>
        <li>
          <a href="#">聚划算</a>
        </li>
        <li>
          <a href="#">积分商城</a>
        </li>
        <li>
          <a href="#">预售</a>
        </li>
        <li>
          <a href="#">店铺街</a>
        </li>
      </ul>
    </div>
  </div>
</div>

  <!--商品列表-->
  <div class="w1200_container" style="min-height: 600px;">
    <!--热卖推荐-->
    <!--商品分类列表热卖推荐-->
<div class="hot_tj_container">
  <div class="hot_tj">热门推荐</div>
  <div class="hot_tj_list">
    <ul>
      <li>
        <div class="item">
          <div class="p_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/commend.jpg" />
            </a>
          </div>
          <div class="p_name">
            <a href="#" title="Apple/苹果 13 英寸：MacBook Pro Multi-Touch Bar 和 Touch ID 2.9GHz 处理器 512GB 存储容量" target="_blank">
              Apple/苹果 13 英寸：MacBook Pro Multi-Touch Bar 和 Touch ID 2.9GHz 处理器 512GB 存储容量
            </a>
          </div>
          <div class="p_price">
            <em>￥</em>7800.00
          </div>
          <div class="p_btn">
            <a href="#" target="_blank">立即购买</a>
          </div>
        </div>
      </li>
      <li>
        <div class="item">
          <div class="p_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/commend1.jpg" />
            </a>
          </div>
          <div class="p_name">
            <a href="#" title="Apple/苹果 13 英寸：MacBook Pro Multi-Touch Bar 和 Touch ID 2.9GHz 处理器 512GB 存储容量" target="_blank">
              Apple/苹果 13 英寸：MacBook Pro Multi-Touch Bar 和 Touch ID 2.9GHz 处理器 512GB 存储容量
            </a>
          </div>
          <div class="p_price">
            <em>￥</em>7800.00
          </div>
          <div class="p_btn">
            <a href="#" target="_blank">立即购买</a>
          </div>
        </div>
      </li>
      <li>
        <div class="item">
          <div class="p_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/commend2.jpg" />
            </a>
          </div>
          <div class="p_name">
            <a href="#" title="Apple/苹果 13 英寸：MacBook Pro Multi-Touch Bar 和 Touch ID 2.9GHz 处理器 512GB 存储容量" target="_blank">
              Apple/苹果 13 英寸：MacBook Pro Multi-Touch Bar 和 Touch ID 2.9GHz 处理器 512GB 存储容量
            </a>
          </div>
          <div class="p_price">
            <em>￥</em>7800.00
          </div>
          <div class="p_btn">
            <a href="#" target="_blank">立即购买</a>
          </div>
        </div>
      </li>
      <li class="last">
        <div class="item">
          <div class="p_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/commend2.jpg" />
            </a>
          </div>
          <div class="p_name">
            <a href="#" title="Apple/苹果 13 英寸：MacBook Pro Multi-Touch Bar 和 Touch ID 2.9GHz 处理器 512GB 存储容量" target="_blank">
              Apple/苹果 13 英寸：MacBook Pro Multi-Touch Bar 和 Touch ID 2.9GHz 处理器 512GB 存储容量
            </a>
          </div>
          <div class="p_price">
            <em>￥</em>7800.00
          </div>
          <div class="p_btn">
            <a href="#" target="_blank">立即购买</a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>

    <!--商品筛选-->
    <!--商品列表-->
    <!--商品分类列表中的额商品列表-->
<div class="clear"></div>
<div class="goods_show_con">
  <div class="picFocus1">
    <div class="bd">
      <div class="tempWrap">
        <ul>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list1.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list2.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list3.jpg"></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="hd">
      <ul>
        <li class="on"><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list1.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list2.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list3.jpg"></li>
      </ul>
    </div>
    <div class="p_mount">
      <div class="p_price">
        <em>￥</em>69.00
      </div>
      <div class="p_num">
        已售<em>10</em>件
      </div>
    </div>
    <div class="p_name">
      <a href="#" title="Sony/索尼 KDL-48W650D 48英寸液晶高清 wifi网络 平板电视 正品保证 三期免息 咨询有礼 售后上门" target="_blank">
        Sony/索尼 KDL-48W650D 48英寸液晶高清 wifi网络 平板电视 正品保证 三期免息 咨询有礼 售后上门
      </a>
    </div>
    <div class="in_cart">
      <span title="网站自营，品质保障">自营</span>
      <span title="该商品参与满减活动">满减</span>
      <div class="in_ca">
        <i><img src="/Public/Home/images/icon/cart2.png"/></i>
        <a href="#">加入购物车</a>
      </div>
    </div>
  </div>
  <div class="picFocus1">
    <div class="bd">
      <div class="tempWrap">
        <ul>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="hd">
      <ul>
        <li class="on"><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
      </ul>
    </div>
    <div class="p_mount">
      <div class="p_price">
        <em>￥</em>69.00
      </div>
      <div class="p_num">
        已售<em>10</em>件
      </div>
    </div>
    <div class="p_name">
      <a href="#" title="Sony/索尼 KDL-48W650D 48英寸液晶高清 wifi网络 平板电视 正品保证 三期免息 咨询有礼 售后上门" target="_blank">
        Sony/索尼 KDL-48W650D 48英寸液晶高清 wifi网络 平板电视 正品保证 三期免息 咨询有礼 售后上门
      </a>
    </div>
    <div class="in_cart">
      <span title="网站自营，品质保障">自营</span>
      <span title="该商品参与满减活动">满减</span>
      <div class="in_ca">
        <i><img src="/Public/Home/images/icon/cart2.png"/></i>
        <a href="#">加入购物车</a>
      </div>
    </div>
  </div>
  <div class="picFocus1">
    <div class="bd">
      <div class="tempWrap">
        <ul>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="hd">
      <ul>
        <li class="on"><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
      </ul>
    </div>
    <div class="p_mount">
      <div class="p_price">
        <em>￥</em>69.00
      </div>
      <div class="p_num">
        已售<em>10</em>件
      </div>
    </div>
    <div class="p_name">
      <a href="#" title="Sony/索尼 KDL-48W650D 48英寸液晶高清 wifi网络 平板电视 正品保证 三期免息 咨询有礼 售后上门" target="_blank">
        Sony/索尼 KDL-48W650D 48英寸液晶高清 wifi网络 平板电视 正品保证 三期免息 咨询有礼 售后上门
      </a>
    </div>
    <div class="in_cart">
      <span title="网站自营，品质保障">自营</span>
      <span title="该商品参与满减活动">满减</span>
      <div class="in_ca">
        <i><img src="/Public/Home/images/icon/cart2.png"/></i>
        <a href="#">加入购物车</a>
      </div>
    </div>
  </div>
  <div class="picFocus1">
    <div class="bd">
      <div class="tempWrap">
        <ul>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="hd">
      <ul>
        <li class="on"><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
      </ul>
    </div>
    <div class="p_mount">
      <div class="p_price">
        <em>￥</em>69.00
      </div>
      <div class="p_num">
        已售<em>10</em>件
      </div>
    </div>
    <div class="p_name">
      <a href="#" title="Sony/索尼 KDL-48W650D 48英寸液晶高清 wifi网络 平板电视 正品保证 三期免息 咨询有礼 售后上门" target="_blank">
        Sony/索尼 KDL-48W650D 48英寸液晶高清 wifi网络 平板电视 正品保证 三期免息 咨询有礼 售后上门
      </a>
    </div>
    <div class="in_cart">
      <span title="网站自营，品质保障">自营</span>
      <span title="该商品参与满减活动">满减</span>
      <div class="in_ca">
        <i><img src="/Public/Home/images/icon/cart2.png"/></i>
        <a href="#">加入购物车</a>
      </div>
    </div>
  </div>

  <div class="picFocus1">
    <div class="bd">
      <div class="tempWrap">
        <ul>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
          <li>
            <a target="_blank" href="#"><img src="/Public/Home/images/goods_list.jpg"></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="hd">
      <ul>
        <li class="on"><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
        <li class=""><img src="/Public/Home/images/goods_list.jpg"></li>
      </ul>
    </div>
    <div class="p_mount">
      <div class="p_price">
        <em>￥</em>69.00
      </div>
      <div class="p_num">
        已售<em>10</em>件
      </div>
    </div>
    <div class="p_name">
      <a href="#" title="Sony/索尼 KDL-48W650D 48英寸液晶高清 wifi网络 平板电视 正品保证 三期免息 咨询有礼 售后上门" target="_blank">
        Sony/索尼 KDL-48W650D 48英寸液晶高清 wifi网络 平板电视 正品保证 三期免息 咨询有礼 售后上门
      </a>
    </div>
    <div class="in_cart">
      <span title="网站自营，品质保障">自营</span>
      <span title="该商品参与满减活动">满减</span>
      <div class="in_ca">
        <i><img src="/Public/Home/images/icon/cart2.png"/></i>
        <a href="#">加入购物车</a>
      </div>
    </div>
  </div>
</div>
<div class="succeed hide">
  <section class="model_bg"></section>
  <section class="tianjia_su">
    <p>添加购物车成功</p>
  </section>
</div>

  </div>


<!--底部-->
<div class="footer_con">
  <div class="fnc_container">
    <div class="help-list">
      <div class="help-item">
        <h3>新手上路 </h3>
        <ul>
          <li>
            <a href="#" title="售后流程" target="_blank">售后流程</a>
          </li>
          <li>
            <a href="#" title="购物流程" target="_blank">购物流程</a>
          </li>
          <li>
            <a href="#" title="订购方式" target="_blank">订购方式</a>
          </li>
        </ul>

      </div>
      <div class="help-item">
        <h3>配送与支付 </h3>
        <ul>
          <li>
            <a href="#" title="货到付款区域" target="_blank">货到付款区域</a>
          </li>
          <li>
            <a href="#" title="配送支付智能查询 " target="_blank">配送支付智能查询</a>
          </li>
          <li>
            <a href="#" title="支付方式说明" target="_blank">支付方式说明</a>
          </li>
        </ul>

      </div>
      <div class="help-item">
        <h3>会员中心</h3>
        <ul>
          <li>
            <a href="#" title="资金管理" target="_blank">资金管理</a>
          </li>
          <li>
            <a href="#" title="我的收藏" target="_blank">我的收藏</a>
          </li>
          <li>
            <a href="#" title="我的订单" target="_blank">我的订单</a>
          </li>
        </ul>

      </div>
      <div class="help-item">
        <h3>服务保证 </h3>
        <ul>
          <li>
            <a href="#" title="退换货原则" target="_blank">退换货原则</a>
          </li>
          <li>
            <a href="#" title="售后服务保证" target="_blank">售后服务保证</a>
          </li>
          <li>
            <a href="#" title="产品质量保证 " target="_blank">产品质量保证</a>
          </li>
        </ul>

      </div>
      <div class="help-item">
        <h3>联系我们 </h3>
        <ul>
          <li>
            <a href="#" title="网站故障报告" target="_blank">网站故障报告</a>
          </li>
          <li>
            <a href="#" title="选机咨询 " target="_blank">选机咨询</a>
          </li>
          <li>
            <a href="#" title="投诉与建议 " target="_blank">投诉与建议</a>
          </li>
        </ul>
      </div>
      <div class="help-item">
        <h3>关注我们 </h3>
        <img src='/Public/Home/images/erweima.png'/>
      </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>

  <script type="text/javascript" src="/Public/Home/js/jquery.SuperSlider.js"></script>
  <script type="text/javascript" src="/Public/Home/js/kuCity.js"></script>
  <script>
    $('.li_dorpdown').hover(function() {
      $('.dorpdown-layer').show();
    });
    $('.li_dorpdown').mouseleave(function() {
      $('.dorpdown-layer').hide();
    });
    $('.icon-close').click(function() {
      $('.top_banner').hide();
    });
    $('.my_center_box_left a').hover(function() {

    });
    $('.cate-layer-right-slide img').mouseenter(function() {

      $(this).delay('300').animate(300);
    });
    $('.cate-layer-right-slide img').mouseleave(function() {
      $(this).css('border', 'none')
    });
  </script>
  <script>
    $('.search').kuCity();
    $("#lun2").slide({
      autoplay: true,
      autoTime: 5000,
    });
  </script>
  <!--滚动展示-->
  <script type="text/javascript">
    (function($) {

      $.fn.myScroll = function(options) {
        //默认配置
        var defaults = {
          speed: 50, //滚动速度,值越大速度越慢
          rowHeight: 50 //每行的高度
        };

        var opts = $.extend({}, defaults, options),
          intId = [];

        function marquee(obj, step) {

          obj.find("ul").animate({
            marginTop: '-=1'
          }, 0, function() {
            var s = Math.abs(parseInt($(this).css("margin-top")));
            if(s >= step) {
              $(this).find("li").slice(0, 1).appendTo($(this));
              $(this).css("margin-top", 0);
            }
          });
        }

        this.each(function(i) {
          var sh = opts["rowHeight"],
            speed = opts["speed"],
            _this = $(this);
          intId[i] = setInterval(function() {
            if(_this.find("ul").height() <= _this.height()) {
              clearInterval(intId[i]);
            } else {
              marquee(_this, sh);
            }
          }, speed);

          _this.hover(function() {
            clearInterval(intId[i]);
          }, function() {
            intId[i] = setInterval(function() {
              if(_this.find("ul").height() <= _this.height()) {
                clearInterval(intId[i]);
              } else {
                marquee(_this, sh);
              }
            }, speed);
          });

        });

      }

    })(jQuery);

    $(function() {

      $("div.ranklist").myScroll({
        speed: 50,
        rowHeight: 50
      });

    });
    $(".closehd").click(function() { //右下角红包图标点击变小
      $(this).hide();
      $('.bk_foot_redbag a').animate({
        width: '80px',
        height: '100px'
      });
    });
    $('#red_bag').click(function() {
      $(this).hide();
      $('.closehd').hide();
      $('.font').show();
      $('.font').css('display', 'inline-block')
      $('.red_bag').animate({
        width: '400px',
        height: '300px'
      });
    });
    $('#ensure').click(function() {
      $('.red_bag').fadeOut();
    });
    $('#red_bag').click(function() {
      $(this).hide();
      $('.closehd').hide();
      $('.font').show();
      $('.font').css('display', 'inline-block')
      $('.red_bag1').animate({
        width: '400px',
        height: '300px'
      });
    });
    $('#ensure').click(function() {
      $('.red_bag1').fadeOut();
    });

    //添加成功
    $('.in_ca').click(function(){
      $('.succeed').show();
      $(function () {
        setTimeout(function () {
          $(".succeed").fadeOut();
        }, 1000);
      })
    });
  </script>
  <script type="text/javascript">
    jQuery(".picFocus1").slide({ mainCell: ".bd ul", effect: "left", });
  </script>

</html>