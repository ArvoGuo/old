<?php
if(!isset($_SESSION)){
    session_start();
}
require 'forQQLogin.func.php';
//用于存储access_token ,$_session['access_token']
qq_callback();



setcookie("QQ_access_token",$_SESSION['access_token'],time()+3600*24*90,"/");

get_openid();
setcookie("QQ_openid",$_SESSION['openid'],time()+3600*24*90,"/");
$arr = get_user_info();
$username=$arr["nickname"];
$sex=$arr["gender"];
require '../config/config_mysql.func.php';



$sql_check="SELECT * FROM USER_ACCOUNT WHERE USERACCOUNT='{$username}'";
	$result=mysql_query($sql_check);
	$_num=mysql_num_rows($result);
	if ($_num==0){
			$_data=array();
	$_data['username']=$username;
	$_data['password']="";
	$_data['sex']=$sex;
	$_data['tel']="";
	$_data['email']="";
	date_default_timezone_set('PRC');
	$_data['createdate'] = date('Y-m-d H:i:s');
	
	$sql="INSERT INTO USER_ACCOUNT(
	USERACCOUNT,
	USERPASSWORD,
	USERTEL,
	USEREMAIL,
	USERSEX,
	USERCREATEDATE
	
	
	) VALUES(
	'{$_data['username']}',
	'{$_data['password']}',
	'{$_data['tel']}',
	'{$_data['email']}',
	'{$_data['sex']}',
	'{$_data['createdate']}'
	
	
	)";
	@conn_query($sql);
	}
	

echo "<script type='text/javascript'>location.href='http://www.jsd001.com';</script>";
//$arr = get_user_info();
//echo "<p>";
//echo "NickName:".$arr["nickname"];
//echo "</p>";
//echo "<p>";
//echo "<img src=\"".$arr['figureurl_2']."\">";
//echo "</p>";
//echo "openid:".$_SESSION['openid'];


?>
