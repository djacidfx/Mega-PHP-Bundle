<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
if(!empty($_GET["id"]) && !empty($_GET['item_id'])){
    $itemId = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
	echo grab_all_comments_onload($pdo,$itemId) ;
}
?>