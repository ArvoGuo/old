<?php

function qq_login($appid, $scope, $callback)
{
	$code = $_REQUEST["code"];
	 if(empty($code)){
    $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
    $login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" 
        . $appid . "&redirect_uri=" . urlencode($callback)
        . "&state=" . $_SESSION['state']
        . "&scope=".$scope;
    header("Location:$login_url");
	 }
}
function qq_callback()
{
    if($_REQUEST['state'] == $_SESSION['state']) //csrf
    {
        $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
            . "client_id=" . $_SESSION["appid"]. "&redirect_uri=" . urlencode($_SESSION["callback"])
            . "&client_secret=" . $_SESSION["appkey"]. "&code=" . $_REQUEST["code"];
        $response = file_get_contents($token_url);
        if (strpos($response, "callback") !== false)
        {
            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
            $msg = json_decode($response);
            if (isset($msg->error))
            {
                echo "<h3>error:</h3>" . $msg->error;
                echo "<h3>msg  :</h3>" . $msg->error_description;
                exit;
            }
        }
        $params = array();
        parse_str($response, $params);
        $_SESSION["access_token"] = $params["access_token"];
    }
    else 
    {
        echo("The state does not match. You may be a victim of CSRF.");
    }
}
function get_openid()
{
    $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" 
        . $_SESSION['access_token'];

    $str  = file_get_contents($graph_url);
    if (strpos($str, "callback") !== false)
    {
        $lpos = strpos($str, "(");
        $rpos = strrpos($str, ")");
        $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
    }
    $user = json_decode($str);
    if (isset($user->error))
    {
        echo "<h3>error:</h3>" . $user->error;
        echo "<h3>msg  :</h3>" . $user->error_description;
        exit;
    }
    $_SESSION["openid"] = $user->openid;
}



function get_user_info()
{
    $get_user_info = "https://graph.qq.com/user/get_user_info?"
        . "access_token=" . $_SESSION['access_token']
        . "&oauth_consumer_key=" . $_SESSION["appid"]
        . "&openid=" . $_SESSION["openid"]
        . "&format=json";

    $info = file_get_contents($get_user_info);
    $arr = json_decode($info, true);

    return $arr;
}

function add_blog()
{
	//发表QQ空间日志的接口地址, 不要更改!!
    $url  = "https://graph.qq.com/blog/add_one_blog";
    $data = "access_token=".$_SESSION["access_token"]
        ."&oauth_consumer_key=".$_SESSION["appid"]
        ."&openid=".$_SESSION["openid"]
        ."&format=".$_POST["format"]
        ."&title=".$_POST["title"]
        ."&content=".$_POST["content"];

    $ret = do_post($url, $data); 
    return $ret;
}
//qq_login($_SESSION["appid"], $_SESSION["scope"], $_SESSION["callback"]);
/////QQ登录成功后的回调地址,主要保存access token
//qq_callback();
////
//////获取用户标示id
//get_openid();
////
////
//////获取用户基本资料
//$arr = get_user_info();
//echo "<p>";
//echo "Gender:".$arr["gender"];
//echo "</p>";
//echo "<p>";
//echo "NickName:".$arr["nickname"];
//echo "</p>";
//echo "<p>";
//echo "<img src=\"".$arr['figureurl']."\">";
//echo "<p>";
//echo "<p>";
//echo "<img src=\"".$arr['figureurl_1']."\">";
//echo "<p>";
//echo "<p>";
//echo "<img src=\"".$arr['figureurl_2']."\">";
//echo "<p>";

?>