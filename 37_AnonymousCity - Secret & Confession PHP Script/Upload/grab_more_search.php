<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ;
if(!empty($_GET["id"]) && !empty($_GET['PID'])){
    $postId = filter_var($_GET["PID"], FILTER_SANITIZE_NUMBER_INT) ;
    $search = filter_var($_GET["id"], FILTER_SANITIZE_STRING) ;
	echo grab_search_onload($pdo,$search,$postId) ;
}
?>