<?php
ob_start();
session_start();
include("db/config.php");
include("db/img_functions.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
if(isset($_POST['btn-action']))
{
	if($_POST['btn-action'] == 'save_step_1')
	{
		if(!empty($_POST['pic_name']) ){
			$picName = filter_var($_POST['pic_name'], FILTER_SANITIZE_STRING) ;
			$itemDate = date("Y-m-d") ;
				$ins = $pdo->prepare("insert into ot_admin_pics (pic_caption,pic_date) values ('".$picName."','".$itemDate."')") ;
				$ins->execute();
				$statement = $pdo->query("SELECT LAST_INSERT_ID()");
				$item_id = $statement->fetchColumn();
				$output = array( 
							'error' => '0',
							'item_id' => $item_id
							) ;
				echo json_encode($output);
				$targetDir = "../admin_images/";   
				if( is_dir($targetDir) === false )
				{
					mkdir($targetDir);
				}
			 
		} else {
			$error = 2 ;
			echo $error ;
		}
	
	}
	if($_POST['btn-action'] == 'edit_step_1')
	{
		if( !empty($_POST['item_id']) && !empty($_POST['pic_name']) ){
			$item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
			$picName = filter_var($_POST['pic_name'], FILTER_SANITIZE_STRING) ;
			$itemDate = date("Y-m-d") ;
			$upd = $pdo->prepare("update ot_admin_pics set pic_caption = '".$picName."' , pic_date = '".$itemDate."' where pic_id='".$item_id."'") ;
				$upd->execute();
				$output = array( 
							'error' => '0',
							'item_id' => $item_id
							) ;
				echo json_encode($output);
				$targetDir = "../admin_images/";   
				if( is_dir($targetDir) === false )
				{
					mkdir($targetDir);
				}
		} else {
			$error = 2 ;
			echo $error ;
		}
	}
}
if(isset($_POST['btn-action-3']))
{
	if($_POST['btn-action-3'] == 'save_step_3')
	{
		if(!empty($_POST['item_id'])){
			$item_id= filter_var($_POST['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
			$upd = $pdo->prepare("update ot_admin_pics set pic_status='1' where pic_id = '".$item_id."'");
			$upd->execute();
		} 
	}
}
if(isset($_POST['btn_action']))
{
	
	if($_POST['btn_action'] == 'changeItemStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update ot_admin_pics set pic_status='0' where pic_id = '".$postId."'");
				$upd->execute();
				echo "Image is Deactivated Now & Saved into Deactivated Images.";
			
			
		}
	}
	
	if($_POST['btn_action'] == 'changePostStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update ot_admin_pics set pic_status='1' where pic_id = '".$postId."'");
				$upd->execute();
				echo "Image is Activated Now & Saved into Activated Images.";
			
			
		}
	}
	
	
	
}
?>