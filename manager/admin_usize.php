
<?php 
require '../include/include.inc.php';
require PATH_ROOT.'/mysql/mysql.php';
$usize=new usize();

//当点击编辑操作 分类
if($_GET['do']=="edit"){
	$usid = $_POST['usid'];
	$infoheight = $_POST['infoheight'];
	$infochest = $_POST['infochest'];
	$infowaist = $_POST['infowaist'];
	$infoshoulder = $_POST['infoshoulder'];
	$infoneck = $_POST['infoneck'];
	$infoarm = $_POST['infoarm'];
	
	if($usize->updateOne($usid,$infoheight,$infochest,$infowaist,$infoshoulder,$infoneck,$infoarm)){
		echo "";
	} ;
}
if($_GET['do']=="del"){
		$usid = $_POST['usid'];
		if(!$usize->deleteOne($usid)){
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
	$list = $usize->getAllInfo();
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
  																	<th>尺寸ID</th>
  																	<th>身高</th>
  																	<th>胸围</th>
  																	<th>腰围</th>
  																	<th>肩宽</th>
  																	<th>领围</th>
  																	<th>臂长</th>
  																	</tr>
  																	<!-- data -->
  																	<?php for ($i=$_pagenum;$i<$_pagenumNext;$i++){?>
  																	<tr>
  																	<td><?php echo $i?></td>
  																	<td><?php echo $list[$i]['UID']?></td>
  																	<td><?php echo $list[$i]['UNAME']?></td>
  																	<td><?php echo $list[$i]['USID']?></td>
  																	<td><?php echo $list[$i]['INFOHIGHT']?></td>
  																	<td><?php echo $list[$i]['INFOCHEST']?></td>
  																		<td><?php echo $list[$i]['INFOWAIST']?></td>
  																	<td><?php echo $list[$i]['INFOSHOULDER']?></td>
  																	<td><?php echo $list[$i]['INFONECK']?></td>
  																	<td><?php echo $list[$i]['INFOARM']?></td>
  																		<!-- 提交表单 -->
  																	<td>
  																				 <button type="button" id="modelSubDel2<?php echo $i?>"  class="btn btn-danger" >
																				           删除
																				 </button>
																				<button class="btn btn-primary" id="btnEdit2<?php echo $i?>" data-toggle="modal" data-target="#myModalEdit2<?php echo $i?>">
  																							编辑
																				</button>
																				<!-- del -->
																				 		<form method="post" action="admin_usize.php?do=del<?php '&page='.$_page?>" style="display:none;">
																				 			 <input type="hidden" name="usid" value="<?php echo $list[$i]['USID']?>" />
																				   			 <input type="submit" id="subDel2<?php echo $i?>" style="display:none;" onclick="JavaScript:return confirm('确定删除吗？')" />
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
																																<form method = "post" action = "admin_usize.php?do=edit<?php '&page='.$_page?>">
																																	<dl>
																																			<input type="hidden" name="usid" value="<?php echo $list[$i]['USID']?>"/>
																																			<dd>姓　　名：<input type="text" class="input" name = "uname"  disabled="disabled" value="<?php echo $list[$i]['UNAME']?>"/></dd>
																																			<dd>身　　高：<input type="text" class="input" name = "infoheight" value="<?php echo $list[$i]['INFOHIGHT']?>"/></dd>
																																			<dd>胸　　围：<input type="text" class="input" name = "infochest" value="<?php echo $list[$i]['INFOCHEST']?>"/></dd>
																																			<dd>腰　　围：<input type="text" class="input" name = "infowaist" value="<?php echo $list[$i]['INFOWAIST']?>"/></dd>
																																			<dd>肩　　宽：<input type="text" class="input" name = "infoshoulder" value="<?php echo $list[$i]['INFOSHOULDER']?>"/></dd>
																																			<dd>领　　围：<input type="text" class="input" name = "infoneck" value="<?php echo $list[$i]['INFONECK']?>"/></dd>
																																			<dd>臂　　长：<input type="text" class="input" name = "infoarm" value="<?php echo $list[$i]['INFOARM']?>"/></dd>
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
																							</script>
		  																	
  																	
  																	<?php };?>
  														
  														
  														</tbody>
  														</table>
  														
  											</div>




														<!-- 翻页 -->
  														<ul class="pagination" >
																<?php
																for($i = 0; $i < $_pageabsolute; $i ++) {
																	echo '<li><a href="admin_usize.php?type='.$type.'&page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
																}
																;
																?>
																</ul>

</html>

 <script type="text/javascript">
 
</script>
 
