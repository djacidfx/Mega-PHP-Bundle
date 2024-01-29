<?php 
require_once('_adminarea_/db/config.php') ;
require_once('_adminarea_/db/post_functions.php') ;
if(isset($_POST['btn_action_sb']))
{
	if($_POST['btn_action_sb'] == 'add_code')
	{
		$first_no = code(1) ;
		$second_no = code(1) ;
		$output = '' ;
		$output = array( 
					'first_no' => $first_no,
					'second_no' => $second_no
					);
		echo json_encode($output);
	}
	if($_POST['btn_action_sb'] == 'Post')
	{
		$err = 0 ;
		$first_no = code(1) ;
		$second_no = code(1) ;
		$approveValue = get_approve_post($pdo) ;
		$postDescription = filter_var($_POST['postDescription'], FILTER_SANITIZE_STRING) ;
		$postTitle = filter_var($_POST['postTitle'], FILTER_SANITIZE_STRING) ;
		$date = date('Y-m-d') ;
		$postDate = date('d F, Y',strtotime($date));
		$firstno = filter_var($_POST['firstno'], FILTER_SANITIZE_NUMBER_INT) ;
		$secondno = filter_var($_POST['secondno'], FILTER_SANITIZE_NUMBER_INT) ;
		$sumvalue = filter_var($_POST['sumvalue'], FILTER_SANITIZE_NUMBER_INT) ;
		$total = $firstno + $secondno ;
		if($total == $sumvalue) {
			if($approveValue == '1') {
				$err = '1' ;
			} else {
				$err = '2' ;
			}
				$ins = $pdo->prepare("insert into anony_post (post_title,post_description,post_date,post_status)  values ('".$postTitle."', '".$postDescription."' ,'".$date."' , '".$approveValue."')");
				$ins->execute();
				$statement = $pdo->query("SELECT LAST_INSERT_ID()");
				$postId = $statement->fetchColumn();
				$postDesign = '
				<div class="card w-100 rounded post-shadow bg-dark text-white">
					  <div class="card-header bg-dark text-white"><h4 class="card-title">'.$postTitle.'</h4></div>
					  <div class="card-body">
						<h5 class="card-title">'.$postDescription.'</h5>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span> &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  <span style="float:right;"><small class="text-muted ">'.$postDate.'</small></span>
					  </div>
				</div>';
				$output = array( 
						'err' => $err,
						'postDesign' => $postDesign
						);
				echo json_encode($output);
		} else {
			$err = 0 ;
			$form_msg =  "Sorry Your Sum is Wrong. Please Prove You are Human.";
			$output = array( 
					'first_no' => $first_no,
					'second_no' => $second_no,
					'form_msg' => $form_msg,
					'err' => '0'
					);
			echo json_encode($output);
		}
	}
	if($_POST['btn_action_sb'] == 'user_like')
	{
		$postId = filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT); 
		$userIp = filter_var($_POST['uip'], FILTER_VALIDATE_IP); 
		$checkLike = check_userlike_post($pdo,$postId,$userIp) ;
		$oldLike = get_post_like($pdo,$postId) ;
		
		if($checkLike > 0) {
			$error = '1';
			$newLike = $oldLike ;
			
		} else {
			$error = '0';
			$newLike = $oldLike + 1;
			$ins = $pdo->prepare("insert into anony_like (like_ip,like_post_id) values ('".$userIp."' , '".$postId."')") ;
			$ins->execute();
			$upd = $pdo->prepare("update anony_post set post_like = '".$newLike."' where id = '".$postId."'") ;
			$upd->execute();
		}
		
		$output = array( 
					'error' => $error,
					'newLike' => $newLike
					);
		echo json_encode($output);
	}
	
	if($_POST['btn_action_sb'] == 'user_love')
	{
		$postId = filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT); 
		$userIp = filter_var($_POST['uip'], FILTER_VALIDATE_IP); 
		$checkLove = check_userlove_post($pdo,$postId,$userIp) ;
		$oldLove = get_post_love($pdo,$postId) ;
		
		if($checkLove > 0) {
			$error = '1';
			$newLove = $oldLove ;
			
		} else {
			$error = '0';
			$newLove = $oldLove + 1;
			$ins = $pdo->prepare("insert into anony_love (love_ip,love_post_id) values ('".$userIp."' , '".$postId."')") ;
			$ins->execute();
			$upd = $pdo->prepare("update anony_post set post_love = '".$newLove."' where id = '".$postId."'") ;
			$upd->execute();
		}
		
		$output = array( 
					'error' => $error,
					'newLove' => $newLove
					);
		echo json_encode($output);
	}
}
?>
