<?php 
header ( 'Content-Type: text/html; charset=utf-8' );
require '../includes/common.inc.php';
session_start();
if ($_SESSION['user']==""){
	_alertinfo_historyback("请先登录");
}
$username=$_SESSION['user'];

	$user=$_SESSION['user'];
	$info='<a href="userCenter.php">个人中心</a>';
	$logout='/<a href="userLogout.php">退出</a>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../style/index.css"/>
<title>极速递--个人中心</title>
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
<a href="../index.php" ><img src="../images/toolbarlogo.png"></img></a><span class="titleCenterOrder word_huawen">显示<?php echo $username?></>最近三条订单</span>
</div>
<div class="divContainer">
<div id = "line" class="toBeCenter paddingUpTopBottom">
<img src="../images/line.png"/>
</div>
</div>

<?php 

	require PATH_ROOT.'config/config_mysql.func.php';
	$sql_check="SELECT * FROM USER_ACCOUNT WHERE USERACCOUNT='{$username}'";
	$result=mysql_query($sql_check);
	$_num=mysql_num_rows($result);
	if ($_num==0){
		_alertinfo_historyback("用户名不存在！");
	}
	if ($_num==1){
		$sql_select="SELECT * FROM ORDERS WHERE ACCOUNT='{$username}' ORDER BY CREATEDATE DESC LIMIT 0,3";
		$result_select=mysql_query($sql_select);
		while (!!$row=mysql_fetch_array($result_select)){
		switch ($row['SID']){
	case 1 :
		$title = "韵达快递";
		break;
	case 2 :
		$title = "圆通快递";
		break;
	case 3 :
		$title = "增益快递";
		break;
	case 4 :
		$title = "全峰快递";
		break;
	default :
		_alert_back ( "errorandreturn" );
		}
			
			
			?>
			<div class="cssbg" style="width:600px;margin-left:370px;">下单时间:<?php echo $row['CREATEDATE']?>　　商家:<?php echo $title?></div>
			<table  class="userCenterOrder cssbg">
			<tr><th>寄件人姓名</th><th>寄件人电话</th><th>寄件人地址</th></tr>
			<tr><td><?php echo $row['SENDERNAME']?></td><td><?php echo $row['SENDERTEL']?></</td><td><?php echo $row['SENDERPROVINCE'].$row['SENDERAREA']. $row['SENDERCITY'].$row['SENDERADDRESS']?></td></tr>
			
			<tr><th>收件人姓名</th><th>收件人电话</th><th>收件人地址</th></tr>
			<tr><td><?php echo $row['GETTERNAME']?></td><td><?php echo $row['GETTERTEL']?></</td><td><?php echo $row['GETTERPROVINCE'].$row['GETTERAREA']. $row['GETTERCITY'].$row['GETTERADDRESS']?></td></tr>
			</table>
	<div class="divContainer">
<div id = "line" class="toBeCenter paddingUpTopBottom">
<img src="../images/line.png"/>
</div>
</div>
			<?php 
			
		}
		
	}
?>

<div id = "footer">
<?php 
require PATH_ROOT.'/includes/footer.inc.php';
?>
</div>
</body>
</html>
