<?php
 	header('Content-Type:text/html;charset=utf-8');
 	
 	
 	define('DB_HOST','115.28.133.116');
 	define('DB_USER','root');
 	define('DB_PWD','b4d61fb89d');
 	define('DB_NAME','JSD');
 	$conn=mysql_connect(DB_HOST,DB_USER,DB_PWD) or die('数据库连接失败'.mysql_error());
 	mysql_select_db(DB_NAME,$conn) or die('数据库连接失败'.mysql_error());

	  mysql_query('SET NAMES UTF8') or die('数据库连接失败'.mysql_error());//设定字符集
 		$query = "SELECT * FROM LOGIN ";
		$result = mysql_query($query);//结果集
//输出结果
//print_r(mysql_fetch_array($result,MYSQL_NUM));
//print_r(mysql_fetch_array($result,MYSQL_ASSOC));
	while(!!$row  = mysql_fetch_array($result)){
		echo $row['ID'].'---'.$row['NAME'];
		echo strlen($row['NAME']);//长度
		echo mb_strlen($row['NAME']);//中文长度
		
		echo '<br />';
	}
//	
//	mysql_close();
//调用 
 //require './includes/header.inc.php';
 //防止恶意调用
 
?>