<?php
//header('Content-Type: text/html; charset=utf-8');
	define('DB_HOST','115.28.143.77');
 	define('DB_USER','root');
 	define('DB_PWD','ab2155836f');
 	define('DB_NAMES','JSD');
 	
 	
 	function conn_mysql(){
 		global $connection;
 		if (!$connection=@mysql_connect(DB_HOST,DB_USER,DB_PWD))
 		{
 			exit('connection error');
 		}
 		
 	}
 	function conn_select_db(){
 		if (!mysql_select_db(DB_NAMES)){
 			exit('connection selection error'.mysql_error()) ;
 		}
 	}
 	function conn_set_names(){
 		if (!mysql_query('SET NAMES UTF8')){
 			exit('connection set utf8 error');
 		}
 	}
 	
 	function conn_query($sql){
 		if (!$result = mysql_query($sql)){
 			exit('connection query error'.mysql_error());
 			
 		}
 		return $result;
 	}
 	/*
 	 * 是否存在数据
 	 * */
 	function conn_fetch_array($sql){
 		return  mysql_fetch_array(conn_query($sql));
 		
 	}
 	
 	function  conn_close(){
 		if (!mysql_close()){
 			exit('connection close error');
 		}
 	}
 	conn_mysql();
 	conn_select_db();
 	conn_set_names();
 	//conn_query('insert into LOGIN(NAME,PASSWORD) values("test","testpass") ');
 	//$result=conn_query('SELECT * FROM LOGIN') or die('error');
	//print_r($result);
	//while (!!$row = mysql_fetch_array($result)){
		
	//	echo $row['ID'].'---'.$row['NAME'].'---'.$row['PASSWORD'];
	//}
	//echo '123';
	

?>