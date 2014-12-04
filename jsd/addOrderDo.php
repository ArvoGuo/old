<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require dirname ( __FILE__ ) . '/includes/common.inc.php';
session_start ();

if (! $_POST ['action'] == 'add') {
	_alert_back ( errorandreturn );

}
require PATH_ROOT . 'config/config_mysql.func.php';

if ($_POST ['send'] == '确定') {
	session_start ();
	$code = $_SESSION ['code'];
	$senderprovince = $_POST ['senderprovince'];
	$sendercity = $_POST ['sendercity'];
	$senderarea = $_POST ['senderarea'];
	$getterprovince = $_POST ['getterprovince'];
	$gettercity = $_POST ['gettercity'];
	$getterarea = $_POST ['getterarea'];
	$sid = $_POST ['sid'];
	$sendername = $_POST ['sendername'];
	$sendertel = $_POST ['sendertel'];
	$senderaddress = $_POST ['senderaddress'];
	$gettername = $_POST ['gettername'];
	$gettertel = $_POST ['gettertel'];
	$getteraddress = $_POST ['getteraddress'];
	$bagcontent = $_POST ['bagcontent'];
	$yzm = $_POST ['yzm'];
	$goodsaddress = $_POST ['goodsaddress'];
	$status1 = 0;
	date_default_timezone_set ( 'PRC' );
	$createdate = date ( 'Y-m-d H:i:s' );
	if ($_SESSION['user']!=""){
		$user=$_SESSION['user'];
	}else {
		$user="";
	}
	
	if (mb_strlen ( $sendername, 'UTF8' ) < 1 || mb_strlen ( $sendertel, 'UTF8' ) < 1 || mb_strlen ( $senderaddress, 'UTF8' ) < 1) {
		_failsubmit_back ( "请正确输入寄件人信息！" );
	}
	;
	if (mb_strlen ( $getteraddress, 'UTF8' ) < 1 || mb_strlen ( $gettername, 'UTF8' ) < 1 || mb_strlen ( $gettertel, 'UTF8' ) < 1) {
		_failsubmit_back ( "请正确输入收件人信息！" );
	}
	;
	if ($senderaddress == "请输入详细地址") {
		_failsubmit_back ( "请正确输入寄件人地址" );
	}
	;
	if ($getteraddress == "请输入详细地址") {
		_failsubmit_back ( "请正确输入收件人地址" );
	}
	;
	if (mb_strlen ( $goodsaddress, 'UTF8' ) > 199) {
		_failsubmit_back ( "上门取货地址请勿超过200个字数" );
	}
	;
	if (mb_strlen ( $sendername, 'UTF8' ) > 49) {
		_failsubmit_back ( "寄件人姓名请勿超过50个字数" );
	}
	;
	if (mb_strlen ( $sendertel, 'UTF8' ) > 11 || mb_strlen ( $sendertel, 'UTF8' ) < 9) {
		_failsubmit_back ( "寄件人号码填写错误" );
	}
	;
	if (mb_strlen ( $senderaddress, 'UTF8' ) > 199) {
		_failsubmit_back ( "寄件人地址请勿超过200个字数" );
	}
	;
	
	if (mb_strlen ( $gettername, 'UTF8' ) > 49) {
		_failsubmit_back ( "收件人姓名请勿超过50个字数" );
	}
	;
	if (mb_strlen ( $gettertel, 'UTF8' ) > 11 || mb_strlen ( $gettertel, 'UTF8' ) < 9) {
		_failsubmit_back ( "收件人号码填写错误" );
	}
	;
	if (mb_strlen ( $getteraddress, 'UTF8' ) > 199) {
		_failsubmit_back ( "收件人地址请勿超过200个字数" );
	}
	;
	
	if (! is_numeric ( $sendertel )) {
		_failsubmit_back ( "寄件人电话号码格式错误" );
	}
	;
	if (! is_numeric ( $gettertel )) {
		_failsubmit_back ( "收件人电话号码格式错误" );
	}
	;
	
	if (mb_strlen ( $yzm, 'UTF8' ) != 4) {
		_failsubmit_back ( "验证码必须为四位" );
	}
	;
	if ($yzm != $code) {
		_failsubmit_back ( "验证码错误" );
	}
	;
	
	$sql = "INSERT INTO ORDERS(
	          SID,
	          STATUS,
	          CREATEDATE,
	          BAGCONTENT,
	          GOODSADDRESS,
	          SENDERPROVINCE,
	          SENDERCITY,
	          SENDERAREA,
	          SENDERNAME,
	          SENDERTEL,
	          SENDERADDRESS,
	          GETTERPROVINCE,
	          GETTERCITY,
	          GETTERAREA,
	          GETTERNAME,
	          GETTERTEL,
	          GETTERADDRESS,
	          ACCOUNT
				 ) VALUES(
	          $sid,
	          $status1,
	          '{$createdate}',
	          '{$bagcontent}',
	          '{$goodsaddress}',
	          '{$senderprovince}',
	          '{$sendercity}',
	          '{$senderarea}',
	          '{$sendername}',
	          '{$sendertel}',
	          '{$senderaddress}',
	          '{$getterprovince}',
	          '{$gettercity}',
	          '{$getterarea}',
	          '{$gettername}',
	          '{$gettertel}',
	          '{$getteraddress}',
	          '{$user}'
				)";
	conn_query ( $sql );
	conn_close ();
	
	switch ($sid) {
		case 1 :
			$title = "韵达快递";
			break;
		case 2 :
			$title = "圆通快递";
			break;
		case 3 :
			$title = "增益快递";
			break;
		case 4 :
			$title = "全峰快递";
			break;
		default :
			_alert_back ( "errorandreturn" );
	}
	;
	$obj = "**" . $title . "**寄件人：" . $sendername . ",手机：" . $sendertel . ",寄件地址：" . $senderprovince . $sendercity . $senderarea . $senderaddress . ",取件地址：" . $goodsaddress;
	$body = $obj . "收件人：" . $gettername . ",收件人手机：" . $gettertel . ",收件人地址：" . $getterprovince . $gettercity . $getterarea . $getteraddress . ",备注信息;" . $bagcontent;
	$send = mail('ifb123@163.com', "{$obj}","{$body}");
	$send = mail('1379623154@qq.com', "{$obj}","{$body}");
	$send = mail('250185087@qq.com', "{$obj}","{$body}");
	

	_success_back ( "您已经成功下单，我们将尽快联系您！", "addOrder.php?sid=$sid" );

}
?>

