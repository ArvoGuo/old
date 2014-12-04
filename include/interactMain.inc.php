<?php 
if($_SESSION['customer']==""){
		echo "<script>alert('请先登录！');location.href='login.php';</script>";
   		exit();
}
$userlogin = new userLogin();
$customer=$_SESSION['customer'];
$userone = $userlogin->getOneUid($customer);
$uid = $userone['UID'];

if(isset($_POST['sub'])){
	if($_POST['sub']=="sub"){
						$gid=$_POST['gid'];
						$name=date('YmdHis');//定义变量，保存图片名，以防图片的名字相同
 						$name.=strrchr($_FILES["file"]["name"],".");//上传文件的名称
 							$tmp_name=$_FILES["file"]["tmp_name"];
 							if($_FILES["file"]["error"]>0){
  									_alertinfo_historyback("上传文件有误:".$_FILES["file"]["error"]);
							 }else{
 	 											if(file_exists(PATH_ROOT."/upload_file/$name")){
  														_alertinfo_historyback("文件已经存在");
  															}else{
  															 			if(move_uploaded_file($tmp_name,PATH_ROOT."/upload_file/$name")){
    																			$int= new interact();
    																			$int->insert($uid,$customer,$gid,$name);
    																			echo "<script>location.href='interact.php';</script>";
 													 					 }else{
   																					 echo "图片上传失败";
																				   }
												 					 }
 														}
	}
}
?>
<input type="hidden" id="uid" value="<?php echo $uid;?>"/>
<div class="width902  center">
	<!-- 位置 -->

<div>   
	<a href="index.php">首页</a>/
	<a href="interact.php"> 互动吧</a>
	
	</div>
			<!-- 上边标题 -->
			<div class="width902 height-40  switchMonth">
				<button type="button " class="btn btn-primary btnM" id="thisMonth">当月点评</button>
					<button type="button " class="btn btn-default btnM" id="oldMonth" >失效点评</button>
			</div>
			<!-- 中间 -->
			<div class=" autoLR">
								<div class="table-responsive" id="interactTab">
		   											<!-- 表格 -->
  														<table class="table table-hover ">
  														<tr><td>当月点评</td><td>失效点评</td></tr>
  																<!-- 当月点评tbody -->
  																<tbody id="thisMonth">
  																		<tr><td>用户名</td><td>服装编号</td><td>定制服图片</td><td>上传时间</td><td>点赞数</td></tr>
  																		<tr>
  																		</tr>
  																</tbody>
  																<!--失效点评tbody -->
  																<tbody id="disable" class="displaynone">
  																</tbody>
  														</table>
  																<!-- 上传 -->
  								</div>
  								<div class="table-responsive" id="interactTab2">
  								</div>
  															<div class="" style="margin-left:350px;paddind-bottom:20px;">
																		<button type="button " class="btn btn-primary " data-toggle="modal" data-target="#myModal">我要上传</button>
																</div>
			</div>
			</div>
			<!-- 上传model -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">互动上传</h4>
      </div>
      <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
            		<dl>
            			<dd>服装编号：<input type="text" name="gid" class="input"></input></dd>
            			<dd>上传图片：<input id="photoCover" class="input" type="text"><input type="file" id="loadfile" name="file" style="display:inline;"></input>	</dd>
            			<input type="submit" id="subbtn" style="display:none;" name="sub" value="sub"></input>
            		</dl>
            
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary sub">上传</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 

