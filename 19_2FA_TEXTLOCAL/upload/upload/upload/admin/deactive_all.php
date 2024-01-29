<?php
ob_start();
session_start();
include("db/config.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."/login.php"); 
	exit;
}
$a = filter_var("0", FILTER_SANITIZE_NUMBER_INT); 
$update = $pdo->prepare("UPDATE country SET active_country=?   WHERE 1");
$update->execute(array($a));
header("location:".ADMIN_URL."/selected_country.php");
?>