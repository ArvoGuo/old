<?php
session_start();
$_SESSION['user']="";
setcookie("QQ_access_token", "", time()-3600,"/");
header("Location:http://www.jsd001.com"); 


?>