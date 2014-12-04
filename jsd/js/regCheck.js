$(document).ready(function() {

	$("#username").blur(function() {
		var checkusername = /^[a-zA-Z].{5,24}$/;
		$result = checkusername.test($(this).val());
		if (!$result) {
			$("#checkusername").text("需以字母为首,6-25字符");
			$(".btn").attr("disabled", "disabled");
		} else {
			$("#checkusername").text("");
			$(".btn").removeAttr("disabled");
		}
	});

	$("#password").blur(function() {
		var checkpassword = /^.{6,25}$/;
		$result = checkpassword.test($(this).val());
		if (!$result) {
			$("#checkpassword").text("密码长度必须在6到25位之间");
			$(".btn").attr("disabled", "disabled");
		} else {
			$("#checkpassword").text("");
			$(".btn").removeAttr("disabled");
		}
		if($(this).val()!=$("#passwordsecond").val()&&$("#passwordsecond").val()!=""){
			$("#checkpasswordsecond").text("两次密码输入不一致");
			$(".btn").attr("disabled","disabled");
		}
		else{
			$("#checkpasswordsecond").text("");
			$(".btn").removeAttr("disabled");
		}
		
	});
	
	$("#passwordsecond").blur(function(){
		if($(this).val()!=$("#password").val()){
			$("#checkpasswordsecond").text("两次密码输入不一致");
			$(".btn").attr("disabled","disabled");
		}
		else{
			$("#checkpasswordsecond").text("");
			$(".btn").removeAttr("disabled");
		}
	});
	$("#tel").blur(function(){
		var checktel=/^[0-9]{8,11}$/;
		$result=checktel.test($(this).val());

		if(!$result){
			$("#checktel").text("请输入正确的手机号码");
			$(".btn").attr("disabled","disabled");
			
		}else{
			$("#checktel").text("");
			$(".btn").removeAttr("disabled");
			
		}
		
	});
	$("#email").blur(function(){
		var checkemail=/^([\w\.\-]+)@([\w\-]+)\..*$/;
		$result=checkemail.test($(this).val());
		
		if(!$result){
			$("#checkemail"	).text("请输入正确的邮箱地址");
			$(".btn").attr("disabled","disabled");
			
		}else{
			$("#checkemail").text("");
			$(".btn").removeAttr("disabled");
		}
	});
	$(".btn").click(function(){
		if($("#username").val()==""){
			$("#checkusername").text("用户名不能为空");
			return false;
		}
		
		if($("#password").val()==""){
			$("#checkpassword").text("密码不能为空");
			return false;
		}
		
		if($("#passwordsecond").val()==""){
			$("#checkpasswordsecond").text("密码确认不能为空");
			return false;
		}
		if($("#tel").val()==""){
			$("#checktel").text("手机号码不能为空");
			return false;
		}
		if($("#email").val()==""){
			$("#checkemail").text("电子邮箱不能为空");
			return false;
		}
		
	});

});