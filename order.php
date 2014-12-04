<?php 
require  dirname(__FILE__)."/include/include.inc.php";
require PATH_ROOT."/mysql/mysql.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type="text/css" href = "css/index.css"/>
<link rel = "stylesheet" type="text/css" href="css/forOrderPic.css"/>
<link rel="stylesheet" href="dist/css/bootstrap.min.css"/>
<title></title>
</head>
<!-- 0 -->

<!-- 1 -->
<div class ="autoLR   ">

<!-- 2 -->
<div class ="autoLR ">
<!-- 3 -->
<div class ="center showBorder">
<!-- header -->
<?php require PATH_ROOT.'/include/header.inc.php'?>
<!-- main -->
<!-- daohang -->

<?php require PATH_ROOT.'/include/orderMain.inc.php';?>
  
  <!-- footer -->
<?php require  PATH_ROOT.'/include/footer.inc.php';?>
  
</div>

</div>
</div>

</div>


</html>

 <script src="js/jquery-1.6.3.min.js"></script>
  <script src="js/jquery.featureCarousel.js"></script>
 <script type="text/javascript">
 $(document).ready(function() {
		$("#carousel").featureCarousel({
			autoPlay:2000,
			trackerIndividual:false,
			trackerSummation:false,
			topPadding:50,
			smallFeatureWidth:.9,
			smallFeatureHeight:.9,
			sidePadding:0,
			smallFeatureOffset:0
		});
	});
	//$('.carousel').carousel('pause');
</script>