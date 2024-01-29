<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/function_xss.php");
if(!empty($_GET["ID"]) && !empty($_GET['searchWord'])){
	$itemId = filter_var($_GET["ID"], FILTER_SANITIZE_NUMBER_INT) ;
	$searchWord = filter_var($_GET["searchWord"], FILTER_SANITIZE_STRING) ;
	echo fetch_searchallproduct_foruser_onload($pdo,trim($searchWord),$itemId) ;
}
?>