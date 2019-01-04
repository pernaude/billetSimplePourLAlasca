<?php
if(isset($_SERVER['HTTP_REFERER'])){
session_start();
if(isset($_SESSION['USER_CONNECT'])){ unset($_SESSION['USER_CONNECT']); }
if(isset($_SESSION['USERID'])){ unset($_SESSION['USERID']); }
if(isset($_SESSION['USER_LAST_CONNECTED'])){ unset($_SESSION['USER_LAST_CONNECTED']); }
header("location:".$_SERVER['HTTP_REFERER']);exit;
}
?>