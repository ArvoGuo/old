<?php 
require dirname(__FILE__).'/includes/common.inc.php';

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico"/>
<link rel="stylesheet" type="text/css" href="style/index.css"/>
	<link rel="stylesheet" href="grumble.js-master/css/grumble.min.css?v=5"/>
<title>极速递</title>
</head>

<body>
<?php 
require PATH_ROOT.'/includes/topBar.php';
?>
<div class="divContainer">
<div id = "header" class="toBeCenter">
<?php 
require PATH_ROOT.'/includes/header.inc.php';
?>
</div>
</div>
<div class="divContainer">
<div id= "words">
<?php 
require PATH_ROOT.'/includes/words.inc.php';
?>
</div>
</div>
<div class="divContainer">
<div id = "line" class="toBeCenter paddingUpTopBottom">
<?php 
require PATH_ROOT.'/includes/line.inc.php';
?>
</div>
</div>
<div class="divContainer">
<div id ="main" class="toBeCenter">
<?php 
require PATH_ROOT.'/includes/main.inc.php';
?>

</div>
</div>
</a>
<div class="divContainer">
<div id = "line" class="toBeCenter paddingUpTopBottom">
<?php 
require PATH_ROOT.'/includes/line.inc.php';
?>
</div>
</div>
<div class="divContainer">
<div id = "footer">
<?php 
require PATH_ROOT.'/includes/footer.inc.php';
?>

</div>
</div>


	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="grumble.js-master/js/jquery.grumble.min.js?v=7"></script>

	<script >

		var $me = $('#qfkd'), interval;
		$me.grumble(
			{
				angle: 330,
				text: '<span style="line-height:18px;">全峰快递 在线下单 ----1 小 时 内----免费上门取件</span>',
				distance: 110,
				onShow: function(){
					var angle = 330, dir = 1;
					interval = setInterval(function(){
						(angle > 330 ? (dir=-1, angle--) : ( angle < 300 ? (dir=1, angle++) : angle+=dir));
						$me.grumble('adjust',{angle: angle});
					},70);
				},
				
			}
		);
	
	function infoBusy(){
		$('#ytkd').grumble(
				{
					text: '很抱歉！业务繁忙<br/><br/>请选择其他快递！',
					angle: 40,
					distance: 120,
					showAfter: 10,
					type:'alt-',
					hideAfter: false,
					hasHideButton: true,
					buttonHideText: '关闭'
				}
			);
		return false
		}

		</script>
</body>

</html>
