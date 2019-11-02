<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>首页</title>
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

  <!--轮播图-->
  <!--轮播图-->
<div class="slide" id="lun2" style="">
  <div class="carouse" style="min-width: 1200px;position:relative;margin-top: 0px;">
    <div class="slideItem">
      <a href="#" target="_blank"><img class="banner-img" src="/Public/Home/images/banner4.jpg" style="height: 500px;"></a>
    </div>
    <div class="slideItem">
      <a href="#" target="_blank"><img class="banner-img" src="/Public/Home/images/banner5.jpg" style="height: 500px;"></a>
    </div>
    <div class="slideItem">
      <a href="#" target="_blank"><img class="banner-img" src="/Public/Home/images/banner6.jpg" style="height: 500px;"></a>
    </div>
    <!--<a class="carousel-control left Next"></a>
    <a class="carousel-control right Previous"></a>-->
  </div>
  <!-- 轮播底部圆点 -->
  <div class="dotList"></div>
</div>

  <!--购物新闻推荐-->
  <!--购物新闻推荐-->
<div class="shop_new">
  <div class="sy_c">
    <div class="sy_gg">
      <div class="shop_new_logo">
        <img src="/Public/Home/images/new1.png" />
        <img src="/Public/Home/images/new3.png" />
      </div>
      <div class="ranklist">
        <ul>
          <li>
            <a href="#">小米：58秒售罄！魅族：抱歉，我30秒</a>
            <a href="#"><span>点我查看详情</span></a>
          </li>
          <li>
            <a href="#">穿这样的裙子会显高，你穿过几种？</a>
            <a href="#"><span>点我查看详情</span></a>
          </li>
          <li>
            <a href="#">蓄电池专场下单立减100元</a>
            <a href="#"><span>点我查看详情</span></a>
          </li>
          <li>
            <a href="#">五星双人自助低至299元</a>
            <a href="#"><span>点我查看详情</span></a>
          </li>
          <li>
            <a href="#">天府大件运营中心开仓公告</a>
            <a href="#"><span>点我查看详情</span></a>
          </li>
        </ul>
      </div>
      <div class="new_more">
        <a href="#"><img src="/Public/Home/images/new_more.png" /></a>
      </div>
    </div>
  </div>
</div>

  <!--今日秒杀-->
  <!--今日秒杀-->
<div class="seckill-channel" id="h-seckill">
  <div class="box-hd clearfix">
    <i class="box_hd_arrow"></i>
    <i class="box_hd_dec"><img src="/Public/Home/images/box_hd_arrow.png"/></i>
    <i class="box-hd-icon"></i>
    <div class="sk-time-cd">
      <div class="sk-cd-tit">距结束</div>
      <div class="cd-time fl" ectype="time" data-time="2017-12-18 10:00:00">
        <div class="days hide">00</div>
        <span class="split hide">天</span>
        <div class="hours">00</div>
        <span class="split">时</span>
        <div class="minutes">00</div>
        <span class="split">分</span>
        <div class="seconds">00</div>
        <span class="split">秒</span>
      </div>
    </div>
    <div class="sk-more">
      <a href="seckill.php" target="_blank">更多秒杀</a> <i class="arrow"></i></div>
  </div>
  <div class="box-bd clearfix slideTxtBox">
    <div class="tempWrap hd">
      <ul>
        <li class="opacity_img clone">
          <div class="p-img">
            <a href="#" target="_blank"><img src="/Public/Home/images/miaosha0.jpg"></a>
          </div>
          <div class="p-name">
            <a href="#" target="_blank" title="HLA/海澜之家撞色长袖T恤春季热卖圆领修身拼接T恤男 简约圆领 微弹修身 撞色拼接 触感柔软">HLA/海澜之家撞色长袖T恤春季热卖圆领修身拼接T恤男 简约圆领 微弹修身 撞色拼接 触感柔软</a>
          </div>
          <div class="p-over">
            <div class="p-info">
              <div class="p-price">
                <span class="shop-price"><em>¥</em>356.00</span>
                <span class="original-price"><em>¥</em>117.60</span>
              </div>
            </div>
            <div class="p-btn">
              <a href="#" target="_blank">立即抢购</a>
            </div>
          </div>
        </li>
        <li class="opacity_img">
          <div class="p-img">
            <a href="#" target="_blank"><img src="/Public/Home/images/miaosha0.jpg"></a>
          </div>
          <div class="p-name">
            <a href="#" target="_blank" title="特大号加厚塑料收纳箱整理箱有盖收纳盒衣服被子置物周转储物箱子">特大号加厚塑料收纳箱整理箱有盖收纳盒衣服被子置物周转储物箱子</a>
          </div>
          <div class="p-over">
            <div class="p-info">
              <div class="p-price">
                <span class="shop-price"><em>¥</em>1423.00</span>
                <span class="original-price"><em>¥</em>240.00</span>
              </div>
            </div>
            <div class="p-btn">
              <a href="#" target="_blank">立即抢购</a>
            </div>
          </div>
        </li>
        <li class="opacity_img">
          <div class="p-img">
            <a href="#" target="_blank"><img src="/Public/Home/images/miaosha0.jpg"></a>
          </div>
          <div class="p-name">
            <a href="#" target="_blank" title="74超薄非球面镜片高度近视眼镜片近视镜片防蓝光配眼镜镜片加工 套餐价低至359元 6款镜架任您选">74超薄非球面镜片高度近视眼镜片近视镜片防蓝光配眼镜镜片加工 套餐价低至359元 6款镜架任您选</a>
          </div>
          <div class="p-over">
            <div class="p-info">
              <div class="p-price">
                <span class="shop-price"><em>¥</em>356.00</span>
                <span class="original-price"><em>¥</em>478.79</span>
              </div>
            </div>
            <div class="p-btn">
              <a href="#" target="_blank">立即抢购</a>
            </div>
          </div>
        </li>
        <li class="opacity_img">
          <div class="p-img">
            <a href="#" target="_blank"><img src="/Public/Home/images/miaosha0.jpg"></a>
          </div>
          <div class="p-name">
            <a href="#" target="_blank" title="南极人法兰绒毛毯加厚秋单人双人珊瑚绒毯子双层冬季被子盖毯 加厚保暖 不掉毛 柔软面料 亲肤透气">南极人法兰绒毛毯加厚秋单人双人珊瑚绒毯子双层冬季被子盖毯 加厚保暖 不掉毛 柔软面料 亲肤透气</a>
          </div>
          <div class="p-over">
            <div class="p-info">
              <div class="p-price">
                <span class="shop-price"><em>¥</em>1641.00</span>
                <span class="original-price"><em>¥</em>180.00</span>
              </div>
            </div>
            <div class="p-btn">
              <a href="#" target="_blank">立即抢购</a>
            </div>
          </div>
        </li>
        <li class="opacity_img">
          <div class="p-img">
            <a href="#" target="_blank"><img src="/Public/Home/images/miaosha0.jpg"></a>
          </div>
          <div class="p-name">
            <a href="#" target="_blank" title="李军塑料防滑衣架衣挂撑子裤架衣服架成人晾衣架晒衣架子儿童衣架 成人衣架普通 款38cm 50个只要 21元">李军塑料防滑衣架衣挂撑子裤架衣服架成人晾衣架晒衣架子儿童衣架 成人衣架普通 款38cm 50个只要 21元</a>
          </div>
          <div class="p-over">
            <div class="p-info">
              <div class="p-price">
                <span class="shop-price"><em>¥</em>2423.00</span>
                <span class="original-price"><em>¥</em>25.20</span>
              </div>
            </div>
            <div class="p-btn">
              <a href="#" target="_blank">立即抢购</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>

  <!--优质新品-->
  <!--优质新品-->
<div class="need-channel clearfix" id="h-need">
  <div class="channel-column" style="background:url('/Public/Home/images/channel_bg1.jpg') no-repeat;">
    <div class="column-title">
      <h3>优质新品</h3>
      <p>专注生活美学</p>
    </div>
    <div class="column-img"><img src="/Public/Home/images/channel.png"></div>
    <a href="#" target="_blank" class="column-btn">去看看</a>
  </div>
  <div class="channel-column" style="background:url('/Public/Home/images/channel_bg2.jpg')  no-repeat;">
    <div class="column-title">
      <h3>品牌精选</h3>
      <p>潮牌尖货 初春换新</p>
    </div>
    <div class="column-img"><img src="/Public/Home/images/channel.png"></div>
    <a href="#" target="_blank" class="column-btn">去看看</a>
  </div>
  <div class="channel-column" style="background:url('/Public/Home/images/channel_bg3.jpg') no-repeat;">
    <div class="column-title">
      <h3>潮流女装</h3>
      <p>春装流行款抢购</p>
    </div>
    <div class="column-img"><img src="/Public/Home/images/channel.png"></div>
    <a href="#" target="_blank" class="column-btn">去看看</a>
  </div>
  <div class="channel-column" style="background:url('/Public/Home/images/channel_bg4.jpg') no-repeat;">
    <div class="column-title">
      <h3>人气美鞋</h3>
      <p>新外貌“鞋”会</p>
    </div>
    <div class="column-img"><img src="/Public/Home/images/channel.png"></div>
    <a href="#" target="_blank" class="column-btn">去看看</a>
  </div>
  <div class="channel-column" style="background:url('/Public/Home/images/channel_bg5.jpg') no-repeat;">
    <div class="column-title">
      <h3>护肤彩妆</h3>
      <p>春妆必买清单 低至3折</p>
    </div>
    <div class="column-img"><img src="/Public/Home/images/channel.png"></div>
    <a href="#" target="_blank" class="column-btn">去看看</a>
  </div>
</div>

  <!--垂钓专场分割图-->
  <div class="discount">
    <div class="dis_con">
      <a href="#"><img src="/Public/Home/images/discount1.png" /></a>
    </div>
  </div>
  <!--更多推荐-->
  <!--更多推荐-->
<div class="w1200_container">
  <!--享品质 享生活-->
  <div class="enjoy_title">
    <h3>享品质 享生活</h3>
  </div>
  <div class="enjoy_content">
    <div class="enjoy_con">
      <a href="#">
        <div class="enjoy_bg">
          <div class="enjoy_info">
            <div class="enjoy1_title">
              <h4>新品首发</h4>
              <p>荣耀系列 今日特惠</p>
            </div>
          </div>
          <img src="/Public/Home/images/enjoy1.png" class="enter1_enjoy" />
        </div>
      </a>
    </div>
    <div class="enjoy_con">
      <a href="#">
        <div class="enjoy_bg">
          <div class="enjoy_info" style="background: #DBCF6E;">
            <div class="enjoy1_title">
              <h4>会逛</h4>
              <p>厨具超级品牌日</p>
            </div>
          </div>
          <img src="/Public/Home/images/enjoy2.jpg" class="enter1_enjoy" />
        </div>
      </a>
    </div>
    <div class="enjoy_con">
      <a href="#">
        <div class="enjoy_bg">
          <div class="enjoy_info" style="background: #534b5d;">
            <div class="enjoy1_title">
              <h4>奢侈大牌</h4>
              <p>尽享品质生活</p>
            </div>
          </div>
          <img src="/Public/Home/images/enjoy3.jpg" class="enter1_enjoy" />
        </div>
      </a>
    </div>
    <div class="enjoy_con">
      <a href="#">
        <div class="enjoy_bg">
          <div class="enjoy_info" style="background: #3b838c;">
            <div class="enjoy1_title">
              <h4>智能生活</h4>
              <p>智能潮货，嗨购不停</p>
            </div>
          </div>
          <img src="/Public/Home/images/enjoy4.jpg" class="enter1_enjoy" />
        </div>
      </a>
    </div>
    <div class="enjoy_con">
      <a href="#">
        <div class="enjoy_bg">
          <div class="enjoy_info" style="background:#d58717;">
            <div class="enjoy1_title">
              <h4>京东超市</h4>
              <p>精选超值好货 天天特价</p>
            </div>
          </div>
          <img src="/Public/Home/images/enjoy5.jpg" class="enter1_enjoy" />
        </div>
      </a>
    </div>
    <div class="enjoy_con">
      <a href="#">
        <div class="enjoy_bg">
          <div class="enjoy_info" style="background: #7e5944">
            <div class="enjoy1_title">
              <h4>白条商城</h4>
              <p>最高12期免息</p>
            </div>
          </div>
          <img src="/Public/Home/images/enjoy6.jpg" class="enter1_enjoy" />
        </div>
      </a>
    </div>
  </div>
  <div class="clear"></div>
  <!--达人专区-->
  <div class="enjoy_title">
    <h3>达人专区</h3>
  </div>
  <div class="mastor_con">
    <div class="mastor_part" style="background: url(/Public/Home/images/vip1.jpg); center center no-repeat">
      <div class="master_main">
        <div class="mastor_title">
          <h3>纯棉质品</h3>
          <span>把好货带回家</span>
        </div>
        <a href="#" class="master_btn" target="_blank" style="color:#7bd1f6;;">去见识</a>
        <div class="master_img">
          <a href="#" target="_blank">
            <img src="/Public/Home/images/vip_shop1.png">
          </a>
        </div>
      </div>
    </div>
    <div class="mastor_part" style="background: url(/Public/Home/images/vip2.jpg); center center no-repeat">
      <div class="master_main">
        <div class="mastor_title">
          <h3>团购热卖</h3>
          <span>都是好货</span>
        </div>
        <a href="#" class="master_btn" target="_blank" style="color:#f75674;">去见识</a>
        <div class="master_img">
          <a href="#" target="_blank">
            <img src="/Public/Home/images/vip_shop2.png">
          </a>
        </div>
      </div>
    </div>
    <div class="mastor_part" style="background: url(/Public/Home/images/vip3.jpg); center center no-repeat">
      <div class="master_main">
        <div class="mastor_title">
          <h3>团购热卖</h3>
          <span>每一款都是好货</span>
        </div>
        <a href="#" class="master_btn" target="_blank" style="color:#ff889e;">去见识</a>
        <div class="master_img">
          <a href="#" target="_blank">
            <img src="/Public/Home/images/vip_shop3.png">
          </a>
        </div>
      </div>
    </div>
    <div class="mastor_part" style="background: url(/Public/Home/images/vip4.jpg); center center no-repeat">
      <div class="master_main">
        <div class="mastor_title">
          <h3>舒适童鞋</h3>
          <span>帮宝宝走路</span>
        </div>
        <a href="#" class="master_btn" target="_blank" style="color:#cd51eb;">去见识</a>
        <div class="master_img">
          <a href="#" target="_blank">
            <img src="/Public/Home/images/vip_shop4.png">
          </a>
        </div>
      </div>
    </div>
    <div class="mastor_part" style="background: url(/Public/Home/images/vip5.jpg); center center no-repeat">
      <div class="master_main">
        <div class="mastor_title">
          <h3>舒适运动鞋</h3>
          <span>品牌直降</span>
        </div>
        <a href="#" class="master_btn" target="_blank" style="color:#43dd72;">去见识</a>
        <div class="master_img">
          <a href="#" target="_blank">
            <img src="/Public/Home/images/vip_shop5.png">
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <!--店铺推荐-->
  <div class="enjoy_title">
    <h3>店铺推荐</h3>
  </div>
  <div class="good_shop_con">
    <div class="good_shop">
      <a href="#" target="_blank">
        <div class="shop_img">
          <img src="/Public/Home/images/good_shop1.png" />
        </div>
        <div class="shop_logo">
          <div class="s_logo">
            <img src="/Public/Home/images/shop_logo.png" />
          </div>
          <div class="s_title">
            <p>美宝莲</p>
            <p>纽约高街潮妆</p>
          </div>
        </div>
      </a>
    </div>
    <div class="good_shop">
      <a href="#" target="_blank">
        <div class="shop_img">
          <img src="/Public/Home/images/good_shop2.png" />
        </div>
        <div class="shop_logo">
          <div class="s_logo">
            <img src="/Public/Home/images/shop_logo1.png" />
          </div>
          <div class="s_title">
            <p>三只松鼠</p>
            <p>就是这个味</p>
          </div>
        </div>
      </a>
    </div>
    <div class="good_shop">
      <a href="#" target="_blank">
        <div class="shop_img">
          <img src="/Public/Home/images/good_shop3.png" />
        </div>
        <div class="shop_logo">
          <div class="s_logo">
            <img src="/Public/Home/images/shop_logo2.png" />
          </div>
          <div class="s_title">
            <p>绿联旗舰店</p>
            <p>给生活多点精彩</p>
          </div>
        </div>
      </a>
    </div>
    <div class="good_shop">
      <a href="#" target="_blank">
        <div class="shop_img">
          <img src="/Public/Home/images/good_shop4.png" />
        </div>
        <div class="shop_logo">
          <div class="s_logo">
            <img src="/Public/Home/images/shop_logo3.png" />
          </div>
          <div class="s_title">
            <p>韩都衣舍</p>
            <p>满249减50</p>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="clear"></div>
  <!--品牌推荐-->
  <div class="enjoy_title">
    <h3>品牌推荐</h3>
  </div>
  <div class="brand_con">
    <div class="brand_left">
      <a href="#" target="_blank">
        <img src="/Public/Home/images/brand.jpg" />
      </a>
    </div>
    <div class="brand_right" id="recommend_brands">
      <ul>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (1).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count0">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (2).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count1">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (3).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (4).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (5).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (6).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (7).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (8).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (9).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (10).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (11).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (12).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (13).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (14).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (15).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (16).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (17).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
        <li>
          <div class="brand_img">
            <a href="#" target="_blank">
              <img src="/Public/Home/images/icon1/brand (18).jpg" />
            </a>
          </div>
          <div class="brand_mash">
            <div class="coupon">
              <a href="#" target="_blank">
                关注人数<br>
                <div id="count2">0</div>
              </a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
  <!--还没逛够-->
  <div class="enjoy_title">
    <h3>还没逛够</h3>
  </div>
  <div class="no_enough">
    <ul>
      <li class="opacity_img1">
        <a href="#" target="_blank">
          <div class="p_img">
            <img src="/Public/Home/images/no_enough1.jpg" />
          </div>
          <div class="no_ename" title="【情侣款】Camel骆驼男靴 时尚潮流英伦风马丁靴高帮皮靴 爆卖1万双！ 情侣马丁靴 好评如潮">
            【情侣款】Camel骆驼男靴 时尚潮流英伦风马丁靴高帮皮靴 爆卖1万双！ 情侣马丁靴 好评如潮
          </div>
          <div class="no_eprice">
            <em>¥</em>555.00
          </div>
        </a>
      </li>
      <li class="opacity_img1">
        <a href="#" target="_blank">
          <div class="p_img">
            <img src="/Public/Home/images/no_enough2.jpg" />
          </div>
          <div class="no_ename" title="春季马丁靴男真皮男靴黄靴工装军靴韩版短靴沙漠靴高帮男鞋大黄靴 头层牛皮">
            春季马丁靴男真皮男靴黄靴工装军靴韩版短靴沙漠靴高帮男鞋大黄靴 头层牛皮
          </div>
          <div class="no_eprice">
            <em>¥</em>555.00
          </div>
        </a>
      </li>
      <li class="opacity_img1">
        <a href="#" target="_blank">
          <div class="p_img">
            <img src="/Public/Home/images/no_enough3.jpg" />
          </div>
          <div class="no_ename" title="特步女鞋2017春季新款运动鞋休闲鞋女慢跑步鞋旅游鞋轻便舒适时尚 早春特惠 爆款休闲女鞋 赠运费险">
            特步女鞋2017春季新款运动鞋休闲鞋女慢跑步鞋旅游鞋轻便舒适时尚 早春特惠 爆款休闲女鞋 赠运费险
          </div>
          <div class="no_eprice">
            <em>¥</em>555.00
          </div>
        </a>
      </li>
      <li class="opacity_img1">
        <a href="#" target="_blank">
          <div class="p_img">
            <img src="/Public/Home/images/no_enough4.jpg" />
          </div>
          <div class="no_ename" title="新款韩版chic学生宽松短款外套上衣字母长袖连帽套头卫衣女潮">
            新款韩版chic学生宽松短款外套上衣字母长袖连帽套头卫衣女潮
          </div>
          <div class="no_eprice">
            <em>¥</em>555.00
          </div>
        </a>
      </li>
      <li class="opacity_img1">
        <a href="#" target="_blank">
          <div class="p_img">
            <img src="/Public/Home/images/no_enough5.jpg" />
          </div>
          <div class="no_ename" title="igtt铝框行李箱拉杆箱旅行箱万向轮男女20/24/26寸密码箱登机箱子 铝合金框 加强密码锁 万向轮 终身保修">
            igtt铝框行李箱拉杆箱旅行箱万向轮男女20/24/26寸密码箱登机箱子 铝合金框 加强密码锁 万向轮 终身保修
          </div>
          <div class="no_eprice">
            <em>¥</em>555.00
          </div>
        </a>
      </li>
      <li class="opacity_img1">
        <a href="#" target="_blank">
          <div class="p_img">
            <img src="/Public/Home/images/no_enough6.jpg" />
          </div>
          <div class="no_ename" title="波米铝框拉杆箱万向轮密码旅行箱子20/24寸行李箱女登机箱男26/28 顺丰速运赠运费险赠十礼品终身质保">
            波米铝框拉杆箱万向轮密码旅行箱子20/24寸行李箱女登机箱男26/28 顺丰速运赠运费险赠十礼品终身质保
          </div>
          <div class="no_eprice">
            <em>¥</em>555.00
          </div>
        </a>
      </li>
      <li class="opacity_img1">
        <a href="#" target="_blank">
          <div class="p_img">
            <img src="/Public/Home/images/no_enough7.jpg" />
          </div>
          <div class="no_ename" title="2016秋冬季新款尖头粗跟短靴女高跟真皮加绒中跟马丁靴女靴子女鞋 优质全头层牛皮，品质女鞋">
            2016秋冬季新款尖头粗跟短靴女高跟真皮加绒中跟马丁靴女靴子女鞋 优质全头层牛皮，品质女鞋
          </div>
          <div class="no_eprice">
            <em>¥</em>555.00
          </div>
        </a>
      </li>
      <li class="opacity_img1">
        <a href="#" target="_blank">
          <div class="p_img">
            <img src="/Public/Home/images/no_enough8.jpg" />
          </div>
          <div class="no_ename" title="创意真皮床双人床现代婚床1.8米1.5榻榻米床储物床皮艺床软床大床 床侧储物 升降靠背 双ll价格 更低">
            创意真皮床双人床现代婚床1.8米1.5榻榻米床储物床皮艺床软床大床 床侧储物 升降靠背 双ll价格 更低
          </div>
          <div class="no_eprice">
            <em>¥</em>555.00
          </div>
        </a>
      </li>
      <li class="opacity_img1">
        <a href="#" target="_blank">
          <div class="p_img">
            <img src="/Public/Home/images/no_enough9.jpg" />
          </div>
          <div class="no_ename" title="韩都衣舍2017韩版女装新款黑白拼接插肩棒球服春季短外套HH5597妠 朴信惠同款 黑白拼接 插肩袖 棒球服">
            韩都衣舍2017韩版女装新款黑白拼接插肩棒球服春季短外套HH5597妠 朴信惠同款 黑白拼接 插肩袖 棒球服
          </div>
          <div class="no_eprice">
            <em>¥</em>555.00
          </div>
        </a>
      </li>
      <li class="opacity_img1">
        <a href="#" target="_blank">
          <div class="p_img">
            <img src="/Public/Home/images/no_enough10.jpg" />
          </div>
          <div class="no_ename" title="秋季新款男士套头卫衣印花外套韩版简约百搭潮流男生上衣服">
            秋季新款男士套头卫衣印花外套韩版简约百搭潮流男生上衣服
          </div>
          <div class="no_eprice">
            <em>¥</em>555.00
          </div>
        </a>
      </li>
    </ul>
  </div>
  <div class="clear"></div>
</div>



  <!--右侧红包栏-->
  <!--<div class="bk_foot_redbag">
    <a href="javascript:void(0)" id="red_bag">
      <img src="/Public/Home/images/red_package.png" width="100%" alt="">
    </a>
    <span class="closehd"></span>
  </div>
  <div class="red_bag">
    <span class="hide font">
      <span>10</span>元红包砸中了您
    </span>
    <br />
    <button class="hide font" id="ensure">确定</button>
  </div>-->

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

  <script type="text/javascript" src="/Public/Home/js/kuCity.js"></script>
  <script type="text/javascript" src="/Public/Home/js/jquery.SuperSlider.js"></script>
  <script type="text/javascript" src="/Public/Home/js/slide.js"></script>
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
    $()
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
    $('#red_bag').click(function(){
      $(this).hide();
      $('.closehd').hide();
      $('.font').show();
      $('.font').css('display','inline-block')
      $('.red_bag').animate({
        width:'400px',
        height:'300px'
      });
    });
    $('#ensure').click(function(){
      $('.red_bag').fadeOut();
    });
  </script>

</html>