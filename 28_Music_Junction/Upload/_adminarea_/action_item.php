<?php
ob_start();
session_start();
include("db/config.php");
include("db/item_functions.php") ;
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
$error = 0 ;
if(isset($_POST['btn-action']))
{
	if($_POST['btn-action'] == 'save_step_1')
	{
		if(!empty($_POST['item_name']) &&  !empty($_POST['cat']) && !empty($_POST['item_tag']) ){
			$itemName = filter_var($_POST['item_name'], FILTER_SANITIZE_STRING) ;
			$itemTags = filter_var($_POST['item_tag'], FILTER_SANITIZE_STRING) ;
			$albumName = filter_var($_POST['album_name'], FILTER_SANITIZE_STRING) ;
			$categoryID = filter_var($_POST['cat'], FILTER_SANITIZE_NUMBER_INT) ;
			$itemDate = date("Y-m-d") ;
				$ins = $pdo->prepare("insert into item_db (item_name, item_album_name, main_category, item_tags,created_date, updated_date) values ('".$itemName."', '".$albumName."', '".$categoryID."', '".$itemTags."', '".$itemDate."', '".$itemDate."')") ;
				$ins->execute();
				$statement = $pdo->query("SELECT LAST_INSERT_ID()");
				$item_id = $statement->fetchColumn();
				if(isset($itemTags)){
					$tags = explode(",", $itemTags);
					for ($x = 0; $x < count($tags); $x++){
						$insTag = $pdo->prepare("insert into ot_tags (tag_item_id, tag_name) values (?,?)");
						$insTag->execute(array($item_id,$tags[$x]));
					}
				}
				$output = array( 
							'error' => '0',
							'item_id' => $item_id
							) ;
				echo json_encode($output);
				$targetDir = "../media/";   
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
		if( !empty($_POST['item_id']) && !empty($_POST['item_name'])  &&  !empty($_POST['cat']) && !empty($_POST['item_tag']) ){
			$item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
			$itemName = filter_var($_POST['item_name'], FILTER_SANITIZE_STRING) ;
			$itemTags = filter_var($_POST['item_tag'], FILTER_SANITIZE_STRING) ;
			$albumName = filter_var($_POST['album_name'], FILTER_SANITIZE_STRING) ;
			$categoryID = filter_var($_POST['cat'], FILTER_SANITIZE_NUMBER_INT) ;
			$itemDate = date("Y-m-d") ;
				$ins = $pdo->prepare("update item_db set item_name = '".$itemName."' , main_category = '".$categoryID."', item_album_name = '".$albumName."' , item_tags = '".$itemTags."' , updated_date = '".$itemDate."' where item_id = '".$item_id."'") ;
				$ins->execute();
				
				$output = array( 
							'error' => '0',
							'item_id' => $item_id
							) ;
				echo json_encode($output);
				if(!empty($itemTags)){
					$delTag = $pdo->prepare("delete from ot_tags where tag_item_id = '".$item_id."'");
					$delTag->execute();
					$tags = explode(",", $itemTags);
					for ($x = 0; $x < count($tags); $x++){
						$insTag = $pdo->prepare("insert into ot_tags (tag_item_id, tag_name) values (?,?)");
						$insTag->execute(array($item_id,$tags[$x]));
					}
				}
				$targetDir = "../media/";   
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
			$upd = $pdo->prepare("update item_db set item_status='1' where item_id = '".$item_id."'");
			$upd->execute();
		} 
	}
}
if(isset($_POST['btn_action']))
{
	
	if($_POST['btn_action'] == 'changeItemStatus')
	{
		if(!empty($_POST['item_id'])){
			$item_id= filter_var($_POST['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update item_db set item_status='0' where item_id = '".$item_id."'");
				$upd->execute();
				echo "Music is inactive Now & Saved into Drafts.";
			
		}
	}
	
}
?>