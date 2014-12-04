<?php
header ( 'Content-Type: text/html; charset=utf-8' );
define ( 'PATH_ROOT', substr ( dirname ( __FILE__ ), 0, - 8 ) );
require PATH_ROOT . 'includes/global.func.php';
function _alert_back($kind) {
	if ($kind == 'errorandreturn') {
		echo "<script type='text/javascript'>alert('非法操作！');location.href='index.php';</script>";
		exit ();
	}

}
function _success_back($info, $address) {
	echo "<script type='text/javascript'>alert('{$info}');location.href='{$address}';</script>";
	exit ();

}
function _failsubmit_back($info) {
	echo "<script type='text/javascript'>alert('{$info}');history.back();</script>";
	exit ();
}
function _alertinfo_historyback($info) {
	echo "<script type='text/javascript'>alert('{$info}');history.back();</script>";
	exit ();
}
function _alertinfo_backaddress($info, $address) {
	echo "<script type='text/javascript'>alert('{$info}');location.href='{$address}';</script>";
	exit ();

}
function _alert_exit($info) {
	echo "<script type='text/javascript'>alert('{$info}');</script>";
	exit ();

}
function _alert($info) {
	echo "<script type='text/javascript'>alert('{$info}');</script>";

}
function get_config($file, $ini, $type = "string") {
	if (! file_exists ( $file ))
		return false;
	$str = file_get_contents ( $file );
	if ($type == "int") {
		$config = preg_match ( "/" . preg_quote ( $ini ) . "=(.*);/", $str, $res );
		return $res [1];
	} else {
		$config = preg_match ( "/" . preg_quote ( $ini ) . "=\"(.*)\";/", $str, $res );
		if ($res [1] == null) {
			$config = preg_match ( "/" . preg_quote ( $ini ) . "='(.*)';/", $str, $res );
		}
		return $res [1];
	}
}
function update_config($file, $ini, $value, $type = "string") {
	if (! file_exists ( $file ))
		return false;
	$str = file_get_contents ( $file );
	$str2 = "";
	if ($type == "int") {
		$str2 = preg_replace ( "/" . preg_quote ( $ini ) . "=(.*);/", $ini . "=" . $value . ";", $str );
	} else {
		$str2 = preg_replace ( "/" . preg_quote ( $ini ) . "=(.*);/", $ini . "=\"" . $value . "\";", $str );
	}
	file_put_contents ( $file, $str2 );
}


?>