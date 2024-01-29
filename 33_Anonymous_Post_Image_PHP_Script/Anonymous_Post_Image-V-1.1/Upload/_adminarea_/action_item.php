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
            $catId = find_category_by_postid($pdo,$postId) ;
            if(check_category_status($pdo,$catId) > 0 ){
				$upd = $pdo->prepare("update anony_post set post_status='1' where id = '".$postId."'");
				$upd->execute();
				echo "Post is Activated Now & Saved into Activated Posts.";
            } else {
                echo "Error : Post cannot be Activated because Category is Deactivated" ;
            }
			
		}
	}
	
	if($_POST['btn_action'] == 'changeFeaturedStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update anony_post set post_featured='1' where id = '".$postId."'");
				$upd->execute();
				echo "Post is Featured Now.";
		}
	}
    
    if($_POST['btn_action'] == 'unFeaturedStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update anony_post set post_featured='0' where id = '".$postId."'");
				$upd->execute();
				echo "Post is Unfeatured Now.";
		}
	}
	
	
    
    if($_POST['btn_action'] == 'fetch_replace_image')
	{	
		if(!empty($_POST['postId'])){
			$postId = filter_var($_POST['postId'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from anony_post where id = ?");
			$announce->execute(array($postId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['postId'] = _e($row['id']);
				$output['postTitle'] = strip_tags($row['post_title']);
			}
			echo json_encode($output) ;
		} else {
			echo "Error : Post Id is mandatory." ;
		}
	}
    if($_POST['btn_action'] == 'EditCaption')
	{
        if(!empty($_POST['postId']) && !empty($_POST['caption'])){
            $postId = filter_var($_POST['postId'], FILTER_SANITIZE_NUMBER_INT);
            $caption = filter_var($_POST['caption'], FILTER_SANITIZE_STRING) ;
            if( check_duplicate_caption($pdo,$caption) == 0){
            $upd = $pdo->prepare("update anony_post set post_title = '".$caption."' where id = '".$postId."'") ;
			$upd->execute();
			echo "Caption Edited Successfully";
            } else {
                echo "Duplicate Caption is not Allowed. Please Use Different Caption." ;
            }
        }
    }
    
    if($_POST['btn_action'] == 'ChangeCategory')
	{
        if(!empty($_POST['postId']) && !empty($_POST['catId'])){
            $postId = filter_var($_POST['postId'], FILTER_SANITIZE_NUMBER_INT);
            $catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update anony_post set cat_id = '".$catId."' where id = '".$postId."'") ;
			$upd->execute();
			echo "Category Changed Successfully";
            
        }
    }
    
    if($_POST['btn_action'] == 'DeletePost')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
            $imageName = find_image_name($pdo,$postId) ;
            $targetDir = "../postImage/" ;
            unlink($targetDir.$imageName);
            $updNew = $pdo->prepare("delete from anony_post where id = '".$postId."' ");
            $updNew->execute();
            echo "Post & Image is Deleted Successfully.";
			
			
		}
	}
	
}
?>