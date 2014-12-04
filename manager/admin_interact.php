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
<body>
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
  												
			</div>
</body>
</html>
 <script type="text/javascript" src="../js/adminInteractAjax.js"></script>
  <script type="text/javascript">

    $('#loadfile').change(function() {
    $('#photoCover').val($(this).val());
    });
	$('#interactTab2').hide();
    $('#thisMonth').click(function(){
    	$('#interactTab2').hide();
    	$('#interactTab').show();
        });
    $('#oldMonth').click(function(){
    	$('#interactTab').hide();
    	$('#interactTab2').show();
    });
    $('.btnM').click(function(){
    	if($('div.switchMonth .btnM').hasClass('btn-primary')){
    		$('div.switchMonth .btnM').addClass('btn-default').removeClass('btn-primary');
		
		}
	$(this).removeClass('btn-default').addClass('btn-primary');
        });

</script>
