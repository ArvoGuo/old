<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require '../includes/common.inc.php';

session_start ();
if ($_SESSION ['manager'] != "") {
	$_SESSION ['manager'] = "";
}
;
if ($_POST ['send'] == "登录") {
	$adminname = $_POST ['adminname'];
	$adminpass = $_POST ['adminpass'];
	$yzm = $_POST ['yzm'];
	if (mb_strlen ( $yzm, 'UTF8' ) != 4) {
		_failsubmit_back ( "验证码必须为四位" );
	}
	;
	
	$code = $_SESSION ['code'];
	if ($yzm != $code) {
		_failsubmit_back ( "验证码错误" );
	}
	;
	require PATH_ROOT . 'config/config_mysql.func.php';
	$sql = "select * from LOGIN where NAME= '{$adminname}' and PASSWORD= '{$adminpass}'";
	if (conn_fetch_array ( $sql )) {
		$_SESSION ['manager'] = $adminname;
		header ( "Location: admin_index.php" );
		exit ();
	}
	;
	_failsubmit_back ( "用户名或密码错误" );

}
;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="../style/signin.css"/>
<title>管理员登陆</title>
</head>

<body>
<div id="login_body">
<form method="post" action="admin_login.php" name="login" id="login">
<h1>管理员登录</h1>
<label for="username">用户名:<input type="text" name="adminname"
	id="username" class="text" /></label> <label for="password">密 码:<input
	type="password" name="adminpass" id="password" class="text" /></label>
<label for="yzm">验证码:<input type="text" name="yzm" id="yzm"
	class="textyzm" /><img id="code" src="../code.php"
	onclick="this.src='../code.php?tm='+Math.random()"
	style="cursor: pointer" alt="刷新" /></label> <input type="submit"
	value="登录" onclick="return check();" name="send" class="submit" /></form>
</div>

<div class="container">

      <form class="form-signin" role="form" method="post" action="admin_login.php" name="login" id="login">
        <h2 class="form-signin-heading">Please sign in</h2>
                
        
        <input name="adminname"  type="text" class="form-control" placeholder="Manager Account" required autofocus>
        
        <input name="adminpass" type="password" class="form-control" placeholder="Password" required>
       
       <input name="yzm" type="text" class="form-control" placeholder="verification code" required>
       <img class="form-control" id="code" src="../code.php"
	onclick="this.src='../code.php?tm='+Math.random()"
	style="cursor: pointer" alt="刷新" />
        <button class="btn btn-lg btn-primary btn-block" type="submit" value="登录" onclick="return check();" name="send">Sign in</button>
         
      </form>

    </div>


</body>
</html>