<?php 
$user = new user();
$userlogin= new userlogin();
$shoporder = new shopOrder();
if(isset($_POST['orderReturn'])){
	$oid=$_POST['oid'];
	$shoporder->updateOkind($oid);
	
	
}


$good = new good();
$customer=$_SESSION['customer'];
$userone = $userlogin->getOneUid($customer);
$uid = $userone['UID'];

if($_GET['do']=="change"){
	$which=$_GET['type'];
	if($user->change($which,$uid)){
	_alertinfo_goto("兑换成功","myOrder.php");}
	else{_alertinfo_goto("兑换失败","myOrder.php");}
}
if($_GET['do']=="intro"){
	$sname=$_POST['sname'];
	$ssex=$_POST['ssex'];
	$stel=$_POST['stel'];
if($user->insert($sname,$ssex,$stel,"","",date('YmdHis'),"123456",2)){
	_alertinfo_goto("推荐成功","myOrder.php");}
else{_alertinfo_goto("推荐失败".mysql_error(),"myOrder.php");

}
}


if($_POST['sub']=="upinfo"){
		$user->updateInfo($uid,$_POST['uname'],$_POST['usex'],$_POST['utel'],$_POST['uemail'],$_POST['uaddress']);
		_alert("修改成功");
}
	$userinfo = $user->getUOne($uid);//渲染个人信息

	if (isset ( $_GET ['page'] )) {
	$_page = $_GET ['page'];

	if (empty ( $_page ) || $_page < 0 || !is_numeric ( $_page )) {
		$_page = 1;
	} else {
		$_page = intval ( $_page );
		
	}
} else {
	$_page = 1;
}
			$_pagesize = 5;
			$_pagenum = ($_page - 1) * $_pagesize;
			$_pagenumNext=$_pagenum+$_pagesize;
	$list = array();
	$list = $shoporder->getSomeOrder($uid);//渲染订单信息
	
	$_num =  count($list);
	if ($_num == 0) {
						$_pageabsolute = 1;
						$info="暂无更多订单";
		} else {
						$info="";
						$_pageabsolute = ceil ( $_num / $_pagesize );
					}
	if ($_page > $_pageabsolute) {
		
						$_page = $_pageabsolute;
		}
	if($_pagenumNext>$_num){
		
						$_pagenumNext=$_num;
		}
			
?>
<div class="width-1000  center">
	<!-- 位置 -->
<div>   
	<a href="index.php">首页</a>/
	<a href="myOrder.php"> 我的定制屋</a>
	</div>
			
			<!-- 左边 -->
					<div class="left width-100 height-400  " style="padding-left:5px;" id="leftselect">
							<dl>
								<dd ><button type="button" class="btn btn-default" id="myInfoL">个人信息</button></dd>
								<dd ><button type="button" class="btn btn-default" id="myOrderL">订单查询</button></dd>
								<dd ><button type="button" class="btn btn-default" id="myGiftL">个人礼包</button></dd>
								<dd ><button type="button" class="btn btn-default" id="myIntroL">推荐介绍</button></dd>
								<dd ><button type="button" class="btn btn-default" id="mySize">我的尺寸</button></dd>
							
							</dl>
					</div>
		   <!-- 右边 -->
		   			 <!-- 个人信息 -->
		   				<div class="left width-896 height-400 showBorder rightDiv displayNone" id="myInfo">
		   							<!-- 个人信息表单 -->
										<form action="myOrder.php" method="post" class="showBorder autoLR width-400">
												<dl>
													<dd>用户　名：<span><?php echo $customer?></span></dd>
													<dd>昵　　称：<input type="text"  class="" name="uname" value="<?php echo $userinfo['UNAME']?>"/></dd>
													<dd>性　　别：<input type="text"  class="" name="usex" value="<?php echo $userinfo['USEX']?>"/></dd>
													<dd>电　　话：<input type="text"  class="" name="utel" value="<?php echo $userinfo['UTEL']?>"/></dd>
													<dd>电子邮箱：<input type="text"  class="" name="uemail" value="<?php echo $userinfo['UEMAIL']?>"/></dd>
													<dd>地　　址：<input type="text"  class="" name="uaddress" value="<?php echo $userinfo['UADDRESS']?>"/></dd>
												</dl>
													<!-- 提交 -->
					   								 <div class="">
															<button type="submit " class="btn btn-primary" name ="sub" value="upinfo">修改</button>
													</div>
										</form>
										<!-- 个人信息表单结束 -->
		   				</div>
					<!-- 订单查询 -->
		   				<div class="left width-896 height-400 showBorder  rightDiv" id="myOrder">
		   								<div class="table-responsive">
		   											<!-- 表格 -->
  														<table class="table table-hover tableOrder">
  														<tr>
  																<th>订单编号</th>
  																<th>用户名</th>
  																<th>服装编号</th>
  																<th>服装图片</th>
  																<th>预约地址</th>
  																<th>预约时间</th>
  																<th>预约服务</th>
  																<th>配送选择</th>
  																<th>礼包兑换</th>
  																<th>服装价格</th>
  																<th>价格优惠</th>
  																<th>订单状态</th>
  														</tr>
  														<?php for ($i=$_pagenum;$i<$_pagenumNext;$i++){?>
  																	<tr class = "trclick" name="<?php echo $list[$i]['OID']?>">
  																	<td ><?php echo $list[$i]['OID']?></td>
  																	<td><?php echo $list[$i]['OUNAME']?></td>
  																	<td><?php echo $list[$i]['OGID']?></td>
  																	<td><?php $info = $good->getGOne($list[$i]['OGID']);
  																				echo 	"<img style='width:40px;height:40px;' src='http://115.28.133.116/upload_file/".$info['GPIC0']."'/>";
  																	?></td>
  																	<td><?php echo $list[$i]['OPROVINCE'].$list[$i]['OCITY'].$list[$i]['OAREA'].$list[$i]['OADDRESS']?></td>
  																	<td><?php echo $list[$i]['OBOOKDATE']?></td>
  																	<td><?php echo $list[$i]['OBOOKSERVICE']?></td>
  																	<td><?php echo $list[$i]['OPOSTSELECT']?></td>
  																	<td><?php echo $list[$i]['OGIFT']?></td>
  																	<td><?php echo $list[$i]['OGPRICE']?></td>
  																	<td><?php echo $list[$i]['OGPRICEPRE']?></td>
  																	<td><?php if($list[$i]['OKIND']==0){ echo "已定制";}if($list[$i]['OKIND']==1){ echo "返修";}
  																				echo "</br>";
  																					if($list[$i]['OSTATE']==0){echo "<span style='color:red;'>未处理</span>";}
  																					if($list[$i]['OSTATE']==1){echo "<span style='color:green;'>已确认</span>";}
  																	
  																	
  																	?></td></tr>
  																	
  																	<?php };?>
  														</table>
  													<!-- 表格结束 -->
  													<!-- 翻页 -->
  														<ul class="pagination" style="padding-left:350px;">
																<?php
																for($i = 0; $i < $_pageabsolute; $i ++) {
																	echo '<li><a href="myOrder.php?page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
																}
																;
																?>
																</ul>
										</div>
													<!-- 返修 -->
					   								 			<button class="btn btn-primary " style="margin-left:400px;" value="" id="btnEdit" >
  																							返修
																				</button>
		   				</div>
					<!-- 个人礼包 -->
		   				<div class="left width-896 height-400 showBorder displayNone rightDiv" id="myGift">
		   									<div class="table-responsive">
		   											<!-- 表格 -->
  														<table class="table table-hover tableOrder">
  														<thead>用户个人优惠</thead>
  														<tr>
  																<th>积分</th>
  																<th>无偿体型测量机会</th>
  																<th>无偿试衣修正机会</th>
  																<th>无偿后续维护机会</th>
  																<th>额外设计服务机会</th>
  														</tr>
  														<tr >
  																<td><?php echo $userinfo['UINTEGRAL']?></td>
  																<td><?php echo $userinfo['UMEASUREMENTTIME']?><a class="glyphicon glyphicon-shopping-cart" href="myOrder.php?type=UMEASUREMENTTIME&do=change"></a></td>
  																<td><?php echo $userinfo['UCORRECTIONTIME']?><a class="glyphicon glyphicon-shopping-cart" href="myOrder.php?type=UCORRECTIONTIME&do=change"></a></td>
  																<td><?php echo $userinfo['UMAINTENANCETIME']?><a class="glyphicon glyphicon-shopping-cart" href="myOrder.php?type=UMAINTENANCETIME&do=change"></a></td>
  																<td><?php echo $userinfo['UEXDISIGN']?></td>
  														</tr>
  														</table>
  													<!-- 表格结束 -->
											</div>
		   				</div>
					<!-- 推荐介绍 -->
		   				<div class="left width-896 height-400  displayNone rightDiv" id="myIntro">
		   						<!-- 推荐介绍表单 -->
										<form action="myOrder.php?do=intro" method="post" class=" autoLR width-400">
												<dl>
													<dd>推荐人姓名：<input type="text"  class="input" name="sname"/></dd>
													<dd>推荐人性别：<input type="radio" name="ssex" value="男"  checked="checked">男　　　　
																				</input><input type="radio" name="ssex" value="女" >女</input></dd>
													<dd>推荐人电话：<input type="text"  class="input" name="stel"/></dd>
												</dl>
													<!-- 提交 -->
					   								 <div class="">
															<button type="button " class="btn btn-primary ">提交</button>
													</div>
										</form>
										<!-- 推荐介绍表单结束 -->
		   				</div>
					
			<!-- 右边结束 -->		
					<div class="clear"></div>
			<!-- 返修窗口 -->
																			
																				<!-- Modal -->
																				<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  																						<div class="modal-dialog">
    																						<div class="modal-content">
      																							<div class="modal-header">
       																								 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       																									 <h4 class="modal-title" id="myModalLabel">返修</h4>
     																										 </div>
    																										 		<div class="modal-body">
																																<form method = "post" action = "">
																																	<dl>
																																			<input id="theid" type="hidden" name="oid" value=""></input>
																																			<dd>无偿试衣修正
																																					<?php if($userinfo['UCORRECTIONTIME']>0){?>
																																						<input type="checkbox"  name="ucorrectiontime" ></input>
																																					<?php }else {?>
																																						<input type="checkbox"  name="" disabled="disabled"></input>
																																					<?php }?>
																																			</dd>
																																			<dd>无偿后续维护
																																					<?php if($userinfo['UMAINTENANCETIME']>0){?>
																																						<input type="checkbox"  name="umaintenancetime"></input>
																																					<?php }else {?>
																																						<input type="checkbox"  name="" disabled="disabled"></input>
																																					<?php }?>
																																			</dd>
																																			<dd>返修说明：</dd>
																																			<dd><textarea></textarea></dd>
																																			<dd><input  type="submit" id="subEdit" style="display:none;" name="orderReturn"/></dd>
																																	</dl>	
																																	</form>
     																												 </div>
     																						 <div class="modal-footer">
       																						  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      																						  <button type="button" class="btn btn-primary " id="modelSubEdit">提交</button>
      																			</div>
       																    </div><!-- /.modal-content -->
       														    </div><!-- /.modal-dialog -->
      											     </div><!-- /.modal -->
	</div>
			
			
		
		  		

