<?php 
session_start();
if ($_SESSION['manager']==""){
	echo "<script type='text/javascript'>alert('ILLEGAL！');location.href='index.php';</script>";
		exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/admin.css"/>
<title>后台管理系统</title>


</head>
<body >

<?php 
	if ($_SESSION['manager']=="root"){
?>
<dl class="sidebar_admin" style="margin-top:30px;">
<dt>◆全部订单◆</dt>
<dd><a href="admin_nav.php?sid=0&status1=2" target="main">◇全部--全部订单◇</a></dd>
<dd><a href="admin_nav.php?sid=0&status1=0" target="main">◇全部未确认订单◇</a></dd>
<dd><a href="admin_nav.php?sid=0&status1=1" target="main">◇全部已确认订单◇</a></dd>

</dl>
<dl class="sidebar_admin" style="margin-top:30px;">
<dt>◆韵达订单◆</dt>
<dd><a href="admin_nav.php?sid=1&status1=2" target="main">◇韵达--全部订单◇</a></dd>
<dd><a href="admin_nav.php?sid=1&status1=0" target="main">◇韵达未确认订单◇</a></dd>
<dd><a href="admin_nav.php?sid=1&status1=1" target="main">◇韵达已确认订单◇</a></dd>
<dd><a href="admin_nav_price.php?sid=1" target="main">◇韵达价格管理◇</a></dd>
</dl>
<dl class="sidebar_admin" style="margin-top:30px;">
<dt>◆圆通订单◆</dt>
<dd><a href="admin_nav.php?sid=2&status1=2" target="main">◇圆通--全部订单◇</a></dd>
<dd><a href="admin_nav.php?sid=2&status1=0" target="main">◇圆通未确认订单◇</a></dd>
<dd><a href="admin_nav.php?sid=2&status1=1" target="main">◇圆通已确认订单◇</a></dd>
<dd><a href="admin_nav_price.php?sid=2" target="main">◇圆通价格管理◇</a></dd>
</dl>
<dl class="sidebar_admin" style="margin-top:30px;">
<dt>◆增益订单◆</dt>
<dd><a href="admin_nav.php?sid=3&status1=2" target="main">◇增益--全部订单◇</a></dd>
<dd><a href="admin_nav.php?sid=3&status1=0" target="main">◇增益未确认订单◇</a></dd>
<dd><a href="admin_nav.php?sid=3&status1=1" target="main">◇增益已确认订单◇</a></dd>
<dd><a href="admin_nav_price.php?sid=3" target="main">◇增益价格管理◇</a></dd>
</dl>
<dl class="sidebar_admin" style="margin-top:30px;">
<dt>◆全峰订单◆</dt>
<dd><a href="admin_nav.php?sid=4&status1=2" target="main">◇全峰--全部订单◇</a></dd>
<dd><a href="admin_nav.php?sid=4&status1=0" target="main">◇全峰未确认订单◇</a></dd>
<dd><a href="admin_nav.php?sid=4&status1=1" target="main">◇全峰未确认订单◇</a></dd>
<dd><a href="admin_nav_price.php?sid=4" target="main">◇全峰价格管理◇</a></dd>

</dl>
<dl>
<dt><a href="admin_nav_BaseNumSet.php" target="main">◆已下单显示基数◆</a></dt>
</dl>


<?php 
	}
	if ($_SESSION['manager']=="ydkd"){
?>

<dl class="sidebar_admin" style="margin-top:30px;">
<dt>◆韵达订单◆</dt>
<dd><a href="admin_nav.php?sid=1&status1=2" target="main">◇韵达--全部订单◇</a></dd>
<dd><a href="admin_nav.php?sid=1&status1=0" target="main">◇韵达未确认订单◇</a></dd>
<dd><a href="admin_nav.php?sid=1&status1=1" target="main">◇韵达已确认订单◇</a></dd>
<dd><a href="admin_nav_price.php?sid=1" target="main">◇韵达价格管理◇</a></dd>
</dl>
<?php 
	}
	if ($_SESSION['manager']=="ytkd"){
?>

<dl class="sidebar_admin" style="margin-top:30px;">
<dt>◆圆通订单◆</dt>
<dd><a href="admin_nav.php?sid=2&status1=2" target="main">◇圆通--全部订单◇</a></dd>
<dd><a href="admin_nav.php?sid=2&status1=0" target="main">◇圆通未确认订单◇</a></dd>
<dd><a href="admin_nav.php?sid=2&status1=1" target="main">◇圆通已确认订单◇</a></dd>
<dd><a href="admin_nav_price.php?sid=2" target="main">◇圆通价格管理◇</a></dd>
</dl>
<?php 
	}
	if ($_SESSION['manager']=="zykd"){
?>

<dl class="sidebar_admin" style="margin-top:30px;">
<dt>◆增益订单◆</dt>
<dd><a href="admin_nav.php?sid=3&status1=2" target="main">◇增益--全部订单◇</a></dd>
<dd><a href="admin_nav.php?sid=3&status1=0" target="main">◇增益未确认订单◇</a></dd>
<dd><a href="admin_nav.php?sid=3&status1=1" target="main">◇增益已确认订单◇</a></dd>
<dd><a href="admin_nav_price.php?sid=3" target="main">◇增益价格管理◇</a></dd>
</dl>

<?php 
	}
	if ($_SESSION['manager']=="qfkd"){
?>
<dl class="sidebar_admin" style="margin-top:30px;">
<dt>◆全峰订单◆</dt>
<dd><a href="admin_nav.php?sid=4&status1=2" target="main">◇全峰--全部订单◇</a></dd>
<dd><a href="admin_nav.php?sid=4&status1=0" target="main">◇全峰未确认订单◇</a></dd>
<dd><a href="admin_nav.php?sid=4&status1=1" target="main">◇全峰已确认订单◇</a></dd>
<dd><a href="admin_nav_price.php?sid=4" target="main">◇全峰价格管理◇</a></dd>
</dl>
<?php 
	}
?>
</body>
</html>