<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ; 
check_user_logged_in($pdo) ;


if(!empty($_FILES['profilefile']))
{
	$userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
	$targetDir = "profilePic/"; 
	$allowTypes = array('jpg', 'png', 'jpeg'); 
	$fileName = filter_var($_FILES["profilefile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["profilefile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	//delete old file if exist
	$statement = $pdo->prepare("select * from ot_users where id = '".$userId."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) {
		$previewfile_name = _e($row['user_dp']) ;
	} 
	if(in_array($fileType, $allowTypes)){ 
		//delete old image
		unlink($targetDir.$previewfile_name); 
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			$upd = $pdo->prepare("update ot_users set user_dp = '".$newfilename."' where id = '".$userId."'");
			$upd->execute();
        } 
    } 
} 

if(!empty($_FILES['previewEditfile']))
{
	$itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
	$targetDir = "tmpImg/"; 
	$allowTypes = array('jpg', 'png', 'jpeg'); 
	$fileName = filter_var($_FILES["previewEditfile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["previewEditfile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	//delete old file if exist
	$statement = $pdo->prepare("select * from ot_users_video_update where update_item_id = '".$itemId."' and update_user_id = '".$_SESSION['unprofessional']['id']."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $total = $statement->rowCount();
	foreach($result as $row) {
		$previewfile_name = _e($row['update_preview_image']) ;
	} 
	if(in_array($fileType, $allowTypes)){ 
		//delete old image
		unlink($targetDir.$previewfile_name); 
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
            if($total > 0){
                $upd = $pdo->prepare("update ot_users_video_update set update_preview_image = '".$newfilename."' where update_item_id = '".$itemId."' and update_user_id = '".$_SESSION['unprofessional']['id']."'");
                $upd->execute();
            } else {
                $ins = $pdo->prepare("insert into ot_users_video_update (update_item_id, update_user_id, update_preview_image) values ('".$itemId."', '".$_SESSION['unprofessional']['id']."' , '".$newfilename."')");
                $ins->execute();
            }
        } 
    } 
} 

if(!empty($_FILES['previewfile']))
{
	$tempId = filter_var($_POST['tempId'], FILTER_SANITIZE_NUMBER_INT) ;
	$targetDir = "tmpImg/"; 
	$allowTypes = array('jpg', 'png', 'jpeg'); 
	$fileName = filter_var($_FILES["previewfile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["previewfile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	//delete old file if exist
	$statement = $pdo->prepare("select * from ot_users_temp_video where temp_id = '".$tempId."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) {
		$previewfile_name = _e($row['item_preview_img']) ;
	} 
	if(in_array($fileType, $allowTypes)){ 
		//delete old image
		unlink($targetDir.$previewfile_name); 
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			$upd = $pdo->prepare("update ot_users_temp_video set item_preview_img = '".$newfilename."' where temp_id = '".$tempId."'");
			$upd->execute();
        } 
    } 
} 

if(!empty($_FILES['docuEditfile']))
{
	$itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
    $FileSize = number_format((($_POST['FileSize'] * 1024)/1000), 2);
	$targetDir = "tmpVideos/"; 
	$allowTypes = array('mp4', 'mov', 'wmv', 'flv', 'avi', 'webm', 'mkv', 'mpeg', 'ogg', 'mpg', 'mpv', 'm4p', 'm4p', 'm4v', 'qt' , 'swf', 'avchd'); 
	$fileName = filter_var($_FILES["docuEditfile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["docuEditfile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	//delete old file if exist
	$statement = $pdo->prepare("select * from ot_users_video_update where update_item_id = '".$itemId."' and update_user_id = '".$_SESSION['unprofessional']['id']."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $total = $statement->rowCount();
	foreach($result as $row) {
		$demovideofile_name = _e($row['update_demo_file']) ;
	} 
	if(in_array($fileType, $allowTypes)){
		//delete old file
		unlink($targetDir.$demovideofile_name); 
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			if($total > 0){
                $upd = $pdo->prepare("update ot_users_video_update set update_demo_file = '".$newfilename."' where update_item_id = '".$itemId."' and update_user_id = '".$_SESSION['unprofessional']['id']."'");
                $upd->execute();
            } else {
                $ins = $pdo->prepare("insert into ot_users_video_update (update_item_id, update_user_id, update_demo_file) values ('".$itemId."', '".$_SESSION['unprofessional']['id']."' , '".$newfilename."')");
                $ins->execute();
            }
			
        } 
    } 
} 

if(!empty($_FILES['mainEditfile']))
{
	$itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
    $FileSize = number_format((($_POST['FileSize'] * 1024)/1000), 2);
	$targetDir = "tmpFiles/"; 
	$allowTypes = array('zip'); 
	$fileName = filter_var($_FILES["mainEditfile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["mainEditfile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	//delete old file if exist
	$statement = $pdo->prepare("select * from ot_users_video_update where update_item_id = '".$itemId."' and update_user_id = '".$_SESSION['unprofessional']['id']."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $total = $statement->rowCount();
	foreach($result as $row) {
		$mainfile_name = _e($row['update_main_file']) ;
	} 
	if(in_array($fileType, $allowTypes)){
		//delete old file
		unlink($targetDir.$mainfile_name); 
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			if($total > 0){
                $upd = $pdo->prepare("update ot_users_video_update set update_main_file = '".$newfilename."', zip_size = '".$FileSize."' where update_item_id = '".$itemId."' and update_user_id = '".$_SESSION['unprofessional']['id']."'");
                $upd->execute();
            } else {
                $ins = $pdo->prepare("insert into ot_users_video_update (update_item_id, update_user_id, update_main_file, zip_size) values ('".$itemId."', '".$_SESSION['unprofessional']['id']."' , '".$newfilename."', '".$FileSize."')");
                $ins->execute();
            }
			
        } 
    } 
} 

if(!empty($_FILES['docufile']))
{
	$tempId = filter_var($_POST['tempId'], FILTER_SANITIZE_NUMBER_INT) ;
    $FileSize = number_format((($_POST['FileSize'] * 1024)/1000), 2);
	$targetDir = "tmpVideos/"; 
	$allowTypes = array('mp4', 'mov', 'wmv', 'flv', 'avi', 'webm', 'mkv', 'mpeg', 'ogg', 'mpg', 'mpv', 'm4p', 'm4p', 'm4v', 'qt' , 'swf', 'avchd'); 
	$fileName = filter_var($_FILES["docufile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["docufile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	//delete old file if exist
	$statement = $pdo->prepare("select item_demo_video from ot_users_temp_video where temp_id = '".$tempId."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) {
		$demovideofile_name = _e($row['item_demo_video']) ;
	} 
	if(in_array($fileType, $allowTypes)){
		//delete old file
		unlink($targetDir.$demovideofile_name); 
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			$upd = $pdo->prepare("update ot_users_temp_video set item_demo_video = '".$newfilename."' , item_demo_video_size='".$FileSize."' where temp_id = '".$tempId."'");
			$upd->execute();
			
        } 
    } 
} 

if(!empty($_FILES['mainfile']))
{
	$tempId = filter_var($_POST['tempId'], FILTER_SANITIZE_NUMBER_INT) ;
    $FileSize = number_format((($_POST['FileSize'] * 1024)/1000), 2);
	$targetDir = "tmpFiles/"; 
	$allowTypes = array('zip'); 
	$fileName = filter_var($_FILES["mainfile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["mainfile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	//delete old file if exist
	$statement = $pdo->prepare("select item_main_file from ot_users_temp_video where temp_id = '".$tempId."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) {
		$mainfile_name = _e($row['item_main_file']) ;
	} 
	if(in_array($fileType, $allowTypes)){
		//delete old file
		unlink($targetDir.$mainfile_name); 
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			$upd = $pdo->prepare("update ot_users_temp_video set item_main_file = '".$newfilename."' , item_main_file_size='".$FileSize."' where temp_id = '".$tempId."'");
			$upd->execute();
			
        } 
    } 
} 

if(isset($_POST['btn_action']))
{
    if($_POST['btn_action'] == 'cancelUpdate')
	{
        if(!empty($_POST['itemId'])) {
            $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
            $tempImageName = find_edit_image($pdo,$itemId) ;
            $tempVideoName = find_edit_video($pdo,$itemId) ;
            $tempFileName =  find_edit_file($pdo,$itemId) ;
            $tempImageDirectory = "tmpImg/"; 
            $tempVideoDirectory = "tmpVideos/"; 
            $tempFileDirectory = "tmpFiles/";
            
            //delete item update image from server
            unlink($tempImageDirectory.$tempImageName); 

            //delete item update demo video from server
            unlink($tempVideoDirectory.$tempVideoName); 

            //delete item update main file from server
            unlink($tempFileDirectory.$tempFileName); 

            $upd = $pdo->prepare("DELETE FROM `ot_users_video_update` WHERE update_item_id = '".$itemId."' and update_user_id = '".$_SESSION['unprofessional']['id']."'") ;
            $upd->execute();
            
            $updateDel = $pdo->prepare("DELETE FROM `ot_users_update_status` WHERE status_item_id = '".$itemId."' and status_user_id = '".$_SESSION['unprofessional']['id']."'");
            $updateDel->execute();
        } 
    }
    
    if($_POST['btn_action'] == 'pauseItemSale')
	{
        if(!empty($_POST['itemId'])) {
            $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_users_video set item_pause = '0' where item_id = '".$itemId."'") ;
            $upd->execute();
            echo "Item is Paused Now. You can find it inside Paused Items.";
        }
    }
    
    if($_POST['btn_action'] == 'unpauseItemSale')
	{
        if(!empty($_POST['itemId'])) {
            $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_users_video set item_pause = '1' where item_id = '".$itemId."'") ;
            $upd->execute();
            echo "Item is Live Now. You can find it inside Active Items.";
        }
    }
    
  if($_POST['btn_action'] == 'SaveTempUploadStepOne')
	{
      if(!empty($_POST['video_title']) && !empty($_POST['video_price']) && !empty($_POST['item_message']) && !empty($_POST['item_tag'])) {
          $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
          $title = filter_var($_POST['video_title'], FILTER_SANITIZE_STRING) ;
          $price = filter_var($_POST['video_price'], FILTER_SANITIZE_NUMBER_INT) ;
          $description = base64_encode($_POST['item_message']) ;
          $tags = filter_var($_POST['item_tag'], FILTER_SANITIZE_STRING) ;
          $time = date("Y-m-d h:i:s") ;
          $ins = $pdo->prepare("insert into ot_users_temp_video (user_id, item_category, item_title, item_price, item_description, item_tags, item_main_file, item_preview_img, reviewer_comment, item_time) values (?,?,?,?,?,?,?,?,?,?)") ;
          $ins->execute(array($userId,'0',$title,$price,$description,$tags,'','','',$time)) ;
          $statement = $pdo->query("SELECT LAST_INSERT_ID()");
          $tempId = $statement->fetchColumn();
          $form_msg = "Step 1 Completed Successfully.";
            $output = array( 
							'error' => '0',
                            'message' => $form_msg,
							'tempId' => $tempId
							) ;
            echo json_encode($output);
      } else {
          echo "1" ;
      }
    }
    
    
    if($_POST['btn_action'] == 'SaveEditUploadStepOne')
	{
      if(!empty($_POST['item_Id']) && !empty($_POST['video_title']) && !empty($_POST['video_price']) && !empty($_POST['item_message']) && !empty($_POST['item_tag'])) {
          $itemId = filter_var($_POST['item_Id'], FILTER_SANITIZE_NUMBER_INT) ;
          $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
          $title = filter_var($_POST['video_title'], FILTER_SANITIZE_STRING) ;
          $price = filter_var($_POST['video_price'], FILTER_SANITIZE_NUMBER_INT) ;
          $description = base64_encode($_POST['item_message']) ;
          $tags = filter_var($_POST['item_tag'], FILTER_SANITIZE_STRING) ;
          $ins = $pdo->prepare("update ot_users_video set item_title = '".$title."' , item_price = '".$price."' , item_description = '".$description."', item_tags = '".$tags."' where item_id = '".$itemId."'") ;
          $ins->execute() ;
          $form_msg = "Step 1 Completed Successfully.";
            $output = array( 
							'error' => '0',
                            'message' => $form_msg,
							'itemId' => $itemId
							) ;
            echo json_encode($output);
      } else {
          echo "1" ;
      }
    }
    
    if($_POST['btn_action'] == 'SaveEditUploadStepTwo')
	{
      if(!empty($_POST['itemId']) && !empty($_POST['category'])) {
          $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
          $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT) ;
          $reviewerComment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING) ;
          $statement = $pdo->prepare("select * from ot_users_video_update where update_item_id = '".$itemId."' and update_user_id = '".$_SESSION['unprofessional']['id']."'");
          $statement->execute();
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);
          $total = $statement->rowCount();
          $insUpdate = $pdo->prepare("insert into ot_users_update_status (status_item_id, status_user_id) values ('".$itemId."', '".$_SESSION['unprofessional']['id']."')");
          $insUpdate->execute();
          if($total > 0){
              $upd = $pdo->prepare("update ot_users_video_update set update_item_category = '".$category."' , update_comment = '".$reviewerComment."' , update_upload_success = '1' where update_item_id = '".$itemId."'") ;
              $upd->execute() ;
          } else {
              $ins = $pdo->prepare("insert into ot_users_video_update (update_item_category, update_comment, update_upload_success, update_item_id, update_user_id) values ('".$category."', '".$reviewerComment."', '1', '".$itemId."', '".$_SESSION['unprofessional']['id']."')") ;
              $ins->execute() ;
          }
          $form_msg = "Item Updated Successfully to Review.";
            $output = array( 
							'error' => '0',
                            'message' => $form_msg
							) ;
            echo json_encode($output);
          //***************************************** Send Email **************************************************
                
                
                //***************************************** Send Email **************************************************


                //***************************************** Send Email **************************************************


                //***************************************** Send Email **************************************************
      } else {
          echo "1" ;
      }
    }
    
    if($_POST['btn_action'] == 'SaveSoftUploadStepOne')
	{
      if(!empty($_POST['temp_Id']) && !empty($_POST['video_title']) && !empty($_POST['video_price']) && !empty($_POST['item_message']) && !empty($_POST['item_tag'])) {
          $tempId = filter_var($_POST['temp_Id'], FILTER_SANITIZE_NUMBER_INT) ;
          $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
          $title = filter_var($_POST['video_title'], FILTER_SANITIZE_STRING) ;
          $price = filter_var($_POST['video_price'], FILTER_SANITIZE_NUMBER_INT) ;
          $description = base64_encode($_POST['item_message']) ;
          $tags = filter_var($_POST['item_tag'], FILTER_SANITIZE_STRING) ;
          $ins = $pdo->prepare("update ot_users_temp_video set item_title = '".$title."' , item_price = '".$price."' , item_description = '".$description."', item_tags = '".$tags."' where temp_id = '".$tempId."'") ;
          $ins->execute() ;
          $form_msg = "Step 1 Completed Successfully.";
            $output = array( 
							'error' => '0',
                            'message' => $form_msg,
							'tempId' => $tempId
							) ;
            echo json_encode($output);
      } else {
          echo "1" ;
      }
    }
    
    if($_POST['btn_action'] == 'SaveTempUploadStepTwo')
	{
      if(!empty($_POST['tempId']) && !empty($_POST['category'])) {
          $tempId = filter_var($_POST['tempId'], FILTER_SANITIZE_NUMBER_INT) ;
          $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT) ;
          $reviewerComment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING) ;
          $ins = $pdo->prepare("update ot_users_temp_video set item_category = '".$category."' , reviewer_comment = '".$reviewerComment."' , upload_success = '1' where temp_id = '".$tempId."'") ;
          $ins->execute() ;
          $form_msg = "Item Uploaded Successfully to Review.";
            $output = array( 
							'error' => '0',
                            'message' => $form_msg
							) ;
            echo json_encode($output);
      } else {
          echo "1" ;
      }
    }
    if($_POST['btn_action'] == 'SaveUserAboutUs')
	{
        if(!empty($_POST['aboutinfo'])) {
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $aboutinfo = filter_var($_POST['aboutinfo'], FILTER_SANITIZE_STRING) ;
            
            $ins = $pdo->prepare("update ot_users set user_about_us = '".$aboutinfo."' where id= '".$userId."'") ;
            $ins->execute();
            if($ins){
                echo "Info saved successfully." ;
            } 
        } else {
                echo "About Yourself cannot be empty. Try Again.";
            }
    }
    
    if($_POST['btn_action'] == 'SaveUserNetwork')
	{
        $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
        $youtubeProfile = filter_var($_POST['youtubeProfile'], FILTER_SANITIZE_URL) ;
        $instaProfile = filter_var($_POST['instaProfile'], FILTER_SANITIZE_URL) ;
        $fbProfile = filter_var($_POST['fbProfile'], FILTER_SANITIZE_URL) ;
        $linkedinProfile = filter_var($_POST['linkedinProfile'], FILTER_SANITIZE_URL) ;
        $twitterProfile = filter_var($_POST['twitterProfile'], FILTER_SANITIZE_URL) ;
        $dribbbleProfile = filter_var($_POST['dribbbleProfile'], FILTER_SANITIZE_URL) ;
        $behanceProfile = filter_var($_POST['behanceProfile'], FILTER_SANITIZE_URL) ;
        $vkProfile = filter_var($_POST['vkProfile'], FILTER_SANITIZE_URL) ;
        $ins = $pdo->prepare("update ot_users set insta_network = '".$instaProfile."' , fb_network = '".$fbProfile."' , twitter_network = '".$twitterProfile."' , linkedin_network = '".$linkedinProfile."' , behance_network = '".$behanceProfile."' , dribbble_network = '".$dribbbleProfile."' , vk_network = '".$vkProfile."' , youtube_network = '".$youtubeProfile."'  where id= '".$userId."'") ;
        $ins->execute();
        if($ins){
            echo "Social Profile saved successfully." ;
        } 
        
    }
    
    if($_POST['btn_action'] == 'fetch_username')
	{
		if(!empty($_POST['value'])){
			$value =  filter_var($_POST['value'], FILTER_SANITIZE_STRING);
			$chk = $pdo->prepare("select * from ot_users where user_name = ?") ;
			$chk->execute(array($value)) ;
			$ok = $chk->rowCount();
			$output = "";
			if($ok > 0) {
				$output = array( 
							'form_msg' => 'Username is Not Available.',
							'err' => '1'
							
						) ;
				echo json_encode($output);
			} else {
				$output = array( 
							'form_msg' => 'Username is Available.',
							'err' => '0'
							
						) ;
				echo json_encode($output);
			}
		} 
	}
    
    if($_POST['btn_action'] == 'Save_Username')
	{
        if(!empty($_POST['username'])) {
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING) ;
            
            $ins = $pdo->prepare("update ot_users set user_name = '".$username."' where id= '".$userId."'") ;
            $ins->execute();
        } 
    }
    
    if($_POST['btn_action'] == 'Save_Userfullname')
	{
        if(!empty($_POST['userfullname'])) {
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $userfullname = filter_var($_POST['userfullname'], FILTER_SANITIZE_STRING) ;
            
            $ins = $pdo->prepare("update ot_users set user_fullname = '".$userfullname."' where id= '".$userId."'") ;
            $ins->execute();
            if($ins){
                echo "Name changed successfully." ;
            } 
        } else {
                echo "Name cannot be empty. Try Again.";
        }
    }
    
    if($_POST['btn_action'] == 'Save_UserEmail')
	{
        if(!empty($_POST['useremail'])) {
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $useremail = filter_var($_POST['useremail'], FILTER_SANITIZE_EMAIL) ;
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            $oldemail = useremail_by_id($pdo,$userId) ;
            $userfullname = user_fullname_by_id($pdo,$userId) ;
            
            if(check_user_email($pdo,$useremail) > 0){
                echo "0" ;
            } else {
                $otp = code(4) ;
                $ins = $pdo->prepare("update ot_users set user_temp_email = '".$useremail."' , user_otp = '".$otp."' where id = '".$userId."'") ;
                $ins->execute() ;
                
                //***************************************** Send Email **************************************************
                $to = $useremail ;
                $subject = "Change Email OTP";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                include("emailTemplates/send_changeemail_otp_email.php");
                mail($to, $subject, $body, $headers);
                
                echo $useremail ;
            }
        } else {
                echo "Email cannot be empty. Try Again.";
        }
    }
    
    if($_POST['btn_action'] == 'Change_UserNewEmail')
	{
        if(!empty($_POST['newemail']) && isset($_POST['otp'])) {
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $useremail = filter_var($_POST['newemail'], FILTER_SANITIZE_EMAIL) ;
            $otp = filter_var($_POST['otp'] ,FILTER_SANITIZE_NUMBER_INT) ;
            if(check_user_otp($pdo) != $otp){
                echo "0" ;
            } else {
                $ins = $pdo->prepare("update ot_users set user_email = '".$useremail."' , user_otp = '' , user_temp_email = '' where id = '".$userId."'") ;
                $ins->execute() ;
                echo $useremail ;
            }
        } else {
                echo "OTP cannot be empty. Try Again.";
        }
    }
    
    if($_POST['btn_action'] == 'followUserAction')
	{
        if(!empty($_POST['userId'])) {
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $parentId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT) ;
            $ins = $pdo->prepare("insert into ot_follower_list (follower_parent_id, follower_user_id) values ('".$parentId."' , '".$userId."')") ;
            $ins->execute() ;
            
            $parentUsername = username_by_id($pdo,$parentId);
            $newFollower = count_followers_by_username($pdo,$parentUsername)  ;
            $username = username_by_id($pdo,$userId);
            $newFollowing = count_following_by_username($pdo,$username) ;
            $upd = $pdo->prepare("update ot_users set user_followers = '".$newFollower."' where id = '".$parentId."'") ;
            $upd->execute();
            $updateFollowing = $pdo->prepare("update ot_users set user_following = '".$newFollowing."' where id = '".$userId."'") ;
            $updateFollowing->execute() ;
            $output = "" ;
            $output = array( 
							'newFollower' => $newFollower,
                            'parentId' => $parentId,
							'err' => '0'
						) ;
            echo json_encode($output);
            //***************************************** Send Email **************************************************
                
                
                //***************************************** Send Email **************************************************
                
                
                //***************************************** Send Email **************************************************
                
                
                //***************************************** Send Email **************************************************
                
        }
        
    }
    
    if($_POST['btn_action'] == 'unfollowUserAction')
	{
        if(!empty($_POST['userId'])) {
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $parentId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT) ;
            $ins = $pdo->prepare("delete from ot_follower_list where follower_parent_id = '".$parentId."' and follower_user_id ='".$userId."'") ;
            $ins->execute() ;
            $parentUsername = username_by_id($pdo,$parentId);
            $newFollower = count_followers_by_username($pdo,$parentUsername) ;
            $username = username_by_id($pdo,$userId);
            $newFollowing = count_following_by_username($pdo,$username) ;
            $upd = $pdo->prepare("update ot_users set user_followers = '".$newFollower."' where id = '".$parentId."'") ;
            $upd->execute();
            $updateFollowing = $pdo->prepare("update ot_users set user_following = '".$newFollowing."' where id = '".$userId."'") ;
            $updateFollowing->execute() ;
            $output = "" ;
            $output = array( 
							'newFollower' => $newFollower,
                            'parentId' => $parentId,
							'err' => '0'
						) ;
            echo json_encode($output);
        } 
        
    }
    
    if($_POST['btn_action'] == 'lovedNewItem')
	{
        if(!empty($_POST['itemId'])) {
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
            $authorId = find_user_id_by_itemid($pdo,$itemId) ;
            $shortUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $nLink = BASE_URL."video/".$itemId."/".$shortUrlTitle ;
            $authorItemLove = want_email_on_item_love($pdo,$authorId) ;
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            $ins = $pdo->prepare("insert into ot_lovers (lovers_item_id, lovers_user_id) values ('".$itemId."' , '".$userId."')") ;
            $ins->execute() ;
            
            $username = username_by_id($pdo,$userId);
            $newLover = user_loveditems_by_username($pdo,$username) + 1  ;
            
            $itemLoves = count_loves($pdo,$itemId) + 1 ;
            
            $upd = $pdo->prepare("update ot_users set user_loved_counting = '".$newLover."' where id = '".$userId."'") ;
            $upd->execute();
            
            $updItem = $pdo->prepare("update ot_users_video set item_love = '".$itemLoves."' where item_id = '".$itemId."'") ;
            $updItem->execute();
            
            if($authorId != $userId){
                $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('10', '".$authorId."', '".$nLink."' ) ");
                $insNotification->execute();
                //***************************************** Send Email When Item Loves **************************************************
                if($authorItemLove == '1'){
                    $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
                    $imageName = find_live_image($pdo,$itemId) ;
                    $userfullname = user_fullname_by_id($pdo,$userId) ;
                    $authoremail = useremail_by_id($pdo,$authorId) ;
                    $to = $authoremail ;
                    $subject = "User Loved Your Item.";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$authoremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    include("emailTemplates/send_item_love_email.php");
                    mail($to, $subject, $body, $headers);
                }
            }
            
            
            $output = "" ;
            $output = array( 
							'newItemLove' => $itemLoves,
                            'itemId' => $itemId,
							'err' => '0'
						) ;
            echo json_encode($output);
            
                
        }
        
    }
    
    if($_POST['btn_action'] == 'unlovedNewItem')
	{
        if(!empty($_POST['itemId'])) {
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
            $ins = $pdo->prepare("delete from ot_lovers where lovers_item_id = '".$itemId."' and lovers_user_id = '".$userId."' ") ;
            $ins->execute() ;
            
            $username = username_by_id($pdo,$userId);
            $newLover = user_loveditems_by_username($pdo,$username) - 1  ;
            
            $itemLoves = count_loves($pdo,$itemId) - 1 ;
            
            $upd = $pdo->prepare("update ot_users set user_loved_counting = '".$newLover."' where id = '".$userId."'") ;
            $upd->execute();
            
            $updItem = $pdo->prepare("update ot_users_video set item_love = '".$itemLoves."' where item_id = '".$itemId."'") ;
            $updItem->execute();
            
            $output = "" ;
            $output = array( 
							'newItemLove' => $itemLoves,
                            'itemId' => $itemId,
							'err' => '0'
						) ;
            echo json_encode($output);
                
        }
        
    }
    
    if($_POST['btn_action'] == 'postMyComment')
	{
        if(!empty($_POST['itemId']) && !empty($_POST['userId']) && !empty($_POST['comment']) ) {
            $userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT) ;
            $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
            $comment = filter_var($_POST['comment'] , FILTER_SANITIZE_STRING) ;
            $authorId = find_user_id_by_itemid($pdo,$itemId) ;
            $wantEmail = want_email_on_item_comment($pdo,$authorId) ;
            if($comment != ''){
                $ins = $pdo->prepare("insert into ot_comments (comment, comment_item_id, comment_user_id) values ('".$comment."', '".$itemId."', '".$userId."')") ;
                $ins->execute() ;
                $statement = $pdo->query("SELECT LAST_INSERT_ID()");
                $commentId = $statement->fetchColumn();
                $commentDate = grab_comment_date($pdo,$commentId) ;

                $username = username_by_id($pdo,$userId);
                $badges = grab_all_badges_by_username($pdo,$username) ;
                $profileUrl = '<a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>&ensp;';
                $purchasedBadge = find_user_purchased_item($pdo,$userId,$itemId) ;
                $output = "" ;
                $output .= '<div class="card p-2">' ;
                $output .= '<div class="row ">' ;
                $output .= '<div class="col-lg-4 mt-1 text-center">
                                <div class="col-lg-12">
                                    <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" class="img-fluid w-50 rounded-circle">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <p>@'.$username.'</p>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>'.$purchasedBadge.'
                                </div>
                                <div class="col-lg-12 mt-2">
                                    Posted On : '.$commentDate.'
                                </div>

                            </div>' ;
                $output .= '<div class="col-lg-3 mt-1">
                                <div class="col-lg-12">
                                    <i class="fas fa-comment"></i> Comment
                                </div>
                                <div class="col-lg-12 mt-3 p-3 ml-3">
                                    '.nl2br($comment).'
                                </div>
                            </div>' ;
                $output .= '<div class="col-lg-5 mt-1">
                                <div class="col-lg-12">
                                    <i class="fas fa-trophy"></i> Achievements
                                </div>
                                <div class="col-lg-12 mt-3 p-1 ml-3">
                                    '.$badges.'
                                </div>
                            </div>' ;
                $output .= '<span class="commentDivider border-top"></span>' ;
                $output .= '</div>' ;
                $output .= '<span class="showSingle'.$commentId.'"></span><form method="post" class="postReply" enctype="multipart/form-data" id="postReplyId'.$commentId.'"><div class="row mb-3">' ;
                $output .= '<div class="col-lg-1 mt-1 text-center"></div>';
                $output .= '<div class="col-lg-9 mt-1 ml-lg-n3 text-center">';
                $output .= '<textarea class="form-control textareaMedium" name="commentReply" maxlength="1000" placeholder="Post Your Reply within 1000 Character"></textarea>' ;
                $output .= '</div>' ;
                $output .= '<div class="col-lg-2 mt-1 text-center">';
                $output .= '<input type="hidden" name="itemId" value="'.$itemId.'" ><input type="hidden" name="commentId" value="'.$commentId.'" ><input type="hidden" name="btn_action" value="saveCommentReply" >';
                $output .= '<button type="submit" class="btn btn-primary btn-sm mt-3">Post Reply</button>';
                $output .= '</div>' ;
                $output .= '</div></form>' ;
                $output .= '</div>' ;
                echo $output ;
                
                //***************************************** Send Email When New Comment on Item *********************************************
                $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
                if($wantEmail == '1'){
                    $imageName = find_live_image($pdo,$itemId) ;
                    
                    $userfullname = user_fullname_by_id($pdo,$userId) ;
                    $authoremail = useremail_by_id($pdo,$authorId) ;
                    $adminName = admin_name($pdo) ;
                    $adminCopyrightName = admin_copyright_name($pdo);
                    $to = $authoremail ;
                    $subject = "New Comment on Your Item.";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$authoremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    include("emailTemplates/send_comment_email.php");
                    mail($to, $subject, $body, $headers);
                }
                $nLink = BASE_URL.'comments/'.$itemId.'/'.$itemUrlTitle ;
                if($userId != $authorId) {
                    $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('6', '".$authorId."', '".$nLink."' ) ");
                    $insNotification->execute();
                }
            }
            
            
        }
    }
    
    
    if($_POST['btn_action'] == 'saveCommentReply')
	{
        if(!empty($_POST['itemId']) && !empty($_POST['commentId']) && !empty($_POST['commentReply']) ) {
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
            $commentId = filter_var($_POST['commentId'], FILTER_SANITIZE_NUMBER_INT) ;
            $commentReply = filter_var($_POST['commentReply'] , FILTER_SANITIZE_STRING) ;
            $authorId = find_user_id_by_itemid($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $nLink = BASE_URL.'comments/'.$itemId.'/'.$itemUrlTitle ;
            $commentUserId = find_user_id_by_commentitemid($pdo,$commentId) ;
            $imageName = find_live_image($pdo,$itemId) ;
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            $authorCommentReply = want_email_on_author_reply($pdo,$commentUserId) ;
            $userCommentReply = want_email_on_commentuser_reply($pdo,$commentUserId) ;
            if($commentReply != ''){
                $ins = $pdo->prepare("insert into ot_comment_thread (thread_comment, thread_item_id, thread_user_id, thread_comment_id) values ('".$commentReply."', '".$itemId."', '".$userId."', '".$commentId."')") ;
                $ins->execute() ;
                $statement = $pdo->query("SELECT LAST_INSERT_ID()");
                $commentReplyId = $statement->fetchColumn();
                $commentReplyDate = grab_comment_reply_date($pdo,$commentReplyId) ;

                $username = username_by_id($pdo,$userId);
                $badges = grab_all_badges_by_username($pdo,$username) ;
                $purchasedBadge = find_user_purchased_item($pdo,$userId,$itemId) ;
                $thread = grab_single_replies_to_comment($pdo, $commentReplyId, $username, $purchasedBadge,$itemId,$userId) ; 
                
                $output = "" ;
                $output .= $thread ;
                echo $output ;
                if($userId != $authorId) {
                    $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('7', '".$authorId."', '".$nLink."' ) ");
                    $insNotification->execute();
                    if($userId != $commentUserId) {
                        $insNoti = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('11', '".$commentUserId."', '".$nLink."' ) ");
                        $insNoti->execute();
                        //****** Send Email To User which they comment earlier when Some Other Replied to their Comment *****************
                        if($userCommentReply == '1'){
                            $userfullname = user_fullname_by_id($pdo,$userId) ;
                            $useremail = useremail_by_id($pdo,$commentUserId) ;
                            $to = $useremail ;
                            $subject = "User Replied to Your Comment.";
                            $headers  = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                            $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                            include("emailTemplates/send_user_replytocomment_email.php");
                            mail($to, $subject, $body, $headers); 
                        }
                    } 
                } else {
                    $insNoti = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('12', '".$commentUserId."', '".$nLink."' ) ");
                    $insNoti->execute();
                    //*********************************** Send Email To User which they comment earlier *********************************
                    if($authorCommentReply == '1'){
                        $userfullname = user_fullname_by_id($pdo,$authorId) ;
                        $useremail = useremail_by_id($pdo,$commentUserId) ;
                        $to = $useremail ;
                        $subject = "Author Replied to Your Comment.";
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                        $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                        include("emailTemplates/send_author_replytocomment_email.php");
                        mail($to, $subject, $body, $headers); 
                    }
                    
                }
                 
                
                
            }
            
            
            
                
                
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
        }
    }
    
    if($_POST['btn_action'] == 'reportItemComment')
	{
        if(!empty($_POST['commentId']) ) {
            $commentId = filter_var($_POST['commentId'], FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_comments set author_report = '1' where comment_id = '".$commentId."'") ;
            $upd->execute() ;
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
        }
    }
    
    if($_POST['btn_action'] == 'reportItemCommentReply')
	{
        if(!empty($_POST['commentReplyId']) ) {
            $commentReplyId = filter_var($_POST['commentReplyId'], FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_comment_thread set thread_report = '1' where comment_thread_id = '".$commentReplyId."'") ;
            $upd->execute() ;
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
        }
    }
    
    if($_POST['btn_action'] == 'saveAuthorReply')
	{
        if(!empty($_POST['ratingId']) && !empty($_POST['itemId']) && !empty($_POST['userId']) && !empty($_POST['authorReply']) ) {
            $ratingId = filter_var($_POST['ratingId'], FILTER_SANITIZE_NUMBER_INT) ;
            $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
            $userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT) ;
            $authorReply = filter_var($_POST['authorReply'], FILTER_SANITIZE_STRING) ;
            $username = get_username_by_itemid($pdo,$itemId) ;
            $output = '';
            
            $upd = $pdo->prepare("update ot_ratings set rating_author_reply = '".$authorReply."' where rating_item_id = '".$itemId."' and rating_user_id = '".$userId."'") ;
            $upd->execute() ;
            
            $output .= '<div class="row">' ;
                $output .= '<div class="col-lg-4 mt-1 text-center">
                                <div class="col-lg-12">
                                    <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" class="img-fluid w-25 rounded-circle">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <p>@'.$username.'</p>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>&ensp;<button class="btn btn-sm- btn-info" disabled><i class="fas fa-check-circle"></i> Author</button>
                                </div>

                            </div>' ;
                $output .= '<div class="col-lg-8 mt-1">
                                <div class="col-lg-12 mt-3">
                                    Author Response
                                </div>
                                <div class="col-lg-12 mt-3 p-3 ">
                                    '.nl2br($authorReply).'
                                </div>
                            </div>' ;
            $output .= '</div>';
            echo $output ;
            
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
        }
    }
    
    if($_POST['btn_action'] == 'reportItemRating')
	{
        if(!empty($_POST['ratingId']) ) {
            $ratingId = filter_var($_POST['ratingId'], FILTER_SANITIZE_NUMBER_INT) ;
            $sel = $pdo->prepare("select * from ot_ratings where rating_id = '".$ratingId."'");
            $sel->execute();
            $result = $sel->fetchAll();
            foreach($result as $row){
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
            $upd = $pdo->prepare("update ot_ratings set rating_report = '1' where rating_id = '".$ratingId."'") ;
            $upd->execute() ;
            $updateItemRating = $pdo->prepare("update ot_users_video set item_rating = '".$newRating."' , item_rated_by = '".$newratedBy."' where item_id = '".$itemId."'") ;
            $updateItemRating->execute();
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
                
                
            //***************************************** Send Email **************************************************
        }
    }
    
    if($_POST['btn_action'] == 'createForumTopic')
	{
      if(!empty($_POST['title']) && !empty($_POST['forumCategory']) && !empty($_POST['description']) ) {
          $forumCategory = filter_var($_POST['forumCategory'], FILTER_SANITIZE_NUMBER_INT) ;
          $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
          $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING) ;
          $description = base64_encode($_POST['description']) ;
          $time = date("Y-m-d h:i:s") ;
          
          $ins = $pdo->prepare("insert into ot_forum_topic (topic_cat_id, topic_user_id, topic_title, topic_description, topic_updated_time) values ('".$forumCategory."' , '".$userId."' , '".$title."', '".$description."', '".$time."' )") ;
          $ins->execute() ;
          $statement = $pdo->query("SELECT LAST_INSERT_ID()");
          $topicId = $statement->fetchColumn();
          $topicUrlTitle = forum_urltitle_by_id($pdo,$topicId) ;
          $form_msg = "Step 1 Completed Successfully.";
            $output = array( 
							'error' => '0',
                            'topicUrlTitle' => $topicUrlTitle,
							'topicId' => $topicId
							) ;
            echo json_encode($output);
      } else {
          echo "1" ;
      }
    }
    
    if($_POST['btn_action'] == 'SubmitForumReply')
	{
        if(!empty($_POST['topicReply']) && !empty($_POST['topicId'])){
            $topicId = filter_var($_POST['topicId'], FILTER_SANITIZE_NUMBER_INT) ;
            $reply = filter_var($_POST['topicReply'] , FILTER_SANITIZE_STRING) ;
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $username = username_by_id($pdo,$userId) ; 
            $userfullname = user_fullname_by_id($pdo,$userId) ;
            $time = date("Y-m-d h:i:s") ;
            $replyDate = date('d F, Y',strtotime($time)); 
            $countOldAnswers = topicanswerscount_by_id($pdo,$topicId); 
            $increaseAnswerCount = ($countOldAnswers + 1) ;
            $forumUrl = forum_urltitle_by_id($pdo,$topicId) ;
            $authorId = forum_userid_by_titleid($pdo,$topicId) ;
            $nLink = BASE_URL."topic/".$topicId.'/'.$forumUrl ;
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            $topicTitle = forum_title_by_id($pdo,$topicId) ;
            $authorForumTopic = want_email_on_forum_topic($pdo,$authorId) ;
            if(!empty($reply)){
                $ins = $pdo->prepare("insert into ot_forum_topic_answers (answer_topic_id, answer_user_id, user_answer) values ('".$topicId."' , '".$userId."', '".$reply."')") ;
                $ins->execute() ;
                if($ins){
                    $upd = $pdo->prepare("update ot_forum_topic set topic_answers = '".$increaseAnswerCount."' , topic_updated_time = '".$time."' , topic_admin_seen = '0' where topic_id = '".$topicId."'") ;
                    $upd->execute() ;
                    
                    if($authorId != $userId){
                        $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('8', '".$authorId."', '".$nLink."' ) ");
                        $insNotification->execute();
                        //****************** Send Forum Email ********************
                        if($authorForumTopic == '1'){
                            $useremail = useremail_by_id($pdo,$authorId) ;
                            $to = $useremail ;
                            $subject = "User Replied on Your Forum Topic.";
                            $headers  = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                            $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                            include("emailTemplates/send_forumanswer_email.php");
                            mail($to, $subject, $body, $headers); 
                        }
                    }
                    
                    $output = "";
                    $output .= '<div class="section-header"><div class="row w-100"><div class="col-lg-12 p-2"><div class="row">';
                    $output .= '<div class="col-lg-4 text-center ">
                                    <div class="col-lg-12">
                                        <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" class="img-fluid w-25 rounded-circle" >
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <p>@'.$username.'</p>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <small>Replied On : '.$replyDate.'</small>
                                    </div>
                               </div>
                               <div class="col-lg-8">
                                    '.nl2br($reply).'
                               </div>
                               ' ;
                    $output .= '</div></div></div></div>' ;
                    echo $output ;
                    


                    //***************************************** Send Email **************************************************


                    //***************************************** Send Email **************************************************


                    //***************************************** Send Email **************************************************


                    //***************************************** Send Email **************************************************
                }
            }
        }
    }
    
    if($_POST['btn_action'] == 'markedSolution')
	{
        if(!empty($_POST['id'])){
            $answerId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $userId = find_userid_by_answerid($pdo,$answerId) ;
            $topicId = find_topicid_by_answerid($pdo,$answerId) ;
            $oldProblemSolved = count_problemsolved_by_userid($pdo,$userId) ;
            $newProblemSolved = ($oldProblemSolved + 1) ;
            
            $updateTopic = $pdo->prepare("update ot_forum_topic set topic_solved = '1' where topic_id = '".$topicId."'");
            $updateTopic->execute();
            
            $updateAnswer = $pdo->prepare("update ot_forum_topic_answers set is_solution = '1' where answer_id = '".$answerId."'");
            $updateAnswer->execute() ;
            
            $updateProblemSolved = $pdo->prepare("update ot_users set community_problem_solved = '".$newProblemSolved."' where id = '".$userId."'");
            $updateProblemSolved->execute() ;
        }
    }
    
    if($_POST['btn_action'] == 'singleNotificationSeen')
	{
        if(!empty($_POST['id'])){
            
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_notifications set n_seen = '1' where notification_id = '".$id."' and n_user_id = '".$_SESSION['unprofessional']['id']."'");
            $upd->execute() ;
        }
    }
    
    if($_POST['btn_action'] == 'allNotificationSeen')
	{
        $upd = $pdo->prepare("update ot_notifications set n_seen = '1' where n_user_id = '".$_SESSION['unprofessional']['id']."'");
        $upd->execute() ;
    }
    
    if($_POST['btn_action'] == 'fetchRefund')
	{	
		if(!empty($_POST['id'])){
			$txnId = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
            
            if(checking_txn_id($pdo,$txnId) > 0){
                $announce = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
                $announce->execute();
                $result = $announce->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row) {
                    $itemId = _e($row['p_item_id']);
                    $output['itemName'] = long_title_by_id($pdo,$itemId) ;
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
    
    if($_POST['btn_action'] == 'submitRefundForm')
	{	
		if(!empty($_POST['tsnId']) && !empty($_POST['userReason']) ){
            $txnId = filter_var($_POST['tsnId'], FILTER_SANITIZE_STRING);
            $userReason = filter_var($_POST['userReason'], FILTER_SANITIZE_STRING);
            $itemId = find_itemid_by_txnid($pdo,$txnId) ;
            $buyerId = find_buyerid_by_txnid($pdo,$txnId) ;
            $authorId = find_authorid_by_txnid($pdo,$txnId) ; 
            $authorReason = "" ;
            $paidAmt = find_paidamt_by_txnid($pdo,$txnId); 
            
            $ins = $pdo->prepare("insert into ot_refunds (r_txn_id, r_item_id, r_user_id, r_user_reason, r_author_id, r_author_reason, r_amount) values ('".$txnId."' , '".$itemId."', '".$buyerId."' , '".$userReason."' , '".$authorId."' , '".$authorReason."' , '".$paidAmt."' )") ;
            $ins->execute() ;
            
            // ***************** Send Refund Email to Author *******************************
            $refundDay = find_max_refund_day($pdo) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $imageName = find_live_image($pdo,$itemId) ;
            $userfullname = user_fullname_by_id($pdo,$authorId) ;
            $authoremail = useremail_by_id($pdo,$authorId) ;
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            $to = $authoremail ;
            $subject = "Buyer wants Refund.";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$authoremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
            include("emailTemplates/send_refund_email_to_author.php");
            mail($to, $subject, $body, $headers);
        }
    }
    
    if($_POST['btn_action'] == 'fetchAuthorRefundInfo')
	{	
		if(!empty($_POST['id'])){
			$txnId = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
            
            if(check_strong_transactionid($pdo,$txnId) > 0){
                $announce = $pdo->prepare("select * from ot_refunds where r_txn_id = '".$txnId."'");
                $announce->execute();
                $result = $announce->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row) {
                    $output['userReason'] = strip_tags($row['r_user_reason']) ;
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
    
    if($_POST['btn_action'] == 'submitAuthorRefundForm')
	{	
		if(!empty($_POST['tsnId']) && !empty($_POST['authorReason']) && !empty($_POST['decision'])){
            $txnId = filter_var($_POST['tsnId'], FILTER_SANITIZE_STRING);
            $authorReason = filter_var($_POST['authorReason'], FILTER_SANITIZE_STRING);
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
                    $decision ='1' ;
                    
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

                        $updStatus = $pdo->prepare("update ot_refunds set r_author_reason = '".$authorReason."' , r_author_declined = '".$decision."' , r_status = '1' where  r_txn_id = '".$txnId."'") ;
                        $updStatus->execute() ;

                        // ***************** Send Author Accept Refund Decision Email to Buyer *******************************
                        $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
                        $imageName = find_live_image($pdo,$itemId) ;
                        $userfullname = user_fullname_by_id($pdo,$buyerId) ;
                        $buyeremail = useremail_by_id($pdo,$buyerId) ;
                        $adminName = admin_name($pdo) ;
                        $adminCopyrightName = admin_copyright_name($pdo);
                        $to = $buyeremail ;
                        $subject = "Author Accepts Your Refund Request.";
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                        $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$buyeremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                        include("emailTemplates/send_refundaccept_email_to_buyer.php");
                        mail($to, $subject, $body, $headers);

                } else {
                    $decision ='2' ;
                    $upd = $pdo->prepare("update ot_refunds set r_author_reason = '".$authorReason."' , r_author_declined = '".$decision."' where  r_txn_id = '".$txnId."'") ;
                    $upd->execute() ;
                    
                    // ***************** Send Author Declined Refund Decision Email to Buyer *******************************
                        $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
                        $imageName = find_live_image($pdo,$itemId) ;
                        $userfullname = user_fullname_by_id($pdo,$buyerId) ;
                        $buyeremail = useremail_by_id($pdo,$buyerId) ;
                        $adminName = admin_name($pdo) ;
                        $adminCopyrightName = admin_copyright_name($pdo);
                        $to = $buyeremail ;
                        $subject = "Author Declined Your Refund Request.";
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                        $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$buyeremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                        include("emailTemplates/send_refunddeclined_email_to_buyer.php");
                        mail($to, $subject, $body, $headers);

                }
            }
            
        }
    }
    
    if($_POST['btn_action'] == 'disputeOn')
	{	
		if(!empty($_POST['id']) ){
            $txnId = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
            if(check_strong_transactionid($pdo,$txnId) > 0){
                $upd = $pdo->prepare("update ot_refunds set r_disputed = '1' where  r_txn_id = '".$txnId."'") ;
                $upd->execute() ;
            }
            
        }
    }
    
    if($_POST['btn_action'] == 'turnOn')
	{
        $upd = $pdo->prepare("update ot_users set email_comment = '1' , email_sale = '1' , email_itemupdate_approve = '1' , email_itemupdate_reject = '1' , email_author_reply = '1' , email_user_reply = '1' , email_item_rating = '1' , email_item_love = '1' , email_payout_release = '1' , email_forum_topic = '1'  where id = '".$_SESSION['unprofessional']['id']."'") ;
        $upd->execute() ;
    }
    
    if($_POST['btn_action'] == 'saveMyEmailSetting')
	{
        $email_comment = filter_var($_POST['emailComment'], FILTER_SANITIZE_NUMBER_INT) ;
        if($email_comment == '1'){
            $email_comment = 1 ;
        } else {
            $email_comment = 0 ;
        }
        
        $email_sale = filter_var($_POST['emailSale'], FILTER_SANITIZE_NUMBER_INT) ;
        if($email_sale == '1'){
            $email_sale = 1 ;
        } else {
            $email_sale = 0 ;
        }
        
        $email_itemupdate_approve = filter_var($_POST['emailUpdateApprove'], FILTER_SANITIZE_NUMBER_INT) ;
        if($email_itemupdate_approve == '1'){
            $email_itemupdate_approve = 1 ;
        } else {
            $email_itemupdate_approve = 0 ;
        }
        
        $email_itemupdate_reject = filter_var($_POST['emailUpdateReject'], FILTER_SANITIZE_NUMBER_INT) ;
        if($email_itemupdate_reject == '1'){
            $email_itemupdate_reject = 1 ;
        } else {
            $email_itemupdate_reject = 0 ;
        }
        
        $email_author_reply = filter_var($_POST['authorCommentReply'], FILTER_SANITIZE_NUMBER_INT) ;
        if($email_author_reply == '1'){
            $email_author_reply = 1 ;
        } else {
            $email_author_reply = 0 ;
        }
        
        $email_user_reply = filter_var($_POST['userCommentReply'], FILTER_SANITIZE_NUMBER_INT) ;
        if($email_user_reply == '1'){
            $email_user_reply = 1 ;
        } else {
            $email_user_reply = 0 ;
        }
        
        $email_item_rating = filter_var($_POST['newRating'], FILTER_SANITIZE_NUMBER_INT) ;
        if($email_item_rating == '1'){
            $email_item_rating = 1 ;
        } else {
            $email_item_rating = 0 ;
        }
        
        $email_item_love = filter_var($_POST['newLove'], FILTER_SANITIZE_NUMBER_INT) ;
        if($email_item_love == '1'){
            $email_item_love = 1 ;
        } else {
            $email_item_love = 0 ;
        }
        
        $email_payout_release = filter_var($_POST['payoutRelease'], FILTER_SANITIZE_NUMBER_INT) ;
        if($email_payout_release == '1'){
            $email_payout_release = 1 ;
        } else {
            $email_payout_release = 0 ;
        }
        
        $email_forum_topic = filter_var($_POST['forumTopic'], FILTER_SANITIZE_NUMBER_INT) ;
        if($email_forum_topic == '1'){
            $email_forum_topic = 1 ;
        } else {
            $email_forum_topic = 0 ;
        }
        
        $upd = $pdo->prepare("update ot_users set email_comment = '".$email_comment."' , email_sale = '".$email_sale."' , email_itemupdate_approve = '".$email_itemupdate_approve."' , email_itemupdate_reject = '".$email_itemupdate_reject."' , email_author_reply = '".$email_author_reply."' , email_user_reply = '".$email_user_reply."' , email_item_rating = '".$email_item_rating."' , email_item_love = '".$email_item_love."' , email_payout_release = '".$email_payout_release."' , email_forum_topic = '".$email_forum_topic."'  where id = '".$_SESSION['unprofessional']['id']."'") ;
        $upd->execute() ;
        echo "Email Setting Saved Successfully." ;
    }
    
    if($_POST['btn_action'] == 'saveMyPayoutEmail')
	{
        if(!empty($_POST['payoutEmail'])){
            $payoutEmail = filter_var($_POST['payoutEmail'], FILTER_SANITIZE_EMAIL) ;
            $upd = $pdo->prepare("update ot_users set user_payout_email = '".$payoutEmail."' where id = '".$_SESSION['unprofessional']['id']."'") ;
            $upd->execute() ;
            echo "Payout Email Saved Successfully." ;
        }
        
    }
    if($_POST['btn_action'] == 'changeMyPassword')
	{
        $oldpass = filter_var($_POST['oldpass'], FILTER_SANITIZE_STRING) ;
		$newpass = filter_var($_POST['newpass'], FILTER_SANITIZE_STRING) ;
		$repass = filter_var($_POST['repass'], FILTER_SANITIZE_STRING) ;
		$id = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT) ;
		$uppercase = preg_match('@[A-Z]@', $newpass);
		$lowercase = preg_match('@[a-z]@', $newpass);
		$number    = preg_match('@[0-9]@', $newpass);
		$statement = $pdo->prepare("select * from ot_users where id = ?");
		$statement->execute(array($id)) ;
		$result = $statement->fetchAll(PDO::FETCH_ASSOC); 
		$user_ok = $statement->rowCount();
		if($user_ok > 0) {
			foreach($result as $row){
				$auth_pass = _e($row['user_auth']) ;
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
						$update_password = $pdo->prepare("update ot_users set user_auth = ? where id = ?");
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
			$form_message = "This is not authorized user.";
			$output = array( 
					'form_message' => $form_message
					) ;
			echo json_encode($output);
		}
    }
    
    if($_POST['btn_action'] == 'completedeleteUserPausedItem')
	{	
		if(!empty($_POST['id'])){
            $itemId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $userId = filter_var($_SESSION['unprofessional']['id'], FILTER_SANITIZE_NUMBER_INT);
            $authorId = find_user_id_by_itemid($pdo,$itemId) ;
            
            if($authorId == $userId){
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
            } else {
                echo "You cannot manipulate data. Try Again." ;
            }
            
        }
    }
    
} 


?>