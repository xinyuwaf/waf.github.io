<?php
//require 'vendor/autoload.php'; // 导入PHPMailer类库
$time1 = date('Y-m-d'); //时间获取，格式2023-08-07
$email_fa = 'xxx@qq.com'; // 发件邮箱地址
$email_fa_mm = 'xxxxxxxx'; // 发件邮箱密码，是授权码
$email_shou = 'xxx@qq.com'; // 收件邮箱地址
$email_bt = $_GET['email_bt']; // 邮件主题
$email_nr = $_GET['email_nr']; // 邮件内容
$email_nr1 = $_GET['email_nr1']; // 联系邮箱

if (!$email_fa)
    exit('{"code":-1,"msg":"发送方邮箱不能为空"}');
if (!$email_fa_mm)
    exit('{"code":-1,"msg":"发送方授权码不能为空"}');
if (!$email_shou)
    exit('{"code":-1,"msg":"接收方邮箱不能为空"}');
if (!$email_bt)
    exit('{"code":-1,"msg":"发送标题不能为空"}');
if (!$email_nr)
    exit('{"code":-1,"msg":"发送内容不能为空"}');
if (!$email_nr1)
    exit('{"code":-1,"msg":"联系邮箱不能为空"}');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

// 创建PHPMailer实例
$mail = new PHPMailer(true); // 异常捕获模式

try {
    // SMTP服务器设置
    $mail->isSMTP(); // 使用SMTP
    $mail->Host = 'smtp.qq.com'; // SMTP服务器地址
    $mail->SMTPAuth = true; // 启用SMTP身份验证
    $mail->Username = $email_fa; // 发送方邮箱地址
    $mail->Password = $email_fa_mm; // 发送方邮箱密码
    $mail->SMTPSecure = 'ssl'; // 启用SSL加密
    $mail->Port = 465; // SMTP服务器端口号

    // 设置发件人和收件人
    $mail->setFrom($email_fa); // 发件人邮箱地址
    $mail->addAddress($email_shou); // 收件人邮箱地址
            
    // 邮件主题和正文
    $mail->Subject = $email_bt;

    // 创建HTML邮件内容
    $htmlContent = '
    <style>
    .qmbox .zibll-email-box .but{
        display: inline-block;
        border-radius: 4px;
        padding: 5px 22px;
        text-align: center;
        background: linear-gradient(135deg, #59c3fb 10%, #268df7 100%) !important;
        color: #fff !important;
        line-height: 1.4;
        text-decoration: none;
    }
    .qmbox .zibll-email-box img{
        max-width: 100%;
    }
    .qmbox .zibll-email-box a{
        text-decoration: none !important;
    }
</style>
<div class="zibll-email-box" style="background:#ecf1f3;padding-top:20px; min-width:820px;">
    <div style="width:801px;height:auto; margin:0px auto;">
        <div style="width:778px;height:auto;margin:0px 11px;background:#fff;box-shadow: 6px 3px 5px rgba(0,0,0,0.05);-webkit-box-shadow: 6px 3px 5px rgba(0,0,0,0.05);-moz-box-shadow: 6px 3px 5px rgba(0,0,0,0.05);-ms-box-shadow: 6px 3px 5px rgba(0,0,0,0.05);-o-box-shadow: 6px 3px 5px rgba(0,0,0,0.05);">
            <div style="width:781px; background:#fff;padding-top: 30px;">
                <div style="width:200px;height:100px;background:url(http://q2.qlogo.cn/headimg_dl?dst_uin=1601736449&spec=100) center no-repeat; margin:auto;background-size: contain;"></div>
            </div>
            <div style="width:627px;margin:0 auto; padding-left:77px; background:#fff;font-size:14px;color:#55798d;padding-right:77px;"><br  />
                <div style="overflow-wrap:break-word;line-height:30px;">
                尊敬的One degree<br  />您有一封新邮件，请你签收！<br  />邮件内容：<br  /><div class="muted-box" style="padding: 10px 15px; border-radius: 8px; background: rgba(141, 141, 141, 0.05); line-height: 1.7;">'.$email_nr.'</div>发送用户：'.$email_nr1.'<br  />发送时间：'.$time1.'<br  />
                </div>
                <br  /><br  /><br  />
            </div>
        </div>
        <div style="position:relative;top:-15px;width:800px;height: 360px;background:url(https://api.yuqios.com/img/mail-bg.png) 0px 0px no-repeat;">
            <div style="height:200px;color:#507383;font-size:14px;line-height: 1.4;padding: 20px 92px;">
                <div style="font-size: 22px;font-weight: bold;">One degree</div>
                <div style="margin:20px 0;color: #6a8895;min-height:4.2em;white-space: pre-wrap;">此信为系统邮件，请不要直接回复。</div>
                <div style=""><a href="http://api.cyan-blue.cn/">访问网站</a> |
<a></a></div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
</div>
';

    $mail->isHTML(true); // 将邮件内容设置为HTML格式
    $mail->Body = $htmlContent;

    // 发送邮件
    $mail->send();
    echo '留言成功！';
} catch (Exception $e) {
    echo '留意失败：' . $mail->ErrorInfo;
}
?>