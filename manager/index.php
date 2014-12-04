<?php

if ($_SESSION['manager']==""){
	header("Location: admin_login.php"); 
	exit;
	
};
header("Location: admin_index.php"); 





?>