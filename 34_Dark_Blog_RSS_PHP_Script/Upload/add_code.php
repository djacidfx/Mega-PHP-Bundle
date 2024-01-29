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
    
    if($_POST['btn_action_sb'] == 'postComment')
	{
        $output = '' ;
        if(isset($_POST['g-recaptcha-response'])){
            $captcha=$_POST['g-recaptcha-response'];
        }
        $secretKey = SECRET_KEY ;
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) {
            if(!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['comment']) && !empty($_POST['pId'])){
                
                $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING) ;
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ;
                $postId = filter_var($_POST['pId'], FILTER_SANITIZE_NUMBER_INT) ;
                $comment = base64_encode($_POST['comment']) ;
                $comment = filter_var($comment, FILTER_SANITIZE_STRING) ;
                if(!empty($comment)){
                    $ins = $pdo->prepare("insert into anony_comment (post_id, comment, user_name, user_email) values ('".$postId."' , '".$comment."' , '".$fullname."' , '".$email."') ") ;
                    $ins->execute();
                    if($ins){
                        $output = array( 
                            'err' => '0'
                        );
                        echo json_encode($output);
                    }
                }
                
            } else {
                $form_msg = "Any of the Mandatory Field is Missing" ;
                $output = array( 
                        'err' => '1',
                        'form_msg' => $form_msg
                        );
                echo json_encode($output);
            }


        } else {
            $form_msg = "Spammer is Not Allowed. Prove, You are Human." ;
            $output = array( 
                    'err' => '2',
                    'form_msg' => $form_msg
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
