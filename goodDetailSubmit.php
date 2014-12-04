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
<div class ="autoLR ">

<!-- 2 -->
<div class ="autoLR ">
<!-- 3 -->
<div class ="center showBorder">
<!-- header -->
<?php require PATH_ROOT.'/include/header.inc.php'?>
<!-- main -->
<?php require PATH_ROOT.'/include/goodDetailSubmitMain.inc.php';?>
  
  <!-- footer -->
  <div style="margin-top:40px;">
<?php require  PATH_ROOT.'/include/footer.inc.php';?>
  </div>
</div>

</div>
</div>






</html>

 <script src="dist/js/jquery-1.11.0.min.js"></script>
 <script src="js/DataSelector.js"></script>
 <script src = "js/jsAddress.js"></script>
 <script src="dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
addressInit('getterprovince', 'gettercity', 'getterarea', '上海', '市辖区', '松江区');
$(document).ready(function () {
	var myDate = new Date();
	$("#dateSelector1").DateSelector({
			ctlYearId: 'idYear',
			ctlMonthId: 'idMonth',
			ctlDayId: 'idDay',
			defYear: myDate.getFullYear(),
			defMonth: (myDate.getMonth()+1),
			defDay: myDate.getDate(),
			minYear: (myDate.getFullYear()-2),
			maxYear: (myDate.getFullYear()+6)
	});
	$("#dateSelector2").DateSelector({
			ctlYearId: 'idYear2',
			ctlMonthId: 'idMonth2',
			ctlDayId: 'idDay2',
			defYear: myDate.getFullYear(),
			defMonth: (myDate.getMonth()+1),
			defDay: myDate.getDate(),
			minYear: (myDate.getFullYear()-2),
			maxYear: (myDate.getFullYear()+6)
	});

});
</script>