<?php
require '../include/include.inc.php';
require PATH_ROOT."/mysql/mysql.php";

if ($_SESSION ['manager'] != "") {
	$_SESSION ['manager'] = "";
}
;
if ($_POST ['send'] == "登录") {
	$adminname = $_POST ['adminname'];
	$adminpass = $_POST ['adminpass'];
	
	$manager = new manager();
	
	
	if ($manager->fetchLogin($adminname,$adminpass)) {
		$_SESSION ['manager'] = $adminname;
		header ( "Location: admin_index.php" );
		exit ();
	}
	;
	_alertinfo_historyback ( "用户名或密码错误" );

}
;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="../css/signin.css"/>
<title>管理员登陆</title>
</head>

<body>

<div class="container">

      <form class="form-signin" role="form" method="post" action="admin_login.php" name="login" id="login">
        <h2 class="form-signin-heading">Welcome Dz!</h2>
                
        
        <input name="adminname"  type="text" class="form-control" placeholder="Manager Account" required autofocus>
        
        <input name="adminpass" type="password" class="form-control" placeholder="Password" required>
       
        <button class="btn btn-lg btn-primary btn-block" type="submit" value="登录" onclick="return check();" name="send" style="margin:10px 0px 10px 0px;">Sign in</button>
       <div class="alert alert-info"> <a href="../index.php">回到首页</a></div>
      </form>

    </div>


</body>
</html>