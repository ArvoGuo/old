<?php 

require '../includes/common.inc.php';
$_nowNumber=get_config("../config/config_indexOrderNum.php","_indexOrderNum","int");
if ($_POST['submit']=="确认修改"){
	$_number=$_POST['number'];
	preg_match("/^[0-9]+$/",$_number,$result_num_preg);
	if ($result_num_preg){
		if ($_number<$_nowNumber){
			echo "<script type='text/javascript'>alert('您输入的数小于当前的数，请重新输入');location.href='admin_nav_BaseNumSet.php';</script>";
		}
		else {
		update_config("../config/config_indexOrderNum.php","_indexOrderNum",$_number,"int");
		echo "<script type='text/javascript'>alert('修改成功！');location.href='admin_nav_BaseNumSet.php';</script>";
	}
	}
	else{
		echo "<script type='text/javascript'>alert('请正确输入！');location.href='admin_nav_BaseNumSet.php';</script>";
	}
	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../dist/css/bootstrap.min.css"/>
<link rel="stylesheet" href="../build/css/messenger.css"/>
<link rel="stylesheet" href="../build/css/messenger-theme-future.css"/>
<script src="../js/jquery-1.11.0.min.js"></script>
<script src="../js/backbone.js"></script>
<script src="../build/js/messenger.min.js"></script>
<title>主页订单基数修改</title>
</head>

<script type="text/javascript">
$(document).ready(function() {
	$._messengerDefaults = {
			extraClasses: 'messenger-fixed messenger-theme-future messenger-on-top messenger-on-right'
		}
$("#inputtext").blur(function(){
	var string=$("#inputtext").val();
	var checknum=/^[0-9]+$/;
	$result=checknum.test(string);
	if(!$result){
		
		$.globalMessenger().hideAll()
		$.globalMessenger().post({
	    message: '请正确输入',
	    type: 'error',
	    showCloseButton: true
	    });

		}else{
			$.globalMessenger().hideAll()
			$.globalMessenger().post({
		    message: '输入正确',
		    type: 'info',
		    showCloseButton: true
		    });
			}
	
	
});

$("#check").click(function(){
	var string=$("#inputtext").val();
	var checknum=/^[0-9]+$/;
	$result=checknum.test(string);
	if(!$result){
		
		$.globalMessenger().hideAll()
		$.globalMessenger().post({
	    message: '请正确输入',
	    type: 'error',
	    showCloseButton: true
	    });

		
return false;
		}
	
	
});
});

</script>

<body>
<div >
<div style="margin:0 auto;width:300px;border:1px solid #CCC;padding:5px;">
  <form class="form-horizontal" method="post" action="admin_nav_BaseNumSet.php">
    <fieldset>
      <div id="legend" class="">
        <legend class="">修改订单基数</legend>
      </div>
      <div class="control-group">
       <label class="control-label" for="input01">当前订单基数：<?php echo $_nowNumber?></label>
      </div>
    <div class="control-group">

          <!-- Text input-->
         
          <label class="control-label" for="input01">订单基数</label>
          <div class="controls">
            <input id="inputtext" type="text" placeholder="请输入订单基数" class="input-xlarge" name="number">
            <p class="help-block">需输入数字</p>
          </div>
        </div>

    

    

    <div class="control-group">
          <label class="control-label">提交按钮</label>

          <!-- Button -->
          <div class="controls">
            <button id="check" type="submit" class="btn btn-primary" name="submit" value="确认修改">确认修改</button>
          </div>
        </div>

    </fieldset>
  </form>
</div>
</div>

</body>
</html>
