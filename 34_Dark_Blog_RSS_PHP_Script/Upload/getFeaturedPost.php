<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/post_functions.php");
if(!empty($_GET["id"])){
	echo get_featured_post_onload($pdo) ;
}
?>