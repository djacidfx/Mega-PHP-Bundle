<?php
ob_start();
session_start();
include("config/database.php") ;
include("functions.php") ;
if (!empty($_GET['mode'])) {
    $getMode = trim(filter_var(htmlentities($_GET['mode']),FILTER_SANITIZE_STRING));
    $_SESSION['mode'] = $getMode;
}
if (!empty($_GET['lang'])) {
    $getLang = trim(filter_var(htmlentities($_GET['lang']),FILTER_SANITIZE_STRING));
    $_SESSION['lang'] = $getLang;
}
include("mode/mode.php") ;
include("language/lang.php") ;
$userIp = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ;
if(find_blocked_ip($pdo , $userIp) > "0"){
    header("location: ".BASE_URL."notforyou");
}
?>