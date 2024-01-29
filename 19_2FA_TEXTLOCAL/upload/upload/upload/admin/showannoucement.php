<?php
ob_start();
session_start();
include("db/config.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."/login.php");
	exit;
}
$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ; 
$upd = $pdo->prepare("update ot_admin set show_announcement = ? where id = '1'");
$upd->execute(array($id)) ;
if($upd) {
 header("location:".ADMIN_URL."/addAnnouncement.php") ;
}
?>