<?php
ob_start();
session_start();
require_once('db/config.php');
if(!isset($_SESSION['admin'])) {
	header('location: '.ADMIN_URL.'/login.php');
	exit;
}
$err = 1 ;
if( !empty($_POST['Api']) && !empty($_POST['senderid']) ){
	$Api = filter_var($_POST['Api'], FILTER_SANITIZE_STRING) ;
	$senderid = filter_var($_POST['senderid'], FILTER_SANITIZE_STRING);
	$update_setting = $pdo->prepare("UPDATE ot_admin SET sms_apikey=? , sms_senderid = ? WHERE id='1'");
	$update_setting->execute(array($Api,$senderid));
	$err = 0 ;
	echo $err ;
} else {
	$err = 1 ;
	echo $err ;
}
?>