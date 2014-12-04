<?php 
$good = new good();
$list = array();
$list = $good->getAllInfo()
;
?>

<div class="orderMain">
<div>   
	<a href="index.php">首页</a>/
	<a href="order.php"> o2o定制</a>/
	</div>
<!-- 代码 开始 -->
<div class="row-bot">
	<div class="center-shadow">
		<div class="carousel-container">
		  <div id="carousel">
		  			<!-- data -->
		  				<?php  foreach($list as $l){?>
						<div class="carousel-feature">
							  <a href="goodDetail.php?gid=<?php echo $l['GID']?>"><img class="carousel-image" alt="" src="http://115.28.133.116/upload_file/<?php echo $l['GPIC0']?>"></a>                          
						</div>
						<?php }?>
					<!-- dataover -->
		  </div>
		</div>
	</div>
</div>
<!-- 代码 结束 -->
</div>