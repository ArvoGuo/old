
<?php 
require '../include/include.inc.php';
require PATH_ROOT.'/mysql/mysql.php';
$good= new good();


if($_GET['do']=="edit"){
	$gid = $_POST['gid'];
	$gname = $_POST['gname'];
	$gprice = $_POST['gprice'];
	$gnum = $_POST['gnum'];
	$gstyle = $_POST['gstyle'];
	if($good->updateInfo($gid,$gname,$gprice,$gnum,$gstyle)){
		echo "";
	} ;
}
if($_GET['do']=="del"){
		$gid = $_POST['gid'];
		if(!$good->deleteOne($gid)){
			echo "失败";		
		};
};
$op=$_GET['op'];
	
		if($_POST['sub']=="sub"){
			$pic=  array();
			$gname=$_POST['gname'];
			$gprice=$_POST['gprice'];
			$gnum=$_POST['gnum'];
			$gstyle=$_POST['gstyle'];
			
			if(!is_numeric($gprice)||!is_numeric($gnum)){
				_alertinfo_historyback("价格和数量必须为数字");
			}
			
			
						for($i=0;$i<7;$i++){
						$name=date('YmdHis');//定义变量，保存图片名，以防图片的名字相同
						$name.=$i;
 						$name.=strrchr($_FILES["file".$i]["name"],".");//上传文件的名称
 							$tmp_name=$_FILES["file".$i]["tmp_name"];
 							if($_FILES["file"]["error"]>0){
  									_alertinfo_historyback("上传文件有误:".$_FILES["file"]["error"]);
							 }else{
 	 											if(file_exists("upload_file/$name")){
  														_alertinfo_historyback("文件已经存在");
  															}else{
  															 			if(move_uploaded_file($tmp_name,PATH_ROOT."/upload_file/$name")){
    																			//echo $name."上传成功";
    																			$pic[]=$name;
 													 					 }else{
   																					 echo "第".$i."张图片上传失败或未上传";
																				   }
												 					 }
 														}
								}
			$good->insert($gname,$gprice,$gnum,$gstyle,$pic[0],$pic[1],$pic[2],$pic[3],$pic[4],$pic[5],$pic[6]);
			_alertinfo_goto("添加成功");
				
		
								
								
	}//IF SUB

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
	$list = $good->getAllInfo();
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
								<!-- 添加商品 -->
								<div></div>
										<form action="admin_good.php?op=add" method="post"  enctype="multipart/form-data" style="margin:30px 100px;">
													<dl>
													<dd>服装名称：<input type="text" name="gname" class="input"></input></dd>
												
													<dd>服装价格：<input type="text" name="gprice" class="input"></input></dd>
													<dd>服装数量：<input type="text" name= "gnum" class="input"></input></dd>
													<dd>服装图片：<input type="file" name="file0" style="display:inline;"></dd>
														<dd>服装细节图片1：<input type="file" name="file1" style="display:inline;"></dd>
															<dd>服装细节图片2：<input type="file" name="file2" style="display:inline;"></dd>
																<dd>服装细节图片3：<input type="file" name="file3" style="display:inline;"></dd>
																	<dd>服装细节图片4：<input type="file" name="file4" style="display:inline;"></dd>
																		<dd>服装细节图片5：<input type="file" name="file5" style="display:inline;"></dd>
																			<dd>服装细节图片6：<input type="file" name="file6" style="display:inline;"></dd>
													<dd>产品属性：<input type="text" name="gstyle" class="input"></input></dd>
													<button type="button " class="btn btn-primary " style="margin-top:20px;margin-left:80px;" name="sub" value="sub">提交</button>													</dl>
										</form>




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
									<div> 管理商品</div>
											<div class="table-responsive">
		   											<!-- 表格 -->
  														<table class="table table-hover ">
  														<tbody>
  																	<tr>
  																	<th>排序</th>
  																	<th>服装编号</th>
  																	<th>服装名称</th>
  																	<th>服装图片</th>
  																	<th>服装价格</th>
  																	<th>产品其他属性</th>
  																	<th>服装上传时间</th>
  																	<th>服装库存</th>
  																	<th>操作</th>
  																	</tr>
  																	<?php echo $info?>
  																	<!-- data -->
  																	<?php for ($i=$_pagenum;$i<$_pagenumNext;$i++){?>
  																	<tr>
  																	<td><?php echo $i?></td>
  																	<td><?php echo $list[$i]['GID']?></td>
  																	<td><?php echo $list[$i]['GNAME']?></td>
  																	<td><img src="<?php echo "http://115.28.133.116/upload_file/".$list[$i]['GPIC0']?>" style="width:50px;height: 50px;"></td>
  																	<td><?php echo $list[$i]['GPRICE']?></td>
  																	<td><?php echo $list[$i]['GSTYLE']?></td>
  																	<td><?php echo $list[$i]['GUPDATE']?></td>
  																	<td><?php echo $list[$i]['GNUM']?></td>
  																		<!-- 提交表单 -->
  																	<td>
  																				 <button type="button" id="modelSubDel2<?php echo $i?>"  class="btn btn-danger" >
																				           删除
																				 </button>
																				<button class="btn btn-primary" id="btnEdit2<?php echo $i?>" data-toggle="modal" data-target="#myModalEdit2<?php echo $i?>">
  																							编辑
																				</button>
																				<!-- del -->
																				 		<form method="post" action="admin_good.php?do=del&op=<?php echo $op.'&page='.$_page?>" style="display:none;">
																				 			 <input type="hidden" name="gid" value="<?php echo $list[$i]['GID']?>" />
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
																																<form method = "post" action = "admin_good.php?do=edit&op=<?php echo $op.'&page='.$_page?>">
																																	<dl>
																																			<input type="hidden" name="gid" value="<?php echo $list[$i]['GID']?>"/>
																																			<dd>商品名称：<input type="text" class="input" name = "gname" value="<?php echo $list[$i]['GNAME']?>"/></dd>
																																			<dd>商品价格：<input type="text" class="input" name = "gprice" value="<?php echo $list[$i]['GPRICE']?>"/></dd>
																																			<dd>商品数量：<input type="text" class="input" name = "gnum" value="<?php echo $list[$i]['GNUM']?>"/></dd>
																																			<dd>商品属性：<input type="text" class="input" name = "gstyle" value="<?php echo $list[$i]['GSTYLE']?>"/></dd>
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
																	echo '<li><a href="admin_good.php?op='.$op.'&page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
																}
																;
																?>
																</ul>
				
			



<?php }?>



</html>

 
