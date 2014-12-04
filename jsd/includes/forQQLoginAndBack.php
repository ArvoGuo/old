<?php
require '../forLogin/comm/config.php';
require 'forQQLogin.func.php';
qq_login($_SESSION["appid"], $_SESSION["scope"], $_SESSION["callback"]);
?>