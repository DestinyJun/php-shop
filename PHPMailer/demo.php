<?php
require_once './Exception.php';
require_once './SMTP.php';
require_once './PHPMailer.php';

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
$mail->FromName = '玩尼玛'; // 发件人昵称
$mail->Subject = '邮件是我发的 主题'; // 邮件主题
try {
  $mail->msgHTML('这是发出去的内容 正文');
} catch (\PHPMailer\PHPMailer\Exception $e) {
} // 邮件正文
try {
  $mail->addAddress('wxmwsw0858@163.com');
} catch (\PHPMailer\PHPMailer\Exception $e) {
} // 收件人
try {
  $mail->addAttachment('../Uploads/goods/2019-10-24/5db1c4bb3a571.jpg');
} catch (\PHPMailer\PHPMailer\Exception $e) {
} // 追加附件
try {
  $res = $mail->send();
} catch (\PHPMailer\PHPMailer\Exception $e) {
}
print_r($res);
