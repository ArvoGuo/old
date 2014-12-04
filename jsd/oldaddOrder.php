<?php 
    require dirname(__FILE__).'/includes/common.inc.php';
	$sid=$_GET['sid'];
	switch ($sid){
		case 1:
			$title="韵达快递";
			 $pricepic="images/priceimages/priceYunDa.png";
			 $table = "PRICE_YD";
			break;
		case 2:
			$title="圆通快递";
			 $pricepic="images/priceimages/priceYuanTong.jpg";
			 	 $table = "PRICE_YT";
			 break;
		
		case 3:
			$title="增益快递";
			$table = "PRICE_ZY";
			 $pricepic="images/priceimages/priceZengYi.png";
			 break;
		case 4:
			$title="全峰快递";
			$table = "PRICE_QF";
			 $pricepic="images/priceimages/priceQuanFeng.png";
			 break;
			default:
				_alert_back("errorandreturn");
};
session_start();
if ($_SESSION['user']!=""){
	
	$user=$_SESSION['user'];
	$info='<a href="user/userCenter.php">个人中心</a>';
	$logout='/<a href="user/userLogout.php">退出</a>';
	
}else {
	$user="";
	$info='<a href="user/userLogin.php">登录</a>/ <a href="user/userReg.php">注册</a>';
	$logout='';
}
require PATH_ROOT.'config/config_mysql.func.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jsAddress.js"></script>
<script type="text/javascript" src="js/common.js"></script>

<script src="js/jquery-1.11.0.min.js"></script>



<link rel="shortcut icon" href="favicon.ico"/>
<link rel="stylesheet" type="text/css" href="style/index.css"/>
<title>极速递--<?php echo $title;?></title>
</head>
<script language="javascript">
function  isValidMobile(str)   
{ 
//	pat4=/^[0-9]{11}$/
	 
	//if(!pat4.exec(str)){	
	//return false;
	//}
	//return true;
if(isNaN(str)||str.length<9||str.length>11){

	return false;
	}
return true;
		
		
} 
var chktelrasult
chktelrasult=""
function checkTelCode(){
    var str =  document.getElementById('txtMobile1').value;
		if (str!=""){
     if (!isValidMobile(str)){   
         chktelrasult="<font color=red>* 请正确填写手机号码</font>"
 	 	 document.getElementById("chkMobile1").innerHTML=chktelrasult
          }      
     else{
         chktelrasult="<font color=green>正确</font>"
 	 	 document.getElementById("chkMobile1").innerHTML=chktelrasult
         }
		 }
		  var str2 =  document.getElementById('txtMobile2').value;
		if (str2!=""){
     if (!isValidMobile(str2)){   
         chktelrasult2="<font color=red>* 请正确填写手机号码</font>"
 	 	 document.getElementById("chkMobile2").innerHTML=chktelrasult2
          }      
     else{
         chktelrasult2="<font color=green>正确</font>"
 	 	 document.getElementById("chkMobile2").innerHTML=chktelrasult2
         }
		 }
		 }
</script>

<body>
<div id="toolbar">
<a class="toolbarlogo" href="http://www.jsd001.com" alt="极速递"><img src="images/toolbarlogo.png"></img></a>
<span class="toolbarlink"><?php echo $user.$info.$logout?></span>
</div>
<div id="index_logo">

<?php 

	require PATH_ROOT.'includes/header.inc.php';
?>


</div>
<div id= "words">
<?php 
require PATH_ROOT.'/includes/words.inc.php';
?>
</div>

<div id="location">
<a href="index.php" ><img src="images/toolbarlogo.png"></img></a> <span class="typetitle"><?php echo $title?></span>
</div>
<div id = "line">
<?php 
require PATH_ROOT.'/includes/line.inc.php';
?>
</div>

<?php 
$sql_selectprice="SELECT * FROM $table ";
$result_price=mysql_query($sql_selectprice);
echo "<table class='pricetable' width='auto'>
<tr>
<th>地区</th><th>首重</th><th>续重</th>
<th>地区</th><th>首重</th><th>续重</th>
<th>地区</th><th>首重</th><th>续重</th>
<th>地区</th><th>首重</th><th>续重</th>
</tr><tr>";
$d=4;
$r_count=0;
while (!!$row=mysql_fetch_array($result_price)){
	if ($r_count%$d==0){
		echo "</tr><tr>";
	}
	echo "<td class='tdarea'>{$row['AREA']}</td><td>{$row['FIRST']}元</td><td>{$row['ADDITIONAL']}元</td>";
	$r_count++;
	
	
	
}
echo "</tr></table>";
?>

<div id = "line">
<?php 
require PATH_ROOT.'/includes/line.inc.php';
?>
</div>



<form method="post" action="addOrderDo.php">
<input type="hidden" name="action" value="add"/>
<div id="senderinfo" class="senderorgetterinfo">
<ul>
<li style=" "><span style="">　	寄件人信息*</span></li>

<li>寄件人姓名<span class="reg_mark">*</span>：<input type="text" name="sendername"   class="textbox" /></li>
<li>寄件人电话<span class="reg_mark">*</span>：<input  type="text" name="sendertel" id="txtMobile1" onblur="checkTelCode();" class="textbox"/>
<span id="chkMobile1">(请填写寄件人的手机号码)</span></li>
<li>寄件人地址<span class="reg_mark">*</span>：</li>
<li>省：<select id="senderprovince" name="senderprovince" class="text_kaiti"></select>
市：<select id="sendercity" name="sendercity" class="text_kaiti"></select>
区：<select id="senderarea" name="senderarea" class="text_kaiti"></select></li>
<li>　　<textarea name="senderaddress"  class="textarea" onBlur="if(this.innerHTML==''){this.innerHTML='请输入详细地址';this.style.color='#D1D1D1'}" style="COLOR: #333" onFocus="if(this.innerHTML=='请输入详细地址'){this.innerHTML='';this.style.color='#000'}" >请输入详细地址</textarea></li>
<li>上门取货地址：</li>
<li>　　<textarea name="goodsaddress"   class="textarea"  onBlur="if(this.innerHTML==''){this.innerHTML='若不填写则默认为寄件地址';this.style.color='#D1D1D1'}" style="COLOR: #333" onFocus="if(this.innerHTML=='若不填写则默认为寄件地址'){this.innerHTML='';this.style.color='#000'}" >若不填写则默认为寄件地址</textarea></li>

</ul>
</div>



<div id="getterInfo" class="senderorgetterinfo">
<ul>
<li ><span >　	收件人信息*</span></li>
<li>收件人姓名<span class="reg_mark">*</span>：<input type="text" name="gettername"    class="textbox" /></li>
<li>收件人电话<span class="reg_mark">*</span>：<input  type="text" name="gettertel" id="txtMobile2" onblur="checkTelCode();" class="textbox"/>
<span id="chkMobile2">(请填写收件人的手机号码)</span></li>
<li>收件人地址<span class="reg_mark">*</span>：</li>
<li>省：<select id="getterprovince" name="getterprovince" class="text_kaiti"></select>
市：<select id="gettercity" name="gettercity" class="text_kaiti"></select>
区：<select id="getterarea" name="getterarea " class="text_kaiti"></select></li>
<li>　　<textarea name="getteraddress" class="textarea" onBlur="if(this.innerHTML==''){this.innerHTML='请输入详细地址';this.style.color='#D1D1D1'}" style="COLOR: #333" onFocus="if(this.innerHTML=='请输入详细地址'){this.innerHTML='';this.style.color='#000'}" >请输入详细地址</textarea></li>

<li>包裹物品描述：</li>
<li>　　<textarea name="bagcontent" class="textarea" onBlur="if(this.innerHTML==''){this.innerHTML='备注具体的取件时间';this.style.color='#D1D1D1'}" style="COLOR: #333" onFocus="if(this.innerHTML=='备注具体的取件时间'){this.innerHTML='';this.style.color='#000'}"  >备注具体的取件时间</textarea></li>

<input type="hidden" name="sid" value="<?php echo $sid;?>" />

</ul>
</div>
<div id = "line">
<?php 
require PATH_ROOT.'/includes/line.inc.php';
?>
</div>
<div id="bannote">
<textarea class="bannotetextarea" id="bannotetextarea" disabled="disabled"></textarea>
</div>
<div id = "line">
<?php 
require PATH_ROOT.'/includes/line.inc.php';
?>
</div>
<div id="yzm_submit"><ul>

<li>验　证　码　：<input type="text" name="yzm" id="yzm"  class="textyzm"  style="width:50px;" /><img id="code" src="code.php" />
　　<input type="submit" name="send" value="确定" class="submitButton btn" /></li>


</ul></div>
</form>

<div id = "line">
<?php 
require PATH_ROOT.'/includes/line.inc.php';
?>
</div>

<div id = "footer">
<?php 
require PATH_ROOT.'/includes/footer.inc.php';
?>
</div>



<script language="javascript">
addressInit('senderprovince', 'sendercity', 'senderarea', '上海', '市辖区', '松江区');
addressInit('getterprovince', 'gettercity', 'getterarea', '上海', '市辖区', '松江区');
</script>
</body>
</html>
