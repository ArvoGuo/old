<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require '../includes/common.inc.php';

session_start();
if ($_SESSION['manager']==""){
	echo "<script type='text/javascript'>alert('ILLEGAL！');location.href='index.php';</script>";
		exit();
}

$sid = $_GET ['sid'];
$status = $_GET ['status1'];
switch ($status) {
	case 0 :
		$ordertype = "未确认订单";
		break;
	case 1 :
		$ordertype = "已确认订单";
		break;
	case 2 :
		$ordertype = "全部";
		break;
	default :
		_alert_back ( "errorandreturn" );
}
;
switch ($sid) {
	case 0 :
		$title = "全部";
		break;
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
;
require PATH_ROOT . 'config/config_mysql.func.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../style/admin.css" />
</head>

<body>
<h2 style="margin: 10px 0; color: blue; text-align: center;"><?php
echo $title . $ordertype;
?></h2>
<div id="orderList">
<ul>
<?php

if ($status == 2) {
	if ($sid == 0)
		$sql = "select * from ORDERS WHERE ISDELETED=0 ORDER BY CREATEDATE DESC ";
	else
		$sql = "SELECT * FROM ORDERS WHERE SID=$sid AND ISDELETED=0 ORDER BY CREATEDATE DESC";
}
;
if ($status != 2) {
	if ($sid == 0)
		$sql = "SELECT * FROM ORDERS WHERE STATUS=$status AND ISDELETED=0 ORDER BY CREATEDATE DESC";
	else
		$sql = "SELECT * FROM ORDERS WHERE STATUS=$status AND SID=$sid AND ISDELETED=0 ORDER BY CREATEDATE DESC";

}
;

if (isset ( $_GET ['page'] )) {
	$_page = $_GET ['page'];

	if (empty ( $_page ) || $_page < 0 || !is_numeric ( $_page )) {
		$_page = 1;
	} else {
		$_page = intval ( $_page );
		
	}
} else {
	$_page = 1;
	
}


$_pagesize = 3;

$_num = mysql_num_rows ( mysql_query ( $sql ) );

if ($_num == 0) {
	$_pageabsolute = 1;
	echo "暂无更多订单";
} else {
	$_pageabsolute = ceil ( $_num / $_pagesize );
}

if ($_page > $_pageabsolute) {
	$_page = $_pageabsolute;
}

$_pagenum = ($_page - 1) * $_pagesize;

$sql .= " LIMIT $_pagenum,$_pagesize";

$result = mysql_query ( $sql );
while ( ! ! $row = mysql_fetch_array ( $result ) ) {
switch ($row ['SID']) {
		case 1 :
			$sidname = "韵达快递";
			break;
		case 2 :
			$sidname = "圆通快递";
			break;
		case 3 :
			$sidname = "增益快递";
			break;
		case 4 :
			$sidname = "全峰快递";
			break;
		default :
			_alert_back ( "errorandreturn" );
	}
	
	?>
<form method="post"
		action="admin_checkDo.php?<?php
	echo "sid=$sid&status1=$status"?>"
		target="main">
		
<div class="cssbg orderUp" >编号:<?php
	echo $row ['ID']?>　订单状态:<span style="color:<?php
	if ($row ['STATUS'] == 1) {
		echo "#339900";
		$statuswords = "已确认";
	}
	if ($row ['STATUS'] == 0) {
		echo "red";
		$statuswords = "未确认";
	}
	?>;font-weight:bold;"><?php
	echo $statuswords?></span>　　下单时间:<?php echo $row['CREATEDATE']?>　　商家:<?php echo $sidname?></div>
			<table  class="userCenterOrder cssbg">
			<tr><th>寄件人姓名</th><th>寄件人电话</th><th>寄件人地址</th><th>操作</th></tr>
			<tr><td><?php echo $row['SENDERNAME']?></td><td><?php echo $row['SENDERTEL']?></</td><td><?php echo $row['SENDERPROVINCE'].$row['SENDERAREA']. $row['SENDERCITY'].$row['SENDERADDRESS']?></td>
			<td rowspan="2">
			
			
			
			
			</td></tr>
			
			<tr><th>收件人姓名</th><th>收件人电话</th><th>收件人地址</th></tr>
			<tr><td><?php echo $row['GETTERNAME']?></td><td><?php echo $row['GETTERTEL']?></</td><td><?php echo $row['GETTERPROVINCE'].$row['GETTERAREA']. $row['GETTERCITY'].$row['GETTERADDRESS']?></td>
			<td rowspan="2">
			删除
			</td>
			</tr>
			<tr><th colspan="3">包裹描述:</th></tr>
			<tr><td colspan="3"><?php
	echo $row ['BAGCONTENT']?></td>
	
	<td rowspan="2">
			修改
			</td>
	</tr>
		<tr><th colspan="3">上门取货地址:</th></tr>
			<tr><td colspan="3"><?php
	echo $row ['GOODADDRESS']?></td></tr>
			</table>
			<input type="hidden" name="id" value="<?php
	echo $row ['ID']?>">


	<table>
		<tr style="background-color: #666666; color: #FFFFFF;">
			<td>ID:</td>
			<td><?php
	echo $row ['ID']?></td>
			<td>订单状态:</td>
			<td><span style="color:<?php
	if ($row ['STATUS'] == 1) {
		echo "#99ffcc";
		$statuswords = "已确认";
	}
	if ($row ['STATUS'] == 0) {
		echo "red";
		$statuswords = "未确认";
	}
	?>;font-weight:bold;"><?php
	echo $statuswords?></span></td>
			<td>快递商家:</td>
			<td><?php

	echo $sidname;
	?></td>
			<td>订单生成时间:</td>
			<td><?php
	echo $row ['CREATEDATE']?></td>
			<td>订单最后修改时间:</td>
			<td><?php
	echo $row ['MODIFYDATE']?></td>

		</tr>

		<tr>
			<td id="table_middle_left" colspan="8">
			<table cellspacing="5" cellpadding="5">
				<tr id="s">
					<td>寄件方</td>
					<td>寄件方姓名</td>
					<td>寄件方电话</td>
					<td>寄件方地址</td>



				</tr>

				<tr>
					<td>寄件方</td>
					<td><?php
	echo $row ['SENDERNAME']?></td>
					<td><?php
	echo $row ['SENDERTEL']?></td>
					<td rowspan="3" align="left" valign="top" width="300px;">
					<?php
	echo $row ['SENDERPROVINCE'] . $row ['SENDERCITY'] . $row ['SENDERAREA'] . $row ['SENDERADDRESS']?></td>


				</tr>
				<tr></tr>
				<tr></tr>



				<tr id="g">
					<td>收件方</td>
					<td>收件方姓名</td>
					<td>收件方电话</td>
					<td>收件方地址</td>



				</tr>

				<tr>
					<td>收件方</td>
					<td><?php
	echo $row ['GETTERNAME']?></td>
					<td><?php
	echo $row ['GETTERTEL']?></td>
					<td rowspan="3" align="left" valign="top" width="300px;"><?php
	echo $row ['GETTERPROVINCE'] . $row ['GETTERCITY'] . $row ['GETTERAREA'] . $row ['GETTERADDRESS']?></td>


				</tr>
				<tr></tr>
				<tr></tr>
			</table>
			</td>

			<td id="table_middle_right" valign="top" align="left " rowspan="3"
				width="150px" style="border-style: solid;">包裹描述：<br />
			<?php
	echo $row ['BAGCONTENT']?></td>
			<td id="table_middle_right" valign="top" align="left" rowspan="3"
				width="150px" style="border-style: solid;">上门取货地址：<br />
			<?php
	echo $row ['GOODADDRESS']?></td>
		</tr>
		<tr>
			<td id="submit" colspan="8"><?php
	if ($row ['STATUS'] == 0) {
		?>
			 <input type="submit" name="check" value="确认" class="submitButton" />
			 <?php
	}
	if ($row['STATUS'] == 1) {
		?>
			 <input type="submit" name="check" value="确认" disabled="disabled"
				class="submitButton" />
			 <?php
	}
	?>
				<input type="submit" name="check" value="删除" class="submitButton"
				onclick="JavaScript:return confirm('确定删除吗？')" /> <input
				type="submit" name="check" class="submitButton" value="修改" /></td>

		</tr>

	</table>






	<input type="hidden" name="id" value="<?php
	echo $row ['ID']?>"></form>
	<?php
}
?>

</ul>
</div>
<span id="page">

<ul>

<?php
for($i = 0; $i < $_pageabsolute; $i ++) {
	echo '<li><a href="admin_nav.php?sid=' . $sid . '&status1=' . $status . '&page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
}
;
?>
</ul>

</span>
</body>
</html>
