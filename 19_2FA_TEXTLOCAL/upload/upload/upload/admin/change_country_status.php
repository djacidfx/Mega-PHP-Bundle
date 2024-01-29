<?php
ob_start();
session_start();
include("db/config.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."/login.php"); 
	exit;
}
if($_POST['btn_action'] == 'changeCountryStatus')
	{
		$countryId = filter_var($_POST['countryId'], FILTER_SANITIZE_NUMBER_INT);
		$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
		if($countryId) { 
			$update = $pdo->prepare("UPDATE country SET active_country=?   WHERE id=?");
			$result_new = $update->execute(array($status,$countryId));
			if($result_new) {
				echo 'Country status changed .' ;		
			}
		}
	}
?>