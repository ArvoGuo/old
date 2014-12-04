<?php 
$gid= $_GET['gid'];
$good = new good();
$info = $good->getGOne($gid);

?>

<div class="goodDetailMain showBorder center">
	<!-- 位置 -->
	<div>   
	<a href="index.php">首页</a>/
	<a href="order.php"> o2o定制</a>/
	<a href="">产品明细</a>
	
	</div>
	<!-- 左边 -->
	<div class="left detailLeft ">
			<!-- 产品明细 -->
				<div class=" detailSmall  showBorder">产品明细<?php echo "<pre>"."名称：</br>".$info['GNAME']."</br>"."风格：</br>".$info['GSTYLE']?></div>
				<div class="detailSmall  showBorder">产品评价
					<?php echo "<pre>"."质感好，做工优良，版型好。"?>


				</div>
			<!-- 产品评价 -->
	</div>
	<!-- 中间 -->
	<div class="left detailMiddle showBorder">
	<img src="http://115.28.133.116/upload_file/<?php echo $info['GPIC0']?>" style="margin-left:20px;" class ="DetailMainPic bigPic"/>
	</div>
	<!-- 右边 -->
	<div class="left detailRight showBorder">
			<!-- 轮播 -->
								<!--  轮播动画开始  -->
								<div id="slider">
										<!-- 切换区域开始 -->
   													 <div class="child" style="display: block; top: 130px;">
   													 <!--200 *130 -->
    														<a href="javascript:;" target="_blank">
    																<img src="http://115.28.133.116/upload_file/<?php echo $info['GPIC1']?>" alt=""  class="DetailSmallPic smallPic"/>
    																<img src="http://115.28.133.116/upload_file/<?php echo $info['GPIC2']?>" alt=""  class="DetailSmallPic smallPic"/>
    																<img src="http://115.28.133.116/upload_file/<?php echo $info['GPIC3']?>" alt=""  class="DetailSmallPic smallPic"/>
    														</a>
   													 </div>
    												<div class="child">
    														<a href="javascript:;" target="_blank">
    																<img src="http://115.28.133.116/upload_file/<?php echo $info['GPIC4']?>" alt="" class="DetailSmallPic smallPic" />
    																<img src="http://115.28.133.116/upload_file/<?php echo $info['GPIC5']?>" alt="" class="DetailSmallPic smallPic" />
    																<img src="http://115.28.133.116/upload_file/<?php echo $info['GPIC6']?>" alt=""  class="DetailSmallPic smallPic"/>
    														</a>
   													 </div>
   													
   													 <!-- 切换区域结束 -->
														<!-- 触发器 -->
   														 <div id="slider-img"></div>
  															  <!-- 上下翻页切换按钮 -->
  																  <div id="btn_prev" class="glyphicon glyphicon-chevron-up"></div>
																  <div id="btn_next" class="glyphicon glyphicon-chevron-down"></div>
							</div>
							<!--  轮播动画结束  -->
	</div>
	<div style="clear:both;"></div>
</div>
<!-- 按钮 -->
<div class="submitBtn">
	<a href="goodDetailSubmit.php?gid=<?php echo $gid ?>" style="color:white;"><button type="button " class="btn btn-primary ">定制</button></a>
</div>