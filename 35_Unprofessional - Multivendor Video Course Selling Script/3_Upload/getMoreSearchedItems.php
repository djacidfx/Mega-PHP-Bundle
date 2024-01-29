<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
if(!empty($_GET["ID"]) && !empty($_GET['searchWord'])){
    $search = filter_var($_GET['searchWord'], FILTER_SANITIZE_STRING) ;
    $itemId = filter_var($_GET['ID'], FILTER_SANITIZE_NUMBER_INT) ;
    
	echo fetch_searchallproduct_foruser_onload($pdo,$search,$itemId) ;
}
?>