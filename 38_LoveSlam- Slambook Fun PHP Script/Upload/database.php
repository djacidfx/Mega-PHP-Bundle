<?php 
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ;
$userNewIp = $_SERVER['REMOTE_ADDR'];
if(find_blocked_ip($pdo , $userNewIp) > 0){
    header("location: ".BASE_URL."notforyou");
}
?>