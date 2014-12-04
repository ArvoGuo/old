<?php
require PATH_ROOT . 'config/config_mysql.func.php';

function  _getNumOfOrders(){
	$sql="SELECT * FROM ORDERS";
$result=mysql_query($sql);
	$_num=mysql_num_rows($result);
	$_baseNum=get_config(PATH_ROOT."config/config_indexOrderNum.php","_indexOrderNum","int");
	return $_baseNum+$_num;
}


?>