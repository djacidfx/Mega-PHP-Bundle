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
if(!empty($_POST['search_keyword'])){
    $search = filter_var($_POST['search_keyword'], FILTER_SANITIZE_STRING) ;  
    $url = BASE_URL."search?term=".$search ;
    header("location: ".$url."") ;
} else {
    header("location: ".BASE_URL."") ;
}
?>