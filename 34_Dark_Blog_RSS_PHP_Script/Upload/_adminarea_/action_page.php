<?php
ob_start();
session_start();
include("db/config.php");
include("db/post_functions.php") ;
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
$error = 0 ;
if(isset($_POST['btn_action']))
{
    if($_POST['btn_action'] == 'save_comment')
	{
        if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['comment']) && !empty($_POST['cId']) && !empty($_POST['comment_reply']) ){
            $fullname = filter_var($_POST['username'], FILTER_SANITIZE_STRING) ;
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ;
            $commentId = filter_var($_POST['cId'], FILTER_SANITIZE_NUMBER_INT) ;
            $comment = base64_encode($_POST['comment']) ;
            $comment = filter_var($comment, FILTER_SANITIZE_STRING) ;
            $commentReply = base64_encode($_POST['comment_reply']) ;
            $commentReply = filter_var($commentReply, FILTER_SANITIZE_STRING) ;
            $upd = $pdo->prepare("update anony_comment set user_name = '".$fullname."' , user_email = '".$email."' , comment= '".$comment."' , admin_reply = '".$commentReply."' where comment_id = '".$commentId."'") ;
            $upd->execute() ;
            echo "0" ;
        } else {
            echo "1" ;
        }
    }
    if($_POST['btn_action'] == 'deleteCommentReply')
	{
        if(!empty($_POST['id']) ) {
            $commentId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $del = $pdo->prepare("delete from anony_comment where comment_id = '".$commentId."'") ;
            $del->execute() ;
            echo "Comment deleted successfully." ;
        } else {
            echo "CommentId is mandatory to delete." ;
        }
    }
    if($_POST['btn_action'] == 'save_blog')
	{
		if(!empty($_POST['blog_title']) && !empty($_POST['catId']) && !empty($_POST['page_content']) ) {
			$blogTitle = filter_var($_POST['blog_title'] , FILTER_SANITIZE_STRING) ;
			$catId = filter_var($_POST['catId'] , FILTER_SANITIZE_NUMBER_INT) ;
			$pageContent = base64_encode($_POST['page_content']) ;
			$pageContent = filter_var($pageContent , FILTER_SANITIZE_STRING) ;
			$checkSlug = check_duplicate_caption($pdo,$blogTitle) ;
			if($checkSlug == '1') {
				$error = 2 ;
				echo $error ;
			} else {
				$ins = $pdo->prepare("insert into anony_post (cat_id, post_title, post_description) values (?,?,?)") ;
				$ins->execute(array($catId, $blogTitle, $pageContent));
				if($ins) {
					$error = 0 ;
					echo $error ;
				}
			}
		} else {
			$error = 1 ;
			echo $error ;
		}
	}
    
    if($_POST['btn_action'] == 'edit_blog')
	{
		if(!empty($_POST['blog_title']) && !empty($_POST['catId']) && !empty($_POST['page_content']) && !empty($_POST['postId'])) {
            $postId = filter_var($_POST['postId'], FILTER_SANITIZE_NUMBER_INT) ;
			$blogTitle = filter_var($_POST['blog_title'] , FILTER_SANITIZE_STRING) ;
			$catId = filter_var($_POST['catId'] , FILTER_SANITIZE_NUMBER_INT) ;
			$pageContent = base64_encode($_POST['page_content']) ;
			$pageContent = filter_var($pageContent , FILTER_SANITIZE_STRING) ;
			$checkSlug = check_blog_title_byId($pdo,$blogTitle,$postId) ;
			if($checkSlug == '1') {
				$error = 2 ;
				echo $error ;
			} else {
				$ins = $pdo->prepare("update anony_post set cat_id = '".$catId."', post_title = '".$blogTitle."', post_description = '".$pageContent."' where id = '".$postId."'") ;
				$ins->execute();
				if($ins) {
					$error = 0 ;
					echo $error ;
				}
			}
		} else {
			$error = 1 ;
			echo $error ;
		}
	}
    
	if($_POST['btn_action'] == 'save_page')
	{
		if(!empty($_POST['page_name']) && !empty($_POST['page_slug']) && !empty($_POST['page_content']) ) {
			$pageName = filter_var($_POST['page_name'] , FILTER_SANITIZE_STRING) ;
			$pageSlug = filter_var(strtolower($_POST['page_slug']) , FILTER_SANITIZE_STRING) ;
			$pageContent = base64_encode($_POST['page_content']) ;
			$pageContent = filter_var($pageContent , FILTER_SANITIZE_STRING) ;
			$checkSlug = check_page_slug($pdo,$pageSlug) ;
			if($checkSlug == '1') {
				$error = 2 ;
				echo $error ;
			} else {
				$ins = $pdo->prepare("insert into ot_admin_pages (page_name, page_slug, page_text) values (?,?,?)") ;
				$ins->execute(array($pageName, $pageSlug, $pageContent));
				if($ins) {
					$error = 0 ;
					echo $error ;
				}
			}
		} else {
			$error = 1 ;
			echo $error ;
		}
	}
	if($_POST['btn_action'] == 'edit_page')
	{
		if(!empty($_POST['page_name']) && !empty($_POST['page_slug']) && !empty($_POST['page_content']) && !empty($_POST['pageId']) ) {
			$pageId = filter_var($_POST['pageId'], FILTER_SANITIZE_NUMBER_INT) ;
			$pageName = filter_var($_POST['page_name'] , FILTER_SANITIZE_STRING) ;
			$pageSlug = filter_var(strtolower($_POST['page_slug']) , FILTER_SANITIZE_STRING) ;
			$pageContent = base64_encode($_POST['page_content']) ;
			$pageContent = filter_var($pageContent , FILTER_SANITIZE_STRING) ;
			$checkSlug = check_page_slug_byId($pdo,$pageSlug,$pageId) ;
			if($checkSlug == '1') {
				$error = 2 ;
				echo $error ;
			} else {
				$ins = $pdo->prepare("update ot_admin_pages set page_name = ? , page_slug = ?, page_text = ? where page_id = '".$pageId."'") ;
				$ins->execute(array($pageName, $pageSlug, $pageContent));
				if($ins) {
					$error = 0 ;
					echo $error ;
				}
			}
		} else {
			$error = 1 ;
			echo $error ;
		}
	}
	
	if($_POST['btn_action'] == 'changePageStatus')
	{
		if(!empty($_POST['id']) ){
			$pageId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) ;
			$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT) ;
			$upd = $pdo->prepare("update ot_admin_pages set page_status = '".$status."' where page_id = '".$pageId."'") ;
			$upd->execute();
			if($upd) {
				echo "Page Status has been changed successfully.";
			}
			
		} else {
			echo "Page ID is mandatory to Change Status of Page. Try Again.";
		}
	}
	
	
}
?>