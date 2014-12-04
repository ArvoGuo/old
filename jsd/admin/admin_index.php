<?php 
session_start();
if ($_SESSION['manager']==""){
	echo "<script type='text/javascript'>alert('ILLEGAL!');location.href='index.php';</script>";
		exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<title>极速递--后台</title>
</head>
<frameset rows="5%,95%" >
<frame src="admin_top.php" scrolling="no" noresize="noresize"/>
<frameset cols="18%,82%">
<frame src="admin_left.php"  noresize="noresize"  />

<frame src="admin_main.php" name="main" noresize="noresize"/>

</frameset>
</frameset>
</html>