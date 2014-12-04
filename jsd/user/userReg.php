<?php 
header ( 'Content-Type: text/html; charset=utf-8' );
require '../includes/common.inc.php';
session_start();
if ($_SESSION['user']!=""){
	_alertinfo_historyback("请先退出");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../style/index.css"/>
<script src="../js/jquery-1.11.0.min.js">
</script>
<script type="text/javascript" src="../js/regCheck.js"></script>


<title>极速递--用户注册</title>
</head>
<body>
<?php 
require PATH_ROOT.'/includes/topBar.php';
?>
<div id = "header">
<a href="../index.php"><img  src="../images/header.jpg" class="header_img" /></a>

</div>
<div id= "words">
<?php 
require PATH_ROOT.'/includes/words.inc.php';
?>
</div>
<div id="location">
<a href="../index.php" ><img src="../images/toolbarlogo.png"></img></a>
</div>
<div class="divContainer">
<div id = "line" class="toBeCenter paddingUpTopBottom">
<img src="../images/line.png"/>
</div>
</div>
<div id="reg">
<label class="reg_title">免费注册</label>
<form  method="post" action="userRegDo.php">




<ul>

<li><label><span class="reg_mark">*</span></label>用户　名<label><span class="reg_mark reg_error" id="checkusername"></span></label></li>
<li><input type="text" name="username" id="username" class="regword"></input></li>
<li><label><span class="reg_mark">*</span></label>密　　码<label><span class="reg_mark reg_error" id="checkpassword"></span></label></li>
<li><input type="password" name="password" id="password" class="regword"></input></li>
<li><label><span class="reg_mark">*</span></label>确认密码<label><span class="reg_mark reg_error" id="checkpasswordsecond"></span></label></li>
<li><input type="password" name="passwordsecond" id="passwordsecond" class="regword"></input></li>
<li><label><span class="reg_mark">*</span></label>性　　别</li>
<li><input type="radio" name="sex" value="male"  checked="checked">男　　　　</input><input type="radio" name="sex" value="famale" >女</input></li>
<li><label><span class="reg_mark">*</span></label>手机号码<label><span class="reg_mark reg_error" id="checktel"></span></label></li>
<li><input type="text" name="tel" id="tel" class="regword"></input></li>
<li><label><span class="reg_mark">*</span></label>电子邮箱<label><span class="reg_mark reg_error" id="checkemail"></span></label></li>
<li><input type="text" name="email" id="email" class="regword"></input></li>
<li><label><span class="reg_mark">*</span></label>验证　码</li>
<li><input type="text" name="yzm" id="yzm"  class="textyzm"  style="width:60px;margin-right:10px;" /><img id="code" src="../code.php"  onclick="this.src='../code.php?tm='+Math.random()" style="cursor:pointer;" alt="刷新" />
<input type="submit" class="btn" name="send"   value="注册"></input>
</li>


</ul>

</form>

</div>

<div id = "footer">
<?php 
require PATH_ROOT.'/includes/footer.inc.php';
?>
</div>
</body>
</html>
