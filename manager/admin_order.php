
<?php 
require '../include/include.inc.php';
require PATH_ROOT.'/mysql/mysql.php';
$order= new shopOrder();
$op=$_GET['op'];

if($_GET['do']=="edit"){
	$oid = $_POST['oid'];
	$ogid = $_POST['ogid'];
	$ogprice = $_POST['ogprice'];
	$ogpricepre = $_POST['ogpricepre'];
	if(!$order->updateInfo($oid,$ogid,$ogprice,$ogpricepre)){
		echo "失败";
	} ;
}
if($_GET['do']=="del"){
	$oid = $_POST['oid'];
		if(!$order->deleteOne($oid)){
			echo "失败";		
		};
};
if($_GET['do']=="com"){
		$oid = $_POST['oid'];
		if(!$order->updateOState($oid)){
			echo "失败";		
		};
};

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
			$_pagesize = 10;
			$_pagenum = ($_page - 1) * $_pagesize;
			$_pagenumNext=$_pagenum+$_pagesize;
	$list= array();
	$list = $order->getAllInfo();
	
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../dist/css/bootstrap.min.css"/>
<link rel = "stylesheet" type="text/css" href = "../css/index.css"/>
 <script src="../dist/js/jquery-1.11.0.min.js"></script>
   <script src="../dist/js/bootstrap.min.js"></script>
<title></title>
</head>

<?php 
//add
if($op=="add"){?>




<?php }?>

<?php 
//edit
if($op=="edit"){?>

<div>edit</div>


<?php }?>
<?php 
//search
if($op=="search"){?>
								<!-- search -->
									<div> 管理订单</div>
											<div class="table-responsive">
		   											<!-- 表格 -->
  														<table class="table table-hover ">
  														<tbody>
  																	<tr>
  																	<th>排序</th>
  																	<th>订单编号</th>
  																	<th>客户编号</th>
  																	<th>服装编号</th>
  																	<th style="width:100px !important;">预约地址</th>
  																	<th>预约时间</th>
  																	<th>预约服务</th>
  																	<th>配送选择</th>
  																	<th>礼包兑换</th>
  																	<th>服装价格</th>
  																	<th>优惠价格</th>
  																	<th style="width:80px;">订单状态</th>
  																	<th>下单时间</th>
  																	<th>操作</th>
  																	</tr>
  																	<?php echo $info?>
  																	<!-- data -->
  																	<?php for ($i=$_pagenum;$i<$_pagenumNext;$i++){?>
  																	<tr>
  																	<td><?php echo $i?></td>
  																	<td><?php echo $list[$i]['OID']?></td>
  																	<td><?php echo $list[$i]['OUID']?></td>
  																	<td><?php echo $list[$i]['OGID']?></td>
  																	<td style="width:100px !important;"><?php echo $list[$i]['OPROVINCE']."</br>".$list[$i]['OCITY']."</br>".$list[$i]['OAREA']."</br>".$list[$i]['OADDRESS']?></td>
  																	<td><?php echo $list[$i]['OBOOKDATE']?></td>
  																	<td><?php echo $list[$i]['OBOOKSERVICE']?></td>
  																	<td><?php echo $list[$i]['OPOSTSELECT']?></td>
  																	<td><?php echo $list[$i]['OGIFT']?></td>
  																	<td><?php echo $list[$i]['OGPRICE']?></td>
  																	<td><?php echo $list[$i]['OGPRICEPRE']?></td>
  																	<td><?php 
  																					if($list[$i]['OKIND']==0){echo "正常订单";}
  																					if($list[$i]['OKIND']==1){echo "返修订单";}
  																					echo "</br>";
  																					if($list[$i]['OSTATE']==0){echo "<span style='color:red;'>未处理</span>";}
  																					if($list[$i]['OSTATE']==1){echo "<span style='color:green;'>已处理</span>";}
		  																	?>
  																	</td>
  																	<td><?php echo $list[$i]['OCREATEDATE']?></td>
  																		<!-- 提交表单 -->
  																	<td>
  																				<button class="btn btn-success" id="modelbtnCom2<?php echo $i?>" >
  																							确定
																				</button></br>
  																				 <button type="button" id="modelSubDel2<?php echo $i?>"  class="btn btn-danger" >
																				           删除
																				 </button>
																				<button class="btn btn-primary" id="btnEdit2<?php echo $i?>" data-toggle="modal" data-target="#myModalEdit2<?php echo $i?>">
  																							编辑
																				</button>
																				<!-- comfirm -->
																						<form method = "post" action="admin_order.php?do=com&op=<?php echo $op.'&page='.$_page?>" style="display:none;">
																							 <input type="hidden" name="oid" value="<?php echo $list[$i]['OID']?>" />
																				   			 <input type="submit" id="subCom2<?php echo $i?>" style="display:none;"  />
																						</form>
																						
																				<!-- del -->
																				 		<form method="post" action="admin_order.php?do=del&op=<?php echo $op.'&page='.$_page?>" style="display:none;">
																				 			 <input type="hidden" name="oid" value="<?php echo $list[$i]['OID']?>" />
																				   			 <input type="submit" id="subDel2<?php echo $i?>" style="display:none;" onclick="JavaScript:return confirm('确定删除吗？')" />
																						</form>
																						
																				<!-- Modal -->
																				<div class="modal fade" id="myModalEdit2<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  																						<div class="modal-dialog">
    																						<div class="modal-content">
      																							<div class="modal-header">
       																								 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       																									 <h4 class="modal-title" id="myModalLabel">编辑商品基本信息</h4>
     																										 </div>
    																										 		<div class="modal-body">
																																<form method = "post" action = "admin_order.php?do=edit&op=<?php echo $op.'&page='.$_page?>">
																																	<dl>
																																			<input type="hidden" name="oid" value="<?php echo $list[$i]['OID']?>"/>
																																			<dd>订单编号：<?php echo $list[$i]['OID']?></dd>
																																			<dd>服装编号：<input type="text" class="input" name = "ogid" value="<?php echo $list[$i]['OGID']?>"/></dd>
																																			<dd>服装价格：<input type="text" class="input" name = "ogprice" value="<?php echo $list[$i]['OGPRICE']?>"/></dd>
																																			<dd>优惠价格：<input type="text" class="input" name = "ogpricepre" value="<?php echo $list[$i]['OGPRICEPRE']?>"/></dd>
																																			<dd><input  type="submit" id="subEdit2<?php echo $i?>" style="display:none;"/></dd>
																																	</dl>	
																																	</form>
     																												 </div>
     																						 <div class="modal-footer">
       																						  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      																						  <button type="button" class="btn btn-primary" id="modelSubEdit2<?php echo $i?>">提交</button>
      																			</div>
       																    </div><!-- /.modal-content -->
       														    </div><!-- /.modal-dialog -->
      											     </div><!-- /.modal -->
																	</td>
  																	</tr>
  																	<!-- 脚本 -->
																			<script type="text/javascript">
																							$('#btnEdit2<?php echo $i?>').click(function(){
																									$('#myModalEdit0<?php echo $i?>').modal();
																								});
																							$('#modelSubEdit2<?php echo $i?>').click(function(){
																									$('#subEdit2<?php echo $i?>').click();
																								});
																							$('#modelSubDel2<?php echo $i?>').click(function(){
																									$('#subDel2<?php echo $i?>').click();
																								});
																							$('#modelbtnCom2<?php echo $i?>').click(function(){
																								$('#subCom2<?php echo $i?>').click();
																							});
																							</script>
		  																	
  																	
  																	<?php };?>
  														
  														
  														</tbody>
  														</table>
  														
  											</div>
														<!-- 翻页 -->
  														<ul class="pagination" >
																<?php
																for($i = 0; $i < $_pageabsolute; $i ++) {
																	echo '<li><a href="admin_order.php?op='.$op.'&page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
																}
																;
																?>
																</ul>
				
			



<?php }?>



</html>

 
