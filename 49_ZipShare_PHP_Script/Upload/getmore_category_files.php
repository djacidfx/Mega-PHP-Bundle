<?php
ob_start();
session_start();
include("config/database.php") ;
include("functions.php") ;
include("language/lang.php") ;
include("mode/mode.php") ;
$userIp = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ;
if(find_blocked_ip($pdo , $userIp) > "0"){
    header("location: ".BASE_URL."notforyou");
}
if(!empty($_GET["id"]) && !empty($_GET['cid'])){
    $catId = filter_var($_GET["cid"], FILTER_SANITIZE_NUMBER_INT) ;
    $zipId = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT) ;
	echo show_category_loadmore($pdo,$catId,$zipId) ;
}
?>