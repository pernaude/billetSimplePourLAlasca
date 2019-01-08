<?php
if(isset($_SERVER['HTTP_REFERER'])){
session_start();
if(isset($_SESSION['USER_CONNECT'])){ unset($_SESSION['USER_CONNECT']); }
if(isset($_SESSION['USER_ID'])){ unset($_SESSION['USER_ID']); }
if(isset($_SESSION['USER_LAST_CONNECTED'])){ unset($_SESSION['USER_LAST_CONNECTED']); }
if(isset($_SESSION['ADMIN_CONNECT'])){ unset($_SESSION['ADMIN_CONNECT']); }
if(isset($_SESSION['ADMIN_ID'])){ unset($_SESSION['ADMIN_ID']); }
if(isset($_SESSION['ADMIN_LAST_CONNECTED'])){ unset($_SESSION['ADMIN_LAST_CONNECTED']); }
header("location:".$_SERVER['HTTP_REFERER']);exit;
}
?>