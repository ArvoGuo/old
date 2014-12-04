
<?php 

if ($_POST ['login'] == "login") {
	$laccount = $_POST ['account'];
	$lpassword = $_POST ['password'];
	
				$user= new user();
						if($user->fetchLogin($laccount,$lpassword)){
									$_SESSION['customer']=$laccount;
									if($_SESSION['flag']=="loginout"){
										$_SESSION['flag']=="";
										echo "<script>location.href='goodDetail.php?gid=".$_SESSION['lastgid']."';</script>";
									exit();
									}
								echo "<script>location.href='index.php';</script>";
									exit();
							};
				_alertinfo_historyback("用户名或密码错误");
}
;
?>

<div class="width902  center">
	<!-- 位置 -->

<div>   
	<a href="index.php">首页</a>/
	<a href="login.php"> 登陆</a>
	
	</div>
			<!-- 上边标题 -->
			<div class="width902 height-40  "></div>
			<!-- 中间 -->
			<div class=" autoLR">
					<!-- 登陆表单 -->
					<form action="login.php" method="post" class=" autoLR width-400">
					<dl >
										<dd>用户　名：<input type="text" name="account" class="input"/></dd>
										<dd>密　　码：<input type="password"  name = "password" class="input"/></dd>
										
								</dl>
											<!-- 提交 -->
					   					 <div class="" style="padding-bottom:20px;margin-left:80px;">
												<button type="submit" class="btn btn-primary " name = "login" value="login">提交</button>
										</div>
					</form>
					<!-- 登陆表单 -->
			</div>
			
		
		  		
			</div>

