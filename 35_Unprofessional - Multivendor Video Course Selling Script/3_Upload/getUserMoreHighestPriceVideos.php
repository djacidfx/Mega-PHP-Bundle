<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
if(!empty($_GET["id"]) && !empty($_GET['username'])){
    $username = filter_var($_GET['username'], FILTER_SANITIZE_STRING) ;
	echo grab_uservideos_items_highprice_onload($pdo,$username) ;
}
?>