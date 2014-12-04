<?php
if(!isset($_SESSION)){
    session_start();
}
define ( 'PATH_ROOT', substr ( dirname ( __FILE__ ), 0, - 8 ) );
header ( 'Content-Type: text/html; charset=utf-8' );

$ini_array = parse_ini_file(PATH_ROOT."/config/properties.ini");
 define('IMGURL',$ini_array['imgUrl']);





//PATH_ROOT  ;E:\AppServ\www\SellSystem
function _alertinfo_historyback($info) {
	echo "<script type='text/javascript'>alert('{$info}');history.back();</script>";
	exit ();
}
function _alertinfo_goto($info, $address="#") {
	echo "<script type='text/javascript'>alert('{$info}');location.href='{$address}';</script>";
	exit ();

}
function _alert($info){
	echo "<script>alert('{$info}');</script>";
}
?>