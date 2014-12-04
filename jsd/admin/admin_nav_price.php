<?php
header ( 'Content-Type:text/html; charset=utf-8' );
require '../includes/common.inc.php';
session_start ();
if ($_SESSION ['manager'] == "") {
	echo "<script type='text/javascript'>alert('ILLEGAL！');location.href='index.php';</script>";
}

$sid = $_GET ['sid'];
switch ($sid) {
	case 0 :
		$title = "全部";
		break;
	case 1 :
		$title = "韵达快递";
		$table = "PRICE_YD";
		break;
	case 2 :
		$title = "圆通快递";
		$table = "PRICE_YT";
		break;
	case 3 :
		$title = "增益快递";
		$table = "PRICE_ZY";
		break;
	case 4 :
		$title = "全峰快递";
		$table = "PRICE_QF";
		break;
	default :
		_alert_back ( "errorandreturn" );
}
;
require PATH_ROOT . 'config/config_mysql.func.php';

if ($_POST ['addarea'] == "添加") {
	
	$_addinfo = array ();
	$_addinfo ['area'] = $_POST ['area'];
	$_addinfo ['first'] = $_POST ['first'];
	$_addinfo ['additional'] = $_POST ['additional'];
	

	if ($_addinfo ['area'] == ""){
		_alertinfo_historyback("地区不能为空");
	}
	
	
	$sql_addcheck = "SELECT * FROM $table WHERE AREA='{$_addinfo['area']}'";
	$result_addcheck = mysql_query ( $sql_addcheck );
	$num_addchek = mysql_num_rows ( $result_addcheck );
	if ($num_addchek > 0) {
		_alert ( "地区已存在" );
	
	}
	
	if ($num_addchek == 0) {
		$sql_addinfo = "INSERT INTO $table (
	AREA,
	FIRST,
	ADDITIONAL
	) VALUES (
	'{$_addinfo['area']}',
	'{$_addinfo['first']}',
	'{$_addinfo['additional']}'
	)";
		mysql_query ( $sql_addinfo );
	}
}
if ($_POST['delete']=="删除"){
	$_deleteinfo = array ();
	$_deleteinfo ['showarea'] = $_POST ['showarea'];
	$_deleteinfo ['showfirst'] = $_POST ['showfirst'];
	$_deleteinfo ['showadditional'] = $_POST ['showadditional'];
	$sql_deletecheck = "SELECT * FROM $table WHERE AREA='{$_deleteinfo['showarea']}'";
	$result_deletecheck = mysql_query ( $sql_deletecheck );
	$num_deletecheck = mysql_num_rows ( $result_deletecheck );
	if ($num_deletecheck == 0) {
		_alertinfo_historyback("删除错误");
	
	}
	if ($num_deletecheck == 1) {
		
		$sql_delete="DELETE  FROM $table WHERE AREA='{$_deleteinfo['showarea']}'";
		mysql_query($sql_delete);
	
	}
	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php
echo $title . "价格管理"?></title>
</head>
<body>
<?php
echo $title . "价格管理"?>
<form method="post"
	action="admin_nav_price.php?<?php
	echo 'sid=' . $sid?>" target="main">
<ul>
	<li>地区:<input type="text" name="area" /> 首重:<input type="text"
		name="first" /> 续重:<input type="text" name="additional" /><input
		type="submit" name="addarea" value="添加" /></li>
</ul>
</form>
<?php

$sql = "SELECT * FROM $table ";
$result = mysql_query ( $sql );
while ( ! ! $row = mysql_fetch_array ( $result ) ) {
	
	?>
<form method="post" action="admin_nav_price.php?<?php
	echo 'sid=' . $sid?>" target="main">
<ul>
	<li>地区:<input type="text" name="showarea"
		value="<?php
	echo $row ['AREA'];
	?>" /> 首重:<input type="text"
		name="showfirst" value="<?php
	echo $row ['FIRST'];
	?>" /> 续重:<input
		type="text" name="showadditional" value="<?php
	echo $row ['ADDITIONAL'];
	?>" />
	<input type="submit" name="delete" value="删除" class="submitButton"
				onclick="JavaScript:return confirm('确定删除吗？')" /> 
	</li>
</ul>
</form>

<?php

}
;
?>
</body>
</html>
