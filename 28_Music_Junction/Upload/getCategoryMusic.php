<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");

if(!empty($_GET['ID'])){
	$catId = filter_var($_GET['subcatId'], FILTER_SANITIZE_NUMBER_INT) ;
	$itemId = filter_var($_GET['ID'], FILTER_SANITIZE_NUMBER_INT) ;
	echo fetch_categorymusic_load_foruser($pdo,$itemId,$catId) ;
}
?>
