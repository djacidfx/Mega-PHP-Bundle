<?php
ob_start();
session_start();
include("db/config.php");
include("db/post_functions.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
if(isset($_POST['btn_action']))
{
	
	if($_POST['btn_action'] == 'changeItemStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update anony_post set post_status='0' where id = '".$postId."'");
				$upd->execute();
				echo "Post is Deactivated Now & Saved into Deactivated Posts.";
			
			
		}
	}
	
	if($_POST['btn_action'] == 'changePostStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update anony_post set post_status='1' where id = '".$postId."'");
				$upd->execute();
				echo "Post is Activated Now & Saved into Activated Posts.";
			
			
		}
	}
	
	if($_POST['btn_action'] == 'changeFeaturedStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$updNew = $pdo->prepare("update anony_post set post_featured='0' where 1");
				$updNew->execute();
				$upd = $pdo->prepare("update anony_post set post_featured='1' where id = '".$postId."'");
				$upd->execute();
				echo "Post is Featured Now.";
			
			
		}
	}
	if($_POST['btn_action'] == 'fetch_post')
	{	
		if(!empty($_POST['pId'])){
			$postId = filter_var($_POST['pId'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from anony_post where id = ?");
			$announce->execute(array($postId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['postId'] = _e($row['id']);
				$output['postTitle'] = strip_tags($row['post_title']);
				$output['postDescription'] = strip_tags($row['post_description']);
			}
			echo json_encode($output) ;
		} else {
			echo "Error : Post Id is mandatory." ;
		}
	}
	
	if($_POST['btn_action'] == 'EditPost')
	{	
		if(!empty($_POST['postId']) && !empty($_POST['postTitle']) && !empty($_POST['postDescription'])){
			$postTitle = filter_var($_POST['postTitle'], FILTER_SANITIZE_STRING) ;
			$postDuplicate = check_post_duplicate($pdo,$postTitle) ;
			$postDescription = filter_var($_POST['postDescription'], FILTER_SANITIZE_STRING) ;
			$postId = filter_var($_POST['postId'], FILTER_SANITIZE_NUMBER_INT);
			if($postDuplicate > 0) {
				echo "Sorry, This is Duplicate Post. Try again.";
			} else {
				$upd = $pdo->prepare("update anony_post set post_title = '".$postTitle."',  post_description = '".$postDescription."' where id = '".$postId."'") ;
				$upd->execute();
				echo "Post is Edited Successfully";
			}
			
		} else {
			echo "Error : All fields are mandatory." ;
		}
	}
	
}
?>