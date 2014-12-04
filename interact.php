<?php 
require  dirname(__FILE__)."/include/include.inc.php";
require PATH_ROOT.'/mysql/mysql.php';
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
<?php require PATH_ROOT.'/include/interactMain.inc.php';?>
  
  <!-- footer -->
<?php require  PATH_ROOT.'/include/footer.inc.php';?>
  
</div>

</div>
</div>






</html>

 <script src="dist/js/jquery-1.11.0.min.js"></script>
 <script src="dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/interactAjax.js"></script>
  <script type="text/javascript">
    $('.sub').click(function(){
			$('#subbtn').click();
        });

    $('#loadfile').change(function() {
    $('#photoCover').val($(this).val());
    });
	$('#interactTab2').hide();
    $('#thisMonth').click(function(){
    	$('#interactTab2').hide();
    	$('#interactTab').show();
        });
    $('#oldMonth').click(function(){
    	$('#interactTab').hide();
    	$('#interactTab2').show();
    });
    $('.btnM').click(function(){
    	if($('div.switchMonth .btnM').hasClass('btn-primary')){
    		$('div.switchMonth .btnM').addClass('btn-default').removeClass('btn-primary');
		
		}
	$(this).removeClass('btn-default').addClass('btn-primary');
        });

</script>
