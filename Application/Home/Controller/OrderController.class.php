<?php
namespace Home\Controller;

final class OrderController extends CommonController
{
  public function check() {
    // 结算之前，必须先登陆
    $this->checkLogin();
    // 登陆后显示结算页，获取数据并显示购物车
    $model = D('Cart');
    $data = $model->getList();
    $total = $model->getTotal($data);
    $total['data'] = $data;
    $this->assign('total',$total);
    $this->display();
  }

  public function order() {
    // 下单之前，必须先登陆
   $this->checkLogin();
    $model = D('Order');
    $res = $model->order();
    if (!$res) {
      $this->error($model->getError());
    }
    // 下单后支付
    require_once './pay/config.php';
    require_once './pay/pagepay/service/AlipayTradeService.php';
    require_once './pay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';

    //商户订单号，商户网站订单系统中唯一订单号，必填
    $out_trade_no = $res['id'];

    //订单名称，必填，测试环境下，无需组装，直接test
    $subject = 'test';

    //付款金额，必填，正式环境下需要写正式金额，测试一分即可
    $total_amount = 0.01;

    //商品描述，可空
    $body = 'test_desc';

    //构造参数
    $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
    $payRequestBuilder->setBody($body);
    $payRequestBuilder->setSubject($subject);
    $payRequestBuilder->setTotalAmount($total_amount);
    $payRequestBuilder->setOutTradeNo($out_trade_no);

    $aop = new \AlipayTradeService($config);
    $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

    //输出表单
    var_dump($response);
  }

  public function returnUrl() {
    require_once("./pay/config.php");
    require_once './pay/pagepay/service/AlipayTradeService.php';


    $arr=$_GET;
    $alipaySevice = new \AlipayTradeService($config);
    $result = $alipaySevice->check($arr);

    /* 实际验证过程建议商户添加以下校验。
    1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
    2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
    3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
    4、验证app_id是否为该商户本身。
    */
    if($result) {//验证成功
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      //请在这里加上商户的业务逻辑程序代码
      //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
      //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

      //商户订单号
      $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

      // 支付成功后修改订单的支付状态
      D('order')->where("id={$out_trade_no}")->setField('pay_status',1);

      //支付宝交易号
      $trade_no = htmlspecialchars($_GET['trade_no']);

      echo "验证成功<br />支付宝交易号：".$trade_no;

      //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    else {
      //验证失败
      echo "验证失败";
    }
  }

  public function pay() {
    // 继续支付
    $this->checkLogin();
    $order_id = I('get.id');
    $model = D('Order');
    $res = $model->where("id={$order_id}")->find();
    if (!$res) {
      $this->error($model->getError());
    }
    // 下单后支付
    require_once './pay/config.php';
    require_once './pay/pagepay/service/AlipayTradeService.php';
    require_once './pay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';

    //商户订单号，商户网站订单系统中唯一订单号，必填
    $out_trade_no = $res['id'];

    //订单名称，必填，测试环境下，无需组装，直接test
    $subject = 'test';

    //付款金额，必填，正式环境下需要写正式金额，测试一分即可
    $total_amount = 0.01;

    //商品描述，可空
    $body = 'test_desc';

    //构造参数
    $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
    $payRequestBuilder->setBody($body);
    $payRequestBuilder->setSubject($subject);
    $payRequestBuilder->setTotalAmount($total_amount);
    $payRequestBuilder->setOutTradeNo($out_trade_no);

    $aop = new \AlipayTradeService($config);
    $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

    //输出表单
    var_dump($response);
  }
}
