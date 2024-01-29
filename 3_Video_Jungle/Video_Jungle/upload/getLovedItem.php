<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");
// Checking User is logged in or not
if(!isset($_SESSION['user']['user_id'])) {
	header("location: ".BASE_URL."login/");
	exit;
}
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'getLovedItem')
	{
			echo show_loved_items_notifications($pdo) ; 
		
	}
	
	
}
?>