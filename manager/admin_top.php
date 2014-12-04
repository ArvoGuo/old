<?php 
require '../include/include.inc.php';
//if ($_SESSION['manager']==""){
//	echo "<script type='text/javascript'>alert('ILLEGAL！');location.href='index.php';</script>";
//		exit();
//}
?>
<body style=" margin-top:5px; padding-top:0px;">
<div >
<label  style="float:right">您好！管理员<?php echo  $_SESSION['manager']?><a href="admin_main.php" target="main" style="text-decoration:none;">　|　后台首页　|　</a><a href="admin_logout.php" target="_parent" style="text-decoration:none">退出后台</a></label>

</div>
</body>