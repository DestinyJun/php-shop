<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title><?php echo ($good["goods_name"]); ?></title>
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/base.css"/>
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css"/>
  <link rel="stylesheet" href="/Public/Home/css/slide.css"/>
  
  <link rel="stylesheet" href="/Public/Home/layui/css/layui.css" />
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/goods_list.css" />
  <link href="/Public/Home/css/common.css" rel="stylesheet" type="text/css" />
  <style>
    .city-choice .dsc-cm {
      position: static;
      border: none;
      height: 28px;
      line-height: 28px;
      z-index: 1;
    }
  </style>

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

  <div class="w1200_container">
    <div style="margin-top: 20px;float: left;">
      <!--页面必要代码,img标签上请务必带上图片真实尺寸px-->
      <div id="showbox">
        <li class="goods_photo">
          <?php if(is_array($goods_imgs)): $i = 0; $__LIST__ = $goods_imgs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="/<?php echo ($vo["goods_img"]); ?>" width="280" height="280" /><?php endforeach; endif; else: echo "" ;endif; ?>
        </li>
      </div>
      <!--展示图片盒子-->
      <div id="showsum"></div>
      <!--展示图片里边-->
      <p class="showpage">
        <a href="javascript:void(0);" id="showlast">
          < </a>
        <a href="javascript:void(0);" id="shownext"> > </a>
      </p>
    </div>
    <div class="pay_content fl">
      <div class="pay_title" style="white-space: nowrap;text-overflow:ellipsis; overflow:hidden;width: 500px"><?php echo ($good["goods_name"]); ?></div>
      <div class="summary">
        <div class="summary_price_warp">
          <div class="s_p_w_wrap">
            <div class="summary_item si_shop_price">
              <div class="si_tit">商 城 价</div>
              <div class="si_warp">
                <strong class="shop_price"><em>¥</em><?php echo ($good["shop_price"]); ?></strong>
                <span class="price_notify" data-userid="63" data-goodsid="650" ectype="priceNotify">降价通知</span>
              </div>
            </div>
            <div class="summary_item si_market_price">
              <div class="si_tit">市 场 价</div>
              <div class="si_warp">
                <div class="m_price"><em>¥</em><?php echo ($good["market_price"]); ?></div>
              </div>
            </div>
            <div class="si_info">
              <div class="si_cumulative">累计评价<em>0</em></div>
              <div class="si_cumulative">累计销量<em>0</em></div>
            </div>
            <div class="clear"></div>
            <div class="summary_basic_info">
              <div class="summary_item is_stock">
                <div class="si_tit">配送</div>
                <div class="si_warp">
										<span class="initial_area">
                                                                                                              上海市
                                        </span>
                  <span>至</span>
                  <div class="city-choice" id="city-choice" data-ectype="dorpdown">
                    <div class="dsc-choie dsc-cm" ectype="dsc-choie">
                      <input type="text" value="石家庄" class="search" style="margin: 3px 0 0 0;border: none;background: #f7f8f8;width: 40px;" />
                    </div>
                  </div>
                  <div class="store_warehouse">
                    <div class="store_prompt"><strong>有货</strong>，下单后立即发货</div>
                  </div>
                </div>
              </div>
              <div class="clear"></div>
              <div class="summary_item is_service">
                <div class="si_tit">服务</div>
                <div class="si_warp">
                  由
                  <a href="" class="link_red" target="_blank">本网站</a> 发货并提供售后服务
                  <span class="gary">[ 快递：<em>¥</em>4.30 ]</span>
                </div>
              </div>
              <div class="clear"></div>
              <div class="summary_item is_integral">
                <div class="si_tit">红包</div>
                <div class="si_warp">可用 <span class="integral">0</span></div>
              </div>
              <div class="summary_item is_number clear">
                <div class="si_tit">数量</div>
                <div class="si_warp">
                  <div class="amount_warp">
                    <input class="text buy_num" value="1" name="number">
                    <div class="a_btn">
                      <a href="javascript:void(0);" class="btn_add" ><i class="iconfont icon-up">+</i></a>
                      <a href="javascript:void(0);" class="btn_reduce btn_disabled" ><i class="iconfont icon-down">-</i></a>
                    </div>
                  </div>
                  <span>库存&nbsp;<em id="goods_attr_num" ectype="goods_attr_num"><?php echo ($good["goods_number"]); ?></em>&nbsp;个</span>
                </div>
              </div>
              <?php if(is_array($single)): $i = 0; $__LIST__ = $single;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="summary_item regular">
                  <div class="si_tit"><?php echo ($vo["0"]["attr_name"]); ?></div>
                  <div class="si_warp">
                    <ul class="regular_list">
                      <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="<?php if(($i) == "1"): ?>regular_sort<?php endif; ?>"><?php echo ($item["attr_values"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                  </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!--class="layui-btn layui-btn-normal"-->
            <div class="choose_btns clear">
              <a href="#" class="btn_buynow">立即购买</a>
              <a href="#" class="btn_append layui-btn layui-btn-danger business" data-type="auto" data-method="setTop"><i class="iconfont icon_carts"><img src="/Public/Home/images/icon/cart1.png" style="margin-top: -5px;"></i>加入购物车</a>
            </div>
            <div class="summary_item is_service">
              <div class="si_tit">温馨提示</div>
              <div class="si_warp gray">
                不支持退换货服务
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="enjoy_title">
      <h3>商品规格</h3>
    </div>
    <div class="no_enough" style="overflow: hidden">
      <?php if(is_array($unique)): $i = 0; $__LIST__ = $unique;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="summary_item regular" style="float: left">
          <div class="si_tit"><?php echo ($vo["attr_name"]); ?></div>
          <div class="si_warp">
            <span><?php echo ($vo["attr_values"]); ?></span>
          </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="clear"></div>
    <div class="enjoy_title">
      <h3>商品详情</h3>
    </div>
    <div class="no_enough" style="text-align: center">
      <?php echo ($good["goods_body"]); ?>
    </div>
  </div>
  <div class="clear"></div>


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
</script>

  <script src="/Public/Home/js/common.js"></script>
  <script type="text/javascript" src="/Public/Home/layui/layui.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var showproduct = {
        "boxid": "showbox",
        "sumid": "showsum",
        "boxw": 400, //宽度,该版本中请把宽高填写成一样
        "boxh": 400, //高度,该版本中请把宽高填写成一样
        "sumw": 60, //列表每个宽度,该版本中请把宽高填写成一样
        "sumh": 60, //列表每个高度,该版本中请把宽高填写成一样
        "sumi": 7, //列表间隔
        "sums": 5, //列表显示个数
        "sumsel": "sel",
        "sumborder": 1, //列表边框，没有边框填写0，边框在css中修改
        "lastid": "showlast",
        "nextid": "shownext"
      };
      $.ljsGlasses.pcGlasses(showproduct); //方法调用，务必在加载完后执行
    });
  </script>
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
    $('.cate-layer-right-slide img').mouseenter(function() {

      $(this).delay('300').animate(300);
    });
    $('.cate-layer-right-slide img').mouseleave(function() {
      $(this).css('border', 'none')
    });
    //alert($('.buy_num').val());
    $('.btn_add').click(function(){
      var index=$('.buy_num').val();
      index++;
      $('.buy_num').val(index++);
    });
    $('.regular_list li').click(function(){
      $(this).parent().children('li').removeClass('regular_sort');
      $(this).addClass('regular_sort');
    });
    $('.btn_reduce').click(function(){
      var index=$('.buy_num').val();
      if(index>1){
        index--;
        $('.buy_num').val(index--);
      }
    });
    //		$('.categorys-type').mouseenter(function(){
    //			$('.categorys-tab-content').show();
    //		});
    //		$('.categorys-type').mouseleave(function(){
    //			$('.categorys-tab-content').hide();
    //		});
  </script>
  <!--滚动展示-->
  <script type="text/javascript">
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
  </script>
  <script>
    layui.use('layer', function() { //独立版的layer无需执行这一句
      var $ = layui.jquery,
        layer = layui.layer; //独立版的layer无需执行这一句

      //触发事件
      var active = {
        setTop: function() {
          var that = this;
          //多窗口模式，层叠置顶
          layer.open({
            type: 2 //此处以iframe举例
            ,
            title: '温馨提示',
            area: ['390px', '260px'],
            shade: 0,
            maxmin: true,
            offset: [ //为了演示，随机坐标
              Math.random() * ($(window).height() - 300), Math.random() * ($(window).width() - 390)
            ],
            content: 'tip.html',
            btn: ['继续购物'],
            btn2: function() {
              layer.closeAll();
            },
            zIndex: layer.zIndex,
            success: function(layero) {
              layer.setTop(layero); //重点2
            }
          });
        },
        confirmTrans: function() {
          //配置一个透明的询问框
          layer.msg('大部分参数都是可以公用的<br>合理搭配，展示不一样的风格', {
            time: 20000, //20s后自动关闭
            btn: ['明白了', '知道了', '哦']
          });
        },
        notice: function() {
          //示范一个公告层
          layer.open({
            type: 1,
            title: false //不显示标题栏
            ,
            closeBtn: false,
            area: '300px;',
            shade: 0.8,
            id: 'LAY_layuipro' //设定一个id，防止重复弹出
            ,
            btn: ['火速围观', '残忍拒绝'],
            btnAlign: 'c',
            moveType: 1 //拖拽模式，0或者1
            ,
            content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">你知道吗？亲！<br>layer ≠ layui<br><br>layer只是作为Layui的一个弹层模块，由于其用户基数较大，所以常常会有人以为layui是layerui<br><br>layer虽然已被 Layui 收编为内置的弹层模块，但仍然会作为一个独立组件全力维护、升级。<br><br>我们此后的征途是星辰大海 ^_^</div>',
            success: function(layero) {
              var btn = layero.find('.layui-layer-btn');
              btn.find('.layui-layer-btn0').attr({
                href: 'http://www.layui.com/',
                target: '_blank'
              });
            }
          });
        }
      };

      $('.business').on('click', function() {
        var othis = $(this),
          method = othis.data('method');
        active[method] ? active[method].call(this, othis) : '';
      });
    });
  </script>

</html>