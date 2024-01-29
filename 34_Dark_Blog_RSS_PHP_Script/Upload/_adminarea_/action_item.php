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
				echo "Blog is Deactivated Now.";
			
			
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
				echo "Blog is Activated Now.";
            } else {
                echo "Error : Blog cannot be Activated because Category is Deactivated" ;
            }
			
		}
	}
	
	if($_POST['btn_action'] == 'changeFeaturedStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update anony_post set post_featured='1' where id = '".$postId."'");
				$upd->execute();
				echo "Blog is Featured Now.";
		}
	}
    
    if($_POST['btn_action'] == 'unFeaturedStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update anony_post set post_featured='0' where id = '".$postId."'");
				$upd->execute();
				echo "Blog is Unfeatured Now.";
		}
	}
    
    if($_POST['btn_action'] == 'changeTrendingStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update anony_post set post_trending='1' where id = '".$postId."'");
				$upd->execute();
				echo "Blog is Trending Now.";
		}
	}
    
    if($_POST['btn_action'] == 'unTrendingStatus')
	{
		if(!empty($_POST['pid'])){
			$postId= filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
				$upd = $pdo->prepare("update anony_post set post_trending='0' where id = '".$postId."'");
				$upd->execute();
				echo "Blog is Trending Now.";
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
            $updNew = $pdo->prepare("delete from anony_post where id = '".$postId."' ");
            $updNew->execute();
            echo "Blog is Deleted Successfully.";
			
			
		}
	}
	
}
?>