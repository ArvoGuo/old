
<?php 
require '../include/include.inc.php';
require PATH_ROOT.'/mysql/mysql.php';
$user=new user();

//当点击编辑操作 分类

if($_GET['do']=="edit"){
	$uid = $_POST['uid'];
	$uintegral = $_POST['uintegral'];
	$umeasurementtime = $_POST['umeasurementtime'];
	$ucorrectiontime = $_POST['ucorrectiontime'];
	$umaintenancetimel = $_POST['umaintenancetime'];
	$uexdisign = $_POST['uexdisign'];
	if(!$user->updateInfoDiscount($uid,$uintegral,$umeasurementtime,$ucorrectiontime,$umaintenancetimel,$uexdisign)){
		echo "失败";
	} ;
}



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
	$list = $user->getAllInfoNot2();
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

									<!-- 用户优惠信息管理 -->
									
											<div class="table-responsive">
		   											<!-- 表格 -->
  														<table class="table table-hover ">
  														<thead><tr>用户优惠信息管理</tr></thead>
  														<tbody>
  																	<tr>
  																	<th>排序</th>
  																	<th>用户编号</th>
  																	<th>姓名</th>
  																	<th>积分</th>
  																	<th>无偿体型测量</th>
  																	<th>无偿试衣修正</th>
  																	<th>无偿后续服务</th>
  																	<th>额外设计服务</th>
  																	<th>操作</th>
  																	</tr>
  																	<?php echo $info?>
  																	<!-- data -->
  																	<?php for ($i=$_pagenum;$i<$_pagenumNext;$i++){?>
  																	<tr>
  																	<td><?php echo $i?></td>
  																	<td><?php echo $list[$i]['UID']?></td>
  																	<td><?php echo $list[$i]['UNAME']?></td>
  																	<td><?php echo $list[$i]['UINTEGRAL']?></td>
  																	<td><?php echo $list[$i]['UMEASUREMENTTIME']?></td>
  																	<td><?php echo $list[$i]['UCORRECTIONTIME']?></td>
  																	<td><?php echo $list[$i]['UMAINTENANCETIME']?></td>
  																	<td><?php echo $list[$i]['UEXDISIGN']?></td>
  																	<!-- 提交表单 -->
  																	<td>
  																				
																				<button class="btn btn-primary" id="btnEdit0<?php echo $i?>" data-toggle="modal" data-target="#myModalEdit0<?php echo $i?>">
  																							编辑
																				</button>
																			
																						
																				<!-- Modal -->
																				<div class="modal fade" id="myModalEdit0<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  																						<div class="modal-dialog">
    																						<div class="modal-content">
      																							<div class="modal-header">
       																								 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       																									 <h4 class="modal-title" id="myModalLabel">编辑Vip用户基本信息</h4>
     																										 </div>
    																										 		<div class="modal-body">
																																<form method = "post" action = "admin_userDiscount.php?do=edit<?php echo '&page='.$_page?>">
																																	<dl>
																																			<input type="hidden" name="uid" value="<?php echo $list[$i]['UID']?>"/>
																																			<dd>姓　　名：<?php echo $list[$i]['UNAME']?></dd>
																																			<dd>积　　分：<input type="text" class="input" name = "uintegral" value="<?php echo $list[$i]['UINTEGRAL']?>"/></dd>
																																			<dd>无偿体型测量：<input type="text" class="input" name = "umeasurementtime" value="<?php echo $list[$i]['UMEASUREMENTTIME']?>"/></dd>
																																			<dd>无偿试衣修正：<input type="text" class="input" name = "ucorrectiontime" value="<?php echo $list[$i]['UCORRECTIONTIME']?>"/></dd>
																																			<dd>无偿后续服务：<input type="text" class="input" name = "umaintenancetime" value="<?php echo $list[$i]['UMAINTENANCETIME']?>"/></dd>
																																			<dd>额外设计服务：<input type="text" class="input" name = "uexdisign" value="<?php echo $list[$i]['UEXDISIGN']?>"/></dd>
																																			<dd><input  type="submit" id="subEdit0<?php echo $i?>" style="display:none;"/></dd>
																																	</dl>	
																																	</form>
     																												 </div>
     																						 <div class="modal-footer">
       																						  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      																						  <button type="button" class="btn btn-primary" id="modelSubEdit0<?php echo $i?>">提交</button>
      																			</div>
       																    </div><!-- /.modal-content -->
       														    </div><!-- /.modal-dialog -->
      											     </div><!-- /.modal -->
																	</td>
  																	</tr>
  																	<!-- 脚本 -->
																			<script type="text/javascript">
																							$('#btnEdit0<?php echo $i?>').click(function(){
																									$('#myModalEdit0<?php echo $i?>').modal();
																								});
																							$('#modelSubEdit0<?php echo $i?>').click(function(){
																									$('#subEdit0<?php echo $i?>').click();
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
																	echo '<li><a href="admin_userDiscount.php?&page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
																}
																;
																?>
																</ul>

</html>

 <script type="text/javascript">
 
</script>
 
