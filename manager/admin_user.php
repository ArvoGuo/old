
<?php 
require '../include/include.inc.php';
require PATH_ROOT.'/mysql/mysql.php';
$user=new user();

//当点击编辑操作 分类

if($_GET['do']=="edit"){
	$uid = $_POST['uid'];
	$uname = $_POST['uname'];
	$usex = $_POST['usex'];
	$utel = $_POST['utel'];
	$uemail = $_POST['uemail'];
	$uaddress = $_POST['uaddress'];
	if($user->updateInfo($uid,$uname,$usex,$utel,$uemail,$uaddress)){
		echo "";
	} ;
}
if($_GET['do']=="del"){
		$uid = $_POST['uid'];
		if(!$user->deleteOne($uid)){
			echo "失败";		
		};
};
if($_GET['do']=="up"){
		$uid = $_POST['uid'];
		if(!$user->updateOne($uid)){
			echo "失败";		
		};
};
if($_GET['do']=="up0"){
		$uid = $_POST['uid'];
		if(!$user->updateZero($uid)){
			echo "失败";		
		};
};



//正常载入
$type=$_GET['type'];

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
	$list = $user->getAllInfo($type);
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
//潜在
if($type=="2"){?>
								<!-- 潜在客户 -->
									<div> 潜在客户</div>
											<div class="table-responsive">
		   											<!-- 表格 -->
  														<table class="table table-hover ">
  														<thead><tr>潜在用户基本信息</tr></thead>
  														<tbody>
  																	<tr>
  																	<th>排序</th>
  																	<th>用户编号</th>
  																	<th>姓名</th>
  																	<th>性别</th>
  																	<th>电话号码</th>
  																	<th>E-mail</th>
  																	<th>地址</th>
  																	<th>操作</th>
  																	</tr>
  																	<?php echo $info?>
  																	<!-- data -->
  																	<?php for ($i=$_pagenum;$i<$_pagenumNext;$i++){?>
  																	<tr>
  																	<td><?php echo $i?></td>
  																	<td><?php echo $list[$i]['UID']?></td>
  																	<td><?php echo $list[$i]['UNAME']?></td>
  																	<td><?php echo $list[$i]['USEX']?></td>
  																	<td><?php echo $list[$i]['UTEL']?></td>
  																	<td><?php echo $list[$i]['UEMAIL']?></td>
  																	<td><?php echo $list[$i]['UADDRESS']?></td>
  																		<!-- 提交表单 -->
  																	<td>
  																				 <button type="button" id="modelSubDel2<?php echo $i?>"  class="btn btn-danger" >
																				           删除
																				 </button>
																				 <button type="button" id="modelSubUp2<?php echo $i?>"  class="btn btn-success" >
																				          升级
																				 </button>
																				<button class="btn btn-primary" id="btnEdit2<?php echo $i?>" data-toggle="modal" data-target="#myModalEdit2<?php echo $i?>">
  																							编辑
																				</button>
																				<!-- del -->
																				 		<form method="post" action="admin_user.php?do=del&type=<?php echo $type.'&page='.$_page?>" style="display:none;">
																				 			 <input type="hidden" name="uid" value="<?php echo $list[$i]['UID']?>" />
																				   			 <input type="submit" id="subDel2<?php echo $i?>" style="display:none;" onclick="JavaScript:return confirm('确定删除吗？')" />
																						</form>
																				<!-- up -->
																						<form method="post" action="admin_user.php?do=up0&type=<?php echo $type.'&page='.$_page?>" style="display:none;">
																				 			 <input type="hidden" name="uid" value="<?php echo $list[$i]['UID']?>" />
																				   			 <input type="submit" id="subUp2<?php echo $i?>" style="display:none;" onclick="JavaScript:return confirm('确定升级该用户吗？')" />
																						</form>		
																						
																				<!-- Modal -->
																				<div class="modal fade" id="myModalEdit2<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  																						<div class="modal-dialog">
    																						<div class="modal-content">
      																							<div class="modal-header">
       																								 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       																									 <h4 class="modal-title" id="myModalLabel">编辑Vip用户基本信息</h4>
     																										 </div>
    																										 		<div class="modal-body">
																																<form method = "post" action = "admin_user.php?do=edit&type=<?php echo $type.'&page='.$_page?>">
																																	<dl>
																																			<input type="hidden" name="uid" value="<?php echo $list[$i]['UID']?>"/>
																																			<dd>姓　　名：<input type="text" class="input" name = "uname" value="<?php echo $list[$i]['UNAME']?>"/></dd>
																																			<dd>性　　别：<input type="text" class="input" name = "usex" value="<?php echo $list[$i]['USEX']?>"/></dd>
																																			<dd>电话号码：<input type="text" class="input" name = "utel" value="<?php echo $list[$i]['UTEL']?>"/></dd>
																																			<dd>邮　　箱：<input type="text" class="input" name = "uemail" value="<?php echo $list[$i]['UEMAIL']?>"/></dd>
																																			<dd>地　　址：<input type="text" class="input" name = "uaddress" value="<?php echo $list[$i]['UADDRESS']?>"/></dd>
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
																									$('#myModalEdit2<?php echo $i?>').modal();
																								});
																							$('#modelSubEdit2<?php echo $i?>').click(function(){
																									$('#subEdit2<?php echo $i?>').click();
																								});
																							$('#modelSubDel2<?php echo $i?>').click(function(){
																									$('#subDel2<?php echo $i?>').click();
																								});
																							$('#modelSubUp2<?php echo $i?>').click(function(){
																								$('#subUp2<?php echo $i?>').click();
																							});
																							</script>
		  																	
  																	
  																	<?php };?>
  														
  														
  														</tbody>
  														</table>
  														
  											</div>




<?php }?>

<?php 
//普通
if($type=="0"){
	?>
									<!-- 普通客户 -->
									<div> 普通客户</div>
											<div class="table-responsive">
		   											<!-- 表格 -->
  														<table class="table table-hover ">
  														<thead><tr>普通用户基本信息</tr></thead>
  														<tbody>
  																	<tr>
  																	<th>排序</th>
  																	<th>用户编号</th>
  																	<th>姓名</th>
  																	<th>性别</th>
  																	<th>电话号码</th>
  																	<th>E-mail</th>
  																	<th>地址</th>
  																	<th>操作</th>
  																	</tr>
  																	<?php echo $info?>
  																	<!-- data -->
  																	<?php for ($i=$_pagenum;$i<$_pagenumNext;$i++){?>
  																	<tr>
  																	<td><?php echo $i?></td>
  																	<td><?php echo $list[$i]['UID']?></td>
  																	<td><?php echo $list[$i]['UNAME']?></td>
  																	<td><?php echo $list[$i]['USEX']?></td>
  																	<td><?php echo $list[$i]['UTEL']?></td>
  																	<td><?php echo $list[$i]['UEMAIL']?></td>
  																	<td><?php echo $list[$i]['UADDRESS']?></td>
  																	<!-- 提交表单 -->
  																	<td>
  																				 <button type="button" id="modelSubDel0<?php echo $i?>"  class="btn btn-danger" >
																				           删除
																				 </button>
																				 <button type="button" id="modelSubUp0<?php echo $i?>"  class="btn btn-success" >
																				          升级
																				 </button>
																				<button class="btn btn-primary" id="btnEdit0<?php echo $i?>" data-toggle="modal" data-target="#myModalEdit0<?php echo $i?>">
  																							编辑
																				</button>
																				<!-- del -->
																				 		<form method="post" action="admin_user.php?do=del&type=<?php echo $type.'&page='.$_page?>" style="display:none;">
																				 			 <input type="hidden" name="uid" value="<?php echo $list[$i]['UID']?>" />
																				   			 <input type="submit" id="subDel0<?php echo $i?>" style="display:none;" onclick="JavaScript:return confirm('确定删除吗？')" />
																						</form>
																				<!-- up -->
																						<form method="post" action="admin_user.php?do=up&type=<?php echo $type.'&page='.$_page?>" style="display:none;">
																				 			 <input type="hidden" name="uid" value="<?php echo $list[$i]['UID']?>" />
																				   			 <input type="submit" id="subUp0<?php echo $i?>" style="display:none;" onclick="JavaScript:return confirm('确定升级该用户吗？')" />
																						</form>		
																						
																				<!-- Modal -->
																				<div class="modal fade" id="myModalEdit0<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  																						<div class="modal-dialog">
    																						<div class="modal-content">
      																							<div class="modal-header">
       																								 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       																									 <h4 class="modal-title" id="myModalLabel">编辑Vip用户基本信息</h4>
     																										 </div>
    																										 		<div class="modal-body">
																																<form method = "post" action = "admin_user.php?do=edit&type=<?php echo $type.'&page='.$_page?>">
																																	<dl>
																																			<input type="hidden" name="uid" value="<?php echo $list[$i]['UID']?>"/>
																																			<dd>姓　　名：<input type="text" class="input" name = "uname" value="<?php echo $list[$i]['UNAME']?>"/></dd>
																																			<dd>性　　别：<input type="text" class="input" name = "usex" value="<?php echo $list[$i]['USEX']?>"/></dd>
																																			<dd>电话号码：<input type="text" class="input" name = "utel" value="<?php echo $list[$i]['UTEL']?>"/></dd>
																																			<dd>邮　　箱：<input type="text" class="input" name = "uemail" value="<?php echo $list[$i]['UEMAIL']?>"/></dd>
																																			<dd>地　　址：<input type="text" class="input" name = "uaddress" value="<?php echo $list[$i]['UADDRESS']?>"/></dd>
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
																							$('#modelSubDel0<?php echo $i?>').click(function(){
																									$('#subDel0<?php echo $i?>').click();
																								});
																							$('#modelSubUp0<?php echo $i?>').click(function(){
																								$('#subUp0<?php echo $i?>').click();
																							});
																							</script>
		  																	
  																	
  																	<?php };?>
  														
  														
  														</tbody>
  														</table>
  														
  											</div>


<?php }?>
<?php 
//vip
if($type=="1"){?>
									<!-- vip客户 -->
									<div> VIP客户</div>
											<div class="table-responsive">
		   											<!-- 表格 -->
  														<table class="table table-hover ">
  														<thead><tr>VIP用户基本信息</tr></thead>
  														<tbody>
  																	<tr>
  																	<th>排序</th>
  																	<th>用户编号</th>
  																	<th>姓名</th>
  																	<th>性别</th>
  																	<th>电话号码</th>
  																	<th>E-mail</th>
  																	<th>地址</th>
  																	<th>操作</th>
  																	</tr>
  																	<?php echo $info?>
  																	<!-- data -->
  																	<?php for ($i=$_pagenum;$i<$_pagenumNext;$i++){?>
  																	<tr>
  																	<td><?php echo $i?></td>
  																	<td><?php echo $list[$i]['UID']?></td>
  																	<td><?php echo $list[$i]['UNAME']?></td>
  																	<td><?php echo $list[$i]['USEX']?></td>
  																	<td><?php echo $list[$i]['UTEL']?></td>
  																	<td><?php echo $list[$i]['UEMAIL']?></td>
  																	<td><?php echo $list[$i]['UADDRESS']?></td>
  																	
  																	<!-- 提交表单 -->
  																	<td>
																				<button class="btn btn-primary" id="btnEdit1<?php echo $i?>" data-toggle="modal" data-target="#myModalEdit1<?php echo $i?>">
  																							编辑
																				</button>
																				 <button type="button" id="modelSubDel1<?php echo $i?>"  class="btn btn-danger" >
																				           删除
																				 </button>
																				 		<form method="post" action="admin_user.php?do=del&type=<?php echo $type.'&page='.$_page?>" style="display:none;">
																				 			 <input type="hidden" name="uid" value="<?php echo $list[$i]['UID']?>" />
																				   			 <input type="submit" id="subDel1<?php echo $i?>" style="display:none;" onclick="JavaScript:return confirm('确定删除吗？')" />
																						</form>
																				<!-- Modal -->
																				<div class="modal fade" id="myModalEdit1<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  																						<div class="modal-dialog">
    																						<div class="modal-content">
      																							<div class="modal-header">
       																								 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       																									 <h4 class="modal-title" id="myModalLabel">编辑Vip用户基本信息</h4>
     																										 </div>
    																										 		<div class="modal-body">
																																<form method = "post" action = "admin_user.php?do=edit&type=<?php echo $type.'&page='.$_page?>">
																																	<dl>
																																			<input type="hidden" name="uid" value="<?php echo $list[$i]['UID']?>"/>
																																			<dd>姓　　名：<input type="text" class="input" name = "uname" value="<?php echo $list[$i]['UNAME']?>"/></dd>
																																			<dd>性　　别：<input type="text" class="input" name = "usex" value="<?php echo $list[$i]['USEX']?>"/></dd>
																																			<dd>电话号码：<input type="text" class="input" name = "utel" value="<?php echo $list[$i]['UTEL']?>"/></dd>
																																			<dd>邮　　箱：<input type="text" class="input" name = "uemail" value="<?php echo $list[$i]['UEMAIL']?>"/></dd>
																																			<dd>地　　址：<input type="text" class="input" name = "uaddress" value="<?php echo $list[$i]['UADDRESS']?>"/></dd>
																																			<dd><input  type="submit" id="subEdit1<?php echo $i?>" style="display:none;"/></dd>
																																	</dl>	
																																	</form>
     																												 </div>
     																						 <div class="modal-footer">
       																						  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      																						  <button type="button" class="btn btn-primary" id="modelSubEdit1<?php echo $i?>">提交</button>
      																			</div>
       																    </div><!-- /.modal-content -->
       														    </div><!-- /.modal-dialog -->
      											     </div><!-- /.modal -->
																	</td>
  																	</tr>
  																	<!-- 脚本 -->
																			<script type="text/javascript">
																							$('#btnEdit1<?php echo $i?>').click(function(){
																									$('#myModalEdit1<?php echo $i?>').modal();
																								});
																							$('#modelSubEdit1<?php echo $i?>').click(function(){
																									$('#subEdit1<?php echo $i?>').click();
																								});
																							$('#modelSubDel1<?php echo $i?>').click(function(){
																									$('#subDel1<?php echo $i?>').click();
																								});
																							</script>
		  																	
  																	
  																	<?php };?>
  														
  														
  														</tbody>
  														</table>
  														
  											</div>



<?php }?>

														<!-- 翻页 -->
  														<ul class="pagination" >
																<?php
																for($i = 0; $i < $_pageabsolute; $i ++) {
																	echo '<li><a href="admin_user.php?type='.$type.'&page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
																}
																;
																?>
																</ul>

</html>

 <script type="text/javascript">
 
</script>
 
