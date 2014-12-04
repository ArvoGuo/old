<?php 
header ( 'Content-Type: text/html; charset=utf-8' );
require '../includes/common.inc.php';
if(!isset($_SESSION)){
    session_start();
}
if ($_SESSION['user']!=""){
	_alertinfo_historyback("请先退出");
}
if($_POST['send']=="登录"){
	$_user=array();
	$_user['username']=$_POST['username'];
	$_user['password']=$_POST['password'];
	require PATH_ROOT.'config/config_mysql.func.php';
	$sql_check="SELECT * FROM USER_ACCOUNT WHERE USERACCOUNT='{$_user['username']}'";
	$result=mysql_query($sql_check);
	$_num=mysql_num_rows($result);
	if ($_num==0){
		_alertinfo_backaddress("用户名不存在!","userLogin.php");
	}
	if ($_num==1){
		$sql="SELECT * FROM USER_ACCOUNT WHERE USERACCOUNT='{$_user['username']}' AND USERPASSWORD='{$_user['password']}'";
			$rs=mysql_query($sql);
			$rs_num=mysql_num_rows($rs);
			if ($rs_num==1){
				$_SESSION['user']=$_user['username'];
				echo "<script type='text/javascript'>location.href='userCenter.php';</script>";
			}
			else {
				_alertinfo_backaddress("账户或密码错误","userLogin.php");
			}
	}else {
		_alertinfo_backaddress("登陆错误","userLogin.php");
	}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../style/index.css"/>
<title>极速递--用户登录</title>
</head>
<body>
<?php 
require PATH_ROOT.'/includes/topBar.php';
?>
<div id = "header">
<a href="../index.php"><img  src="../images/header.jpg" class="header_img" /></a>
</div>
<div id= "words">
<?php 
require PATH_ROOT.'/includes/words.inc.php';
?>
</div>
<div id="location">
<a href="../index.php" ><img src="../images/toolbarlogo.png"></img></a>
</div>
<div class="divContainer">
<div id = "line" class="toBeCenter paddingUpTopBottom">
<img src="../images/line.png"/>
</div>
</div>
<div id="reg">
<label class="reg_title">欢迎登陆</label>
<form method="post" action="userLogin.php">




<ul>

<li><label><span class="reg_mark">*</span></label>用 户  名：<input type="text" name="username" id="username" class="regword"></input></li>
<li><label><span class="reg_mark">*</span></label>密　　码：<input type="password" name="password" id="password" class="regword"></input></li>

<li><input type="submit" class="btn" name="send" value="登录"></input></li>

</ul>

</form>

</div>

<div id = "footer">
<?php 
require PATH_ROOT.'/includes/footer.inc.php';
?>
</div>
</body>
</html>
