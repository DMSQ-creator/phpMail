<?php
include("class.phpmailer.php");
include("class.smtp.php"); 

//你只需填写以下信息即可****************************

$smtp = "smtp.126.com";//必填，设置SMTP服务器 QQ邮箱是smtp.qq.com ，QQ邮箱默认未开启，请在邮箱里设置开通。网易的是 smtp.163.com 或 smtp.126.com

$youremail =  'xxxxxx@126.com'; // 必填，开通SMTP服务的邮箱；也就是发件人Email。(本系统功能也就是自己给自己发邮件)

$password = "*********"; //必填， 以上邮箱对应的密码

$ymail = "xxxxxxxxx@qq.com"; //收信人的邮箱地址，也就是你自己收邮件的邮箱

$yname = "xxxxxxxx"; //收件人称呼



function get_ip(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
       $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
       $ip = getenv("HTTP_X_FORWARDED_FOR");
   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
       $ip = getenv("REMOTE_ADDR");
   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
       $ip = $_SERVER['REMOTE_ADDR'];
   else
       $ip = "unknown";
   return($ip);
}

$mail = new PHPMailer();

$mail->CharSet ='utf-8'; //编码要指定 
$mail->Encoding = 'base64'; //加密方式
$mail->SMTPSecure = "ssl";  //解决25端口被屏蔽 参考源：https://github.com/LuhangRui/phpmailer/blob/master/example.php
$mail->IsSMTP();
$mail->Port=465; //使用端口
$mail->SMTPAuth = true; 
$mail->Host = $smtp; 


$mail->Username = $youremail; 
$mail->Password = $password; //必填， 以上邮箱对应的密码

$mail->From = $youremail; 
$mail->FromName = "询盘系统"; 

$mail->AddAddress($ymail,$yname);

if($_POST['add']=='1'){
	$yourname = $_POST['yourname'];
	$tel = $_POST['tel'];
	$qq = $_POST['qq'];
	$email = $_POST['email'];


	//$message = htmlentities($_POST['message'],ENT_QUOTES, "utf-8");
	$message=str_replace(" "," ",str_replace("\n","<br/>",$_POST['message']));
	//htmlentities(trim($message), ENT_QUOTES, "utf-8");
	
	$ip = get_ip();
	
	$mail->Subject = $yourname."-【xxxxxxxxx】"; 
	date_default_timezone_set('Asia/Shanghai');
	$time = date("Y-m-d H:i:s",time());
	
	$htmlcss="<div style='border: #93b5ff 1px solid;padding:10px;background-color: #e5fbe9;width:50%;margin-left:auto;margin-right:auto;'>";
	//$hc="</div>";

	//$html = $htmlcss.'Name：'.$yourname.'<br>Tel：'.$tel.'<br>QQ：'.$qq.'<br>Email：'.$email.'<br>IP：'.$ip.'<br>Time：'.$time.'<br>Content：<br>'.$message."</div>";
	$html = $htmlcss.'Name：'.$yourname.'<br>Email：'.$email.'<br>IP：'.$ip.'<br>Time：'.$time.'<br>Content：<br>'.$message."</div>";
	
	$mail->MsgHTML($html);
	
	$mail->IsHTML(true); 

	if(!$mail->Send()) {
		header("Content-Type: text/html; charset=utf-8");

		echo '<script>alert("提交失败了！");history.go(-1);</script>';
	} else {
		header("Content-Type: text/html; charset=utf-8");
	    echo '<script>alert("提交成功！感谢你的反馈。");history.go(-1);</script>';
	}
}
?>
