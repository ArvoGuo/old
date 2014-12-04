<?php 
if ($_POST['submit']=="reg"){
	$_data=array();
	$_data['username']=$_POST['username'];
	$_data['password']=$_POST['password'];
	$_data['passwordsecond']=$_POST['passwordsecond'];
	$_data['sex']=$_POST['sex'];
	$_data['tel']=$_POST['tel'];
	$_data['email']=$_POST['email'];
	$_data['nickName']=$_POST['nickName'];
	$_data['address']=$_POST['address'];
	date_default_timezone_set('PRC');
	$_data['createdate'] = date('Y-m-d H:i:s');
	$rule_username="/^[a-zA-Z].{5,24}$/";
	$rule_password="/^.{6,25}$/";
	$rule_tel="/^[0-9]{8,11}$/";
	$rule_email="/^([\w\.\-]+)@([\w\-]+)\..*$/";
	preg_match($rule_username,$_data['username'],$result_username);
	preg_match($rule_password,$_data['password'],$result_password);
	preg_match($rule_tel,$_data['tel'],$result_tel);
	preg_match($rule_email,$_data['email'],$result_email);
	
	if (!$result_username){
		_alertinfo_historyback("用户名填写错误");
	}
if (!$result_password){
		_alertinfo_historyback("密码填写错误");
	}
if ($_data['passwordsecond']!=$_data['password']){
			_alertinfo_historyback("密码填写不一致");
	
}
if (!$result_tel){
		_alertinfo_historyback("手机号码填写错误");
	}
if (!$result_email){
		_alertinfo_historyback("电子邮箱填写错误");
	}
$user = new user();
	$user->ifHasAccount($_data['username']);
	
if ($user->ifHasAccount($_data['username'])){
		_alertinfo_historyback("用户名已存在！");
	}
	

			$user->insert($_data['nickName'],$_data['sex'],$_data['tel'],$_data['email'],$_data['address'],$_data['username'],$_data['password']);
			
			
			
			_alertinfo_goto("恭喜您成功注册!","login.php");
	
	
	
	
}


?>



<div class="width902  center">
	<!-- 位置 -->
	<div>   
	<a href="index.php">首页</a>/
	<a href="reg.php"> 注册</a>
	
	</div>
			<!-- 上边标题 -->
			
			<!-- 中间 -->
			<div class=" autoLR">
					<!-- 注册表单 -->
					<form action="reg.php" method="post" class=" autoLR width-400">
								<ul>
												<li>
															<label><span class="reg_mark">*</span></label>用户　名
															<label><span class="reg_mark reg_error" id="checkusername"></span></label>
												</li>
												<li>
															<input type="text" name="username" id="username" class="regword"></input>
												</li>
												<li>
															<label><span class="reg_mark">*</span></label>密　　码
															<label><span class="reg_mark reg_error" id="checkpassword"></span></label>
												</li>
												<li>
															<input type="password" name="password" id="password" class="regword"></input>
												</li>
												<li>
															<label><span class="reg_mark">*</span></label>确认密码
															<label><span class="reg_mark reg_error" id="checkpasswordsecond"></span></label>
												</li>
												<li>
															<input type="password" name="passwordsecond" id="passwordsecond" class="regword"></input>
												</li>
												<li>
															<label><span class="reg_mark">*</span></label>昵　　称
															<label><span class="reg_mark reg_error" id=""></span></label>
												</li>
												<li>
															<input type="text" id="nickName" name = "nickName" class="regword"></input>
												</li>
												<li>
															<label><span class="reg_mark">*</span></label>性　　别
												</li>
												<li>
															<input type="radio" name="sex" value="男"  checked="checked">男　　　　
															</input><input type="radio" name="sex" value="女" >女</input>
												</li>
												<li>
															<label><span class="reg_mark">*</span></label>电　　话
															<label><span class="reg_mark reg_error" id="checktel"></span></label>
												</li>
												<li>
															<input type="text" name="tel" id="tel" class="regword"></input>
												</li>
												<li>
															<label><span class="reg_mark">*</span></label>电子邮箱
															<label><span class="reg_mark reg_error" id="checkemail"></span></label>
												</li>
												<li>
															<input type="text" name="email" id="email" class="regword"></input>
												</li>
												<li>
															地址
												</li>
												<li>
															<input type="text" id ="address" name ="address" class="regword"></input>
												</li>

</ul>
											<!-- 提交 -->
					   					 <div class="" style="margin-left:150px;padding-bottom:20px;">
												<button type="button " class="btn btn-primary " name="submit" value="reg">提交</button>
										</div>
					</form>
					
					
					
					
					<!-- 注册表单结束 -->
			</div>
			
		
		  		
			</div>

