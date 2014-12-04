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
require PATH_ROOT . 'config/config_mysql.func.php';

$submit=$_POST['check'];
$order_id=$_POST['id'];
if (empty($submit)){
	
	_alert_back("errorandreturn");
}
if ($submit=="确认"){
	date_default_timezone_set ( 'PRC' );
		$now = date ( 'Y-m-d H:i:s' );
	$sql="update ORDERS set STATUS=1 ,MODIFYDATE='{$now}' where ID='{$order_id}'";
	conn_query($sql);
	echo "<script>location.href='admin_nav.php?sid=$sid&status1=$status';</script>";
	
}
if ($submit=="删除"){
	$sql_select="SELECT * FROM ORDERS WHERE ID='{$order_id}'";
	$result=mysql_query($sql_select);
	$_num=mysql_num_rows($result);
	if ($_num==0){
		echo "<script>alert('数据不存在');location.href='admin_nav.php?sid=$sid&status1=$status';</script>";
		exit();
	}
	if ($_num==1){
	
			date_default_timezone_set ( 'PRC' );
		$now = date ( 'Y-m-d H:i:s' );
		$sql_delete="UPDATE ORDERS SET ISDELETED=1,MODIFYDATE='{$now}' WHERE ID='{$order_id}'";
		conn_query($sql_delete);
		echo  "<script>location.href='admin_nav.php?sid=$sid&status1=$status';</script></script>";
		exit();
	}
	
	
}
if ($submit=="修改"){
	
}

?>