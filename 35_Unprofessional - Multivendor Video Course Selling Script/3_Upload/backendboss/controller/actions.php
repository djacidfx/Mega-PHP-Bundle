<?php
ob_start();
session_start();
include("../config/db.php") ; 
include("../controller/functions.php") ; 
check_admin_logged_in($pdo) ;

if(!empty($_FILES['previewfile']))
{
	$catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT) ;
	$targetDir = "../../catImg/"; 
	$allowTypes = array('jpg', 'png', 'jpeg'); 
	$fileName = filter_var($_FILES["previewfile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["previewfile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	//delete old file if exist
	$statement = $pdo->prepare("select category_image from ot_category where id = '".$catId."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) {
		$previewfile_name = _e($row['category_image']) ;
	} 
	if(in_array($fileType, $allowTypes)){ 
		//delete old image
		unlink($targetDir.$previewfile_name); 
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			$upd = $pdo->prepare("update ot_category set category_image = '".$newfilename."' where id = '".$catId."'");
			$upd->execute();
        } 
    } 
} 

if(isset($_POST['btn_action']))
{
    if($_POST['btn_action'] == 'SaveCategoryName')
	{
		if(!empty($_POST['catName'])){
			$categoryName = filter_var($_POST['catName'], FILTER_SANITIZE_STRING) ;
			$ins = $pdo->prepare("insert into ot_category (category_name) values (?)") ;
			$ins->execute(array($categoryName));
            $statement = $pdo->query("SELECT LAST_INSERT_ID()");
            $catId = $statement->fetchColumn();
			$form_msg = "Category Name added successfully.";
            $output = array( 
							'error' => '0',
                            'message' => $form_msg,
							'catId' => $catId
							) ;
				echo json_encode($output);
		} else {
			echo "1";
		}
	}
    
    if($_POST['btn_action'] == 'EditCategoryName')
	{
		if(!empty($_POST['catName']) && !empty($_POST['editcatId'])){
			$categoryName = filter_var($_POST['catName'], FILTER_SANITIZE_STRING) ;
            $catId = filter_var($_POST['editcatId'], FILTER_SANITIZE_NUMBER_INT) ;
			$ins = $pdo->prepare("update ot_category set category_name = '".$categoryName."' where id='".$catId."'") ;
			$ins->execute();
			$form_msg = "Category Name edited successfully.";
            $output = array( 
							'error' => '0',
                            'message' => $form_msg,
							'catId' => $catId
							) ;
				echo json_encode($output);
		} else {
			echo "1";
		}
	}
    
    if($_POST['btn_action'] == 'DeactivateCategory')
	{
		if(!empty($_POST['catId'])){
			$categoryId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT) ;
			$ins = $pdo->prepare("update ot_category set category_status='0' where id='".$categoryId."'") ;
			$ins->execute();
            $upd = $pdo->prepare("update ot_users_video set item_status = '0' where item_category = '".$categoryId."'") ;
            $upd->execute() ;
			echo "Category & All the Item belongs to this category is Disabled.";
		} else {
			echo "Category Id is missing. Refresh the Page & Try Again.";
		}
	}
    
    if($_POST['btn_action'] == 'ActivateCategory')
	{
		if(!empty($_POST['catId'])){
			$categoryId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT) ;
			$ins = $pdo->prepare("update ot_category set category_status='1' where id='".$categoryId."'") ;
			$ins->execute();
			$upd = $pdo->prepare("update ot_users_video set item_status = '1' where item_category = '".$categoryId."'") ;
            $upd->execute() ;
			echo "Category & All the Item belongs to this category is Enabled.";
		} else {
			echo "Category Id is missing. Refresh the Page & Try Again.";
		}
	}
    
    if($_POST['btn_action'] == 'SaveHrTitle')
	{
		if(!empty($_POST['hr'])){
			$titleName = filter_var($_POST['hr'], FILTER_SANITIZE_STRING) ;
			$ins = $pdo->prepare("insert into ot_hr_title (hr_title) values (?)") ;
			$ins->execute(array($titleName));
			$form_msg = "Hard Reject Title added successfully.";
            echo $form_msg;
		} else {
            $form_msg = "Title is Mandatory. Try Again.";
			echo $form_msg;
		}
	}
    
    if($_POST['btn_action'] == 'fetch_hr_title')
	{	
		if(!empty($_POST['hrId'])){
			$hrId = filter_var($_POST['hrId'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from ot_hr_title where hr_id = ?");
			$announce->execute(array($hrId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['hrId'] = _e($row['hr_id']);
				$output['hrName'] = strip_tags($row['hr_title']);
			}
			echo json_encode($output) ;
		} else {
			echo "Error : Hard Reject Id is mandatory." ;
		}
	}
	if($_POST['btn_action'] == 'EditHrTitle')
	{	
		if(!empty($_POST['hrId']) && !empty($_POST['hr'])){
			$titleName = filter_var($_POST['hr'], FILTER_SANITIZE_STRING) ;
			$hrId = filter_var($_POST['hrId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_hr_title set hr_title = '".$titleName."' where hr_id = '".$hrId."'") ;
			$upd->execute();
			echo "Hard Reject Title Updated Successfully";
			
		} else {
			echo "Error : Hard Reject ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'deactivate_hr_title')
	{	
		if(!empty($_POST['hrId'])){
			$hrId = filter_var($_POST['hrId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_hr_title set hr_status = '0' where hr_id = '".$hrId."'") ;
			$upd->execute();
			echo "Hard Reject Title Deactivated Successfully";
			
		} else {
			echo "Error : Hard Reject ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'activate_hr_title')
	{	
		if(!empty($_POST['hrId'])){
			$hrId = filter_var($_POST['hrId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_hr_title set hr_status = '1' where hr_id = '".$hrId."'") ;
			$upd->execute();
			echo "Hard Reject Title Activated Successfully";
			
		} else {
			echo "Error : Hard Reject ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'SaveHrReason')
	{
		if(!empty($_POST['hr_reason'])){
			$reasonName = filter_var($_POST['hr_reason'], FILTER_SANITIZE_STRING) ;
			$ins = $pdo->prepare("insert into ot_hr_subject (hr_sub_title) values (?)") ;
			$ins->execute(array($reasonName));
			$form_msg = "Hard Reject Reason added successfully.";
            echo $form_msg;
		} else {
            $form_msg = "Reason is Mandatory. Try Again.";
			echo $form_msg;
		}
	}
    
    if($_POST['btn_action'] == 'fetch_hr_sub_title')
	{	
		if(!empty($_POST['hrSubId'])){
			$hrId = filter_var($_POST['hrSubId'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from ot_hr_subject where hr_sub_id = ?");
			$announce->execute(array($hrId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['hrSubId'] = _e($row['hr_sub_id']);
				$output['hr_reason'] = strip_tags($row['hr_sub_title']);
			}
			echo json_encode($output) ;
		} else {
			echo "Error : Hard Reject Id is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'EditHrSubTitle')
	{	
		if(!empty($_POST['hrSubId']) && !empty($_POST['hr_reason'])){
			$reasonName = filter_var($_POST['hr_reason'], FILTER_SANITIZE_STRING) ;
			$hrId = filter_var($_POST['hrSubId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_hr_subject set hr_sub_title = '".$reasonName."' where hr_sub_id = '".$hrId."'") ;
			$upd->execute();
			echo "Hard Reject Reson Updated Successfully";
			
		} else {
			echo "Error : Hard Reject ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'deactivate_hr_sub_title')
	{	
		if(!empty($_POST['hrSubId'])){
			$hrId = filter_var($_POST['hrSubId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_hr_subject set hr_sub_status = '0' where hr_sub_id = '".$hrId."'") ;
			$upd->execute();
			echo "Hard Reject Reason Deactivated Successfully";
			
		} else {
			echo "Error : Hard Reject ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'activate_hr_sub_title')
	{	
		if(!empty($_POST['hrSubId'])){
			$hrId = filter_var($_POST['hrSubId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_hr_subject set hr_sub_status = '1' where hr_sub_id = '".$hrId."'") ;
			$upd->execute();
			echo "Hard Reject Reason Activated Successfully";
			
		} else {
			echo "Error : Hard Reject ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'SaveForumCategory')
	{
		if(!empty($_POST['cat'])){
			$categoryName = filter_var($_POST['cat'], FILTER_SANITIZE_STRING) ;
			$ins = $pdo->prepare("insert into ot_forum_category (forum_cat_name) values (?)") ;
			$ins->execute(array($categoryName));
			$form_msg = "Forum Category added successfully.";
            echo $form_msg;
		} else {
            $form_msg = "Category Name is Mandatory. Try Again.";
			echo $form_msg;
		}
	}
    
    if($_POST['btn_action'] == 'fetch_forumcategory_title')
	{	
		if(!empty($_POST['catId'])){
			$catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from ot_forum_category where forum_cat_id = ?");
			$announce->execute(array($catId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['catId'] = _e($row['forum_cat_id']);
				$output['cat'] = strip_tags($row['forum_cat_name']);
			}
			echo json_encode($output) ;
		} else {
			echo "Error : Category Id is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'EditForumCategory')
	{	
		if(!empty($_POST['catId']) && !empty($_POST['cat'])){
			$catName = filter_var($_POST['cat'], FILTER_SANITIZE_STRING) ;
			$catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_forum_category set forum_cat_name = '".$catName."' where forum_cat_id = '".$catId."'") ;
			$upd->execute();
			echo "Category Name Updated Successfully";
			
		} else {
			echo "Error : Category ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'deactivate_forum_category')
	{	
		if(!empty($_POST['catId'])){
			$catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_forum_category set forum_cat_status = '0' where forum_cat_id = '".$catId."'") ;
			$upd->execute();
            $updTopic = $pdo->prepare("update ot_forum_topic set topic_status = '0' where topic_cat_id = '".$catId."'") ;
            $updTopic->execute();
			echo "Category Deactivated Successfully & All Previous User Posts is hidden now on Forum.";
			
		} else {
			echo "Error : Category ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'activate_forum_category')
	{	
		if(!empty($_POST['catId'])){
			$catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_forum_category set forum_cat_status = '1' where forum_cat_id = '".$catId."'") ;
			$upd->execute();
            $updTopic = $pdo->prepare("update ot_forum_topic set topic_status = '1' where topic_cat_id = '".$catId."'") ;
            $updTopic->execute();
			echo "Category Activated Successfully & All Previous User Posts is live now on Forum.";
			
		} else {
			echo "Error : Category ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'delete_forum_topic')
	{	
		if(!empty($_POST['topicId'])){
			$topicId = filter_var($_POST['topicId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("delete from ot_forum_topic where topic_id = '".$topicId."'") ;
			$upd->execute();
            $updTopic = $pdo->prepare("delete from ot_forum_topic_answers where answer_topic_id = '".$topicId."'") ;
            $updTopic->execute();
			
		} else {
			echo "Error : Topic ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'delete_forum_topic_answer')
	{	
		if(!empty($_POST['answerId'])){
			$answerId = filter_var($_POST['answerId'], FILTER_SANITIZE_NUMBER_INT);
            $topicId = find_topicid_by_answerid($pdo,$answerId) ;
            $oldAnswers = topicanswerscount_by_id($pdo,$topicId) ;
            $newAnswerCount = ($oldAnswers - 1) ;
            
			$upd = $pdo->prepare("delete from ot_forum_topic_answers where answer_id = '".$answerId."'") ;
			$upd->execute();
			
            $updTopic = $pdo->prepare("update ot_forum_topic set topic_answers = '".$newAnswerCount."' where topic_id = '".$topicId."'");
            $updTopic->execute() ;
		} else {
			echo "Error : Answer ID is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'delete_pending_item')
	{
        $tempId = filter_var($_POST['tempId'], FILTER_SANITIZE_NUMBER_INT);
        $tempImageDirectory = "../../tmpImg/"; 
        $tempVideoDirectory = "../../tmpVideos/"; 
        $tempFileDirectory = "../../tmpFiles/";
        $tempImageName = find_temp_image($pdo,$tempId) ;
        $tempVideoName = find_temp_video($pdo,$tempId) ;
        $tempFileName = find_temp_file($pdo,$tempId) ; 
        
        //delete hard rejected item temp image from server
        unlink($tempImageDirectory.$tempImageName); 

        //delete hard rejected item temp demo video from server
        unlink($tempVideoDirectory.$tempVideoName); 

        //delete hard rejected item temp main file from server
        unlink($tempFileDirectory.$tempFileName); 
        
        $upd = $pdo->prepare("DELETE FROM `ot_users_temp_video` WHERE temp_id = '".$tempId."'") ;
        $upd->execute();
    }
    
    if($_POST['btn_action'] == 'HardRejectItem')
	{	
		if(!empty($_POST['hardRejectTitle']) && !empty($_POST['hardRejectReason']) && !empty($_POST['tempId']) && !empty($_POST['userId']) && !empty($_POST['catId']) && !empty($_POST['itemTitle'])){
			$tempId = filter_var($_POST['tempId'], FILTER_SANITIZE_NUMBER_INT);
            $userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);
            $userfullname = user_fullname_by_id($pdo,$userId) ;
            $useremail = useremail_by_id($pdo,$userId) ;
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            $catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
            $itemTitle = filter_var($_POST['itemTitle'], FILTER_SANITIZE_STRING);
            $hardRejectTitleId = filter_var($_POST['hardRejectTitle'], FILTER_SANITIZE_NUMBER_INT);
            $hardRejectTitle = grab_hr_title_for_user($pdo,$hardRejectTitleId);
            $reasonId = filter_var($_POST['hardRejectReason'], FILTER_SANITIZE_NUMBER_INT) ;
            $hardRejectReason =  grab_hr_reason_for_user($pdo,$reasonId) ;
            $userCommentId = filter_var($_POST['userComment'], FILTER_SANITIZE_STRING) ;
            $userComment = reviewercomment_by_id($pdo,$tempId) ; 
            
            $instruction = filter_var($_POST['instruction'], FILTER_SANITIZE_STRING) ;
            
            $tempImageDirectory = "../../tmpImg/"; 
            $tempVideoDirectory = "../../tmpVideos/"; 
            $tempFileDirectory = "../../tmpFiles/";
            $tempImageName = find_temp_image($pdo,$tempId) ;
            $tempVideoName = find_temp_video($pdo,$tempId) ;
            $tempFileName = find_temp_file($pdo,$tempId) ; 
            $time = date("Y-m-d h:i:s") ;
            //***************************************** Send Hard Reject Email to User **************************************************
            $to = $useremail ;
            $subject = $hardRejectTitle;
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
            include("../../emailTemplates/send_hard_reject_email.php");
            mail($to, $subject, $body, $headers);
            if(mail){
                //delete hard rejected item temp image from server
                unlink($tempImageDirectory.$tempImageName); 

                //delete hard rejected item temp demo video from server
                unlink($tempVideoDirectory.$tempVideoName); 

                //delete hard rejected item temp main file from server
                unlink($tempFileDirectory.$tempFileName); 

                $upd = $pdo->prepare("DELETE FROM `ot_users_temp_video` WHERE temp_id = '".$tempId."'") ;
                $upd->execute();
                if($upd){
                    echo "1";
                    $ins = $pdo->prepare("insert into ot_hard_rejects (user_id, item_title, cat_id, title, reason, user_comment, instruction, hard_reject_time) values ('".$userId."', '".$itemTitle."', '".$catId."', '".$hardRejectTitle."', '".$hardRejectReason."', '".$userComment."', '".$instruction."','".$time."')") ;
                    $ins->execute() ;
                    $newHardRejectCount = count_old_hard_reject($pdo) + 1 ;
                    $updateHardReject = $pdo->prepare("update ot_admin set hard_rejected = '".$newHardRejectCount."' where id = '1'");
                    $updateHardReject->execute();
                    
                }
            }
            $nLink = BASE_URL.'hardrejects' ;
            $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('2', '".$userId."', '".$nLink."' ) ");
            $insNotification->execute();
		} else {
			echo "0" ;
		}
	}
    if($_POST['btn_action'] == 'SoftRejectItem')
	{
        if( !empty($_POST['tempId']) && !empty($_POST['userId']) && !empty($_POST['catId']) && !empty($_POST['itemTitle'])){
            $tempId = filter_var($_POST['tempId'], FILTER_SANITIZE_NUMBER_INT);
            $userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);
            $catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
            $itemTitle = filter_var($_POST['itemTitle'], FILTER_SANITIZE_STRING);
            $userCommentId = filter_var($_POST['userComment'], FILTER_SANITIZE_STRING) ;
            $userComment = reviewercomment_by_id($pdo,$tempId) ;             
            $instruction = filter_var($_POST['instruction'], FILTER_SANITIZE_STRING) ;
            $tempImageDirectory = "../../tmpImg/"; 
            $tempVideoDirectory = "../../tmpVideos/"; 
            $tempFileDirectory = "../../tmpFiles/";
            $tempImageName = find_temp_image($pdo,$tempId) ;
            $tempVideoName = find_temp_video($pdo,$tempId) ;
            $tempFileName = find_temp_file($pdo,$tempId) ; 
            $time = date("Y-m-d h:i:s") ;
            $titleIssue = filter_var($_POST['titleIssue'], FILTER_SANITIZE_NUMBER_INT);
            $priceIssue = filter_var($_POST['priceIssue'], FILTER_SANITIZE_NUMBER_INT);
            $descriptionIssue = filter_var($_POST['descriptionIssue'], FILTER_SANITIZE_NUMBER_INT);
            $tagsIssue = filter_var($_POST['tagsIssue'], FILTER_SANITIZE_NUMBER_INT);
            $categoryIssue = filter_var($_POST['categoryIssue'], FILTER_SANITIZE_NUMBER_INT);
            $previewIssue = filter_var($_POST['previewIssue'], FILTER_SANITIZE_NUMBER_INT);
            $demoIssue = filter_var($_POST['demoIssue'], FILTER_SANITIZE_NUMBER_INT);
            $demoSize = itemdemo_videosize_by_id($pdo,$tempId) ;
            $mainfileIssue = filter_var($_POST['mainfileIssue'], FILTER_SANITIZE_NUMBER_INT);
            $mainfileSize = item_mainfilesize_by_id($pdo,$tempId) ;
            $imageFile = find_temp_image($pdo,$tempId) ; 
            $demoFile = find_temp_video($pdo,$tempId) ;
            $mainFile = find_temp_file($pdo,$tempId) ;
            $newSoftRejectCount = count_old_soft_reject($pdo,$tempId) + 1 ;
            $userfullname = user_fullname_by_id($pdo,$userId) ;
            $useremail = useremail_by_id($pdo,$userId) ;
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            //***************************************** Send Soft Reject Email to User **************************************************
            $to = $useremail ;
            $subject = "Your Item is Soft Rejected.";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
            include("../../emailTemplates/send_soft_reject_email.php");
            mail($to, $subject, $body, $headers);
            /**/
            if(mail){
                echo "1" ;
                if($previewIssue == '1'){
                    $imageFile = "" ;
                    //delete soft rejected item temp image from server
                    unlink($tempImageDirectory.$tempImageName); 
                }
                if($demoIssue == '1'){
                    $demoFile = "" ;
                    $demoSize = "" ;
                    //delete hard rejected item temp demo video from server
                    unlink($tempVideoDirectory.$tempVideoName); 
                }
                if($mainfileIssue == '1'){
                    $mainFile = "" ;
                    $mainfileSize = "" ;
                    //delete hard rejected item temp main file from server
                    unlink($tempFileDirectory.$tempFileName); 
                }
                $upd = $pdo->prepare("update ot_users_temp_video set item_main_file = '".$mainFile."' , item_main_file_size = '".$mainfileSize."' , item_preview_img = '".$imageFile."' , item_demo_video = '".$demoFile."' , item_demo_video_size = '".$demoSize."' , title_issue = '".$titleIssue."' , price_issue = '".$priceIssue."' , description_issue = '".$descriptionIssue."' , tags_issue = '".$tagsIssue."' , category_issue = '".$categoryIssue."' , preview_issue = '".$previewIssue."' , demo_issue = '".$demoIssue."' , mainfile_issue = '".$mainfileIssue."' , item_soft_reject = '1', upload_success = '0' , soft_reject_count = '".$newSoftRejectCount."' , additonal_instruction = '".$instruction."' WHERE temp_id = '".$tempId."'") ;
                $upd->execute();
                $nLink = BASE_URL.'softrejects' ;
                $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('3', '".$userId."', '".$nLink."' ) ");
                $insNotification->execute();
            }
        } else {
			echo "0" ;
		}
        
    }
    
    
    if($_POST['btn_action'] == 'approve_temp_item')
	{
        if( !empty($_POST['tempId'])){
            $tempId = filter_var($_POST['tempId'], FILTER_SANITIZE_NUMBER_INT);
            $userId = find_user_id($pdo,$tempId);
            $userfullname = user_fullname_by_id($pdo,$userId) ;
            $useremail = useremail_by_id($pdo,$userId) ;
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            $catId = find_cat_id($pdo,$tempId);
            $itemTitle = itemtitle_by_id($pdo,$tempId);
            $price = find_item_price($pdo,$tempId) ;
            $description = base64_encode(itemdescription_by_id($pdo,$tempId)) ;
            $itemTags = itemtags_by_id($pdo,$tempId) ;
            $catId = find_cat_id($pdo,$tempId) ; 
            $tempImageDirectory = "../../tmpImg/"; 
            $tempVideoDirectory = "../../tmpVideos/"; 
            $tempFileDirectory = "../../tmpFiles/";
            $mainImageDirectory = "../../mainImg/";
            $mainVideoDirectory = "../../mainVideos/";
            $mainFileDirectory = "../../mainFiles/";
            $tempImageName = find_temp_image($pdo,$tempId) ;
            $tempVideoName = find_temp_video($pdo,$tempId) ;
            $tempFileName = find_temp_file($pdo,$tempId) ; 
            $time = date("Y-m-d h:i:s") ;
            $mainfileSize = item_mainfilesize_by_id($pdo,$tempId) ;
            
            
            $ins = $pdo->prepare("insert into ot_users_video (user_id, item_category, item_title, item_price, item_description,  item_tags, item_mainfile, item_mainfile_size, item_preview_image, item_demo_video, item_created_time, item_updated_time) values ('".$userId."', '".$catId."', '".$itemTitle."', '".$price."', '".$description."' , '".$itemTags."', '".$tempFileName."', '".$mainfileSize."', '".$tempImageName."', '".$tempVideoName."', '".$time."', '".$time."')") ;
            $ins->execute() ;
            $statement = $pdo->query("SELECT LAST_INSERT_ID()");
            $item_id = $statement->fetchColumn();
            $itemUrlTitle = item_urltitle_by_id($pdo,$item_id) ;
            if(!empty($item_id)){
                //***************************************** Send Soft Reject Email to User **************************************************
                
                $to = $useremail ;
                $subject = "Congratulations ! Your Item is Approved.";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                include("../../emailTemplates/send_approve_item_email.php");
                mail($to, $subject, $body, $headers);
                
                rename($tempImageDirectory.$tempImageName , $mainImageDirectory.$tempImageName) ;
                rename($tempVideoDirectory.$tempVideoName , $mainVideoDirectory.$tempVideoName) ;
                rename($tempFileDirectory.$tempFileName , $mainFileDirectory.$tempFileName) ;
                if(isset($itemTags)){
                        $tags = explode(",", $itemTags);
                        for ($x = 0; $x < count($tags); $x++){
                            $insTag = $pdo->prepare("insert into ot_tags (tag_item_id, tag_name) values (?,?)");
                            $insTag->execute(array($item_id,$tags[$x]));
                        }
                }
                if(check_author_badge($pdo,$userId) == 0){
                    $authorBadge = $pdo->prepare("insert into ot_author_badge (user_id) values ('".$userId."')") ;
                    $authorBadge->execute() ;
                }
                $del = $pdo->prepare("DELETE FROM `ot_users_temp_video` WHERE temp_id = '".$tempId."'") ;
                $del->execute();
            }
            $nLink = BASE_URL.'video/'.$item_id.'/'.$itemUrlTitle ;
            $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('13', '".$userId."', '".$nLink."' ) ");
            $insNotification->execute();
            echo "1" ;
            
        } else {
			echo "0" ;
		}
        
    }
    
    if($_POST['btn_action'] == 'SaveAuthorBadge')
	{	
		if(!empty($_POST['level_one']) && !empty($_POST['level_two']) && !empty($_POST['level_three']) && !empty($_POST['level_four']) && !empty($_POST['level_five']) && !empty($_POST['level_six']) && !empty($_POST['level_seven']) && !empty($_POST['level_eight']) && !empty($_POST['level_nine']) && !empty($_POST['level_ten']) && !empty($_POST['level_eleven']) && !empty($_POST['level_twelve']) && !empty($_POST['level_thirteen']) && !empty($_POST['level_fourteen']) && !empty($_POST['level_fifteen']) && !empty($_POST['level_sixteen']) ){
			$level_one = filter_var($_POST['level_one'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_one = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_one."' where level_id = '1'") ;
			$upd_level_one->execute();
            
            $level_two = filter_var($_POST['level_two'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_two = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_two."' where level_id = '2'") ;
			$upd_level_two->execute();
            
            $level_three = filter_var($_POST['level_three'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_three = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_three."' where level_id = '3'") ;
			$upd_level_three->execute();
            
            $level_four = filter_var($_POST['level_four'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_four = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_four."' where level_id = '4'") ;
			$upd_level_four->execute();
            
            $level_five = filter_var($_POST['level_five'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_five = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_five."' where level_id = '5'") ;
			$upd_level_five->execute();
            
            $level_six = filter_var($_POST['level_six'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_six = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_six."' where level_id = '6'") ;
			$upd_level_six->execute();
            
            $level_seven = filter_var($_POST['level_seven'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_seven = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_seven."' where level_id = '7'") ;
			$upd_level_seven->execute();
            
            $level_eight = filter_var($_POST['level_eight'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_eight = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_eight."' where level_id = '8'") ;
			$upd_level_eight->execute();
            
            $level_nine = filter_var($_POST['level_nine'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_nine = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_nine."' where level_id = '9'") ;
			$upd_level_nine->execute();
            
            $level_ten = filter_var($_POST['level_ten'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_ten = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_ten."' where level_id = '10'") ;
			$upd_level_ten->execute();
            
            $level_eleven = filter_var($_POST['level_eleven'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_eleven = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_eleven."' where level_id = '11'") ;
			$upd_level_eleven->execute();
            
            $level_twelve = filter_var($_POST['level_twelve'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_twelve = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_twelve."' where level_id = '12'") ;
			$upd_level_twelve->execute();
            
            $level_thirteen = filter_var($_POST['level_thirteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_thirteen = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_thirteen."' where level_id = '13'") ;
			$upd_level_thirteen->execute();
            
            $level_fourteen = filter_var($_POST['level_fourteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_fourteen = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_fourteen."' where level_id = '14'") ;
			$upd_level_fourteen->execute();
            
            $level_fifteen = filter_var($_POST['level_fifteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_fifteen = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_fifteen."' where level_id = '15'") ;
			$upd_level_fifteen->execute();
            
            $level_sixteen = filter_var($_POST['level_sixteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_sixteen = $pdo->prepare("update ot_author_level_requirement set level_price = '".$level_sixteen."' where level_id = '16'") ;
			$upd_level_sixteen->execute();
            
			echo "Author Badges Settings saved Successfully";
			
		} else {
			echo "Error : All Levels is mandatory." ;
		}
	}
    
    
    if($_POST['btn_action'] == 'SaveAuthorUploaderBadge')
	{	
		if(!empty($_POST['level_one']) && !empty($_POST['level_two']) && !empty($_POST['level_three']) && !empty($_POST['level_four']) && !empty($_POST['level_five']) && !empty($_POST['level_six']) && !empty($_POST['level_seven']) && !empty($_POST['level_eight']) && !empty($_POST['level_nine']) && !empty($_POST['level_ten']) && !empty($_POST['level_eleven']) && !empty($_POST['level_twelve']) && !empty($_POST['level_thirteen']) && !empty($_POST['level_fourteen']) && !empty($_POST['level_fifteen']) && !empty($_POST['level_sixteen']) ){
			$level_one = filter_var($_POST['level_one'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_one = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_one."' where uploader_level_id = '1'") ;
			$upd_level_one->execute();
            
            $level_two = filter_var($_POST['level_two'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_two = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_two."' where uploader_level_id = '2'") ;
			$upd_level_two->execute();
            
            $level_three = filter_var($_POST['level_three'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_three = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_three."' where uploader_level_id = '3'") ;
			$upd_level_three->execute();
            
            $level_four = filter_var($_POST['level_four'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_four = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_four."' where uploader_level_id = '4'") ;
			$upd_level_four->execute();
            
            $level_five = filter_var($_POST['level_five'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_five = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_five."' where uploader_level_id = '5'") ;
			$upd_level_five->execute();
            
            $level_six = filter_var($_POST['level_six'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_six = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_six."' where uploader_level_id = '6'") ;
			$upd_level_six->execute();
            
            $level_seven = filter_var($_POST['level_seven'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_seven = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_seven."' where uploader_level_id = '7'") ;
			$upd_level_seven->execute();
            
            $level_eight = filter_var($_POST['level_eight'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_eight = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_eight."' where uploader_level_id = '8'") ;
			$upd_level_eight->execute();
            
            $level_nine = filter_var($_POST['level_nine'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_nine = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_nine."' where uploader_level_id = '9'") ;
			$upd_level_nine->execute();
            
            $level_ten = filter_var($_POST['level_ten'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_ten = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_ten."' where uploader_level_id = '10'") ;
			$upd_level_ten->execute();
            
            $level_eleven = filter_var($_POST['level_eleven'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_eleven = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_eleven."' where uploader_level_id = '11'") ;
			$upd_level_eleven->execute();
            
            $level_twelve = filter_var($_POST['level_twelve'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_twelve = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_twelve."' where uploader_level_id = '12'") ;
			$upd_level_twelve->execute();
            
            $level_thirteen = filter_var($_POST['level_thirteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_thirteen = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_thirteen."' where uploader_level_id = '13'") ;
			$upd_level_thirteen->execute();
            
            $level_fourteen = filter_var($_POST['level_fourteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_fourteen = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_fourteen."' where uploader_level_id = '14'") ;
			$upd_level_fourteen->execute();
            
            $level_fifteen = filter_var($_POST['level_fifteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_fifteen = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_fifteen."' where uploader_level_id = '15'") ;
			$upd_level_fifteen->execute();
            
            $level_sixteen = filter_var($_POST['level_sixteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_sixteen = $pdo->prepare("update ot_uploader_level_requirement set uploader_level_videos = '".$level_sixteen."' where uploader_level_id = '16'") ;
			$upd_level_sixteen->execute();
            
			echo "Uploader Badges Settings saved Successfully";
			
		} else {
			echo "Error : All Levels is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'SaveAuthorEliteBadge')
	{
        if(!empty($_POST['eliteAuthor']) && !empty($_POST['powereliteAuthor']) && !empty($_POST['uploaderKing'])){
            $eliteLevel = filter_var($_POST['eliteAuthor'], FILTER_SANITIZE_NUMBER_INT) ;
            $powerEliteLevel = filter_var($_POST['powereliteAuthor'], FILTER_SANITIZE_NUMBER_INT) ;
            $uploaderKingLevel = filter_var($_POST['uploaderKing'], FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_admin set elite_author_requirement = '".$eliteLevel."' , power_elite_author_requirement = '".$powerEliteLevel."'  , uploader_king_requirement = '".$uploaderKingLevel."'  where id= '1'");
            $upd->execute();
            echo "Badges Settings saved Successfully." ;
        } else {
            echo "Error : All fields are mandatory." ;
        }
    }
    
    if($_POST['btn_action'] == 'SaveFollowerBadge')
	{	
		if(!empty($_POST['level_one']) && !empty($_POST['level_two']) && !empty($_POST['level_three']) && !empty($_POST['level_four']) && !empty($_POST['level_five']) && !empty($_POST['level_six']) && !empty($_POST['level_seven']) && !empty($_POST['level_eight']) && !empty($_POST['level_nine']) && !empty($_POST['level_ten']) && !empty($_POST['level_eleven']) && !empty($_POST['level_twelve']) && !empty($_POST['level_thirteen']) && !empty($_POST['level_fourteen']) && !empty($_POST['level_fifteen']) && !empty($_POST['level_sixteen']) && !empty($_POST['rockstar']) ){
			$level_one = filter_var($_POST['level_one'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_one = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_one."' where follower_level_id = '1'") ;
			$upd_level_one->execute();
            
            $level_two = filter_var($_POST['level_two'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_two = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_two."' where follower_level_id = '2'") ;
			$upd_level_two->execute();
            
            $level_three = filter_var($_POST['level_three'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_three = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_three."' where follower_level_id = '3'") ;
			$upd_level_three->execute();
            
            $level_four = filter_var($_POST['level_four'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_four = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_four."' where follower_level_id = '4'") ;
			$upd_level_four->execute();
            
            $level_five = filter_var($_POST['level_five'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_five = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_five."' where follower_level_id = '5'") ;
			$upd_level_five->execute();
            
            $level_six = filter_var($_POST['level_six'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_six = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_six."' where follower_level_id = '6'") ;
			$upd_level_six->execute();
            
            $level_seven = filter_var($_POST['level_seven'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_seven = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_seven."' where follower_level_id = '7'") ;
			$upd_level_seven->execute();
            
            $level_eight = filter_var($_POST['level_eight'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_eight = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_eight."' where follower_level_id = '8'") ;
			$upd_level_eight->execute();
            
            $level_nine = filter_var($_POST['level_nine'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_nine = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_nine."' where follower_level_id = '9'") ;
			$upd_level_nine->execute();
            
            $level_ten = filter_var($_POST['level_ten'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_ten = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_ten."' where follower_level_id = '10'") ;
			$upd_level_ten->execute();
            
            $level_eleven = filter_var($_POST['level_eleven'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_eleven = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_eleven."' where follower_level_id = '11'") ;
			$upd_level_eleven->execute();
            
            $level_twelve = filter_var($_POST['level_twelve'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_twelve = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_twelve."' where follower_level_id = '12'") ;
			$upd_level_twelve->execute();
            
            $level_thirteen = filter_var($_POST['level_thirteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_thirteen = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_thirteen."' where follower_level_id = '13'") ;
			$upd_level_thirteen->execute();
            
            $level_fourteen = filter_var($_POST['level_fourteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_fourteen = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_fourteen."' where follower_level_id = '14'") ;
			$upd_level_fourteen->execute();
            
            $level_fifteen = filter_var($_POST['level_fifteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_fifteen = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_fifteen."' where follower_level_id = '15'") ;
			$upd_level_fifteen->execute();
            
            $level_sixteen = filter_var($_POST['level_sixteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_sixteen = $pdo->prepare("update ot_follower_level_requirement set follower_level_users = '".$level_sixteen."' where follower_level_id = '16'") ;
			$upd_level_sixteen->execute();
            
            $rockstar = filter_var($_POST['rockstar'], FILTER_SANITIZE_NUMBER_INT);
			$upd_rockstar = $pdo->prepare("update ot_admin set follower_rockstar_requirement = '".$rockstar."' where id = '1'") ;
			$upd_rockstar->execute();
            
			echo "Follower Badges Settings saved Successfully";
			
		} else {
			echo "Error : All Levels is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'SaveCommunityBadge')
	{	
		if(!empty($_POST['level_one']) && !empty($_POST['level_two']) && !empty($_POST['level_three']) && !empty($_POST['level_four']) && !empty($_POST['level_five']) && !empty($_POST['level_six']) && !empty($_POST['level_seven']) && !empty($_POST['level_eight']) && !empty($_POST['level_nine']) && !empty($_POST['level_ten']) && !empty($_POST['level_eleven']) && !empty($_POST['level_twelve']) && !empty($_POST['level_thirteen']) && !empty($_POST['level_fourteen']) && !empty($_POST['level_fifteen']) && !empty($_POST['level_sixteen']) && !empty($_POST['communitySuperstar']) ){
			$level_one = filter_var($_POST['level_one'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_one = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_one."' where counsellor_level_id = '1'") ;
			$upd_level_one->execute();
            
            $level_two = filter_var($_POST['level_two'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_two = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_two."' where counsellor_level_id = '2'") ;
			$upd_level_two->execute();
            
            $level_three = filter_var($_POST['level_three'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_three = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_three."' where counsellor_level_id = '3'") ;
			$upd_level_three->execute();
            
            $level_four = filter_var($_POST['level_four'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_four = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_four."' where counsellor_level_id = '4'") ;
			$upd_level_four->execute();
            
            $level_five = filter_var($_POST['level_five'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_five = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_five."' where counsellor_level_id = '5'") ;
			$upd_level_five->execute();
            
            $level_six = filter_var($_POST['level_six'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_six = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_six."' where counsellor_level_id = '6'") ;
			$upd_level_six->execute();
            
            $level_seven = filter_var($_POST['level_seven'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_seven = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_seven."' where counsellor_level_id = '7'") ;
			$upd_level_seven->execute();
            
            $level_eight = filter_var($_POST['level_eight'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_eight = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_eight."' where counsellor_level_id = '8'") ;
			$upd_level_eight->execute();
            
            $level_nine = filter_var($_POST['level_nine'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_nine = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_nine."' where counsellor_level_id = '9'") ;
			$upd_level_nine->execute();
            
            $level_ten = filter_var($_POST['level_ten'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_ten = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_ten."' where counsellor_level_id = '10'") ;
			$upd_level_ten->execute();
            
            $level_eleven = filter_var($_POST['level_eleven'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_eleven = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_eleven."' where counsellor_level_id = '11'") ;
			$upd_level_eleven->execute();
            
            $level_twelve = filter_var($_POST['level_twelve'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_twelve = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_twelve."' where counsellor_level_id = '12'") ;
			$upd_level_twelve->execute();
            
            $level_thirteen = filter_var($_POST['level_thirteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_thirteen = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_thirteen."' where counsellor_level_id = '13'") ;
			$upd_level_thirteen->execute();
            
            $level_fourteen = filter_var($_POST['level_fourteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_fourteen = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_fourteen."' where counsellor_level_id = '14'") ;
			$upd_level_fourteen->execute();
            
            $level_fifteen = filter_var($_POST['level_fifteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_fifteen = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_fifteen."' where counsellor_level_id = '15'") ;
			$upd_level_fifteen->execute();
            
            $level_sixteen = filter_var($_POST['level_sixteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_sixteen = $pdo->prepare("update ot_counsellor_level_requirement set counsellor_level_solutions = '".$level_sixteen."' where counsellor_level_id = '16'") ;
			$upd_level_sixteen->execute();
            
            $communitySuperstar = filter_var($_POST['communitySuperstar'], FILTER_SANITIZE_NUMBER_INT);
			$upd_superstar = $pdo->prepare("update ot_admin set community_superstar_requirement = '".$communitySuperstar."' where id = '1'") ;
			$upd_superstar->execute();
            
			echo "Community Badges Settings saved Successfully";
			
		} else {
			echo "Error : All Levels is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'SaveBuyerBadge')
	{	
		if(!empty($_POST['level_one']) && !empty($_POST['level_two']) && !empty($_POST['level_three']) && !empty($_POST['level_four']) && !empty($_POST['level_five']) && !empty($_POST['level_six']) && !empty($_POST['level_seven']) && !empty($_POST['level_eight']) && !empty($_POST['level_nine']) && !empty($_POST['level_ten']) && !empty($_POST['level_eleven']) && !empty($_POST['level_twelve']) && !empty($_POST['level_thirteen']) && !empty($_POST['level_fourteen']) && !empty($_POST['level_fifteen']) && !empty($_POST['level_sixteen']) && !empty($_POST['eliteBuyer']) && !empty($_POST['powerEliteBuyer']) ){
			$level_one = filter_var($_POST['level_one'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_one = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_one."' where buyer_level_id = '1'") ;
			$upd_level_one->execute();
            
            $level_two = filter_var($_POST['level_two'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_two = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_two."' where buyer_level_id = '2'") ;
			$upd_level_two->execute();
            
            $level_three = filter_var($_POST['level_three'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_three = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_three."' where buyer_level_id = '3'") ;
			$upd_level_three->execute();
            
            $level_four = filter_var($_POST['level_four'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_four = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_four."' where buyer_level_id = '4'") ;
			$upd_level_four->execute();
            
            $level_five = filter_var($_POST['level_five'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_five = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_five."' where buyer_level_id = '5'") ;
			$upd_level_five->execute();
            
            $level_six = filter_var($_POST['level_six'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_six = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_six."' where buyer_level_id = '6'") ;
			$upd_level_six->execute();
            
            $level_seven = filter_var($_POST['level_seven'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_seven = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_seven."' where buyer_level_id = '7'") ;
			$upd_level_seven->execute();
            
            $level_eight = filter_var($_POST['level_eight'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_eight = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_eight."' where buyer_level_id = '8'") ;
			$upd_level_eight->execute();
            
            $level_nine = filter_var($_POST['level_nine'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_nine = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_nine."' where buyer_level_id = '9'") ;
			$upd_level_nine->execute();
            
            $level_ten = filter_var($_POST['level_ten'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_ten = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_ten."' where buyer_level_id = '10'") ;
			$upd_level_ten->execute();
            
            $level_eleven = filter_var($_POST['level_eleven'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_eleven = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_eleven."' where buyer_level_id = '11'") ;
			$upd_level_eleven->execute();
            
            $level_twelve = filter_var($_POST['level_twelve'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_twelve = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_twelve."' where buyer_level_id = '12'") ;
			$upd_level_twelve->execute();
            
            $level_thirteen = filter_var($_POST['level_thirteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_thirteen = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_thirteen."' where buyer_level_id = '13'") ;
			$upd_level_thirteen->execute();
            
            $level_fourteen = filter_var($_POST['level_fourteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_fourteen = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_fourteen."' where buyer_level_id = '14'") ;
			$upd_level_fourteen->execute();
            
            $level_fifteen = filter_var($_POST['level_fifteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_fifteen = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_fifteen."' where buyer_level_id = '15'") ;
			$upd_level_fifteen->execute();
            
            $level_sixteen = filter_var($_POST['level_sixteen'], FILTER_SANITIZE_NUMBER_INT);
			$upd_level_sixteen = $pdo->prepare("update ot_buyer_level_requirement set buyer_level_purchased = '".$level_sixteen."' where buyer_level_id = '16'") ;
			$upd_level_sixteen->execute();
            
            $powerEliteBuyer = filter_var($_POST['powerEliteBuyer'], FILTER_SANITIZE_NUMBER_INT);
            $eliteBuyer = filter_var($_POST['eliteBuyer'], FILTER_SANITIZE_NUMBER_INT);
			$upd_buyer = $pdo->prepare("update ot_admin set elite_buyer_requirement = '".$eliteBuyer."' , power_elite_buyer_requirement = '".$powerEliteBuyer."' where id = '1'") ;
			$upd_buyer->execute();
            
			echo "Buyer Badges Settings saved Successfully";
			
		} else {
			echo "Error : All Levels is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'itemUpdateDecision')
	{
        if(!empty($_POST['itemId']) && !empty($_POST['status']) ){
            $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT);
            $status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
            $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
            $authorId = find_user_id_by_itemid($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $nLink = BASE_URL.'video/'.$itemId.'/'.$itemUrlTitle ;
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            $userfullname = user_fullname_by_id($pdo,$authorId) ;
            $useremail = useremail_by_id($pdo,$authorId) ;
            
            $previewImage = find_edit_image($pdo,$itemId) ;
            $demoVideo = find_edit_video($pdo,$itemId) ;
            $mainfile = find_edit_file($pdo,$itemId) ;
            $updateCatId = find_updatecategory_id($pdo,$itemId) ;
            $updatedfileSize = updated_mainfilesize_by_id($pdo,$itemId) ;
            
            $liveImage = find_live_image($pdo,$itemId) ;
            $liveVideo = find_live_video($pdo,$itemId) ;
            $liveFile = find_live_file($pdo,$itemId) ;
            
            $tempImageDirectory = "../../tmpImg/"; 
            $tempVideoDirectory = "../../tmpVideos/"; 
            $tempFileDirectory = "../../tmpFiles/";
            $mainImageDirectory = "../../mainImg/";
            $mainVideoDirectory = "../../mainVideos/";
            $mainFileDirectory = "../../mainFiles/";
            
            if($status == '2'){
                //delete rejected item update image from server
                unlink($tempImageDirectory.$previewImage); 

                //delete rejected item update demo video from server
                unlink($tempVideoDirectory.$demoVideo); 

                //delete rejected item update main file from server
                unlink($tempFileDirectory.$mainfile); 

                $upd = $pdo->prepare("DELETE FROM `ot_users_video_update` WHERE update_item_id = '".$itemId."'") ;
                $upd->execute();
                $updStatus = $pdo->prepare("update ot_users_update_status set status_approved = 'Update Rejected' , status_reviewer_comment = '".$comment."' where status_item_id = '".$itemId."' and status_approved = 'Pending'");
                $updStatus->execute() ;
                
                $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('5', '".$authorId."', '".$nLink."' ) ");
                $insNotification->execute();
                
                $itemUpdateReject = want_email_on_item_update_reject($pdo,$authorId) ;
                
                //***************************************** Send Email **************************************************
                
                if($itemUpdateReject == '1'){
                    $to = $useremail ;
                    $subject = "Your Item Update is Rejected.";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    include("../../emailTemplates/send_update_reject_email.php");
                    mail($to, $subject, $body, $headers);
                }
            }
            
            if($status == '1'){
                
                
                if(!empty($previewImage)){
                    $upd = $pdo->prepare("update ot_users_video set item_preview_image = '".$previewImage."' where item_id = '".$itemId."'");
                    $upd->execute() ;
                    rename($tempImageDirectory.$previewImage , $mainImageDirectory.$previewImage) ;
                    //delete old item image from server
                    unlink($mainImageDirectory.$liveImage); 
                }
                
                if(!empty($demoVideo)){
                    $upd = $pdo->prepare("update ot_users_video set item_demo_video = '".$demoVideo."' where item_id = '".$itemId."'");
                    $upd->execute() ;
                    rename($tempVideoDirectory.$demoVideo , $mainVideoDirectory.$demoVideo) ;
                    //delete old item  demo video from server
                    unlink($mainVideoDirectory.$liveVideo);
                }
                
                if(!empty($mainfile)){
                    $upd = $pdo->prepare("update ot_users_video set item_mainfile = '".$mainfile."', item_mainfile_size = '".$updatedfileSize."' where item_id = '".$itemId."'");
                    $upd->execute() ;
                    rename($tempFileDirectory.$mainfile , $mainFileDirectory.$mainfile) ;
                    //delete old item  main file from server
                    unlink($mainFileDirectory.$liveFile); 
                    
                 //***************************************** Send Email to Buyers **************************************************
                    $itemEmail = $pdo->prepare("select purchase_user_id from ot_user_purchases where purchase_item_id = '".$itemId."'") ;
                    $itemEmail->execute() ;
                    $resultEmail = $itemEmail->fetchAll();
                    foreach($resultEmail as $newrow){
                        $buyerId = _e($newrow['purchase_user_id']) ;
                        $buyerName = user_fullname_by_id($pdo,$buyerId) ;
                        $buyeremail = useremail_by_id($pdo,$buyerId) ;
                        if(checking_salereversal_users($pdo,$buyerId) == '0'){
                            $to = $buyeremail ;
                            $subject = "Your Purchased Item Update is Available.";
                            $headers  = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                            $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$buyeremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                            include("../../emailTemplates/send_update_approve_emailtobuyer.php");
                            mail($to, $subject, $body, $headers);
                        }
                        
                    }
                }
                $time = date("Y-m-d h:i:s") ;
                $upd = $pdo->prepare("update ot_users_video set item_category = '".$updateCatId."' , item_updated_time = '".$time."' where item_id = '".$itemId."'");
                $upd->execute() ;
                
                $updDel = $pdo->prepare("DELETE FROM `ot_users_video_update` WHERE update_item_id = '".$itemId."'") ;
                $updDel->execute();
                
                $updStatus = $pdo->prepare("update ot_users_update_status set status_approved = 'Update Approved' , status_reviewer_comment = '".$comment."' where status_item_id = '".$itemId."' and status_approved = 'Pending'");
                $updStatus->execute() ;
                
                $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('4', '".$authorId."', '".$nLink."' ) ");
                $insNotification->execute();
                
                $itemUpdateApprove = want_email_on_item_update_approved($pdo,$authorId) ;
                
                //***************************************** Send Email **************************************************
                
                if($itemUpdateApprove == '1'){
                    $to = $useremail ;
                    $subject = "Your Item Update is Approved.";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    include("../../emailTemplates/send_update_approve_email.php");
                    mail($to, $subject, $body, $headers);
                }
                
            }
            

            
        }
    }
    
    if($_POST['btn_action'] == 'fetchAdminRefundInfo')
	{	
		if(!empty($_POST['id'])){
			$txnId = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
            
            if(check_strong_transactionid($pdo,$txnId) > 0){
                $announce = $pdo->prepare("select * from ot_refunds where r_txn_id = '".$txnId."'");
                $announce->execute();
                $result = $announce->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row) {
                    $output['userReason'] = strip_tags($row['r_user_reason']) ;
                    $output['authorReason'] = strip_tags($row['r_author_reason']) ;
                    $output['tsnId'] = $txnId ;
                }
                echo json_encode($output) ;
            } else {
                echo "0" ;
            }
			
		} else {
			echo "Error : You cannot Manipulate the Data." ;
		}
	}
    
    if($_POST['btn_action'] == 'submitAdminRefundForm')
	{	
		if(!empty($_POST['tsnId']) && !empty($_POST['decision'])){
            $txnId = filter_var($_POST['tsnId'], FILTER_SANITIZE_STRING);
            $decision = filter_var($_POST['decision'], FILTER_SANITIZE_NUMBER_INT);
            $itemPrice = find_paidamt_by_txnid($pdo,$txnId); 
            $itemId = find_itemid_by_txnid($pdo,$txnId) ; 
            $authorId = find_authorid_by_txnid($pdo,$txnId) ;
            $buyerId = find_buyerid_by_txnid($pdo,$txnId) ;
            $buyerWallet = find_userwallet_amt($pdo,$buyerId) ;
            $newBuyerWallet = ($buyerWallet + find_paidamt_by_txnid($pdo,$txnId)) ;
            $userPurchaseCount = (count_user_all_purchases($pdo,$buyerId) - 1) ;
            $saleCount = (active_itemsales_by_id($pdo,$itemId) - 1 ) ;
            $authorUsername = get_username_by_itemid($pdo,$itemId) ;
            $authorSaleCount = (user_solditems_by_username($pdo,$authorUsername) - 1) ;
            $authorSoldAmount = (count_author_sold_amount($pdo,$authorId) - find_paidamt_by_txnid($pdo,$txnId)) ;
            if(check_strong_transactionid($pdo,$txnId) > 0){
                if($decision == '1'){
                    $updAccept = $pdo->prepare("update ot_refunds set r_status = '1' where  r_txn_id = '".$txnId."'") ;
                    $updAccept->execute() ;

                    // ***************** Send Admin  Accept Refund Decision Email to Buyer *******************************
                    
                    $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
                    $imageName = find_live_image($pdo,$itemId) ;
                    $userfullname = user_fullname_by_id($pdo,$buyerId) ;
                    $buyeremail = useremail_by_id($pdo,$buyerId) ;
                    $adminName = admin_name($pdo) ;
                    $adminCopyrightName = admin_copyright_name($pdo);
                    $to = $buyeremail ;
                    $subject = "Dispute Decision in Favor of Buyer.";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$buyeremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    include("../../emailTemplates/send_adminrefundaccept_email_to_buyer.php");
                    mail($to, $subject, $body, $headers);
                    
                    $walletUpdate = $pdo->prepare("update ot_users set user_wallet = '".$newBuyerWallet."', user_purchased_items = '".$userPurchaseCount."' where id='".$buyerId."'") ;
                    $walletUpdate->execute() ;
                    $deletePurchasedItem = $pdo->prepare("DELETE FROM `ot_user_purchases` WHERE purchase_item_id = '".$itemId."' and purchase_user_id = '".$buyerId."'") ;
                    $deletePurchasedItem->execute() ;
                    $updateSale = $pdo->prepare("update ot_users_video set item_sale = '".$saleCount."' where item_id = '".$itemId."'");
                    $updateSale->execute() ;
                    $updateAuthor = $pdo->prepare("update ot_users set user_sold_items = '".$authorSaleCount."' , user_sold_price = '".$authorSoldAmount."' where id='".$authorId."'");
                    $updateAuthor->execute();
                    $authorEarned = get_authorearned_by_transactionid($pdo,$txnId) ; 
                    if(check_transactionid_paid($pdo,$txnId) > 0){
                        $ins = $pdo->prepare("insert into ot_author_statement (s_txn_id, author_id, s_item_id, s_author_earning, s_type, s_paid) values ('".$txnId."', '".$authorId."', '".$itemId."', '".$authorEarned."', '2', '1',)") ;
                        $ins->execute() ;
                    } else {
                        $update = $pdo->prepare("update ot_author_statement set s_type = '2' where s_txn_id = '".$txnId."'");
                        $update->execute() ;
                    }
                    $sel = $pdo->prepare("select * from ot_ratings where rating_item_id = '".$itemId."' and rating_user_id = '".$buyerId."'");
                    $sel->execute();
                    $result = $sel->fetchAll();
                    $total = $sel->rowCount();
                    if($total > 0){
                        foreach($result as $row){
                            $ratingId = _e($row['rating_id']) ;
                            $rating = _e($row['rating_star']) ;
                            $userId = _e($row['rating_user_id']) ;
                            $itemId = _e($row['rating_item_id']) ;
                        }
                        $ratedBy = grab_rated_by($pdo,$itemId) ;
                        $oldRating = (grab_rating_ofitem($pdo,$itemId) * $ratedBy) ;
                        $oldRating = ($oldRating - $rating) ; 
                        $newratedBy = ($ratedBy - 1) ;
                        $newRating = ($oldRating / $newratedBy) ;

                        $updateItemRating = $pdo->prepare("update ot_users_video set item_rating = '".$newRating."' , item_rated_by = '".$newratedBy."' where item_id = '".$itemId."'") ;
                        $updateItemRating->execute();

                        $updDelete = $pdo->prepare("delete from ot_ratings where rating_id = '".$ratingId."'") ;
                        $updDelete->execute() ;
                    }                    
                    
                } else {
                    $upd = $pdo->prepare("update ot_refunds set r_status = '2' where  r_txn_id = '".$txnId."'") ;
                    $upd->execute() ;
                    // ***************** Send Admin Declined Refund Decision Email to Buyer *******************************
                        $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
                        $imageName = find_live_image($pdo,$itemId) ;
                        $userfullname = user_fullname_by_id($pdo,$buyerId) ;
                        $buyeremail = useremail_by_id($pdo,$buyerId) ;
                        $adminName = admin_name($pdo) ;
                        $adminCopyrightName = admin_copyright_name($pdo);
                        $to = $buyeremail ;
                        $subject = "Dispute Decision in Favor of Author.";
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                        $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$buyeremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                        include("../../emailTemplates/send_adminrefunddeclined_email_to_buyer.php");
                        mail($to, $subject, $body, $headers);
                }
            }
            
            // ***************** Send Author Decision to User *******************************
        }
    }
    
    if($_POST['btn_action'] == 'saveMainSettings')
	{
        $adminName = filter_var($_POST['adminName'], FILTER_SANITIZE_STRING) ;
		$quickLinkName = filter_var($_POST['quickLinkName'], FILTER_SANITIZE_STRING) ;
		$aboutusName = filter_var($_POST['aboutusName'], FILTER_SANITIZE_STRING) ;
		$aboutUsInfo =  filter_var($_POST['aboutUsInfo'], FILTER_SANITIZE_STRING) ;
		$copyrightName = filter_var($_POST['copyrightName'], FILTER_SANITIZE_STRING) ;
		$on_load = filter_var($_POST['on_load'], FILTER_SANITIZE_NUMBER_INT) ;
		$default_load = filter_var($_POST['default_load'], FILTER_SANITIZE_NUMBER_INT) ;
        $commission = filter_var($_POST['commission'], FILTER_SANITIZE_NUMBER_INT) ;
        $minWallet = filter_var($_POST['minwallet'], FILTER_SANITIZE_NUMBER_INT) ;
        $maxWallet = filter_var($_POST['maxwallet'], FILTER_SANITIZE_NUMBER_INT) ;
        $community = filter_var($_POST['show_community'], FILTER_SANITIZE_NUMBER_INT) ;
        $maxrefund = filter_var($_POST['maxrefund'], FILTER_SANITIZE_NUMBER_INT) ;
        $userpanel = filter_var($_POST['userpanel'], FILTER_SANITIZE_NUMBER_INT) ;
        $panelmsg =  filter_var($_POST['panelmsg'], FILTER_SANITIZE_STRING) ;
        $otpchances = filter_var($_POST['otpchances'], FILTER_SANITIZE_NUMBER_INT) ;
        $payoutday = filter_var($_POST['payoutday'], FILTER_SANITIZE_NUMBER_INT) ;
        $stripe = filter_var($_POST['stripe'], FILTER_SANITIZE_NUMBER_INT) ;
        $paypal = filter_var($_POST['paypal'], FILTER_SANITIZE_NUMBER_INT) ;
        if($community == '1'){
            $community = 1 ;
        } else {
            $community = 0 ;
        }
        if($userpanel == '1'){
            $userpanel = 1 ;
        } else {
            $userpanel = 0 ;
        }
        if($stripe == '1'){
            $stripe = 1 ;
        } else {
            $stripe = 0 ;
        }
        if($paypal == '1'){
            $paypal = 1 ;
        } else {
            $paypal = 0 ;
        }
        
		$statement = $pdo->prepare("update ot_admin set adm_name = '".$adminName."', link_name = '".$quickLinkName."', about_us_name = '".$aboutusName."', about_us_info = '".$aboutUsInfo."', copyright_name = '".$copyrightName."', on_load = '".$on_load."', default_load = '".$default_load."' , commission = '".$commission."' , min_wallet = '".$minWallet."' , max_wallet = '".$maxWallet."' , show_community_earning = '".$community."' , refund_max_day = '".$maxrefund."' , show_user_panel = '".$userpanel."' , user_panel_message = '".$panelmsg."' , user_chance = '".$otpchances."'  , send_payout_day = '".$payoutday."' ,  stripe_on = '".$stripe."' , paypal_on = '".$paypal."' where id = '1'");
		$statement->execute() ;
    }
    
    if($_POST['btn_action'] == 'saveSocialSettings')
	{
        $instaUrl = filter_var($_POST['instaUrl'], FILTER_SANITIZE_URL) ;
        $fbUrl = filter_var($_POST['fbUrl'], FILTER_SANITIZE_URL) ;
        $twitterUrl = filter_var($_POST['twitterUrl'], FILTER_SANITIZE_URL) ;
        $linkedinUrl = filter_var($_POST['linkedinUrl'], FILTER_SANITIZE_URL) ;
        $behanceUrl = filter_var($_POST['behanceUrl'], FILTER_SANITIZE_URL) ;
        $dribbleUrl = filter_var($_POST['dribbleUrl'], FILTER_SANITIZE_URL) ;
        $vkUrl = filter_var($_POST['vkUrl'], FILTER_SANITIZE_URL) ;

        $upd = $pdo->prepare("update ot_admin set insta_url = '".$instaUrl."', fb_url = '".$fbUrl."', twitter_url = '".$twitterUrl."', linkedin_url = '".$linkedinUrl."', behance_url = '".$behanceUrl."', dribble_url = '".$dribbleUrl."', vk_url = '".$vkUrl."' where id = '1'") ;
        $upd->execute();
    }
    
    if($_POST['btn_action'] == 'saveGASettings')
	{
        $gCode = base64_encode($_POST['gCode']) ;
        $gCode = filter_var($gCode, FILTER_SANITIZE_STRING) ;
        $userOn = filter_var($_POST['userOn'], FILTER_SANITIZE_NUMBER_INT) ;
        $adminOn = filter_var($_POST['adminOn'], FILTER_SANITIZE_NUMBER_INT) ;

        $upd = $pdo->prepare("update ot_admin set g_code = '".$gCode."', admin_on = '".$adminOn."', user_on = '".$userOn."' where id = '1'") ;
        $upd->execute();
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
    
    if($_POST['btn_action'] == 'makeItemFeatured')
	{
		if(!empty($_POST['id']) ){
			$itemId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."' and item_status='1' and item_pause = '1' and item_featured = '0'";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $total = $statement->rowCount();
            if($total > 0){
                $authorId = find_user_id_by_itemid($pdo,$itemId) ;
                $upd = $pdo->prepare("update ot_users_video set item_featured = '1' WHERE item_id='".$itemId."'") ;
                $upd->execute() ;
                $ins = $pdo->prepare("insert into ot_featured (featured_item_id) values ('".$itemId."') ") ;
                $ins->execute();
                if(check_featuredfile_badge($pdo,$authorId) == '0'){
                    $insAuthor = $pdo->prepare("insert into ot_featured_author_file (featured_file_user_id) values ('".$authorId."')");
                    $insAuthor->execute();
                } 
                echo "Item is Featured Now." ;
            } else {
                echo "Error : Either Item is disabled or paused." ;
            }
            			
		} else {
			echo "Error : Item ID is mandatory to make Item Featured." ;
		}
	}
    
    if($_POST['btn_action'] == 'makeItemFeaturedAgain')
	{
		if(!empty($_POST['id']) ){
			$itemId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."' and item_status='1' and item_pause = '1' and item_featured = '1'";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $total = $statement->rowCount();
            if($total > 0){
                $del = $pdo->prepare("delete from ot_featured where featured_item_id = '".$itemId."'") ;
                $del->execute() ;
                $ins = $pdo->prepare("insert into ot_featured (featured_item_id) values ('".$itemId."') ") ;
                $ins->execute();
                echo "Item is Featured Again Now." ;
            } else {
                echo "Error : Either Item is disabled or paused." ;
            }
            			
		} else {
			echo "Error : Item ID is mandatory to make Item Featured." ;
		}
	}
    
    if($_POST['btn_action'] == 'wantBreakUpModal')
	{
        if(!empty($_POST['id']) && !empty($_POST['status'])  ){
            $authorId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $endDate = base64_decode($_POST['status']) ;
            $endTimeStamp = " 23:59:59" ;
            $endTimeStamp = $endDate.$endTimeStamp ;
            $newEndDate = base64_encode($endDate) ;
            $output = "" ;
            $new = $pdo->prepare("select * from ot_author_statement WHERE s_time <= '".$endTimeStamp."' and author_id = '".$authorId."' and s_paid = 0") ;
            $new->execute() ;
            $newtotal = $new->rowCount();
            if($newtotal > 0){
                $output .= grab_author_unpaid_breakups($pdo,$authorId,$newEndDate) ;
                echo $output ;
            } else {
                $output .= grab_author_paid_breakups($pdo,$authorId,$newEndDate) ;
                echo $output ;
            }
        }
    }
    
    if($_POST['btn_action'] == 'fetchAuthorPayout')
	{
        if(!empty($_POST['id']) && !empty($_POST['status'])  ){
            $authorId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $payoutAmt = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION) ;
            $curMonth = date("m") ;
            $curYear = date("Y") ;
            $curMonthYear = date($curYear."-".$curMonth) ;
            $previousMonthYear = date('Y-m', strtotime($curMonthYear." -1 month"));
            $previousMonth = strtotime($previousMonthYear);
            $previousMonth = date("m",$previousMonth) ;
            $concatPreviousYear = date("Y",strtotime($previousMonthYear)) ;
            $endDate = date($concatPreviousYear."-".$previousMonth."-31");
            $authorPayout = grab_author_total_unpaidamount_monthly($pdo,$authorId,$endDate) ; 
            $authorPayoutEmail = user_payout_email_for_admin($pdo,$authorId) ;
            $authorEmail = useremail_by_id($pdo,$authorId) ;
            $output['authorId'] = $authorId ;
            $output['payoutAmt'] = $authorPayout ;
            $output['payoutEmail'] = $authorPayoutEmail ;
			
			echo json_encode($output) ;
        }
    }
    
    if($_POST['btn_action'] == 'sendPayoutToAuthor')
	{
        if(!empty($_POST['payoutEmail']) && !empty($_POST['payoutAmt']) && !empty($_POST['txnId']) && !empty($_POST['authorId']) && !empty($_POST['monName']) && !empty($_POST['year'])  ){
            $payoutEmail = filter_var($_POST['payoutEmail'], FILTER_SANITIZE_EMAIL) ;
            $payoutAmt = filter_var($_POST['payoutAmt'], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION) ;
            $txnId = filter_var($_POST['txnId'], FILTER_SANITIZE_STRING) ;
            $authorId = filter_var($_POST['authorId'], FILTER_SANITIZE_NUMBER_INT) ;
            $monName = filter_var($_POST['monName'], FILTER_SANITIZE_STRING) ;
            $year = filter_var($_POST['year'], FILTER_SANITIZE_NUMBER_INT) ;
            $authorEmail = useremail_by_id($pdo,$authorId) ;
            $userfullname = user_fullname_by_id($pdo,$authorId) ;
            
            
            
            $ins = $pdo->prepare("insert into ot_author_payouts (p_txn_id, p_author_id, p_month, p_year, payout_amt, payout_method, paypal_email) values ('".$txnId."' , '".$authorId."' , '".$monName."' , '".$year."' , '".$payoutAmt."' , 'Paypal' , '".$payoutEmail."' ) ");
            $ins->execute() ;
            if($ins){
                $statement = $pdo->prepare("update ot_author_statement set s_paid = '1' where author_id = '".$authorId."' and s_type = '1'");
                $statement->execute();
                $adminName = admin_name($pdo) ;
                $adminCopyrightName = admin_copyright_name($pdo);
                $to = $authorEmail ;
                $subject = "Celebrations ! It's a Payout Day.";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$authorEmail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                include("../../emailTemplates/send_payout_email.php");
                mail($to, $subject, $body, $headers);

                echo "Payout & Email has been sent to Author." ;
            } else {
                echo "Error : Transaction Id should be unique." ;
            }
            
            
            
        } else {
            echo "Error : Something goes wrong. Try again." ;
        }

    }
    
    if($_POST['btn_action'] == 'itemsaleReversal')
	{	
		if(!empty($_POST['id'])){
            $txnId = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
            $itemPrice = find_paidamt_by_txnid($pdo,$txnId); 
            $itemId = find_itemid_by_txnid($pdo,$txnId) ; 
            $authorId = find_authorid_by_txnid($pdo,$txnId) ;
            $buyerId = find_buyerid_by_txnid($pdo,$txnId) ;
            $saleCount = (active_itemsales_by_id($pdo,$itemId) - 1 ) ;
            $authorUsername = get_username_by_itemid($pdo,$itemId) ;
            $authorSaleCount = (user_solditems_by_username($pdo,$authorUsername) - 1) ;
            $authorSoldAmount = (count_author_sold_amount($pdo,$authorId) - find_paidamt_by_txnid($pdo,$txnId)) ;
            if(check_strong_statement_transactionid($pdo,$txnId) > 0){
                $blockUser = $pdo->prepare("update ot_users set user_blocked = '1' where id = '".$buyerId."'") ;
                $blockUser->execute() ;
                $blockPurchasedItem = $pdo->prepare("update `ot_user_purchases` set download_block = '1' WHERE purchase_user_id = '".$buyerId."'") ;
                $blockPurchasedItem->execute() ;
                $updateSale = $pdo->prepare("update ot_users_video set item_sale = '".$saleCount."' where item_id = '".$itemId."'");
                $updateSale->execute() ;
                $updateAuthor = $pdo->prepare("update ot_users set user_sold_items = '".$authorSaleCount."' , user_sold_price = '".$authorSoldAmount."' where id='".$authorId."'");
                $updateAuthor->execute();
                $authorEarned = get_authorearned_by_transactionid($pdo,$txnId) ; 
                if(check_transactionid_paid($pdo,$txnId) > 0){
                    $ins = $pdo->prepare("insert into ot_author_statement (s_txn_id, author_id, s_item_id, s_author_earning, s_type, s_paid) values ('".$txnId."', '".$authorId."', '".$itemId."', '".$authorEarned."', '0', '1',)") ;
                    $ins->execute() ;
                } else {
                    $update = $pdo->prepare("update ot_author_statement set s_type = '0' where s_txn_id = '".$txnId."'");
                    $update->execute() ;
                }
                $sel = $pdo->prepare("select * from ot_ratings where rating_item_id = '".$itemId."' and rating_user_id = '".$buyerId."'");
                $sel->execute();
                $result = $sel->fetchAll();
                $total = $sel->rowCount();
                if($total > 0){
                    foreach($result as $row){
                        $ratingId = _e($row['rating_id']) ;
                        $rating = _e($row['rating_star']) ;
                        $userId = _e($row['rating_user_id']) ;
                        $itemId = _e($row['rating_item_id']) ;
                    }
                    $ratedBy = grab_rated_by($pdo,$itemId) ;
                    $oldRating = (grab_rating_ofitem($pdo,$itemId) * $ratedBy) ;
                    $oldRating = ($oldRating - $rating) ;
                    if($ratedBy > '1'){
                        $newratedBy = ($ratedBy - 1) ;
                    } else {
                        $newratedBy = $ratedBy ;                        
                    }
                    
                    $newRating = ($oldRating / $newratedBy) ;
                    
                    $updateItemRating = $pdo->prepare("update ot_users_video set item_rating = '".$newRating."' , item_rated_by = '".$newratedBy."' where item_id = '".$itemId."'") ;
                    $updateItemRating->execute();

                    $updDelete = $pdo->prepare("delete from ot_ratings where rating_id = '".$ratingId."'") ;
                    $updDelete->execute() ;
                }
                echo "Sale Reversed Successfully & User is blocked." ;
            } else {
                echo "Error : Manipulated Transaction Id. Try Again." ;
            }
            
        }
    }
    
    if($_POST['btn_action'] == 'deleteReportedComment')
	{	
		if(!empty($_POST['id'])){
            $commentId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            
            $commentDelete = $pdo->prepare("delete from ot_comments where comment_id = '".$commentId."'") ;
            $commentDelete->execute() ;
            
            $commentReplyDelete = $pdo->prepare("delete from ot_comment_thread where thread_comment_id = '".$commentId."'") ;
            $commentReplyDelete->execute() ;
            
            echo "Comment Deleted Successfully." ;
            
        }
    }
    
    if($_POST['btn_action'] == 'denyReportedComment')
	{	
		if(!empty($_POST['id'])){
            $commentId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            
            $commentUpdate = $pdo->prepare("update ot_comments set author_report = '0' where comment_id = '".$commentId."'") ;
            $commentUpdate->execute() ;
            
            echo "Report Denied Successfully." ;
            
        }
    }
    
    if($_POST['btn_action'] == 'deleteReportedReply')
	{	
		if(!empty($_POST['id'])){
            $commentThreadId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                        
            $commentReplyDelete = $pdo->prepare("delete from ot_comment_thread where comment_thread_id = '".$commentThreadId."'") ;
            $commentReplyDelete->execute() ;
            
            echo "Comment Reply Deleted Successfully." ;
            
        }
    }
    
    if($_POST['btn_action'] == 'denyReportedReply')
	{	
		if(!empty($_POST['id'])){
            $commentThreadId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            
            $commentUpdate = $pdo->prepare("update ot_comment_thread set thread_report = '0' where comment_thread_id = '".$commentThreadId."'") ;
            $commentUpdate->execute() ;
            
            echo "Comment Reply Report Denied Successfully." ;
            
        }
    }
    
    if($_POST['btn_action'] == 'deleteReportedRating')
	{	
		if(!empty($_POST['id'])){
            $ratingId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                        
            $ratingDelete = $pdo->prepare("delete from ot_ratings where rating_id = '".$ratingId."'") ;
            $ratingDelete->execute() ;
            
            echo "User Rating Deleted Successfully." ;
            
        }
    }
    
    if($_POST['btn_action'] == 'denyReportedRating')
	{	
		if(!empty($_POST['id'])){
            $ratingId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            
            $sel = $pdo->prepare("select * from ot_ratings where rating_id = '".$ratingId."'");
            $sel->execute();
            $result = $sel->fetchAll();
            $total = $sel->rowCount();
            if($total > 0){
                foreach($result as $row){
                    $ratingId = _e($row['rating_id']) ;
                    $rating = _e($row['rating_star']) ;
                    $userId = _e($row['rating_user_id']) ;
                    $itemId = _e($row['rating_item_id']) ;
                }
                
                $ratedBy = grab_rated_by($pdo,$itemId) ;
                $oldRating = grab_rating_ofitem($pdo,$itemId) ; 
                $oldRating = ($oldRating * $ratedBy) ;
                $newRating = $oldRating + $rating ;
                $newRatedBy = ( $ratedBy + 1 )  ;
                $newRating = ( $newRating / $newRatedBy ) ;
                $upd = $pdo->prepare("update ot_ratings set rating_report = '0' where rating_id = '".$ratingId."'") ;
                $upd->execute();
                $updateItemRating = $pdo->prepare("update ot_users_video set item_rating='".$newRating."' , item_rated_by = '".$newRatedBy."' where item_id = '".$itemId."' ") ;
                $updateItemRating->execute() ;
                
                
            }
            
            echo "Rating Report Denied Successfully." ;
            
        }
    }
    
    if($_POST['btn_action'] == 'disableActiveItem')
	{	
		if(!empty($_POST['id'])){
            $itemId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $upd = $pdo->prepare("update ot_users_video set item_status = '0' where item_id = '".$itemId."'") ;
            $upd->execute() ;
            echo "Item Disabled Successfully." ;
        }
    }
    
    if($_POST['btn_action'] == 'enableDisabledItem')
	{	
		if(!empty($_POST['id'])){
            $itemId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $upd = $pdo->prepare("update ot_users_video set item_status = '1' where item_id = '".$itemId."'") ;
            $upd->execute() ;
            echo "Item Enabled Successfully." ;
        }
    }
    
    if($_POST['btn_action'] == 'completedeleteDisabledItem')
	{	
		if(!empty($_POST['id'])){
            $itemId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            
            $liveVideo = find_live_video($pdo,$itemId) ;
            $liveFile = find_live_file($pdo,$itemId) ;
            
            $mainVideoDirectory = "../../mainVideos/";
            $mainFileDirectory = "../../mainFiles/";
            
            //delete demo video from server
            unlink($mainVideoDirectory.$liveVideo); 

            //delete main file from server
            unlink($mainFileDirectory.$liveFile); 
            
            $upd = $pdo->prepare("update ot_users_video set item_status = '0' , item_delete = '0' , item_pause = '1' , item_mainfile = '' , item_mainfile_size = '' , item_demo_video = ''  where item_id = '".$itemId."'") ;
            $upd->execute() ;
            echo "Item Deleted Successfully." ;
        }
    }
    
    if($_POST['btn_action'] == 'change_admin_password')
	{
        $oldpass = filter_var($_POST['oldpass'], FILTER_SANITIZE_STRING) ;
		$newpass = filter_var($_POST['newpass'], FILTER_SANITIZE_STRING) ;
		$repass = filter_var($_POST['repass'], FILTER_SANITIZE_STRING) ;
		$id = filter_var("1", FILTER_SANITIZE_NUMBER_INT) ;
		$uppercase = preg_match('@[A-Z]@', $newpass);
		$lowercase = preg_match('@[a-z]@', $newpass);
		$number    = preg_match('@[0-9]@', $newpass);
		$statement = $pdo->prepare("select * from ot_admin where id = ?");
		$statement->execute(array($id)) ;
		$result = $statement->fetchAll(PDO::FETCH_ASSOC); 
		$user_ok = $statement->rowCount();
		if($user_ok > 0) {
			foreach($result as $row){
				$auth_pass = _e($row['adm_password']) ;
			}
			if(password_verify($oldpass, $auth_pass)) {
				if($newpass == $repass) {
					//validate password
					if(!$uppercase || !$lowercase || !$number || strlen($newpass) < 8) {
						$form_message = "Password must contain 8 characters, an uppercase character, a lowercase character & atleast 1 number. Try Again.";
						$output = array( 
								'form_message' => $form_message
								) ;
						echo json_encode($output);
					} else {
						$update_password = $pdo->prepare("update ot_admin set adm_password = ? where id = ?");
						$update_password->execute(array(password_hash($newpass, PASSWORD_DEFAULT),$id));
						$form_message = "Password Updated Successfully.";
						$output = array( 
								'form_message' => $form_message
								) ;
						echo json_encode($output);
					}
				} else {
					$form_message = "Password & Confirm Password is not Match. Try Again.";
					$output = array( 
							'form_message' => $form_message
							) ;
					echo json_encode($output);
				}
			} else {
				$form_message = "Old Password is wrong. Try Again.";
				$output = array( 
						'form_message' => $form_message
						) ;
				echo json_encode($output);
			}
		} else {
			$form_message = "This is not authorized admin.";
			$output = array( 
					'form_message' => $form_message
					) ;
			echo json_encode($output);
		}
    }
    
    if($_POST['btn_action'] == 'change_admin_email')
	{
        $oldpass = filter_var($_POST['passw'], FILTER_SANITIZE_STRING) ;
		$newemail = filter_var($_POST['newemail'], FILTER_SANITIZE_EMAIL) ;
		$id = filter_var("1", FILTER_SANITIZE_NUMBER_INT) ;
		$statement = $pdo->prepare("select * from ot_admin where id = ?");
		$statement->execute(array($id)) ;
		$result = $statement->fetchAll(PDO::FETCH_ASSOC); 
		$user_ok = $statement->rowCount();
		if($user_ok > 0) {
			foreach($result as $row){
				$auth_pass = _e($row['adm_password']) ;
			}
			//validate password
			if(password_verify($oldpass, $auth_pass)) {
					$update_password = $pdo->prepare("update ot_admin set adm_email = ? where id = ?");
					$update_password->execute(array($newemail,$id));
					$form_message = "Email Updated Successfully.";
					$output = array( 
							'form_message' => $form_message
							) ;
					echo json_encode($output);
				
			} else {
				$form_message = "Password is wrong. Try Again.";
				$output = array( 
						'form_message' => $form_message
						) ;
				echo json_encode($output);
			}
		} else {
			$form_message = "This is not authorized admin.";
			$output = array( 
					'form_message' => $form_message
					) ;
			echo json_encode($output);
		}
    }
    
    if($_POST['btn_action'] == 'fetchUserDetails')
	{	
		if(!empty($_POST['id'])){
			$userId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$username = username_by_id($pdo,$userId) ;
            $fullname = user_fullname_by_id($pdo,$userId) ;
            $walletbalance = find_userwallet_amt($pdo,$userId) ;
            
            $output['userId'] = $userId ;
            $output['username'] = $username ;
            $output['fullname'] = $fullname ;
            $output['walletbalance'] = $walletbalance ;
            
			
			echo json_encode($output) ;
		} else {
			echo "Error :User Id is mandatory." ;
		}
	}
    
    if($_POST['btn_action'] == 'sendCreditToUser')
	{	
		if(!empty($_POST['userId']) && !empty($_POST['addedamt'])){
            $userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);
            $credit = filter_var($_POST['addedamt'], FILTER_SANITIZE_NUMBER_INT);
			$username = username_by_id($pdo,$userId) ;
            $fullname = user_fullname_by_id($pdo,$userId) ;
            $walletbalance = find_userwallet_amt($pdo,$userId) ;
            $txnId = generate_wallet_txn_id($pdo) ;
            $method = "Added By Admin" ;
            
            $walletbalance = find_userwallet_amt($pdo,$userId) ;
            
            $newWalletBalance = ($walletbalance + $credit) ;
            
            $ins = $pdo->prepare("insert into ot_wallet (w_txn_id, w_user_id, w_amt, w_payment_method, w_payment_status, w_complete_status) values ('".$txnId."' , '".$userId."' , '".$credit."' , '".$method."' , 'Completed' , '1' ) ") ;
            $ins->execute() ;
            
            $upd = $pdo->prepare("update ot_users set user_wallet = '".$newWalletBalance."' where id = '".$userId."'");
            $upd->execute() ;
            
            echo "$".$credit." has been credited to User Wallet." ;
        } else {
            echo "Error : Something goes wrong. Try Again." ;
        } 
    }
    
    if($_POST['btn_action'] == 'blockActiveUser')
	{	
		if(!empty($_POST['id'])){
			$userId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $upd = $pdo->prepare("update ot_users set user_blocked = '1' where id = '".$userId."'");
            $upd->execute() ;
            
            echo "User Blocked Successfully." ;
        } else {
            echo "Error : UserId is mandatory to block" ;
        }
    }
    
    if($_POST['btn_action'] == 'unblockVerifiedUser')
	{	
		if(!empty($_POST['id'])){
			$userId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $upd = $pdo->prepare("update ot_users set user_blocked = '0' where id = '".$userId."'");
            $upd->execute() ;
            
            echo "User Unblocked Successfully." ;
        } else {
            echo "Error : UserId is mandatory to unblock" ;
        }
    }
    
}
?>