<?php
include("database.php") ;

if(isset($_POST['btn_action']))
{
    if($_POST['btn_action'] == 'user_love')
	{
        $postId = filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT); 
		$userIp = filter_var($_POST['uip'], FILTER_VALIDATE_IP); 
		$checkLove = check_userlove_post($pdo,$postId,$userIp) ;
		$oldLove = post_loves_by_id($pdo,$postId) ;
		
		if($checkLove > 0) {
			$error = '1';
			$newLove = $oldLove ;
			
		} else {
			$error = '0';
			$newLove = $oldLove + 1;
			$ins = $pdo->prepare("insert into ot_secret_love (love_user_ip,love_post_id) values ('".$userIp."' , '".$postId."')") ;
			$ins->execute();
			$upd = $pdo->prepare("update ot_secrets set loves = '".$newLove."' where id = '".$postId."'") ;
			$upd->execute();
		}
		
		$output = array( 
					'error' => $error,
					'newLove' => $newLove
					);
		echo json_encode($output);
    }
    
    if($_POST['btn_action'] == 'share_secret')
	{
        $postId = filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT); 
        $postshortTitle = post_short_title_by_id($pdo,$postId) ;
        $postTitle = post_title_by_id($pdo,$postId) ;
        $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
        $output = '' ;
        $output .= '
                    <div class="modal-header justify-content-center customBottomBorder">
                        <h4 class="modal-title text-muted"><i class="bi bi-signpost-2-fill text-muted"></i> '.$postTitle.'</h4>
                    </div>
                    <div class="modal-body text-center customBottomBorder">
                        <span class="p-1"><a href="https://www.facebook.com/sharer/sharer.php?u='.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" target="_blank"><i class="bi bi-facebook pointer shareIcon fbColor" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"></i></a></span>
                        <span class="p-1"><a href="https://twitter.com/share?url='.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'&text='.$postTitle.'" target="_blank"><i class="bi bi-twitter twitterColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Twitter"></i></a></span>
                        <span class="p-1"><a href="https://wa.me/?text='.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" target="_blank"><i class="bi bi-whatsapp wpColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Whatsapp"></i></a></span>
                        <span class="p-1"><a href="https://www.pinterest.com/pin/create/button/?url='.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'&media&description='.$postTitle.'" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Pinterest"><img src="'.BASE_URL.'img/pinterest.png" class="mt-n4"></a></span>
                        <span class="p-1"><a href="https://www.linkedin.com/shareArticle?mini=true&url='.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'&title='.$postTitle.'&summary=&source=" target="_blank" ><i class="bi bi-linkedin ldColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Linkedin"></i></a></span>
                        
                    </div>
                    <div class="modal-footer justify-content-center customBottomBorder"> 
                        <button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal">Close</button>
                    </div>
        ';
        
        echo $output ;
    }
    
    if($_POST['btn_action'] == 'postSecret')
	{
        if(!empty($_POST['title']) && !empty($_POST['description'])){
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            $secretKey = SECRET_KEY ;
            $ip = $_SERVER['REMOTE_ADDR'];
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents_ssl($url);
            $responseKeys = json_decode($response,true);
            $postDescription = base64_encode($_POST['description']) ;
            $postDescription = filter_var($postDescription , FILTER_SANITIZE_STRING) ;
            $postTitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING) ;
            $postDuplicate = check_post_duplicate($pdo,$postTitle) ;
            if($responseKeys["success"]) {
                if($postDuplicate > 0) {
                    $form_msg =  "Sorry, Duplicate Title. Please Try with Another Title.";
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '3'
                            );
                    echo json_encode($output);
                } else {
                    $ins = $pdo->prepare("insert into ot_secrets (title,description,user_ip)  values ('".$postTitle."', '".$postDescription."' ,'".$ip."')");
                    $ins->execute();
                    $statement = $pdo->query("SELECT LAST_INSERT_ID()");
                    $postId = $statement->fetchColumn();
                    $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
                    $output = array( 
                        'purl' => $postUrlTitle,
                        'pid' => $postId,
                        'err' => '0'
                        );
                    echo json_encode($output);
                }
            } else {
                $form_msg =  "Spam is not allowed. Prove, You are a Human !";
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '2'
                        );
                echo json_encode($output);
                
            }
        } else {
			$form_msg =  "Mandatory Field is Missing. Try Again";
			$output = array( 
					'form_msg' => $form_msg,
					'err' => '1'
					);
			echo json_encode($output);
        }
        
    }
    
    if($_POST['btn_action'] == 'postComment')
	{
        if(!empty($_POST['usercomment']) && !empty($_POST['pid'])){
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            $secretKey = SECRET_KEY ;
            $ip = $_SERVER['REMOTE_ADDR'];
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents_ssl($url);
            $responseKeys = json_decode($response,true);
            $postId = filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT) ;
            $comment = filter_var($_POST['usercomment'], FILTER_SANITIZE_STRING) ;
            $comment = base64_encode($comment) ;
            $ip = $_SERVER['REMOTE_ADDR'];
            if($responseKeys["success"]) {
                if(check_post_id($pdo , $postId) > 0) {
                   $ins = $pdo->prepare("insert into ot_comments (post_id, comment, c_user_ip) values ('".$postId."' , '".$comment."' , '".$ip."') ") ;
                    $ins->execute() ;
                    echo "0" ; 
                } else {
                    echo "1"  ;
                }
            } else {
                echo "2" ;
            }
        } else {
            echo "1" ;
        }
    }
    if($_POST['btn_action'] == 'manualUserSearch')
	{
        if(!empty($_POST['search_keyword'])){
            $search = filter_var($_POST['search_keyword'], FILTER_SANITIZE_STRING) ;            
            $query = "SELECT * FROM `ot_secrets` WHERE (title LIKE '%$search%') order by id DESC ";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $total = $statement->rowCount();
            if($total > 0){
                $url = BASE_URL."search?term=".$search ;
                echo $url ;
            } else {
                echo "2" ;
            }
        } else {
            echo "1" ;
        }
    }
}
?>