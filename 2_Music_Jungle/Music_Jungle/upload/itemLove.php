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
	if($_POST['btn_action'] == 'changeLoveStatus')
	{
		if(!empty($_POST['id']) ) {
			$itemId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
			$itemLoved = get_item_loved_by($pdo,$itemId) + 1 ;
			$ins = $pdo->prepare("insert into item_loved (love_uid, love_item_id) values (?,?)") ;
			$ins->execute(array($_SESSION['user']['user_id'], $itemId));
			$upd = $pdo->prepare("update item_db set item_loved_by = '".$itemLoved."' where item_Id = '".$itemId."'");
			$upd->execute();
				
		}
		echo count_loved_items($pdo) ; 
	}
	if($_POST['btn_action'] == 'changeUnLoveStatus')
	{
		if(!empty($_POST['id']) ) {
			$itemId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
			$itemLoved = get_item_loved_by($pdo,$itemId) - 1 ;
			$ins = $pdo->prepare("DELETE FROM `item_loved` WHERE love_uid = ? and love_item_id = ?") ;
			$ins->execute(array($_SESSION['user']['user_id'], $itemId));
			$upd = $pdo->prepare("update item_db set item_loved_by = '".$itemLoved."' where item_Id = '".$itemId."'");
			$upd->execute();
				
		}
		echo count_loved_items($pdo) ; 
	}
	if($_POST['btn_action'] == 'removeLoveStatus')
	{
		if(!empty($_POST['id']) && !empty($_POST['status'])) {
			$itemId = filter_var($_POST['status'] , FILTER_SANITIZE_NUMBER_INT) ;
			$loveId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
			$itemLoved = get_item_loved_by($pdo,$itemId) - 1 ;
			$ins = $pdo->prepare("delete from item_loved where love_id = '".$loveId."'") ;
			$ins->execute();
			$upd = $pdo->prepare("update item_db set item_loved_by = '".$itemLoved."' where item_Id = '".$itemId."'");
			$upd->execute();
				
		}
		echo count_loved_items($pdo) ; 
	}
	
}
?>