<?php 
$gid = $_GET['gid'];
$_SESSION['lastgid']=$gid;
if($_SESSION['customer']==""){
	$_SESSION['flag']="loginout";//未登录标记
		echo "<script>location.href='login.php';</script>";
   		exit();
}
$good = new good();
$userlogin = new userlogin();
$user = new user();
$info = $good->getGOne($gid);
$customer=$_SESSION['customer'];
$userone = $userlogin->getOneUid($customer);
$uid = $userone['UID'];
$userinfo = $user->getUOne($uid);//get userinfo
if($_POST['sub']=="sub"){
	$data = new stdClass();
	date_default_timezone_set ( 'PRC' );
	$data->ocreatedate= date ( 'Y-m-d H:i:s' );
	$data->ouname = $_POST['name'];
	$data->ogid = $_POST['gid'];
	$data->ouid = $uid;
	$data->oaddress = $_POST['address'];
	$data->ogprice = $_POST['gprice'];
	
	$data->obookdate = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
	$data->obookservice = $_POST['service'];
	$data->opostselect = $_POST['postselect'];
	$data->ogift = $_POST['gift'];
	$data->oprovince=$_POST['getterprovince'];
	$data->ocity=$_POST['gettercity'];
	$data->oarea=$_POST['getterarea'];
	if($data->ogift=="无偿体型测量机会"){
		$data->ogpricepre = $_POST['gprice']*0.9;
	}else if($data->ogift=="额外设计服务机会"){
		$data->ogpricepre = $_POST['gprice']*0.8;
	}else {
		$data->ogpricepre = $_POST['gprice'];
	}
	
	
	$shoporder= new shopOrder();
	$shoporder->insert($data);
	echo "<script>alert('订单提交成功!\\n请等待工作人员与您联系!\\n您好,离你最近的取货地址是：上海市松江区龙腾路333号！');</script>";
	
}



?>

<div class=" showBorder center" style="width:910px;">
	<!-- 位置 -->
	<div>   
	<a href="index.php">首页</a>/
	<a href="order.php"> o2o定制</a>/
	<a href="">商品下单</a>
	</div>
			<!-- 上边标题 -->
			
			<!-- 左边 -->
			<div class="height-400 showBorder  left" style="width:250px;">
						<!-- 图片 -->
						<img alt="" src="http://115.28.133.116/upload_file/<?php echo $info['GPIC0']?>" style="width:248px;" class=" height-300">
						<!-- 编号 -->
						<span>编号:<?php echo $info['GID']?></span>
						<!-- 价格 -->
						<span>价格:<?php echo $info['GPRICE']?></span>
			
			</div>
			<!-- 右边 -->
			<div class="height-400   left" style="width:650px;">
						<!-- 表单 -->
						<form action="goodDetailSubmit.php?gid=<?php echo $gid?>" method="post" style="margin-left:40px">
								<input type="hidden" name="gid" value="<?php echo $info['GID']?>"></input>
								<input type="hidden" name="gprice" value="<?php echo $info['GPRICE']?>"></input>
								<dl style="width:350px;">
										<dd>姓　　名：<input type="text"  name ="name" class="" value="<?php echo $userinfo['UNAME']?>"/></dd>
										<dd>电　　话：<input type="text"  name ="tel"  class="" value="<?php echo $userinfo['UTEL']?>"/></dd>
										<dd>预约地址：<select id="getterprovince" name="getterprovince" class=""></select>
													 <select id="gettercity" name="gettercity" class=""></select>
													 <select id="getterarea" name="getterarea" class=""></select></dd>
										<dd>详细地址：<textarea name = "address"></textarea></dd>			 
										<dd><span class="left">预约时间：</span>
												<!-- 时间选择控件 -->
													 <div id="dateSelector1" class="left">
															<SELECT id="idYear" name="year"></SELECT>年 
															<SELECT id="idMonth" name="month"></SELECT>月 
															<SELECT id="idDay" name="day"></SELECT>日
													</div> 
													<div class="clear"></div>
											    <!-- 时间选择控件结束 -->
										</dd>
										<dd><span class="left">取货时间：</span>
												<!-- 时间选择控件 -->
													 <div id="dateSelector2" class="left">
															<SELECT id="idYear2" name="year"></SELECT>年 
															<SELECT id="idMonth2" name="month"></SELECT>月 
															<SELECT id="idDay2" name="day"></SELECT>日
													</div> 
													<div class="clear"></div>
											    <!-- 时间选择控件结束 -->
										</dd>
										<dd>预约服务：<select name="service"><option>量体</option><option>设计</option></select></dd>
										<dd>配送选择：<select name="postselect"><option> 自取</option><option>快递</option></select>
									   </dd>
										
										<dd>礼包兑换：<select name="gift">
																				
																	<?php if($userinfo['UMEASUREMENTTIME']>0){
																						echo "<option> 无偿体型测量机会</option>";
																				}
																				if($userinfo['UMEASUREMENTTIME']>0){
																						echo "<option> 额外设计服务机会</option>";
																				}
																				if($userinfo['UMEASUREMENTTIME']==0&&$userinfo['UMEASUREMENTTIME']==0){
																						echo "<option> 无可兑换礼包</option>";
																				}
																				
																					?>
																					<option>不选择兑换礼包 </option>
																</select>
										</dd>
								</dl>
						 <div class="submitBtn left ">
												<button type="button " class="btn btn-primary" name="sub" value="sub">预约定制</button>
												
										</div>
										
						<!-- 表单结束 -->
						</form>
						<div style="margin-top: 20px;
margin-bottom: 20px; margin-left:20px;" class="left">
										<a href="sanwei.html"><button type="button " class="btn btn-primary" name="" value="">三维虚拟</button></a>
										</div>
										<div style="margin-top: 20px;
margin-bottom: 20px;  margin-left:20px;"  class="left">
												<a a href="chengyi.html"><button type="button " class="btn btn-primary" name="" value="">成衣定制</button></a>
								</div>
			</div>
			<!-- 提交 -->
					   					
					<div class="clear"></div>    		
			</div>

