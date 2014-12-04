<?php 
require  dirname(__FILE__)."/include/include.inc.php";
require PATH_ROOT.'/mysql/mysql.php';
if ($_SESSION['customer']==""){
	echo "<script type='text/javascript'>alert('请先登录');location.href='login.php';</script>";
		exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type="text/css" href = "css/index.css"/>
<link rel="stylesheet" href="dist/css/bootstrap.min.css"/>
<title></title>
</head>
<!-- 0 -->
<?php 
//require PATH_ROOT.'/include/backGround.inc.php';
?>
<!-- 1 -->
<div class ="autoLR   ">

<!-- 2 -->
<div class ="autoLR ">
<!-- 3 -->
<div class ="center showBorder">
<!-- header -->
<?php require PATH_ROOT.'/include/header.inc.php'?>
<!-- main -->
<?php require PATH_ROOT.'/include/myOrderMain.inc.php';?>
  
  <!-- footer -->
  <div style="margin-top:50px;">
<?php require  PATH_ROOT.'/include/footer.inc.php';?>
  </div>
</div>

</div>
</div>






</html>

 <script src="dist/js/jquery-1.11.0.min.js"></script>
 <script src="dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#mySize').click(function(){
		$('.rightDiv').removeClass('displayNone');
		$('.rightDiv').addClass('displayNone');
		$('#mySize').removeClass('displayNone');
		
		});

	$('#myInfoL').click(function(){
		$('.rightDiv').removeClass('displayNone');
		$('.rightDiv').addClass('displayNone');
		$('#myInfo').removeClass('displayNone');
		
		});
	$('#myOrderL').click(function(){
		$('.rightDiv').removeClass('displayNone');
		$('.rightDiv').addClass('displayNone');
		$('#myOrder').removeClass('displayNone');
		});
	$('#myGiftL').click(function(){
		$('.rightDiv').removeClass('displayNone');
		$('.rightDiv').addClass('displayNone');
		$('#myGift').removeClass('displayNone');
		});
	$('#myIntroL').click(function(){
		$('.rightDiv').removeClass('displayNone');
		$('.rightDiv').addClass('displayNone');
		$('#myIntro').removeClass('displayNone');
		});
	$('.trclick').click(function(){
		$('.trclick').css("background-color","white");
		$(this).css("background-color","#f5f5f5");
		$('#btnEdit').attr('value',$(this).attr('name'));
		$('#theid').val($(this).attr('name'));
		});	
	$('#btnEdit').click(function(){
		if($(this).attr('value')==""){
			alert("请选择订单");
			}
		else{
		$('#myModalEdit').modal();
		}
	});
	$('#modelSubEdit').click(function(){
		$('#subEdit').click();
	});
	$('div#leftselect .btn').click(function(){
		if($('div#leftselect  .btn').hasClass('btn-primary')){
				$('div#leftselect  .btn-primary').addClass('btn-default').removeClass('btn-primary');
			
			}
		$(this).removeClass('btn-default').addClass('btn-primary');
		
		});
	
});

</script>