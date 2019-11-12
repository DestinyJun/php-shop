<?php
// 定义项目使用的公共函数，此文件下的函数会自动载入到项目中，并且所有函数可以在项目的任何模块下使用
/**
 * 生成商品列表中的链接地址函数
 * @param $name string
 * @param $value string 需要排序字段
 */
function myU($name, $value)
{
  $attr = I('get.attr');
  if ($name == 'sort') {
    // 将排序字段保存到$sort中
    $sort = $value;
    $price = I('get.price');
  } elseif ($name == 'price') {
    $price = $value;
    $sort = I('get.sort');
  } elseif ($name == 'attr') {
    // 这里需要注意：实现多个属性值进行筛选查询的情况
    if (!$attr) {
      $attr = $value;
    } else {
      $attr = explode(',', $attr);
      $attr[] = $value;
      $attr = array_unique($attr);
      $attr = implode(',', $attr);
    }
  }
  return U("Category/index") . '?id=' . I('get.id') . '&sort=' . $sort . 'price=' . $price . 'attr=' . $attr;
}

/**
 * 发送模板短信
 * @param string to 手机号码集合,用英文逗号分开
 * @param array datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
 * @param string $tempId 模板Id
 */
function sendTemplateSMS($to="18798723901", $datas=array('2345','60'), $tempId="1")
{
  include_once("./sms/CCPRestSDK.php");

//主帐号
  $accountSid = '8aaf07086e0115bb016e589512f42ec9';

//主帐号Token
  $accountToken = 'bff682f0aa904315bcac86d47c63db5a';

//应用Id
  $appId = '8a216da86e011fa3016e5994ed343027';

//请求地址，格式如下，不需要写https://
// 生产环境：app.cloopen.com
// 测试环境：sandboxapp.cloopen.com
  $serverIP = 'sandboxapp.cloopen.com';

//请求端口
  $serverPort = '8883';

//REST版本号
  $softVersion = '2013-12-26';
  // 初始化REST SDK
  $rest = new \REST($serverIP, $serverPort, $softVersion);
  $rest->setAccount($accountSid, $accountToken);
  $rest->setAppId($appId);

  // 发送模板短信
  $result = $rest->sendTemplateSMS($to, $datas, $tempId);
  if ($result == NULL) {
    return false;
  }
  if ($result->statusCode != 0) {
    //TODO 添加错误处理逻辑
    echo "error code :" . $result->statusCode . "<br>";
    echo "error msg :" . $result->statusMsg . "<br>";
    return false;
  }
  return true;
}

/**
 * 邮箱认证发送
 * @param $code
 * @param $address
 * @return bool
 * @throws \PHPMailer\PHPMailer\Exception
 */
function sendEmail($code,$address) {
  include_once './PHPMailer/Exception.php';
  include_once './PHPMailer/SMTP.php';
  include_once './PHPMailer/PHPMailer.php';
  $mail = new PHPMailer\PHPMailer\PHPMailer();
  /* 服务器配置相关信息*/
  $mail->isSMTP(); // 使用smtp方式发生邮件
  $mail->SMTPAuth = true; // 使用用户信息认证
  $mail->Host = 'smtp.163.com'; // 设置发邮件的smtp服务器地址
  $mail->Username = 'wwjwxm0858'; // 发件邮箱的用户名
  $mail->Password = 'lps5815081'; // 发件邮箱的POP3/SMTP/IMAP授权码

  /* 发送的邮件内容信息 */
  $mail->isHTML(true); // 使用html文本格式
  $mail->CharSet = 'UTF-8'; // 内容字符集
  $mail->From = 'wwjwxm0858@163.com'; // 发件人邮件地址
  $mail->FromName = '文君电商'; // 发件人昵称
  $mail->Subject = '文君电商注册邮箱认证'; // 邮件主题
  $mail->msgHTML("邮箱验证码位：{$code}，10分钟内有效"); // 邮件正文
  $mail->addAddress($address); // 收件人
  $mail->addAttachment('./Uploads/goods/2019-10-24/5db1c4bb3a571.jpg'); // 追加附件
  $res = $mail->send();
  return $res;
}
