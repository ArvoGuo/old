<?php 
header ( 'Content-Type:text/html; charset=utf-8' );
require '../includes/common.inc.php';
if(!isset($_SESSION)){
    session_start();
}
if ($_POST['send']=="注册"){
	$_data=array();
	$_data['username']=$_POST['username'];
	$_data['password']=$_POST['password'];
	$_data['passwordsecond']=$_POST['passwordsecond'];
	$_data['sex']=$_POST['sex'];
	$_data['tel']=$_POST['tel'];
	$_data['email']=$_POST['email'];
	$_data['yzm']=$_POST['yzm'];
	date_default_timezone_set('PRC');
	$_data['createdate'] = date('Y-m-d H:i:s');
	
if ($_data['yzm']!=$_SESSION['code']){
		_alertinfo_historyback("验证码填写错误");
	}
	$rule_username="/^[a-zA-Z].{5,24}$/";
	$rule_password="/^.{6,25}$/";
	$rule_tel="/^[0-9]{8,11}$/";
	$rule_email="/^([\w\.\-]+)@([\w\-]+)\..*$/";
	preg_match($rule_username,$_data['username'],$result_username);
	preg_match($rule_password,$_data['password'],$result_password);
	preg_match($rule_tel,$_data['tel'],$result_tel);
	preg_match($rule_email,$_data['email'],$result_email);
	
	if (!$result_username){
		_alertinfo_historyback("用户名填写错误");
	}
if (!$result_password){
		_alertinfo_historyback("密码填写错误");
	}
if ($_data['passwordsecond']!=$_data['password']){
			_alertinfo_historyback("密码填写不一致");
	
}
if (!$result_tel){
		_alertinfo_historyback("手机号码填写错误");
	}
if (!$result_email){
		_alertinfo_historyback("电子邮箱填写错误");
	}
	require PATH_ROOT.'config/config_mysql.func.php';
	$sql_check="SELECT * FROM USER_ACCOUNT WHERE USERACCOUNT='{$_data['username']}'";
	$result=mysql_query($sql_check);
	$_num=mysql_num_rows($result);
	if ($_num!=0){
		_alertinfo_historyback("用户名已存在！");
	}
	
	
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
	conn_query($sql);
	$_SESSION['user']=$_data['username'];
	_success_back("恭喜您成功注册!","../index.php");
	
	
	

	



}else{
	_failsubmit_back("error");
	exit();
}
?>

