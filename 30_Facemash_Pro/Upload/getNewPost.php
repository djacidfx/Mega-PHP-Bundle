<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/img_functions.php");
if(!empty($_GET["id"])){
	$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
	echo get_other_images($pdo, $id) ;
}
?>