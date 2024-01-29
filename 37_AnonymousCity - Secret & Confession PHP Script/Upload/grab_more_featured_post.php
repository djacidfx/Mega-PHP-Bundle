<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ;
if(!empty($_GET["id"]) ){
    $limit = featuredload_featuredpage($pdo) ;
	echo grab_featured_allpost_onload($pdo,$limit) ;
}
?>