<?php


//随机数
//mt_rand(0,15);
//转换16进制
//dechex(mt_rand(0,15));
session_start();//开启

//随机码个数
$_rnd_num=4;
//创建随机码
for ($i=0;$i<4;$i++){
	$_nmsg .=dechex(mt_rand(0,15));
	
}
//保存
$_SESSION['code'] = $_nmsg;
//创建一张图像
$_width = 75;
$_height = 25;
$_img = imagecreatetruecolor($_width,$_height);
//白色
$_white = imagecolorallocate($_img,255,255,255);
//填充
imagefill($_img,0,0,$_white);
//黑色 
//$_black = imagecolorallocate($_img,0,0,0);
$_black =  imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
//边框 有溢出所以-1
imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);
//随机化出6条线
 for ($i=0;$i<6;$i++){
 	$_rnd_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
 	imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);
 	
 }
 //随机雪花
 for ($i=0;$i<20;$i++){
 	 	$_rnd_color = imagecolorallocate($_img,mt_rand(150,255),mt_rand(150,255),mt_rand(150,255));
 		imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rnd_color);
 	
 }
 //输出验证码
 for ($i=0;$i<strlen($_SESSION['code']);$i++){
 	$_rnd_color = imagecolorallocate($_img,mt_rand(0,160),mt_rand(0,150),mt_rand(0,160)); 	
 	imagestring($_img,5,$i*$_width/4+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_rnd_color);
 }

//设置格式
header('Content-Type:image/png');
imagepng($_img);
imagedestroy($_img);
?>

