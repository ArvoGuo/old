<?php
require PATH_ROOT . 'includes/mysql.func.php';
require PATH_ROOT.'includes/forQQLogin.func.php';
	$_showNum=_getNumOfOrders();
if(!isset($_SESSION)){
    session_start();
}
if(isset($_COOKIE['QQ_access_token'])&&isset($_COOKIE['QQ_openid'])){
$_SESSION['access_token']=$_COOKIE['QQ_access_token'];
$_SESSION['openid']=$_COOKIE['QQ_openid'];
get_openid();
$_SESSION["appid"]    = 101005973; 
$arr = get_user_info();
$_SESSION['user']=$arr["nickname"];

}
$url="";
$urlOfUserCenter=$url.'user/userCenter.php';
$urlOfUserLogout=$url.'user/userLogout.php';
$urlOfUserReg=$url.'user/userReg.php';
$urlOfUserLogin=$url.'user/userLogin.php';
$urlOfToolBarLogo=$url.'images/toolbarlogo.png';
$urlOfQQimages=$url.'images/qq_login.png';


if ($_SESSION['user']!=""){
	
	$user="<img src='".$arr['figureurl']."'/>".$_SESSION['user'];
	$info="<a href=".$urlOfUserCenter.">个人中心</a>";
	$logout="/<a href=".$urlOfUserLogout.">退出</a>";
	
}else {
	$user="";
	$info="<a href='".$url."includes/forQQLoginAndBack.php' style='vertical-align:middle;' ><img src='".$urlOfQQimages."' /></a>　　
	<a href=".$urlOfUserLogin.">极速递登录</a>/ <a href=".$urlOfUserReg.">注册</a>";
	$logout='';
}
?>
<div id="toolbar">
<a class="toolbarlogo" href="../index.php" alt="极速递"><img src="<?php echo $urlOfToolBarLogo?>"></img></a>
<div id="toolBarNum"><MARQUEE  scrollAmount=1 scrollDelay=1 direction=up height="99%">
<span >已成功从本站下单超过<?php echo $_showNum?>单</span>
</MARQUEE></div>
 <span class="toolbarlink"><?php echo $user.$info.$logout?> </span>
</div>