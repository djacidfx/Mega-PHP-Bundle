<?php

// *** Note - If you do not know PHP, OOPS & Classes then Do not touch any line or remove any spaces. Otheriwse, Website will break.

// 1 -  It saves from XSS Attacks

function _e($string) {
	return htmlentities(strip_tags($string), ENT_QUOTES, 'UTF-8');
}

// 2 -  Access Denied if Admin Not Logged In

function check_admin_logged_in($pdo){
    if(!isset($_SESSION['boss'])) 
    {
        header("location: ".ADMIN_URL."signout");
        exit;
    } 
}

// 3 -  Category Name

function category_name($pdo,$catId){
    $query = "SELECT * FROM ot_category WHERE id='".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['category_name']) ;
    }
    return $output ;
}

// 4 -  Category Videos Course Count

function category_course($pdo,$catId){
    $query = "SELECT count(item_id) as total_videos FROM ot_users_video WHERE item_category='".$catId."' and item_status = '1' and item_pause = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['total_videos']) ;
    }
    return $output ;
}

// 5 -  Category Views Count

function category_views($pdo,$catId){
    $query = "SELECT * FROM ot_category WHERE id='".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['category_view']) ;
    }
    return $output ;
}

// 6 -  Last 5 Categories

function last_five_categories($pdo){
    $query = "SELECT * FROM ot_category WHERE category_status = '1' order by id desc";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    if($total > 0) {
        foreach($result as $row)
        {

                $catId = _e($row['id']) ;
                $output .= '<li class="media">
                              <img class="mr-3 rounded" width="55" src="'.BASE_URL.'catImg/'._e($row['category_image']).'" alt="product">
                              <div class="media-body">
                                <div class="float-right"><div class="font-weight-600 text-muted text-small">'.category_course($pdo,$catId).' Course</div></div>
                                <div class="media-title">'.category_name($pdo,$catId).'</div>
                                <div class="mt-1">
                                    <div class="budget-price-label">'.category_views($pdo,$catId).' Views</div>
                                </div>
                              </div>
                            </li>';   


        }
    } else {
            $output .= '<li class="media text-muted justify-content-center">No Category</li>' ;
        }
	return ($output);
}

// 7 -  Show Active Category First Slider should be active on Users Home Page

function show_active_category_first_slider($pdo){
    $query = "SELECT max(id) as id, max(category_image) as category_image FROM ot_category WHERE  category_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    if($total > 0) {
        foreach($result as $row)
        {
                
                $catId = _e($row['id']) ;
                $output .= '<div class="carousel-item active">
                                
                                <div class="col-md-4 text-center ">
                                    <div class="card card-body decorationNone">
                                    <a href="'.BASE_URL.'category/'.$catId.'" class="text-muted">
                                        <img class="img-fluid" src="'.BASE_URL.'catImg/'._e($row['category_image']).'">
                                        <h5 class="mt-2">'.category_name($pdo,$catId).'</h5>
                                        <p class="mt-2"><small><b><i class="fa fa-video"></i> '.category_course($pdo,$catId).' Course&ensp;&ensp;<i class="fa fa-eye"></i> '.category_views($pdo,$catId).' Views</b></small></p>
                                    </a>
                                    </div>
                                </div>
                                
                            </div>';   


        }
    } else {
            $output .= '' ;
        }
	return ($output);
}

// 8 -  Show Active Category Slider on Users Home Page

function show_active_category_slider($pdo){
    $query = "SELECT * FROM ot_category WHERE id != (select max(id) from ot_category) and category_status = '1' order by category_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    if($total > 0) {
        foreach($result as $row)
        {
                
                $catId = _e($row['id']) ;
                $output .= '<div class="carousel-item ">
                                <div class="col-md-4 text-center ">
                                    <div class="card card-body decorationNone">
                                    <a href="'.BASE_URL.'category/'.$catId.'" class="text-muted">
                                        <img class="img-fluid" src="'.BASE_URL.'catImg/'._e($row['category_image']).'">
                                        <h5 class="mt-2">'.category_name($pdo,$catId).'</h5>
                                        <p class="mt-2"><small><b><i class="fa fa-video"></i> '.category_course($pdo,$catId).' Course&ensp;&ensp;<i class="fa fa-eye"></i> '.category_views($pdo,$catId).' Views</b></small></p>
                                    </div>
                                    </a>
                                </div>
                            </div>';   


        }
    } else {
            $output .= '' ;
        }
	return ($output);
}

// 9 -  Grab User Full Name

function user_fullname($pdo){
    $query = "SELECT * FROM ot_users WHERE id='".$_SESSION['unprofessional']['id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_fullname']) ;
    }
    return $output ;
}

// 10 -  Access Denied if User Not Logged In

function check_user_logged_in($pdo){
    if(!isset($_SESSION['unprofessional'])) {
        header("location: ".BASE_URL."logout");
        exit;
    } 
}

// 11 - Choose Active Category Options for User in Upload Form

function choose_category($pdo){
    $query = "SELECT * FROM ot_category WHERE category_status='1' order by category_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'._e($row['id']).'">'._e($row['category_name']).'</option>' ;
    }
    return $output ;
}

// 12 -  Count In Review Item for Users

function count_review($pdo){
    $query = "SELECT count(temp_id) as ct FROM ot_users_temp_video WHERE user_id='".$_SESSION['unprofessional']['id']."' and upload_success = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= '&ensp;<span class="badge badge-primary w-25 mt-n1">'._e($row['ct']).'</span>' ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 13 -  Count In Review Item for Admin

function count_review_for_admin($pdo){
    $query = "SELECT count(temp_id) as ct FROM ot_users_temp_video WHERE upload_success = '1'  and item_soft_reject = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}


// 14 -  Grab User Full Name by ID for Admin

function user_fullname_by_id($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_fullname']) ;
    }
    return $output ;
}

// 15 -  Grab Username by ID for Admin

function username_by_id($pdo,$userId) {
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_name']) ;
    }
    return $output ;
}

// 16 -  Grab User Email by ID for Admin

function useremail_by_id($pdo,$userId) {
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_email']) ;
    }
    return $output ;
}

// 17 - Grab Item Title by Temp ID

function itemtitle_by_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= strip_tags($row['item_title']) ;
    }
    return $output ;
}

// 18 - Grab Category Name by Temp ID

function categoryname_by_tempid($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $catId = _e($row['item_category']) ;
        $categoryName = category_name($pdo,$catId) ;
        $output .= $categoryName ;
    }
    return $output ;
}

// 19 - Grab Item Preview Image by Temp ID

function itempreview_by_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<div class="p-2"><img src='.BASE_URL.'tmpImg/'._e($row['item_preview_img']).' class="img-fluid" ></div>' ;
    }
    return $output ;
}

// 20 - Grab Item Demo Video by Temp ID

function itemdemovideo_by_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<div class="col-lg-12">
                        <div class="embed-responsive embed-responsive-16by9 rounded">
                         <video controls>
                              <source src="'.BASE_URL.'tmpVideos/'._e($row['item_demo_video']).'">
                              Your browser does not support the video tag.
                        </video>
                        </div> 
                    </div>' ;
    }
    return $output ;
}

// 21 - Grab Item Preview Image Size by Temp ID

function itemdemo_videosize_by_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_demo_video_size']) ;
    }
    return $output ;
}

// 22 - Grab Item Description by Temp ID

function itemdescription_by_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['item_description']) ;
    }
    return $output ;
}

// 23 - Grab Item Tags by Temp ID

function itemtags_by_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_tags']) ;
    }
    return $output ;
}

// 24 - Grab Comment to Reviewer by Temp ID

function reviewercomment_by_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= (strip_tags($row['reviewer_comment'])) ;
    }
    return $output ;
}

// 25 - Grab Main File Size by Temp ID

function item_mainfilesize_by_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_main_file_size']) ;
    }
    return $output ;
}

// 25 - Temp Main File Download to check by Admin via Temp ID

function temp_mainfile_download_by_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $tempFileSize = _e($row['item_main_file_size']) ;
        $mainFileName = _e($row['item_main_file']) ; 
        $output .= '<form method="POST" action="'.ADMIN_URL.'tempdownload" enctype="multipart/form-data">
                        <input type="hidden" name="mainfile_name" value="'.$mainFileName.'" >
                        <input type="submit" name="SaveMainfile" value="Download Main File - '.$tempFileSize.' MB" class="btn btn-primary btn-block" >
                    </form>';
    }
    return $output ;
}

// 26 - Grab Hard Reject Title Options for User in Temp Review Page

function choose_hr_title($pdo){
    $query = "SELECT * FROM ot_hr_title WHERE hr_status='1' order by hr_id desc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'._e($row['hr_id']).'">'._e($row['hr_title']).'</option>' ;
    }
    return $output ;
}

// 26 - Grab Hard Reject Reason Options for User in Temp Review Page

function choose_hr_reason($pdo){
    $query = "SELECT * FROM ot_hr_subject WHERE hr_sub_status='1' order by hr_sub_id desc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $strLength = nl2br($row['hr_sub_title']);
        if(strlen($strLength) > 60) {
			$dot = "...";
		} else {
			$dot = "";
		}
        $output .= '<option value="'._e($row['hr_sub_id']).'">'.strip_tags(substr_replace($row['hr_sub_title'], $dot, 60)).'</option>' ;
    }
    return $output ;
}

// 27 - Grab User ID by Temp ID

function find_user_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_id']) ;
    }
    return $output ;
}

// 28 - Grab Category ID by Temp ID

function find_cat_id($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_category']) ;
    }
    return $output ;
}

// 29 - Grab Temp Image Name by Temp ID

function find_temp_image($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_preview_img']) ;
    }
    return $output ;
}

// 30 - Grab Temp Video Name by Temp ID

function find_temp_video($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_demo_video']) ;
    }
    return $output ;
}

// 31 - Grab Temp Main File Name by Temp ID

function find_temp_file($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_main_file']) ;
    }
    return $output ;
}

// 31 - Grab Temp Item Price Name by Temp ID

function find_item_price($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_price']) ;
    }
    return $output ;
}


// 31 - Checking Temp Item is uploaded successfully by Temp ID and is in pending review

function checking_temp_item($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."' and upload_success='1' and item_soft_reject = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	if($total == 0){
        header("location: ".ADMIN_URL."inreview");
    }
}

// 32 - Grab Hard Reject Reason for User in User Panel

function grab_hr_reason_for_user($pdo,$reasonId){
    $query = "SELECT * FROM ot_hr_subject WHERE hr_sub_id='".$reasonId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        
        $output .= strip_tags(nl2br($row['hr_sub_title'])) ;
    }
    return $output ;
}

// 33 -  Count Hard Rejection for Admin 

function count_old_hard_reject($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        
        $output .= _e($row['hard_rejected']) ;
    }
    return $output ;
}

// 34 -  Count Soft Rejection of an Item for Admin by Temp ID

function count_old_soft_reject($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        
        $output .= _e($row['soft_reject_count']) ;
    }
    return $output ;
}

//35 - Count Soft Reject Item Notification for Users

function count_soft_reject_item($pdo) {
    $query = "SELECT count(temp_id) as ct FROM ot_users_temp_video WHERE user_id='".$_SESSION['unprofessional']['id']."' and upload_success = '0' and item_soft_reject = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= '&ensp;<span class="badge badge-primary w-25 mt-n1">'._e($row['ct']).'</span>' ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

//36 - Count Soft Reject Item for Users by Temp ID

function count_soft_reject_item_foruser($pdo,$tempId) {
    $query = "SELECT count(temp_id) as ct FROM ot_users_temp_video WHERE user_id='".$_SESSION['unprofessional']['id']."' and upload_success = '0' and item_soft_reject = '1' and temp_id = '".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']);
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

//37 - Soft Rejection Issues showing to User

function correct_soft_reject_issues($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE user_id='".$_SESSION['unprofessional']['id']."' and upload_success = '0' and item_soft_reject = '1' and temp_id = '".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if(!empty($row['additonal_instruction'])){
            $output .= '<li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><h5>Reviewer Comment</h5><i class="fas fa-comment text-success"></i> '.strip_tags(nl2br($row['additonal_instruction'])).' </div>
                        </div>
                      </div>
                    </li>' ;
        } 
        if($row['title_issue'] == '1'){
            $output .= '<li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-exclamation-circle text-danger"></i> Title Issue </div>
                        </div>
                      </div>
                    </li>' ;
        } 
        if($row['price_issue'] == '1'){
            $output .= '<li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-exclamation-circle text-danger"></i> Price Issue </div>
                        </div>
                      </div>
                    </li>' ;
        } 
        if($row['description_issue'] == '1'){
            $output .= '<li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-exclamation-circle text-danger"></i> Description Issue </div>
                        </div>
                      </div>
                    </li>' ;
        } 
        if($row['tags_issue'] == '1'){
            $output .= '<li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-exclamation-circle text-danger"></i> Tags Issue </div>
                        </div>
                      </div>
                    </li>' ;
        } 
        if($row['category_issue'] == '1'){
            $output .= '<li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-exclamation-circle text-danger"></i> Category Issue </div>
                        </div>
                      </div>
                    </li>' ;
        } 
        if($row['preview_issue'] == '1'){
            $output .= '<li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-exclamation-circle text-danger"></i> Preview Image Issue </div>
                        </div>
                      </div>
                    </li>' ;
        } 
        if($row['demo_issue'] == '1'){
            $output .= '<li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-exclamation-circle text-danger"></i> Demo Video Issue </div>
                        </div>
                      </div>
                    </li>' ;
        } 
        if($row['mainfile_issue'] == '1'){
            $output .= '<li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-exclamation-circle text-danger"></i> Main File Issue </div>
                        </div>
                      </div>
                    </li>' ;
        }
        
    }
    return $output ;
}

// 38 - Choose other category by temp id

function choose_category_by_tempid($pdo,$tempId) {
    $catId = find_cat_id($pdo,$tempId) ; 
    $query = "SELECT * FROM ot_category WHERE category_status='1' and id != '".$catId."' order by category_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'._e($row['id']).'">'._e($row['category_name']).'</option>' ;
    }
    return $output ;
}

// 39 - Choose other category by temp id

function selected_old_category_by_tempid($pdo,$tempId) {
    $catId = find_cat_id($pdo,$tempId) ; 
    $query = "SELECT * FROM ot_category WHERE category_status='1' and id = '".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'._e($row['id']).'">'._e($row['category_name']).'</option>' ;
    }
    return $output ;
}

// 40 - Checking Soft Rejects Uploaded Successfully.

function checking_softreject_item($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."' and upload_success='0' and item_soft_reject = '1' and user_id = '".$_SESSION['unprofessional']['id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	if($total == 0){
        header("location: ".BASE_URL."softrejects");
    }
}

// 41 - Count Soft Reject Review for Admin 

function count_soft_reject_review_for_admin($pdo) {
    $query = "SELECT count(temp_id) as ct FROM ot_users_temp_video WHERE upload_success = '1'  and item_soft_reject = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 42 - Checking Soft Reject Temp Item is uploaded successfully by Temp ID and is in pending review

function checking_tempsr_item($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."' and upload_success='1' and item_soft_reject = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	if($total == 0){
        header("location: ".ADMIN_URL."softrejectreview");
    }
}

//43 - Soft Rejection Issues showing to Admin on Soft Reject Review Page

function previous_soft_reject_issues($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE upload_success = '1' and item_soft_reject = '1' and temp_id = '".$tempId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if(!empty($row['additonal_instruction'])){
            $output .= '<h5>Reviewer Comment</h5><p><i class="fas fa-comment text-success"></i> '.strip_tags(nl2br($row['additonal_instruction'])).'</p><h5>Previous Issues</h5> <p><i class="fas fa-exclamation-circle text-danger"></i>&ensp;' ;
        } 
        if($row['title_issue'] == '1'){
            $output .= ' Title Issue,&ensp; ' ;
        } 
        if($row['price_issue'] == '1'){
            $output .= 'Price Issue,&ensp;' ;
        } 
        if($row['description_issue'] == '1'){
            $output .= 'Description Issue,&ensp;' ;
        } 
        if($row['tags_issue'] == '1'){
            $output .= 'Tags Issue,&ensp;' ;
        } 
        if($row['category_issue'] == '1'){
            $output .= 'Category Issue,&ensp;' ;
        } 
        if($row['preview_issue'] == '1'){
            $output .= 'Preview Image Issue,&ensp;' ;
        } 
        if($row['demo_issue'] == '1'){
            $output .= 'Demo Video Issue,&ensp;' ;
        } 
        if($row['mainfile_issue'] == '1'){
            $output .= 'Main File Issue,&ensp;' ;
        }
        $output .= '</p>' ;
        
    }
    return $output ;
}

// 43 - User Achieved Author Badge or Not by approving at least 1 Item

function check_author_badge($pdo,$userId) {
    $query = "SELECT * FROM ot_author_badge WHERE user_id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	return $total ;
}

// 44 - Checking Active Item is active & Not Pause for sale, If deactive no one can access this item and redrect to home page.

function checking_active_item($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."' and item_status='1' and item_pause = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	if($total == 0){
        header("location: ".BASE_URL."error");
    }
}

// 45 - Count How many Items Admin want to show everywhere on Default

function get_limit_default($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row["default_load"]) ;
	}
	return ($output);
}

// 46 - Count How many Items Admin want to show on Load means when pressing on Load More Button

function get_limit_onload($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row["on_load"]) ;
	}
	return ($output);
}

// 47 - Active Item is active & Not Pause for sale on home page.

function new_item_on_indexpage($pdo) {
    $limit = get_limit_default($pdo);
    $query = "SELECT * FROM ot_users_video WHERE item_status='1' and item_pause = '1' order by item_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-video fa-lg text-muted mt-n1"></i> New </h1></div>
                          <div class="col-lg-4 col-md-4 col-sm-4 text-lg-right"><a href="'.BASE_URL.'new" class="btn btn-sm btn-primary">Browse All</a></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        $output .= '</div> ';
    }
    return $output ; 
}

// 48 - Grab Item Demo Video by Original ID

function active_itemdemovideo_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<div class="col-lg-12 p-0">
                        <div class="embed-responsive embed-responsive-16by9 rounded">
                         <video controls>
                              <source src="'.BASE_URL.'mainVideos/'._e($row['item_demo_video']).'">
                              Your browser does not support the video tag.
                        </video>
                        </div> 
                    </div>' ;
    }
    return $output ;
}

// 48 - Grab Item Demo Video by Original ID

function active_itemdescription_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['item_description']) ;
    }
    return $output ;
}

// 49 - Grab Item Sales by Original ID

function active_itemsales_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_sale']) ;
    }
    return $output ;
}

// 50 - Grab Item Rating with Star by Original ID

function active_itemrating_star_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
        $itemRating = _e($row['item_rating']) ;
        $itemRatedBy = _e($row['item_rated_by']) ;
        if($itemRating > 0 && $itemRating <= 0.5){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:10%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">('.$itemRating.' based on '.$itemRatedBy.' Rating)</small>
                            </a>
                        </div>' ;
        }
        if($itemRating > 0.5 && $itemRating <= 1){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:20%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">('.$itemRating.' based on '.$itemRatedBy.' Rating)</small>
                            </a>
                        </div>' ;
        }
        if($itemRating > 1 && $itemRating <= 1.5){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:30%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">('.$itemRating.' based on '.$itemRatedBy.' Rating)</small>
                            </a>
                        </div>' ;
        }
        if($itemRating > 1.5 && $itemRating <= 2){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:40%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">('.$itemRating.' based on '.$itemRatedBy.' Rating)</small>
                            </a>
                        </div>' ;
        }
        if($itemRating > 2 && $itemRating <= 2.5){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:50%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">('.$itemRating.' based on '.$itemRatedBy.' Rating)</small>
                            </a>
                        </div>' ;
        }
        if($itemRating > 2.5 && $itemRating <= 3){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:60%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">('.$itemRating.' based on '.$itemRatedBy.' Rating)</small>
                            </a>
                        </div>' ;
        }
        if($itemRating > 3 && $itemRating <= 3.5){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:70%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">('.$itemRating.' based on '.$itemRatedBy.' Rating)</small>
                            </a>
                        </div>' ;
        }
        if($itemRating > 3.5 && $itemRating <= 4){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:80%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">('.$itemRating.' based on '.$itemRatedBy.' Rating)</small>
                            </a>
                        </div>' ;
        }
        if($itemRating > 4 && $itemRating <= 4.5){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:90%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">('.$itemRating.' based on '.$itemRatedBy.' Rating)</small>
                            </a>
                        </div>' ;
        }
        if($itemRating > 4.5 ){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:100%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">('.$itemRating.' based on '.$itemRatedBy.' Rating)</small>
                            </a>
                        </div>' ;
        }
        if($itemRating == 0 ){
            $output .= '<span class="score">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:0%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>
                        <div class="col-lg-12 mt-n3 p-0">
                            <a href="'.BASE_URL.'ratings/'.$itemId.'/'.$itemUrlTitle.'" class="text-primary">
                            <small class="text-primary">(No Ratings Yet)</small>
                            </a>
                        </div>' ;
        }
        
    }
    return $output ;
}

// 51 - Count Comment on Item 

function count_comments($pdo,$itemId) {
    $query = "SELECT count(comment_id) as ct FROM ot_comments WHERE comment_item_id = '".$itemId."' and comment_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "0" ;
        }
    }
    return $output ;
}

// 52 - Count Loves on Item 

function count_loves($pdo,$itemId) {
    $query = "SELECT item_love as ct FROM ot_users_video WHERE item_id = '".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "0" ;
        }
    }
    return $output ;
}

// 53 - Item Featured

function item_featured($pdo,$itemId) {
    $query = "SELECT * FROM ot_featured WHERE featured_item_id = '".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 54 - Grab Item Price Name by ID

function find_activeitem_price($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_price']) ;
    }
    return $output ;
}

// 55 - Grab Short Item Title 

function short_title_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $strLength = strip_tags($row['item_title']);
		if(strlen($strLength) > 25) {
			$dot = "...";
		} else {
			$dot = "";
		}
        $output .= strip_tags(substr_replace($row['item_title'], $dot, 25)) ;
    }
    return $output ;
}

// 56 - Grab Short Item Title for URL

function item_urltitle_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $itemTitle = _e($row['item_title']) ;
        $itemUrlTitle = preg_replace("/[^\w]+/", "-", $itemTitle);
        $itemUrlTitle = strtolower($itemUrlTitle)  ;
        $output .= strtolower($itemUrlTitle) ;
    }
    return $output ;
}

// 57 - Grab Item Rating with Star for Preview by Original ID

function preview_itemrating_star_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $itemRating = _e($row['item_rating']) ;
        $itemRatedBy = _e($row['item_rated_by']) ;
        if($itemRating > 0 && $itemRating <= 0.5){
            $output .= '<span class="newscore text-left">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:10%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        if($itemRating > 0.5 && $itemRating <= 1){
            $output .= '<span class="newscore text-left">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:20%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        if($itemRating > 1 && $itemRating <= 1.5){
            $output .= '<span class="newscore text-left">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:30%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        if($itemRating > 1.5 && $itemRating <= 2){
            $output .= '<span class="newscore">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:40%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        if($itemRating > 2 && $itemRating <= 2.5){
            $output .= '<span class="newscore text-left">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:50%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        if($itemRating > 2.5 && $itemRating <= 3){
            $output .= '<span class="newscore text-left">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:60%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        if($itemRating > 3 && $itemRating <= 3.5){
            $output .= '<span class="newscore text-left">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:70%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        if($itemRating > 3.5 && $itemRating <= 4){
            $output .= '<span class="newscore text-left">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:80%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        if($itemRating > 4 && $itemRating <= 4.5){
            $output .= '<span class="newscore text-left">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:90%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        if($itemRating > 4.5 ){
            $output .= '<span class="newscore text-left">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:100%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        if($itemRating == 0 ){
            $output .= '<span class="newscore text-left">
                            <div class="score-wrap">
                                <span class="stars-active" style="width:0%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                                <span class="stars-inactive">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </span>

                            </div>
                        </span>' ;
        }
        
    }
    return $output ;
}

// 58 - Category Preview Image as Icon

function category_icon_image($pdo,$catId){
    $query = "SELECT * FROM ot_category WHERE id='".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<img class="img-fluid roundBadge float-left" src="'.BASE_URL.'catImg/'._e($row['category_image']).'">' ;
    }
    return $output ;
}

// 59 - Inside Preview Common Design
function inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales) {
    
    $output = '<div class="col-lg-4">
                    <div class="card">
                          <div class="card-header p-3">
                            <a href="'.BASE_URL.'video/'.$itemId.'/'.$itemUrlTitle.'" ><h4>'.$itemTitle.'</h4></a>
                          </div>
                          <div class="card-body p-3">
                            <div class="chocolat-parent">
                              <a href="'.BASE_URL.'video/'.$itemId.'/'.$itemUrlTitle.'" class="chocolat-image" title="">

                                  <img alt="'.$itemTitle.'" src="'.BASE_URL.'mainImg/'.$imageName.'" class="img-fluid">
                              </a>
                            </div>
                          </div>
                          <hr class="hrLine negativeMargin">
                          <div class="card-footer text-right mt-n2 p-3">
                           '.category_icon_image($pdo,$catId).' '.preview_itemrating_star_by_id($pdo,$itemId).'&ensp;'.$itemSales.'&ensp;<a href="'.BASE_URL.'video/'.$itemId.'/'.$itemUrlTitle.'" class="btn btn-sm btn-light"><b class="bigFont text-primary">$'.find_activeitem_price($pdo,$itemId).'</b></a>
                          </div>
                        </div>
                </div> ' ;
    return $output ;
}

// 60 - Featured Item is active & Not Pause for sale on home page.

function featured_item_on_indexpage($pdo) {
    $limit = get_limit_default($pdo);
    $query = "SELECT item_id, item_preview_image, item_category, item_price, item_sale FROM ot_featured left join ot_users_video on (ot_users_video.item_id = ot_featured.featured_item_id) WHERE item_status='1' and item_pause = '1' order by featured_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-star fa-lg text-muted mt-n1"></i> Featured </h1></div>
                          <div class="col-lg-4 col-md-4 col-sm-4 text-lg-right"><a href="'.BASE_URL.'featured" class="btn btn-sm btn-primary">Browse All</a></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            $username = get_username_by_itemid($pdo,$itemId) ;
            $userId = userid_by_username($pdo,$username) ;
            if(check_featuredfile_badge($pdo,$userId) == '0'){
                $ins = $pdo->prepare("insert into ot_featured_author_file (featured_file_user_id) values ('".$userId."')");
                $ins->execute();
            }
            if($itemSales > 0) {
                $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        $output .= '</div> ';
    }
    return $output ; 
}

// 61 - Trending Item is active & Not Pause for sale on home page.

function trending_item_on_indexpage($pdo) {
    $limit = get_limit_default($pdo);
    $query = "SELECT sum(item_sale + item_love + item_viewed) as totalSum ,item_id, item_preview_image, item_category, item_price, item_sale FROM ot_users_video WHERE item_status='1' and item_pause = '1' group by item_id order by totalSum desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-signal fa-lg text-muted mt-n1"></i> Trending </h1></div>
                          <div class="col-lg-4 col-md-4 col-sm-4 text-lg-right"><a href="'.BASE_URL.'trending" class="btn btn-sm btn-primary">Browse All</a></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            $username = get_username_by_itemid($pdo,$itemId) ;
            $userId = userid_by_username($pdo,$username) ;
            if(check_trending_badge($pdo,$userId) == '0'){
                $ins = $pdo->prepare("insert into ot_trendsetter (trending_user_id) values ('".$userId."')");
                $ins->execute();
            }
            if($itemSales > 0) {
                $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        $output .= '</div> ';
    }
    return $output ; 
}

// 61 - Best Sellers Item is active & Not Pause for sale on home page.

function bestsellers_item_on_indexpage($pdo) {
    $limit = get_limit_default($pdo);
    $query = "SELECT * FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_sale != '0' order by item_sale desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-dollar-sign fa-lg text-muted mt-n1"></i> Best Sellers </h1></div>
                          <div class="col-lg-4 col-md-4 col-sm-4 text-lg-right "><a href="'.BASE_URL.'bestsellers" class="btn btn-sm btn-primary">Browse All</a></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
                $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        $output .= '</div> ';
    }
    return $output ; 
}

// 62 - Fetch All New Active Items.

function fetch_all_new_item_default($pdo) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT count(*) as number_rows FROM ot_users_video WHERE item_status = '1'  and item_pause = '1' order by item_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ot_users_video WHERE item_status='1' and item_pause = '1' order by item_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-video fa-lg text-muted mt-n1"></i> New </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_item" id="show_more_new_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ; 
}

// 63 - Fetch All New Item when Press Load More Button

function fetch_all_new_item_onload($pdo){
    $limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM ot_users_video WHERE item_status = '1'  and item_pause = '1' and item_id < ".$_GET['id']." order by item_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_id < ".$_GET['id']." order by item_id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $output .= '<div class="row mt-2">' ;
	foreach($result as $row)
	{
		$itemId = _e($row['item_id']);
        $imageName = _e($row['item_preview_image']) ;
        $itemTitle = short_title_by_id($pdo,$itemId) ;
        $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
        $catId = _e($row['item_category']) ;
        $itemSales = _e($row['item_sale']) ;
        if($itemSales > 0) {
           $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
        } else {
            $itemSales = "" ;
        }
        $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
	}
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_item" id="show_more_new_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	$output .='</div>';
	return ($output);
}

// 64 - Fetch All Featured Items.

function fetch_all_featured_item_default($pdo) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT count(featured_id) as number_rows FROM ot_featured left join ot_users_video on (ot_users_video.item_id = ot_featured.featured_item_id) WHERE item_status='1' and item_pause = '1' " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT featured_id, item_id, item_preview_image, item_category, item_price, item_sale FROM ot_featured left join ot_users_video on (ot_users_video.item_id = ot_featured.featured_item_id) WHERE item_status='1' and item_pause = '1' order by featured_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-star fa-lg text-muted mt-n1"></i> Featured </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $featuredId = _e($row['featured_id']);
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_featured_item" id="show_more_featured_item'.$featuredId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$featuredId.'" class="show_more_allfeatured_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ; 
}

// 65 - Fetch All Featured Items when Load More Button Press.

function fetch_all_featured_item_onload($pdo) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT count(featured_id) as number_rows FROM ot_featured left join ot_users_video on (ot_users_video.item_id = ot_featured.featured_item_id) WHERE item_status='1' and item_pause = '1' and featured_id < ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT featured_id, item_id, item_preview_image, item_category, item_price, item_sale FROM ot_featured left join ot_users_video on (ot_users_video.item_id = ot_featured.featured_item_id) WHERE item_status='1' and item_pause = '1' and featured_id < ".$_GET['id']." order by featured_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $featuredId = _e($row['featured_id']);
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_featured_item" id="show_more_featured_item'.$featuredId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$featuredId.'" class="show_more_allfeatured_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ; 
}

// 66 - Fetch All Trending Item

function fetch_all_trending_item_default($pdo){
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT sum(item_sale + item_love + item_viewed) as totalSum ,item_id, item_preview_image, item_category, item_price, item_sale FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id order by totalSum desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-signal fa-lg text-muted mt-n1"></i> Trending </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_trending_item" id="show_more_trending_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_alltrending_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
    
}

// 67 - Fetch All Trending Item when User press Load More button

function fetch_all_trending_item_onload($pdo) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT sum(item_sale + item_love + item_viewed) as totalSum ,item_id, item_preview_image, item_category, item_price, item_sale FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id order by totalSum desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_trending_item" id="show_more_trending_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_alltrending_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ; 
}

// 68 - Fetch All Best Seller Item on Deafault 

function fetch_all_bestseller_item_default($pdo) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id order by item_sale desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-dollar-sign fa-lg text-muted mt-n1"></i> Best Sellers </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_bestseller_item" id="show_more_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_allbestseller_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 69 - Fetch Best Seller Item when User Press Load More Button

function fetch_all_bestseller_item_onload($pdo){
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id order by item_sale desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_bestseller_item" id="show_more_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_allbestseller_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 70 - Fetch Low to High Price Items on Default

function fetch_all_lowtohigh_price_item_default($pdo) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id order by item_price asc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-chevron-circle-up fa-lg text-muted mt-n1"></i> Low to High Price </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_lowtohigh_item" id="show_more_lowtohigh_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_lowtohigh_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 71 - Fetch Low to High Price Item when User Press Load More Button

function fetch_all_lowtohigh_price_item_onload($pdo){
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id order by item_price asc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_lowtohigh_item" id="show_more_lowtohigh_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_lowtohigh_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 72 - Fetch High to Low Price Item on Default 

function fetch_all_hightolow_price_item_default($pdo) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id order by item_price desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-chevron-circle-down fa-lg text-muted mt-n1"></i> High to Low Price </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_hightolow_item" id="show_more_hightolow_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_hightolow_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 72 - Fetch High to Low Price Item when User Press Load More Button

function fetch_all_hightolow_price_item_onload($pdo) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price FROM ot_users_video WHERE item_status='1' and item_pause = '1' GROUP BY item_id order by item_price desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_hightolow_item" id="show_more_hightolow_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_hightolow_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 73 - Fetch Above 4.5 Star Item on Default 

function fetch_all_fourfive_star_item_default($pdo) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_rating > 4.5 GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_rating > 4.5 GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-star-half-alt fa-lg text-muted mt-n1"></i> Above 4.5 Star Rating </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_fourfive_star_item" id="show_more_fourfive_star_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_fourfive_star_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 74 - Fetch Above 4.5 Star Item when User Press Load More Button

function fetch_all_fourfive_star_item_onload($pdo) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_rating > 4.5 GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_rating > 4.5 GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_fourfive_star_item" id="show_more_fourfive_star_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_fourfive_star_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 75 - Fetch Above 4 Star Item on Default 

function fetch_all_four_star_item_default($pdo) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_rating > 4 GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_rating > 4 GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-star-half-alt fa-lg text-muted mt-n1"></i> Above 4 Star Rating </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_four_star_item" id="show_more_four_star_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_four_star_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 76 - Fetch Above 4 Star Item when User Press Load More Button

function fetch_all_four_star_item_onload($pdo) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_rating > 4 GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_rating > 4 GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_four_star_item" id="show_more_four_star_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_four_star_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 77 - Fetch Above 3 Star Item on Default 

function fetch_all_three_star_item_default($pdo) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_rating > 3 GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_rating > 3 GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-star-half-alt fa-lg text-muted mt-n1"></i> Above 3 Star Rating </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_three_star_item" id="show_more_three_star_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_three_star_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 78 - Fetch Above 3 Star Item when User Press Load More Button

function fetch_all_three_star_item_onload($pdo) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_rating > 3 GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_rating > 3 GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_three_star_item" id="show_more_three_star_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_three_star_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 79 - Fetch Above 2 Star Item on Default 

function fetch_all_two_star_item_default($pdo) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_rating > 2 GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_rating > 2 GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-star-half-alt fa-lg text-muted mt-n1"></i> Above 2 Star Rating </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_two_star_item" id="show_more_two_star_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_two_star_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 80 - Fetch Above 2 Star Item when User Press Load More Button

function fetch_all_two_star_item_onload($pdo) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_rating > 2 GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_rating > 2 GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_two_star_item" id="show_more_two_star_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_two_star_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 81 - Fetch Above 1 Star Item on Default 

function fetch_all_one_star_item_default($pdo) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_rating > 1 GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_rating > 1 GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fas fa-star-half-alt fa-lg text-muted mt-n1"></i> Above 1 Star Rating </h1></div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_one_star_item" id="show_more_one_star_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_one_star_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 80 - Fetch Above 1 Star Item when User Press Load More Button

function fetch_all_one_star_item_onload($pdo) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_rating > 1 GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_rating > 1 GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_one_star_item" id="show_more_one_star_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_all_one_star_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 81 -  Category Short Name for Left Sidebar

function category_short_name($pdo,$catId){
    $query = "SELECT * FROM ot_category WHERE id='".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $strLength = strip_tags($row['category_name']);
		if(strlen($strLength) > 20) {
			$dot = "..";
		} else {
			$dot = "";
		}
        $output .= strip_tags(substr_replace($row['category_name'], $dot, 20)) ;
    }
    return $output ;
}

// 82 - Active Category List on Left Sidebar

function active_category_list_for_sidebar($pdo){
    $query = "SELECT * FROM ot_category WHERE category_status = '1' order by category_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $catId = _e($row['id']) ;
        $catName = _e($row['category_name']) ;
        $catShortName =  category_short_name($pdo,$catId) ;
        if(!empty($_GET['cat_id'])) {
            if($catId == $_GET['cat_id']) {
                $catActive = "active" ;
            } else {
                $catActive = "" ;
            }
        } else {
            $catActive = "" ;
        }
        
        $output .= '<li class="'.$catActive.'"><a class="nav-link" href="'.BASE_URL.'category/'.$catId.'">'.$catShortName.'</a></li>';
    }
    return $output ;
}

// 83 - Increase Category Views Count when anyone view

function increase_category_view($pdo,$catId) {
    $CatViews = category_views($pdo,$catId) + 1 ;
    $query = "update ot_category set category_view = '".$CatViews."' WHERE category_status = '1' and id = '".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    return true ;
}

// 84 - Checking Category is Active otherwise Access Denied

function checking_active_category($pdo,$catId) {
    $query = "SELECT * FROM ot_category WHERE id='".$catId."' and category_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	if($total == 0){
        header("location: ".BASE_URL."error");
    }
    return $total ; 
}

// 85 - Category Preview Image as Big Icon

function category_bigicon_image($pdo,$catId){
    $query = "SELECT * FROM ot_category WHERE id='".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<img class="img-fluid w-25" src="'.BASE_URL.'catImg/'._e($row['category_image']).'">' ;
    }
    return $output ;
}

// 86 - Fetch Category Item on Default

function fetch_category_item_default($pdo,$catId) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT count(*) as number_rows FROM ot_users_video WHERE item_status = '1'  and item_pause = '1' and item_category = '".$catId."' order by item_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' order by item_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8">
                            '.category_bigicon_image($pdo,$catId).'
                          </div>
                          <div class="col-lg-4 mt-5">
                            <select class="form-control mt-3" onchange="location = this.value;">
                                <option value="'.BASE_URL.'category/'.$catId.'" selected>New Releases</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&seller=bestseller">Best Sellers</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&price=lowest" >Lowest Price</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&highprice=highest" >Highest Price</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&rating=top" >Highest Rating</option>
                                
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_category_new_item" id="show_more_category_new_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_category_newest_item btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 87 - Fetch Category New Item when User press Load More Button

function fetch_category_item_onload($pdo,$catId) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT count(*) as number_rows FROM ot_users_video WHERE item_status = '1'  and item_pause = '1'  and item_id < ".$_GET['id']." and item_category = '".$catId."' order by item_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_id < ".$_GET['id']." and item_category = '".$catId."' order by item_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if(empty($itemId)){
			$itemId = "";
		}
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_category_new_item" id="show_more_category_new_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_category_newest_item btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 88 - Fetch Category Best Seller Item on Default

function fetch_category_item_bestseller_default($pdo,$catId) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id order by item_sale desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8">
                            '.category_bigicon_image($pdo,$catId).'
                          </div>
                          <div class="col-lg-4 mt-5">
                            <select class="form-control mt-3" onchange="location = this.value;">
                                <option value="'.BASE_URL.'category/'.$catId.'" >New Releases</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&seller=bestseller" selected>Best Sellers</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&price=lowest" >Lowest Price</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&highprice=highest" >Highest Price</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&rating=top" >Highest Rating</option>
                                
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if(empty($additionalId)){
			$additionalId = "";
		}
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_category_bestseller_item" id="show_more_category_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_category_toppers_item btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 89 - Fetch Category Best Seller when User Press Load More Button 

function fetch_category_item_bestseller_onload($pdo,$catId) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id order by item_sale desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if(empty($additionalId)){
			$additionalId = "";
		}
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_category_bestseller_item" id="show_more_category_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_category_toppers_item btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 90 - Fetch Category Lowest Price Item on Default

function fetch_category_item_lowprice_default($pdo,$catId) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id order by item_price asc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8">
                            '.category_bigicon_image($pdo,$catId).'
                          </div>
                          <div class="col-lg-4 mt-5">
                            <select class="form-control mt-3" onchange="location = this.value;">
                                <option value="'.BASE_URL.'category/'.$catId.'" >New Releases</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&seller=bestseller">Best Sellers</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&price=lowest" selected>Lowest Price</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&highprice=highest" >Highest Price</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&rating=top" >Highest Rating</option>
                                
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if(empty($additionalId)){
			$additionalId = "";
		}
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_category_lowprice_item" id="show_more_lowprice_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_category_lowestprice_item btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 91 - Fetch Category Lowest Price Item when User Press Load More Button 

function fetch_category_item_lowprice_onload($pdo,$catId) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id order by item_price asc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if(empty($additionalId)){
			$additionalId = "";
		}
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_category_lowprice_item" id="show_more_lowprice_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_category_lowestprice_item btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 92 - Fetch Category Highest Price Item on Default

function fetch_category_item_highprice_default($pdo,$catId) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id order by item_price desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8">
                            '.category_bigicon_image($pdo,$catId).'
                          </div>
                          <div class="col-lg-4 mt-5">
                            <select class="form-control mt-3" onchange="location = this.value;">
                                <option value="'.BASE_URL.'category/'.$catId.'" >New Releases</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&seller=bestseller">Best Sellers</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&price=lowest" >Lowest Price</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&highprice=highest" selected>Highest Price</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&rating=top" >Highest Rating</option>
                                
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if(empty($additionalId)){
			$additionalId = "";
		}
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_category_highprice_item" id="show_more_highprice_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_category_highestprice_item btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 93 - Fetch Category Highest Price Item when User Press Load More Button 

function fetch_category_item_highprice_onload($pdo,$catId) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id order by item_price desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if(empty($additionalId)){
			$additionalId = "";
		}
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_category_highprice_item" id="show_more_highprice_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_category_highestprice_item btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 94 - Fetch Category Highest Rating Item on Default

function fetch_category_item_highrating_default($pdo,$catId) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="section-header">
                        <div class="row no-gutters w-100">
                          <div class="col-lg-8">
                            '.category_bigicon_image($pdo,$catId).'
                          </div>
                          <div class="col-lg-4 mt-5">
                            <select class="form-control mt-3" onchange="location = this.value;">
                                <option value="'.BASE_URL.'category/'.$catId.'" >New Releases</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&seller=bestseller">Best Sellers</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&price=lowest" >Lowest Price</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&highprice=highest" >Highest Price</option>
                                <option value="'.BASE_URL.'category/'.$catId.'&rating=top" selected>Highest Rating</option>
                                
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if(empty($additionalId)){
			$additionalId = "";
		}
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_category_highrating_item" id="show_more_highrating_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_category_highestrating_item btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 95 - Fetch Category Highest Rating Item when User Press Load More Button 

function fetch_category_item_highrating_onload($pdo,$catId) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and item_category = '".$catId."' GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if(empty($additionalId)){
			$additionalId = "";
		}
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_category_highrating_item" id="show_more_highrating_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_more_category_highestrating_item btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 96 - Fetch Last 3 Featured Item for Search Page

function featured_item_on_searchpage($pdo) {
    $limit = "3";
    $query = "SELECT item_id, item_preview_image, item_category, item_price, item_sale FROM ot_featured left join ot_users_video on (ot_users_video.item_id = ot_featured.featured_item_id) WHERE item_status='1' and item_pause = '1' order by featured_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="search-header">Featured</div>';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $output .= '<div class="search-item">
                            <a href="'.BASE_URL.'video/'.$itemId.'/'.$itemUrlTitle.'">
                              <img alt="'.$itemTitle.'" src="'.BASE_URL.'mainImg/'.$imageName.'" class="mr-3 roundBadge" alt="'.$itemTitle.'">
                              '.$itemTitle.'
                            </a>
                              <a href="'.BASE_URL.'video/'.$itemId.'/'.$itemUrlTitle.'" class="search-close"><i class="fas fa-star text-warning"></i></a>
                        </div>';
        }
        $output .= '';
    }
    return $output ; 
}

// 97 - Fetch Last 3 Trending Item for Search Page

function trending_item_on_searchpage($pdo) {
    $limit = "3";
    $query = "SELECT sum(item_sale + item_love + item_viewed) as totalSum ,item_id, item_preview_image, item_category, item_price, item_sale FROM ot_users_video WHERE item_status='1' and item_pause = '1' group by item_id order by totalSum desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="search-header">Trending</div>';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $output .= '<div class="search-item">
                            <a href="'.BASE_URL.'video/'.$itemId.'/'.$itemUrlTitle.'">
                              <img alt="'.$itemTitle.'" src="'.BASE_URL.'mainImg/'.$imageName.'" class="mr-3 roundBadge" alt="'.$itemTitle.'">
                              '.$itemTitle.'
                            </a>
                              <a href="'.BASE_URL.'video/'.$itemId.'/'.$itemUrlTitle.'" class="search-close"><i class="fas fa-chart-line text-warning"></i></a>
                        </div>';
        }
        $output .= '';
    }
    return $output ; 
}

// 98 - Fetch Items when User Search 

function fetch_searchallproduct_foruser($pdo,$search) {
	
	$limit = get_limit_default($pdo);
	$newstring = implode(", ", preg_split("/[\s]+/", $search));
	$sql = "SELECT count(*) as number_rows FROM `ot_users_video` WHERE item_status ='1' and item_pause='1' and (item_title LIKE '%$search%' OR item_tags LIKE '%$newstring%')" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM `ot_users_video` WHERE item_status ='1' and item_pause='1' and (item_title LIKE '%$search%' OR item_tags LIKE '%$newstring%') order by item_id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = $statement->rowCount();
	$output = '';
	if($total > 0) {
	$output .='<div class="row">';
	
	foreach($result as $row)
    {
        $itemId = _e($row['item_id']);
        $imageName = _e($row['item_preview_image']) ;
        $itemTitle = short_title_by_id($pdo,$itemId) ;
        $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
        $catId = _e($row['item_category']) ;
        $itemSales = _e($row['item_sale']) ;
        if($itemSales > 0) {
           $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
        } else {
            $itemSales = "" ;
        }
        $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
    }
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_search" id="show_more_new_search'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_search btn btn-primary btn-sm ann'.$search.'" >Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
		$output .='</div>';
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> Sorry, Nothing Found. Try with other Search Term.</h3>';
	}
	return ($output);

}

// 99 - Fetch Items when User Search & Press Load More Button

function fetch_searchallproduct_foruser_onload($pdo,$search,$itemId) {
	
	$limit = get_limit_onload($pdo);
	$newstring = implode(", ", preg_split("/[\s]+/", $search));
	$sql = "SELECT count(*) as number_rows FROM `ot_users_video` WHERE item_status ='1' and item_pause='1' and item_id < ".$itemId." and (item_title LIKE '%$search%' OR item_tags LIKE '%$newstring%')" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM `ot_users_video` WHERE item_status ='1' and item_pause='1' and item_id < ".$itemId." and (item_title LIKE '%$search%' OR item_tags LIKE '%$newstring%') order by item_id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = $statement->rowCount();
	$output = '';
	if($total > 0) {
	$output .='<div class="row">';
	
	foreach($result as $row)
    {
        $itemId = _e($row['item_id']);
        $imageName = _e($row['item_preview_image']) ;
        $itemTitle = short_title_by_id($pdo,$itemId) ;
        $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
        $catId = _e($row['item_category']) ;
        $itemSales = _e($row['item_sale']) ;
        if($itemSales > 0) {
           $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
        } else {
            $itemSales = "" ;
        }
        $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
    }
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_search" id="show_more_new_search'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_search btn btn-primary btn-sm ann'.$search.'" >Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
		$output .='</div>';
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> Sorry, Nothing Found. Try with other Search Term.</h3>';
	}
	return ($output);

}

// 100 - Fetch Users by username when User Search 

function fetch_searchallusers_byusername($pdo,$search) {
	$query = "SELECT * FROM `ot_users` WHERE user_status ='1' and user_blocked='0' and (user_name LIKE '%$search%') order by  user_name asc ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = $statement->rowCount();
	$output = '';
	if($total > 0) {
	$output .='<div class="section-header"><div class="row"><div class="col-lg-12"><small>We Also Found Some Users / Authors</small></div><div class="col-lg-12 mt-2">';
	
	foreach($result as $row)
    {
        $username = _e($row['user_name']);
        $output .= '<a href="'.BASE_URL.'user/'.$username.'" class="btn btn-primary rounded btn-sm">'.$username.'</a>&ensp;';
    }
		$output .='</div></div></div>';
	} 
	return ($output);

}

// 101 - Checking Username 

function checking_userprofile($pdo,$username) {
    $query = "SELECT * FROM ot_users WHERE user_name='".$username."' and user_status='1' and user_blocked = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	if($total == 0){
        header("location: ".BASE_URL."error");
    }
}

// 102 -  Grab ID by Username

function userid_by_username($pdo,$username) {
    $query = "SELECT * FROM ot_users WHERE user_name='".$username."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['id']) ;
    }
    return $output ;
}

// 103 - Videos Course Count via Username

function user_course_count($pdo,$username){
    $userId = userid_by_username($pdo,$username) ; 
    $query = "SELECT count(item_id) as total_videos FROM ot_users_video WHERE user_id='".$userId."' and item_status = '1' and item_pause = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['total_videos']) ;
    }
    return $output ;
}

// 104 Get Membership Badge for Active Users

function get_membership_badge($pdo,$username){
    $userId = userid_by_username($pdo,$username) ; 
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $regDate = _e($row['reg_date']) ;
        $time = date("Y-m-d h:i:s") ;        
        $start_date = new DateTime($regDate);
        $since_start = $start_date->diff(new DateTime($time));
        if(($since_start->y) == 0 ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_new.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="'.$since_start->days.' Days of Membership">&ensp;' ;
        }
        if( (($since_start->y) > 0) && (($since_start->y) <= 1) ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_1.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="'.$since_start->y.' Year of Membership">&ensp;' ;
        }
        if( (($since_start->y) > 1) && (($since_start->y) <= 2) ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_2.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="'.$since_start->y.' Year of Membership">&ensp;' ;
        }
        if( (($since_start->y) > 2) && (($since_start->y) <= 3) ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_3.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="'.$since_start->y.' Year of Membership">&ensp;' ;
        }
        if( (($since_start->y) > 3) && (($since_start->y) <= 4) ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_4.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="'.$since_start->y.' Year of Membership">&ensp;' ;
        }
        if( (($since_start->y) > 4) && (($since_start->y) <= 5) ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_5.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="'.$since_start->y.' Year of Membership">&ensp;' ;
        }
        if( (($since_start->y) > 5) && (($since_start->y) <= 6) ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_6.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="'.$since_start->y.' Year of Membership">&ensp;' ;
        }
        if( (($since_start->y) > 6) && (($since_start->y) <= 7) ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_7.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="'.$since_start->y.' Year of Membership">&ensp;' ;
        }
        if( (($since_start->y) > 7) && (($since_start->y) <= 8) ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_8.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="'.$since_start->y.' Year of Membership">&ensp;' ;
        }
        if( (($since_start->y) > 8) && (($since_start->y) <= 9) ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_9.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="'.$since_start->y.' Year of Membership">&ensp;' ;
        }
        if( (($since_start->y) > 9) ) {
            $output .= '<img src="'.BASE_URL.'/badges/member_10.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="10+ Years of Membership">&ensp;' ;
        }
        
    }
    return $output ;
}

// 105 Get Author Badge for Active Users

function get_author_badge($pdo,$username){
    $userId = userid_by_username($pdo,$username) ; 
    $output = '';
    if(check_author_badge($pdo,$userId) > 0){
       $output .= '<img src="'.BASE_URL.'/badges/author_badge.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Verified Author">&ensp;' ;
    }
    return $output ;
}

// 106 -  Grab Author Level Price

function get_author_level_requirement($pdo,$level) {
    $query = "SELECT * FROM ot_author_level_requirement WHERE level_id='".$level."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['level_price']) ;
    }
    return $output ;
}

// 107 -  Grab Elite Author Requirement

function get_elite_level_requirement($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['elite_author_requirement']) ;
    }
    return $output ;
}

// 108 -  Grab Power Elite Author Requirement

function get_power_elite_level_requirement($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['power_elite_author_requirement']) ;
    }
    return $output ;
}

// 109 -  Grab Elite Author Badge

function get_elite_author_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $eliteLevel = get_elite_level_requirement($pdo) ;
    $eliteSoldPrice = get_author_level_requirement($pdo,$eliteLevel) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userSoldPrice = _e($row['user_sold_price']) ;
        if($userSoldPrice >= $eliteSoldPrice){
            $output .= '<img src="'.BASE_URL.'/badges/elite_badge.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Elite Author : Sold More Than $'.$eliteSoldPrice.'+">&ensp;';
        }
    }
    return $output ;
}

// 110 -  Grab Power Elite Author Badge

function get_power_elite_author_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $powereliteLevel = get_power_elite_level_requirement($pdo) ;
    $powereliteSoldPrice = get_author_level_requirement($pdo,$powereliteLevel) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userSoldPrice = _e($row['user_sold_price']) ;
        if($userSoldPrice >= $powereliteSoldPrice){
            $output .= '<img src="'.BASE_URL.'/badges/power_elite_badge.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Power Elite Author : Sold More Than $'.$powereliteSoldPrice.'+">&ensp;';
        }
    }
    return $output ;
}

// 111 -  Grab Author Level Badge

function get_authorlevel_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $level_one = get_author_level_requirement($pdo,1) ;
    $level_two = get_author_level_requirement($pdo,2) ;
    $level_three = get_author_level_requirement($pdo,3) ;
    $level_four = get_author_level_requirement($pdo,4) ;
    $level_five = get_author_level_requirement($pdo,5) ;
    $level_six = get_author_level_requirement($pdo,6) ;
    $level_seven = get_author_level_requirement($pdo,7) ;
    $level_eight = get_author_level_requirement($pdo,8) ;
    $level_nine = get_author_level_requirement($pdo,9) ;
    $level_ten = get_author_level_requirement($pdo,10) ;
    $level_eleven = get_author_level_requirement($pdo,11) ;
    $level_twelve = get_author_level_requirement($pdo,12) ;
    $level_thirteen = get_author_level_requirement($pdo,13) ;
    $level_fourteen = get_author_level_requirement($pdo,14) ;
    $level_fifteen = get_author_level_requirement($pdo,15) ;
    $level_sixteen = get_author_level_requirement($pdo,16) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userSoldPrice = _e($row['user_sold_price']) ;
        if($userSoldPrice >= $level_one && $userSoldPrice < $level_two){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_1.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 1 : Sold Between $'.$level_one.' - $'.$level_two.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_two && $userSoldPrice < $level_three){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_2.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 2 : Sold Between $'.$level_two.' - $'.$level_three.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_three && $userSoldPrice < $level_four){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_3.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 3 : Sold Between $'.$level_three.' - $'.$level_four.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_four && $userSoldPrice < $level_five){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_4.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 4 : Sold Between $'.$level_four.' - $'.$level_five.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_five && $userSoldPrice < $level_six){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_5.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 5 : Sold Between $'.$level_five.' - $'.$level_six.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_six && $userSoldPrice < $level_seven){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_6.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 6 : Sold Between $'.$level_six.' - $'.$level_seven.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_seven && $userSoldPrice < $level_eight){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_7.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 7 : Sold Between $'.$level_seven.' - $'.$level_eight.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_eight && $userSoldPrice < $level_nine){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_8.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 8 : Sold Between $'.$level_eight.' - $'.$level_nine.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_nine && $userSoldPrice < $level_ten){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_9.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 9 : Sold Between $'.$level_nine.' - $'.$level_ten.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_ten && $userSoldPrice < $level_eleven){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_10.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 10 : Sold Between $'.$level_ten.' - $'.$level_eleven.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_eleven && $userSoldPrice < $level_twelve){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_11.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 11 : Sold Between $'.$level_eleven.' - $'.$level_twelve.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_twelve && $userSoldPrice < $level_thirteen){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_12.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 12 : Sold Between $'.$level_twelve.' - $'.$level_thirteen.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_thirteen && $userSoldPrice < $level_fourteen){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_13.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 13 : Sold Between $'.$level_thirteen.' - $'.$level_fourteen.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_fourteen && $userSoldPrice < $level_fifteen){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_14.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 14 : Sold Between $'.$level_fourteen.' - $'.$level_fifteen.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_fifteen && $userSoldPrice < $level_sixteen){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_15.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 15 : Sold Between $'.$level_fifteen.' - $'.$level_sixteen.' worth of Items">&ensp;';
        }
        if($userSoldPrice >= $level_sixteen){
            $output .= '<img src="'.BASE_URL.'/badges/author_level_16.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Author Level 16 : Sold More Than $'.$level_sixteen.'+ worth of Items">&ensp;';
        }
    }
    return $output ;
}

// 112 -  Grab Buyer Level set by Admin

function get_buyer_level_requirement($pdo,$level) {
    $query = "SELECT * FROM ot_buyer_level_requirement WHERE buyer_level_id='".$level."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['buyer_level_purchased']) ;
    }
    return $output ;
}

// 113 -  Grab Elite Buyer Requirement

function get_elite_buyer_level_requirement($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['elite_buyer_requirement']) ;
    }
    return $output ;
}

// 114 -  Grab Power Elite Buyer Requirement

function get_power_elite_buyer_level_requirement($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['power_elite_buyer_requirement']) ;
    }
    return $output ;
}

// 115 -  Grab Elite Buyer Badge

function get_elite_buyer_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $eliteLevel = get_elite_buyer_level_requirement($pdo) ;
    $eliteSoldPrice = get_buyer_level_requirement($pdo,$eliteLevel) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userSoldPrice = _e($row['user_purchased_items']) ;
        if($userSoldPrice >= $eliteSoldPrice){
            $output .= '<img src="'.BASE_URL.'/badges/elite_buyer.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Elite Buyer : Purchased '.$eliteSoldPrice.'+ Items">&ensp;';
        }
    }
    return $output ;
}

// 116 -  Grab Power Elite Author Badge

function get_power_elite_buyer_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $powereliteLevel = get_power_elite_buyer_level_requirement($pdo) ;
    $powereliteSoldPrice = get_buyer_level_requirement($pdo,$powereliteLevel) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userSoldPrice = _e($row['user_purchased_items']) ;
        if($userSoldPrice >= $powereliteSoldPrice){
            $output .= '<img src="'.BASE_URL.'/badges/power_elite_buyer.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Power Elite Buyer : Purchased '.$powereliteSoldPrice.'+ Items">&ensp;';
        }
    }
    return $output ;
}

// 117 -  Grab Buyer Level Badge

function get_buyerlevel_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $level_one = get_buyer_level_requirement($pdo,1) ;
    $level_two = get_buyer_level_requirement($pdo,2) ;
    $level_three = get_buyer_level_requirement($pdo,3) ;
    $level_four = get_buyer_level_requirement($pdo,4) ;
    $level_five = get_buyer_level_requirement($pdo,5) ;
    $level_six = get_buyer_level_requirement($pdo,6) ;
    $level_seven = get_buyer_level_requirement($pdo,7) ;
    $level_eight = get_buyer_level_requirement($pdo,8) ;
    $level_nine = get_buyer_level_requirement($pdo,9) ;
    $level_ten = get_buyer_level_requirement($pdo,10) ;
    $level_eleven = get_buyer_level_requirement($pdo,11) ;
    $level_twelve = get_buyer_level_requirement($pdo,12) ;
    $level_thirteen = get_buyer_level_requirement($pdo,13) ;
    $level_fourteen = get_buyer_level_requirement($pdo,14) ;
    $level_fifteen = get_buyer_level_requirement($pdo,15) ;
    $level_sixteen = get_buyer_level_requirement($pdo,16) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userSoldPrice = _e($row['user_purchased_items']) ;
        if($userSoldPrice >= $level_one && $userSoldPrice < $level_two){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_1.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 1 : Purchased Between '.$level_one.' - '.$level_two.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_two && $userSoldPrice < $level_three){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_2.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Buyer Level 2 : Purchased Between '.$level_two.' - '.$level_three.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_three && $userSoldPrice < $level_four){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_3.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 3 : Purchased Between '.$level_three.' - '.$level_four.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_four && $userSoldPrice < $level_five){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_4.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 4 : Purchased Between '.$level_four.' - '.$level_five.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_five && $userSoldPrice < $level_six){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_5.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 5 : Purchased Between '.$level_five.' - '.$level_six.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_six && $userSoldPrice < $level_seven){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_6.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 6 : Purchased Between '.$level_six.' - '.$level_seven.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_seven && $userSoldPrice < $level_eight){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_7.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 7 : Purchased Between '.$level_seven.' - '.$level_eight.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_eight && $userSoldPrice < $level_nine){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_8.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 8 : Purchased Between '.$level_eight.' - '.$level_nine.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_nine && $userSoldPrice < $level_ten){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_9.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 9 : Purchased Between '.$level_nine.' - '.$level_ten.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_ten && $userSoldPrice < $level_eleven){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_10.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 10 : Purchased Between '.$level_ten.' - '.$level_eleven.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_eleven && $userSoldPrice < $level_twelve){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_11.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 11 : Purchased Between '.$level_eleven.' - '.$level_twelve.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_twelve && $userSoldPrice < $level_thirteen){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_12.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 12 : Purchased Between '.$level_twelve.' - '.$level_thirteen.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_thirteen && $userSoldPrice < $level_fourteen){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_13.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 13 : Purchased Between '.$level_thirteen.' - '.$level_fourteen.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_fourteen && $userSoldPrice < $level_fifteen){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_14.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 14 : Purchased Between '.$level_fourteen.' - '.$level_fifteen.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_fifteen && $userSoldPrice < $level_sixteen){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_15.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 15 : Purchased Between '.$level_fifteen.' - '.$level_sixteen.' Items">&ensp;';
        }
        if($userSoldPrice >= $level_sixteen){
            $output .= '<img src="'.BASE_URL.'/badges/buyer_level_16.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Buyer Level 16 : Purchased More Than '.$level_sixteen.'+ Items">&ensp;';
        }
        
    }
    return $output ;
}

// 118 -  Grab Community Superstar Badge Requirement

function get_community_superstar_level_requirement($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['community_superstar_requirement']) ;
    }
    return $output ;
}

// 119 -  Grab Community Level set by Admin

function get_community_level_requirement($pdo,$level) {
    $query = "SELECT * FROM ot_counsellor_level_requirement WHERE counsellor_level_id='".$level."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['counsellor_level_solutions']) ;
    }
    return $output ;
}

// 120 -  Grab Community Superstar Badge

function get_community_superstar_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $superstarLevel = get_community_superstar_level_requirement($pdo) ;
    $solutions = get_community_level_requirement($pdo,$superstarLevel) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userSolutions = _e($row['community_problem_solved']) ;
        if($userSolutions >= $solutions){
            $output .= '<img src="'.BASE_URL.'/badges/community_superstar.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Community Superstar : Has Solved '.$solutions.'+ Community Problems">&ensp;';
        }
    }
    return $output ;
}

// 121 -  Grab Counsellor Level Badge

function get_counsellorlevel_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $level_one = get_community_level_requirement($pdo,1) ;
    $level_two = get_community_level_requirement($pdo,2) ;
    $level_three = get_community_level_requirement($pdo,3) ;
    $level_four = get_community_level_requirement($pdo,4) ;
    $level_five = get_community_level_requirement($pdo,5) ;
    $level_six = get_community_level_requirement($pdo,6) ;
    $level_seven = get_community_level_requirement($pdo,7) ;
    $level_eight = get_community_level_requirement($pdo,8) ;
    $level_nine = get_community_level_requirement($pdo,9) ;
    $level_ten = get_community_level_requirement($pdo,10) ;
    $level_eleven = get_community_level_requirement($pdo,11) ;
    $level_twelve = get_community_level_requirement($pdo,12) ;
    $level_thirteen = get_community_level_requirement($pdo,13) ;
    $level_fourteen = get_community_level_requirement($pdo,14) ;
    $level_fifteen = get_community_level_requirement($pdo,15) ;
    $level_sixteen = get_community_level_requirement($pdo,16) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userSolutions = _e($row['community_problem_solved']) ;
        if($userSolutions >= $level_one && $userSolutions < $level_two){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_1.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 1 : Has Solved '.$level_one.' - '.$level_two.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_two && $userSolutions < $level_three){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_2.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Counsellor Level 2 : Has Solved '.$level_two.' - '.$level_three.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_three && $userSolutions < $level_four){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_3.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 3 : Has Solved '.$level_three.' - '.$level_four.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_four && $userSolutions < $level_five){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_4.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 4 : Has Solved '.$level_four.' - '.$level_five.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_five && $userSolutions < $level_six){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_5.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 5 : Has Solved '.$level_five.' - '.$level_six.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_six && $userSolutions < $level_seven){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_6.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 6 : Has Solved '.$level_six.' - '.$level_seven.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_seven && $userSolutions < $level_eight){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_7.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 7 : Has Solved '.$level_seven.' - '.$level_eight.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_eight && $userSolutions < $level_nine){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_8.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 8 : Has Solved '.$level_eight.' - '.$level_nine.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_nine && $userSolutions < $level_ten){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_9.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 9 : Has Solved '.$level_nine.' - '.$level_ten.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_ten && $userSolutions < $level_eleven){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_10.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 10 : Has Solved '.$level_ten.' - '.$level_eleven.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_eleven && $userSolutions < $level_twelve){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_11.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 11 : Has Solved '.$level_eleven.' - '.$level_twelve.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_twelve && $userSolutions < $level_thirteen){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_12.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 12 : Has Solved '.$level_twelve.' - '.$level_thirteen.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_thirteen && $userSolutions < $level_fourteen){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_13.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 13 : Has Solved '.$level_thirteen.' - '.$level_fourteen.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_fourteen && $userSolutions < $level_fifteen){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_14.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 14 : Has Solved '.$level_fourteen.' - '.$level_fifteen.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_fifteen && $userSolutions < $level_sixteen){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_15.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 15 : Has Solved '.$level_fifteen.' - '.$level_sixteen.' Community Problems">&ensp;';
        }
        if($userSolutions >= $level_sixteen){
            $output .= '<img src="'.BASE_URL.'/badges/counsellor_level_16.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Counsellor Level 16 : Has Solved '.$level_sixteen.'+ Community Problems">&ensp;';
        }
        
    }
    return $output ;
}

// 122 -  Find username by Item ID

function get_username_by_itemid($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userId = _e($row['user_id']) ;
        $output .= username_by_id($pdo,$userId) ;
    }
    return $output ;
}

// 123 - Check Trendsetter Badge 

function check_trending_badge($pdo,$userId) {
    $query = "SELECT * FROM ot_trendsetter WHERE trending_user_id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	return $total ;
}

// 124 - User Achieved Trendsetter Badge 

function get_trending_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $output = '';
    if(check_trending_badge($pdo,$userId) > 0){
        $output .= '<img src="'.BASE_URL.'/badges/trending_badge.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Trendsetter : Had an Item that was Trending ">&ensp;' ;
    }
    return $output ;
}

// 125 - Check Trendsetter Badge 

function check_featuredfile_badge($pdo,$userId) {
    $query = "SELECT * FROM ot_featured_author_file WHERE featured_file_user_id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	return $total ;
}

// 126 - User Achieved Trendsetter Badge 

function get_featuredfile_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $output = '';
    if(check_featuredfile_badge($pdo,$userId) > 0){
        $output .= '<img src="'.BASE_URL.'/badges/featured_badge.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Featured Item : Had an Item that was Featured">&ensp;' ;
    }
    return $output ;
}

// 127 -  Grab Uploader King Badge Requirement

function get_uploader_king_level_requirement($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['uploader_king_requirement']) ;
    }
    return $output ;
}

// 128 -  Grab Uploader Level set by Admin

function get_uploader_level_requirement($pdo,$level) {
    $query = "SELECT * FROM ot_uploader_level_requirement WHERE uploader_level_id='".$level."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['uploader_level_videos']) ;
    }
    return $output ;
}

// 129 -  Grab Uploader King Badge

function get_uploader_king_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $kingLevel = get_uploader_king_level_requirement($pdo) ;
    $videos = get_uploader_level_requirement($pdo,$kingLevel) ;
    $output = '';
    $userVideos = user_course_count($pdo,$username) ;
    if($userVideos >= $videos){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_king.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader King : Had Uploaded '.$videos.'+ Approved Videos">&ensp;';
    }
    
    return $output ;
}

// 130 -  Grab Uploader Level Badge

function get_uploaderlevel_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $level_one = get_uploader_level_requirement($pdo,1) ;
    $level_two = get_uploader_level_requirement($pdo,2) ;
    $level_three = get_uploader_level_requirement($pdo,3) ;
    $level_four = get_uploader_level_requirement($pdo,4) ;
    $level_five = get_uploader_level_requirement($pdo,5) ;
    $level_six = get_uploader_level_requirement($pdo,6) ;
    $level_seven = get_uploader_level_requirement($pdo,7) ;
    $level_eight = get_uploader_level_requirement($pdo,8) ;
    $level_nine = get_uploader_level_requirement($pdo,9) ;
    $level_ten = get_uploader_level_requirement($pdo,10) ;
    $level_eleven = get_uploader_level_requirement($pdo,11) ;
    $level_twelve = get_uploader_level_requirement($pdo,12) ;
    $level_thirteen = get_uploader_level_requirement($pdo,13) ;
    $level_fourteen = get_uploader_level_requirement($pdo,14) ;
    $level_fifteen = get_uploader_level_requirement($pdo,15) ;
    $level_sixteen = get_uploader_level_requirement($pdo,16) ;
    $userVideos = user_course_count($pdo,$username) ;
    $output = "" ;
    if($userVideos >= $level_one && $userVideos < $level_two){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_1.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 1 : Has Uploaded '.$level_one.' - '.$level_two.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_two && $userVideos < $level_three){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_2.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Uploader Level 2 : Has Uploaded '.$level_two.' - '.$level_three.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_three && $userVideos < $level_four){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_3.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 3 : Has Uploaded '.$level_three.' - '.$level_four.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_four && $userVideos < $level_five){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_4.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 4 : Has Uploaded '.$level_four.' - '.$level_five.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_five && $userVideos < $level_six){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_5.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 5 : Has Uploaded '.$level_five.' - '.$level_six.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_six && $userVideos < $level_seven){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_6.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 6 : Has Uploaded '.$level_six.' - '.$level_seven.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_seven && $userVideos < $level_eight){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_7.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 7 : Has Uploaded '.$level_seven.' - '.$level_eight.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_eight && $userVideos < $level_nine){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_8.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 8 : Has Uploaded '.$level_eight.' - '.$level_nine.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_nine && $userVideos < $level_ten){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_9.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 9 : Has Uploaded '.$level_nine.' - '.$level_ten.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_ten && $userVideos < $level_eleven){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_10.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 10 : Has Uploaded '.$level_ten.' - '.$level_eleven.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_eleven && $userVideos < $level_twelve){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_11.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 11 : Has Uploaded '.$level_eleven.' - '.$level_twelve.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_twelve && $userVideos < $level_thirteen){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_12.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 12 : Has Uploaded '.$level_twelve.' - '.$level_thirteen.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_thirteen && $userVideos < $level_fourteen){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_13.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 13 : Has Uploaded '.$level_thirteen.' - '.$level_fourteen.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_fourteen && $userVideos < $level_fifteen){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_14.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 14 : Has Uploaded '.$level_fourteen.' - '.$level_fifteen.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_fifteen && $userVideos < $level_sixteen){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_15.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 15 : Has Uploaded '.$level_fifteen.' - '.$level_sixteen.' Approved Videos">&ensp;';
    }
    if($userVideos >= $level_sixteen){
        $output .= '<img src="'.BASE_URL.'/badges/uploader_level_16.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Uploader Level 16 : Has Uploaded '.$level_sixteen.'+ Approved Videos">&ensp;';
    }
        
    return $output ;
}

// 131 -  Grab Follower Rockstar Badge Requirement

function get_follower_rockstar_level_requirement($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['follower_rockstar_requirement']) ;
    }
    return $output ;
}

// 132 -  Grab Follower Level set by Admin

function get_follower_level_requirement($pdo,$level) {
    $query = "SELECT * FROM ot_follower_level_requirement WHERE follower_level_id='".$level."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['follower_level_users']) ;
    }
    return $output ;
}

// 133 -  Grab Follower Rockstar Badge

function get_follower_rockstar_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $rockstarLevel = get_follower_rockstar_level_requirement($pdo) ;
    $followers = get_follower_level_requirement($pdo,$rockstarLevel) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userFollowers = _e($row['user_followers']) ;
        if($userFollowers >= $followers){
            $output .= '<img src="'.BASE_URL.'/badges/follower_rockstar.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Rockstar : '.$followers.'+ Followers">&ensp;';
        }
    }
    return $output ;
}

// 134 -  Grab Follower Level Badge

function get_followerlevel_badge($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $level_one = get_follower_level_requirement($pdo,1) ;
    $level_two = get_follower_level_requirement($pdo,2) ;
    $level_three = get_follower_level_requirement($pdo,3) ;
    $level_four = get_follower_level_requirement($pdo,4) ;
    $level_five = get_follower_level_requirement($pdo,5) ;
    $level_six = get_follower_level_requirement($pdo,6) ;
    $level_seven = get_follower_level_requirement($pdo,7) ;
    $level_eight = get_follower_level_requirement($pdo,8) ;
    $level_nine = get_follower_level_requirement($pdo,9) ;
    $level_ten = get_follower_level_requirement($pdo,10) ;
    $level_eleven = get_follower_level_requirement($pdo,11) ;
    $level_twelve = get_follower_level_requirement($pdo,12) ;
    $level_thirteen = get_follower_level_requirement($pdo,13) ;
    $level_fourteen = get_follower_level_requirement($pdo,14) ;
    $level_fifteen = get_follower_level_requirement($pdo,15) ;
    $level_sixteen = get_follower_level_requirement($pdo,16) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userSolutions = _e($row['user_followers']) ;
        if($userSolutions >= $level_one && $userSolutions < $level_two){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_1.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 1 : '.$level_one.' - '.$level_two.' Followers">&ensp;';
        }
        if($userSolutions >= $level_two && $userSolutions < $level_three){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_2.png" class="img-fluid badgesImgSize" data-toggle="tooltip" data-placement="top" title="Follower Level 2 : '.$level_two.' - '.$level_three.' Followers">&ensp;';
        }
        if($userSolutions >= $level_three && $userSolutions < $level_four){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_3.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 3 : '.$level_three.' - '.$level_four.' Followers">&ensp;';
        }
        if($userSolutions >= $level_four && $userSolutions < $level_five){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_4.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 4 : '.$level_four.' - '.$level_five.' Followers">&ensp;';
        }
        if($userSolutions >= $level_five && $userSolutions < $level_six){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_5.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 5 : '.$level_five.' - '.$level_six.' Followers">&ensp;';
        }
        if($userSolutions >= $level_six && $userSolutions < $level_seven){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_6.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 6 : '.$level_six.' - '.$level_seven.' Followers">&ensp;';
        }
        if($userSolutions >= $level_seven && $userSolutions < $level_eight){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_7.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 7 : '.$level_seven.' - '.$level_eight.' Followers">&ensp;';
        }
        if($userSolutions >= $level_eight && $userSolutions < $level_nine){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_8.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 8 : '.$level_eight.' - '.$level_nine.' Followers">&ensp;';
        }
        if($userSolutions >= $level_nine && $userSolutions < $level_ten){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_9.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 9 : '.$level_nine.' - '.$level_ten.' Followers">&ensp;';
        }
        if($userSolutions >= $level_ten && $userSolutions < $level_eleven){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_10.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 10 : '.$level_ten.' - '.$level_eleven.' Followers">&ensp;';
        }
        if($userSolutions >= $level_eleven && $userSolutions < $level_twelve){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_11.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 11 : '.$level_eleven.' - '.$level_twelve.' Followers">&ensp;';
        }
        if($userSolutions >= $level_twelve && $userSolutions < $level_thirteen){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_12.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 12 : '.$level_twelve.' - '.$level_thirteen.' Followers">&ensp;';
        }
        if($userSolutions >= $level_thirteen && $userSolutions < $level_fourteen){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_13.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 13 : '.$level_thirteen.' - '.$level_fourteen.' Followers">&ensp;';
        }
        if($userSolutions >= $level_fourteen && $userSolutions < $level_fifteen){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_14.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 14 : '.$level_fourteen.' - '.$level_fifteen.' Followers">&ensp;';
        }
        if($userSolutions >= $level_fifteen && $userSolutions < $level_sixteen){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_15.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 15 : '.$level_fifteen.' - '.$level_sixteen.' Followers">&ensp;';
        }
        if($userSolutions >= $level_sixteen){
            $output .= '<img src="'.BASE_URL.'/badges/follower_level_16.png" class="img-fluid badgesImgSize mt-1" data-toggle="tooltip" data-placement="top" title="Follower Level 16 : '.$level_sixteen.'+ Followers">&ensp;';
        }
        
    }
    return $output ;
}

// 135 - Get About Us Info it can be also used for Meta Description Of WEBSITE

function get_aboutus_info($pdo){
	$query = "SELECT about_us_info FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output = strip_tags($row['about_us_info']) ; 
		}
	}
	return ($output) ;
}

// 137 - Grab Social Network for User

function get_social_network($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."' and (insta_network != '' or fb_network != '' or linkedin_network != '' or dribbble_network != '' or behance_network != '' or vk_network != '' or twitter_network != '')";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return ($total) ;
}

// 138 - Grab Instagram Profile for User

function get_insta_network($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT insta_network FROM ot_users WHERE id='".$userId."' and insta_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= '<a href="'._e($row['insta_network']).'" target="_blank"><i class="fab fa-instagram fa-lg text-info"></i></a>&ensp;&ensp;' ; 
		}
	}
	return ($output) ;
}

// 139 - Grab Youtube Profile for User

function get_youtube_network($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT youtube_network FROM ot_users WHERE id='".$userId."' and youtube_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= '<a href="'._e($row['youtube_network']).'" target="_blank"><i class="fab fa-youtube fa-lg text-danger"></i></a>&ensp;&ensp;' ; 
		}
	}
	return ($output) ;
}

// 140 - Grab Facebook Profile for User

function get_fb_network($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT fb_network FROM ot_users WHERE id='".$userId."' and fb_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= '<a href="'._e($row['fb_network']).'" target="_blank"><i class="fab fa-facebook fa-lg text-primary"></i></a>&ensp;&ensp;' ; 
		}
	}
	return ($output) ;
}

// 141 - Grab Twitter Profile for User

function get_twitter_network($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT twitter_network FROM ot_users WHERE id='".$userId."' and twitter_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= '<a href="'._e($row['twitter_network']).'" target="_blank"><i class="fab fa-twitter fa-lg text-info"></i></a>&ensp;&ensp;' ; 
		}
	}
	return ($output) ;
}

// 142 - Grab Dribbble Profile for User

function get_dribbble_network($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT dribbble_network FROM ot_users WHERE id='".$userId."' and dribbble_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= '<a href="'._e($row['dribbble_network']).'" target="_blank"><i class="fab fa-dribbble fa-lg text-dark"></i></a>&ensp;&ensp;' ; 
		}
	}
	return ($output) ;
}

// 143 - Grab Linkedin Profile for User

function get_linkedin_network($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT linkedin_network FROM ot_users WHERE id='".$userId."' and linkedin_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= '<a href="'._e($row['linkedin_network']).'" target="_blank"><i class="fab fa-linkedin fa-lg text-primary"></i></a>&ensp;&ensp;' ; 
		}
	}
	return ($output) ;
}

// 144 - Grab Behance Profile for User

function get_behance_network($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT behance_network FROM ot_users WHERE id='".$userId."' and behance_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= '<a href="'._e($row['behance_network']).'" target="_blank"><i class="fab fa-behance fa-lg text-dark"></i></a>&ensp;&ensp;' ; 
		}
	}
	return ($output) ;
}

// 145 - Grab VK Profile for User

function get_vk_network($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT vk_network FROM ot_users WHERE id='".$userId."' and vk_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= '<a href="'._e($row['vk_network']).'" target="_blank"><i class="fab fa-vk fa-lg text-primary"></i></a>&ensp;&ensp;' ; 
		}
	}
	return ($output) ;
}

// 145 - Grab User Profile Picture

function get_user_profilepic($pdo){
    $userId = $_SESSION['unprofessional']['id'] ;
    $query = "SELECT user_dp FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	foreach($result as $row)
		{
            $userDp = _e($row['user_dp']) ;
            if($userDp != ''){
                $output .='<img src="'.BASE_URL.'profilePic/'.$userDp.'" class="img-fluid rounded-circle" >';
            } else {
                $output .='<img src="'.BASE_URL.'img/profile.png" class="img-fluid rounded-circle" >' ;
            } 
		}
	return ($output) ;
}

// 146 Grab User Profile Picture Name

function get_user_profilepic_name_url($pdo){
    $userId = $_SESSION['unprofessional']['id'] ;
    $query = "SELECT user_dp FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	foreach($result as $row)
		{
            $userDp = _e($row['user_dp']) ;
            if($userDp != ''){
                $output .='profilePic/'.$userDp ;
            } else {
                $output .='img/profile.png' ;
            } 
		}
	return ($output) ;
}

// 146 Grab User Profile Picture Name

function get_user_profilepic_name_url_username($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT user_dp FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	foreach($result as $row)
		{
            $userDp = _e($row['user_dp']) ;
            if($userDp != ''){
                $output .='profilePic/'.$userDp ;
            } else {
                $output .='img/profile.png' ;
            } 
		}
	return ($output) ;
}

// 147 Grab User About Us Info

function get_user_aboutus_by_username($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT user_about_us FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	foreach($result as $row)
		{
            $output.= strip_tags(nl2br($row['user_about_us'])) ;
		}
	return ($output) ;
}

// 148 - Grab Youtube Link for User

function get_youtube_network_url($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT youtube_network FROM ot_users WHERE id='".$userId."' and youtube_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= _e($row['youtube_network']) ; 
		}
	}
	return ($output) ;
}

// 149 - Grab Facebook Link for User

function get_fb_network_url($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT fb_network FROM ot_users WHERE id='".$userId."' and fb_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= _e($row['fb_network']) ; 
		}
	}
	return ($output) ;
}

// 150 - Grab Twitter Link for User

function get_twitter_network_url($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT twitter_network FROM ot_users WHERE id='".$userId."' and twitter_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= _e($row['twitter_network']) ; 
		}
	}
	return ($output) ;
}

// 151 - Grab Dribbble Link for User

function get_dribbble_network_url($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT dribbble_network FROM ot_users WHERE id='".$userId."' and dribbble_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= _e($row['dribbble_network']) ; 
		}
	}
	return ($output) ;
}

// 152 - Grab Linkedin Link for User

function get_linkedin_network_url($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT linkedin_network FROM ot_users WHERE id='".$userId."' and linkedin_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= _e($row['linkedin_network']) ; 
		}
	}
	return ($output) ;
}

// 153 - Grab Behance Link for User

function get_behance_network_url($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT behance_network FROM ot_users WHERE id='".$userId."' and behance_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= _e($row['behance_network']) ; 
		}
	}
	return ($output) ;
}

// 154 - Grab VK Link for User

function get_vk_network_url($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT vk_network FROM ot_users WHERE id='".$userId."' and vk_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= _e($row['vk_network']) ; 
		}
	}
	return ($output) ;
}

// 155 - Grab Instagram Link for User

function get_insta_network_url($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT insta_network FROM ot_users WHERE id='".$userId."' and insta_network != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	if($total > 0) {
	
	foreach($result as $row)
		{
			$output .= _e($row['insta_network']) ; 
		}
	}
	return ($output) ;
}

// 156 -  Grab User Full Name by username

function user_fullname_by_username($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_fullname']) ;
    }
    return $output ;
}

// 157 - It generates OTP

function code($no_of_char){
		$code='';
		$possible_char="0123456789";
		while($no_of_char>0)
			{
				$code.=substr($possible_char, rand(0, strlen($possible_char)-1), 1);
				$no_of_char--;
			}
		return $code;
}

// 158 - Check Already Registered Email

function check_user_email($pdo,$useremail) {
    $query = "SELECT * FROM ot_users WHERE user_email='".$useremail."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	return $total ;
}

// 159 - Check User OTP 

function check_user_otp($pdo) {
    $userId = $_SESSION['unprofessional']['id'] ;
    $query = "SELECT user_otp FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_otp']) ;
    }
    return $output ;
}

// 160 - Count Followers by Username

function count_followers_by_username($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT count(follower_list_id) as follower FROM ot_follower_list WHERE follower_parent_id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['follower']) ;
    }
    return $output ;
}

// 161 - Count Following by Username

function count_following_by_username($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT count(follower_list_id) as following FROM ot_follower_list WHERE follower_user_id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['following']) ;
    }
    return $output ;
}

// 162 - Checking User has following or not

function check_following($pdo,$parentId){
    $query = "SELECT * FROM ot_follower_list WHERE follower_parent_id='".$parentId."' and follower_user_id = '".$_SESSION['unprofessional']['id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    return $total ;
}

// 163 - Grab Follower List by username 

function grab_follower_list($pdo,$username){
    $limit = get_limit_default($pdo);
    $userId = userid_by_username($pdo,$username) ;
    $sql = "SELECT count(*) as number_rows FROM ot_follower_list WHERE follower_parent_id='".$userId."' order by follower_list_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_follower_list WHERE follower_parent_id='".$userId."' order by follower_list_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    
    if($total > 0){
        $output = '<div class="col p-0">';
        foreach($result as $row)
        {
            $id = _e($row['follower_list_id']) ;
            $followerUserId = _e($row['follower_user_id']) ;
            $followerUsername = username_by_id($pdo,$followerUserId) ;
            $followerBtn = "" ;
            if(empty($_SESSION['unprofessional'])) {
                $followerBtn = '&ensp;<a href="'.BASE_URL.'login" class="btn btn-primary btn-sm">Follow</a>' ;
            } else {
                if(($_SESSION['unprofessional']['id']) != $followerUserId ){
                    if(check_following($pdo,$followerUserId) > 0){
                       $followerBtn = '
                       &ensp;<span class="followResult'.$followerUserId.'"><button class="btn btn-sm btn-light unfollowUser" id="'.$followerUserId.'">Unfollow</button></span>
                        <span class="unfollowResult'.$followerUserId.'"></span>
                        ' ; 
                    } else {
                        $followerBtn = '
                       &ensp;<span class="unfollowResult'.$followerUserId.'"><button class="btn btn-sm btn-primary followUser" id="'.$followerUserId.'">Follow</button></span>
                        <span class="followResult'.$followerUserId.'"></span>
                        ' ; 
                    }
                }
            }
            $output .= '<div class="card p-2">' ;
            $output .= '<div class="row">' ;
            $output .= '<div class="col-lg-4 mt-1 text-center">
                            <div class="col-lg-12">
                                <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$followerUsername).'" class="img-fluid w-50 rounded-circle">
                            </div>
                            <div class="col-lg-12 mt-2">
                                <p>@'.$followerUsername.'</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <a href="'.BASE_URL.'user/'.$followerUsername.'" class="btn btn-sm btn-primary">View Profile</a>'.$followerBtn.'
                            </div>

                        </div>' ;
            $output .= '<div class="col-lg-3 mt-1">
                            <button class="btn btn-info btn-block mt-1"><i class="fas fa-shopping-cart"></i> '.user_solditems_by_username($pdo,$followerUsername).' Sales</button>
                            <a href="#" class="btn btn-info btn-block" ><i class="fas fa-video"></i> '.user_course_count($pdo,$followerUsername).' Videos</a>
                            <a href="#" class="btn btn-info btn-block" ><i class="fas fa-heart"></i> '.user_loveditems_by_username($pdo,$followerUsername).' Loves</a>
                            <a href="'.BASE_URL.'followers/'.$followerUsername.'" class="btn btn-info btn-block" ><i class="fas fa-users"></i> '.count_followers_by_username($pdo,$followerUsername).' Followers</a>
                            <a href="'.BASE_URL.'following/'.$followerUsername.'" class="btn btn-info btn-block " ><i class="fas fa-recycle"></i> '.count_following_by_username($pdo,$followerUsername).' Following</a>
                        </div>' ;
            $output .= '<div class="col-lg-5 mt-1">
                            <div class="col-lg-12">
                                <i class="fas fa-trophy"></i> Achievements
                            </div>
                            <div class="col-lg-12 mt-3 p-1">
                                '.get_membership_badge($pdo,$followerUsername).get_power_elite_author_badge($pdo,$followerUsername). get_elite_author_badge($pdo,$followerUsername).get_author_badge($pdo,$followerUsername).get_authorlevel_badge($pdo,$followerUsername).get_featuredfile_badge($pdo,$followerUsername).get_trending_badge($pdo,$followerUsername).get_uploader_king_badge($pdo,$followerUsername).get_uploaderlevel_badge($pdo,$followerUsername).get_follower_rockstar_badge($pdo,$followerUsername).get_followerlevel_badge($pdo,$followerUsername).get_community_superstar_badge($pdo,$followerUsername).get_counsellorlevel_badge($pdo,$followerUsername).get_power_elite_buyer_badge($pdo,$followerUsername).get_elite_buyer_badge($pdo,$followerUsername).get_buyerlevel_badge($pdo,$followerUsername).'
                            </div>
                        </div>' ;
            $output .='</div></div>' ;
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_follower" id="show_more_new_follower'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_all_follower btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .='</div>' ;
    }
    return $output ;
}

// 164 - Grab Follower List by username when User Press Load More Button

function grab_follower_list_onload($pdo,$username){
    $limit = get_limit_onload($pdo);
    $userId = userid_by_username($pdo,$username) ;
    $sql = "SELECT count(*) as number_rows FROM ot_follower_list WHERE follower_parent_id='".$userId."'  and follower_list_id < ".$_GET['id']." order by follower_list_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_follower_list WHERE follower_parent_id='".$userId."' and follower_list_id < ".$_GET['id']."  order by follower_list_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    
    if($total > 0){
        $output = '<div class="col p-0">';
        foreach($result as $row)
        {
            $id = _e($row['follower_list_id']) ;
            $followerUserId = _e($row['follower_user_id']) ;
            $followerUsername = username_by_id($pdo,$followerUserId) ;
            $followerBtn = "" ;
            if(empty($_SESSION['unprofessional'])) {
                $followerBtn = '&ensp;<a href="'.BASE_URL.'login" class="btn btn-primary btn-sm">Follow</a>' ;
            } else {
                if(($_SESSION['unprofessional']['id']) != $followerUserId ){
                    if(check_following($pdo,$followerUserId) > 0){
                       $followerBtn = '
                       &ensp;<span class="followResult'.$followerUserId.'"><button class="btn btn-sm btn-light unfollowUser" id="'.$followerUserId.'">Unfollow</button></span>
                        <span class="unfollowResult'.$followerUserId.'"></span>
                        ' ; 
                    } else {
                        $followerBtn = '
                       &ensp;<span class="unfollowResult'.$followerUserId.'"><button class="btn btn-sm btn-primary followUser" id="'.$followerUserId.'">Follow</button></span>
                        <span class="followResult'.$followerUserId.'"></span>
                        ' ; 
                    }
                }
            }
            $output .= '<div class="card p-2">' ;
            $output .= '<div class="row">' ;
            $output .= '<div class="col-lg-4 mt-1 text-center">
                            <div class="col-lg-12">
                                <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$followerUsername).'" class="img-fluid w-50 rounded-circle">
                            </div>
                            <div class="col-lg-12 mt-2">
                                <p>@'.$followerUsername.'</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <a href="'.BASE_URL.'user/'.$followerUsername.'" class="btn btn-sm btn-primary">View Profile</a>'.$followerBtn.'
                            </div>

                        </div>' ;
            $output .= '<div class="col-lg-3 mt-1">
                            <button class="btn btn-info btn-block mt-1"><i class="fas fa-shopping-cart"></i> '.user_solditems_by_username($pdo,$followerUsername).' Sales</button>
                            <a href="'.BASE_URL.'uservideos/'.$followerUsername.'" class="btn btn-info btn-block" ><i class="fas fa-video"></i> '.user_course_count($pdo,$followerUsername).' Videos</a>
                            <a href="'.BASE_URL.'loves/'.$followerUsername.'" class="btn btn-info btn-block" ><i class="fas fa-heart"></i> '.user_loveditems_by_username($pdo,$followerUsername).' Loves</a>
                            <a href="'.BASE_URL.'followers/'.$followerUsername.'" class="btn btn-info btn-block" ><i class="fas fa-users"></i> '.count_followers_by_username($pdo,$followerUsername).' Followers</a>
                            <a href="'.BASE_URL.'following/'.$followerUsername.'" class="btn btn-info btn-block " ><i class="fas fa-recycle"></i> '.count_following_by_username($pdo,$followerUsername).' Following</a>
                        </div>' ;
            $output .= '<div class="col-lg-5 mt-1">
                            <div class="col-lg-12">
                                <i class="fas fa-trophy"></i> Achievements
                            </div>
                            <div class="col-lg-12 mt-3 p-1">
                                '.get_membership_badge($pdo,$followerUsername).get_power_elite_author_badge($pdo,$followerUsername). get_elite_author_badge($pdo,$followerUsername).get_author_badge($pdo,$followerUsername).get_authorlevel_badge($pdo,$followerUsername).get_featuredfile_badge($pdo,$followerUsername).get_trending_badge($pdo,$followerUsername).get_uploader_king_badge($pdo,$followerUsername).get_uploaderlevel_badge($pdo,$followerUsername).get_follower_rockstar_badge($pdo,$followerUsername).get_followerlevel_badge($pdo,$followerUsername).get_community_superstar_badge($pdo,$followerUsername).get_counsellorlevel_badge($pdo,$followerUsername).get_power_elite_buyer_badge($pdo,$followerUsername).get_elite_buyer_badge($pdo,$followerUsername).get_buyerlevel_badge($pdo,$followerUsername).'
                            </div>
                        </div>' ;
            $output .='</div></div>' ;
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_follower" id="show_more_new_follower'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_all_follower btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .='</div>' ;
    }
    return $output ;
}

// 165 -  Grab User Total Sold Counting by username

function user_solditems_by_username($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_sold_items']) ;
    }
    return $output ;
}

// 166 -  Grab User Loved Items Counting by username

function user_loveditems_by_username($pdo,$username){
    $userId = userid_by_username($pdo,$username) ;
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_loved_counting']) ;
    }
    return $output ;
}

// 167 - Grab Following List by username 

function grab_following_list($pdo,$username){
    $limit = get_limit_default($pdo);
    $userId = userid_by_username($pdo,$username) ;
    $sql = "SELECT count(*) as number_rows FROM ot_follower_list WHERE follower_user_id='".$userId."' order by follower_list_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_follower_list WHERE follower_user_id='".$userId."' order by follower_list_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    
    if($total > 0){
        $output = '<div class="col p-0">';
        foreach($result as $row)
        {
            $id = _e($row['follower_list_id']) ;
            $followerUserId = _e($row['follower_parent_id']) ;
            $followerUsername = username_by_id($pdo,$followerUserId) ;
            $followerBtn = "" ;
            if(empty($_SESSION['unprofessional'])) {
                $followerBtn = '&ensp;<a href="'.BASE_URL.'login" class="btn btn-primary btn-sm">Follow</a>' ;
            } else {
                if(($_SESSION['unprofessional']['id']) != $followerUserId ){
                    if(check_following($pdo,$followerUserId) > 0){
                       $followerBtn = '
                       &ensp;<span class="followResult'.$followerUserId.'"><button class="btn btn-sm btn-light unfollowUser" id="'.$followerUserId.'">Unfollow</button></span>
                        <span class="unfollowResult'.$followerUserId.'"></span>
                        ' ; 
                    } else {
                        $followerBtn = '
                       &ensp;<span class="unfollowResult'.$followerUserId.'"><button class="btn btn-sm btn-primary followUser" id="'.$followerUserId.'">Follow</button></span>
                        <span class="followResult'.$followerUserId.'"></span>
                        ' ; 
                    }
                }
            }
            $output .= '<div class="card p-2">' ;
            $output .= '<div class="row">' ;
            $output .= '<div class="col-lg-4 mt-1 text-center">
                            <div class="col-lg-12">
                                <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$followerUsername).'" class="img-fluid w-50 rounded-circle">
                            </div>
                            <div class="col-lg-12 mt-2">
                                <p>@'.$followerUsername.'</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <a href="'.BASE_URL.'user/'.$followerUsername.'" class="btn btn-sm btn-primary">View Profile</a>'.$followerBtn.'
                            </div>

                        </div>' ;
            $output .= '<div class="col-lg-3 mt-1">
                            <button class="btn btn-info btn-block mt-1"><i class="fas fa-shopping-cart"></i> '.user_solditems_by_username($pdo,$followerUsername).' Sales</button>
                            <a href="'.BASE_URL.'uservideos/'.$followerUsername.'" class="btn btn-info btn-block" ><i class="fas fa-video"></i> '.user_course_count($pdo,$followerUsername).' Videos</a>
                            <a href="'.BASE_URL.'loves/'.$followerUsername.'" class="btn btn-info btn-block" ><i class="fas fa-heart"></i> '.user_loveditems_by_username($pdo,$followerUsername).' Loves</a>
                            <a href="'.BASE_URL.'followers/'.$followerUsername.'" class="btn btn-info btn-block" ><i class="fas fa-users"></i> '.count_followers_by_username($pdo,$followerUsername).' Followers</a>
                            <a href="'.BASE_URL.'following/'.$followerUsername.'" class="btn btn-info btn-block " ><i class="fas fa-recycle"></i> '.count_following_by_username($pdo,$followerUsername).' Following</a>
                        </div>' ;
            $output .= '<div class="col-lg-5 mt-1">
                            <div class="col-lg-12">
                                <i class="fas fa-trophy"></i> Achievements
                            </div>
                            <div class="col-lg-12 mt-3 p-1">
                                '.get_membership_badge($pdo,$followerUsername).get_power_elite_author_badge($pdo,$followerUsername). get_elite_author_badge($pdo,$followerUsername).get_author_badge($pdo,$followerUsername).get_authorlevel_badge($pdo,$followerUsername).get_featuredfile_badge($pdo,$followerUsername).get_trending_badge($pdo,$followerUsername).get_uploader_king_badge($pdo,$followerUsername).get_uploaderlevel_badge($pdo,$followerUsername).get_follower_rockstar_badge($pdo,$followerUsername).get_followerlevel_badge($pdo,$followerUsername).get_community_superstar_badge($pdo,$followerUsername).get_counsellorlevel_badge($pdo,$followerUsername).get_power_elite_buyer_badge($pdo,$followerUsername).get_elite_buyer_badge($pdo,$followerUsername).get_buyerlevel_badge($pdo,$followerUsername).'
                            </div>
                        </div>' ;
            $output .='</div></div>' ;
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_following" id="show_more_new_following'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_all_following btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .='</div>' ;
    }
    return $output ;
}

// 168 - Grab Following List by username when User Press Load More Button

function grab_following_list_onload($pdo,$username){
    $limit = get_limit_onload($pdo);
    $userId = userid_by_username($pdo,$username) ;
    $sql = "SELECT count(*) as number_rows FROM ot_follower_list WHERE follower_user_id='".$userId."'  and follower_list_id < ".$_GET['id']." order by follower_list_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_follower_list WHERE follower_user_id='".$userId."' and follower_list_id < ".$_GET['id']."  order by follower_list_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    
    if($total > 0){
        $output = '<div class="col p-0">';
        foreach($result as $row)
        {
            $id = _e($row['follower_list_id']) ;
            $followerUserId = _e($row['follower_parent_id']) ;
            $followerUsername = username_by_id($pdo,$followerUserId) ;
            $followerBtn = "" ;
            if(empty($_SESSION['unprofessional'])) {
                $followerBtn = '&ensp;<a href="'.BASE_URL.'login" class="btn btn-primary btn-sm">Follow</a>' ;
            } else {
                if(($_SESSION['unprofessional']['id']) != $followerUserId ){
                    if(check_following($pdo,$followerUserId) > 0){
                       $followerBtn = '
                       &ensp;<span class="followResult'.$followerUserId.'"><button class="btn btn-sm btn-light unfollowUser" id="'.$followerUserId.'">Unfollow</button></span>
                        <span class="unfollowResult'.$followerUserId.'"></span>
                        ' ; 
                    } else {
                        $followerBtn = '
                       &ensp;<span class="unfollowResult'.$followerUserId.'"><button class="btn btn-sm btn-primary followUser" id="'.$followerUserId.'">Follow</button></span>
                        <span class="followResult'.$followerUserId.'"></span>
                        ' ; 
                    }
                }
            }
            $output .= '<div class="card p-2">' ;
            $output .= '<div class="row">' ;
            $output .= '<div class="col-lg-4 mt-1 text-center">
                            <div class="col-lg-12">
                                <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$followerUsername).'" class="img-fluid w-50 rounded-circle">
                            </div>
                            <div class="col-lg-12 mt-2">
                                <p>@'.$followerUsername.'</p>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <a href="'.BASE_URL.'user/'.$followerUsername.'" class="btn btn-sm btn-primary">View Profile</a>'.$followerBtn.'
                            </div>

                        </div>' ;
            $output .= '<div class="col-lg-3 mt-1">
                            <button class="btn btn-info btn-block mt-1"><i class="fas fa-shopping-cart"></i> '.user_solditems_by_username($pdo,$followerUsername).' Sales</button>
                            <a href="'.BASE_URL.'uservideos/'.$followerUsername.'" class="btn btn-info btn-block" ><i class="fas fa-video"></i> '.user_course_count($pdo,$followerUsername).' Videos</a>
                            <a href="'.BASE_URL.'loves/'.$followerUsername.'" class="btn btn-info btn-block" ><i class="fas fa-heart"></i> '.user_loveditems_by_username($pdo,$followerUsername).' Loves</a>
                            <a href="'.BASE_URL.'followers/'.$followerUsername.'" class="btn btn-info btn-block" ><i class="fas fa-users"></i> '.count_followers_by_username($pdo,$followerUsername).' Followers</a>
                            <a href="'.BASE_URL.'following/'.$followerUsername.'" class="btn btn-info btn-block " ><i class="fas fa-recycle"></i> '.count_following_by_username($pdo,$followerUsername).' Following</a>
                        </div>' ;
            $output .= '<div class="col-lg-5 mt-1">
                            <div class="col-lg-12">
                                <i class="fas fa-trophy"></i> Achievements
                            </div>
                            <div class="col-lg-12 mt-3 p-1">
                                '.get_membership_badge($pdo,$followerUsername).get_power_elite_author_badge($pdo,$followerUsername). get_elite_author_badge($pdo,$followerUsername).get_author_badge($pdo,$followerUsername).get_authorlevel_badge($pdo,$followerUsername).get_featuredfile_badge($pdo,$followerUsername).get_trending_badge($pdo,$followerUsername).get_uploader_king_badge($pdo,$followerUsername).get_uploaderlevel_badge($pdo,$followerUsername).get_follower_rockstar_badge($pdo,$followerUsername).get_followerlevel_badge($pdo,$followerUsername).get_community_superstar_badge($pdo,$followerUsername).get_counsellorlevel_badge($pdo,$followerUsername).get_power_elite_buyer_badge($pdo,$followerUsername).get_elite_buyer_badge($pdo,$followerUsername).get_buyerlevel_badge($pdo,$followerUsername).'
                            </div>
                        </div>' ;
            $output .='</div></div>' ;
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_following" id="show_more_new_following'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_all_following btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .='</div>' ;
    }
    return $output ;
}

// 169 - Grab Item Full Title 

function long_title_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= strip_tags($row['item_title']) ;
    }
    return $output ;
}

// 170 - Checking User has loved the item

function check_loved_items($pdo,$itemId){
    $query = "SELECT * FROM ot_lovers WHERE lovers_item_id='".$itemId."' and lovers_user_id = '".$_SESSION['unprofessional']['id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    return $total ;
}

// 171 - Grab Loved Items by Username

function grab_loved_items($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_default($pdo);
    $sql = "SELECT count(lovers_id) as number_rows FROM ot_lovers left join ot_users_video on (ot_users_video.item_id = ot_lovers.lovers_item_id) WHERE item_status='1' and item_pause = '1' and lovers_user_id = '".$userId."' order by lovers_id desc" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT lovers_id, item_id, item_preview_image, item_category, item_price, item_sale FROM ot_lovers left join ot_users_video on (ot_users_video.item_id = ot_lovers.lovers_item_id) WHERE item_status='1' and item_pause = '1' and lovers_user_id = '".$userId."' order by lovers_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $id = _e($row['lovers_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_userloved_item" id="show_more_userloved_item'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_alluserloved_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 171 - Grab Loved Items by Username when User Press Load More Button

function grab_loved_items_onload($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_onload($pdo);
    $sql = "SELECT count(lovers_id) as number_rows FROM ot_lovers left join ot_users_video on (ot_users_video.item_id = ot_lovers.lovers_item_id) WHERE item_status='1' and item_pause = '1' and lovers_user_id = '".$userId."' and lovers_id < ".$_GET['id']." order by lovers_id desc" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT lovers_id, item_id, item_preview_image, item_category, item_price, item_sale FROM ot_lovers left join ot_users_video on (ot_users_video.item_id = ot_lovers.lovers_item_id) WHERE item_status='1' and item_pause = '1' and lovers_user_id = '".$userId."' and lovers_id < ".$_GET['id']." order by lovers_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $id = _e($row['lovers_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_userloved_item" id="show_more_userloved_item'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_alluserloved_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 172 - Fetch User Item on Default by Username

function grab_uservideos_items_default($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_default($pdo);
    $sql = "SELECT count(*) as number_rows FROM ot_users_video WHERE item_status = '1'  and item_pause = '1' and user_id = '".$userId."' order by item_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' order by item_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '
                        <div class="row no-gutters w-100 mt-n5">
                          <div class="col-lg-8">
                            
                          </div>
                          <div class="col-lg-4">
                            <select class="form-control mt-3" onchange="location = this.value;">
                                <option value="'.BASE_URL.'uservideos/'.$username.'" selected>New Releases</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&seller=bestseller">Best Sellers</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&price=lowest" >Lowest Price</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&highprice=highest" >Highest Price</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&rating=top" >Highest Rating</option>
                                
                            </select>
                          </div>
                        </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_uservideo_new_item" id="show_more_uservideo_new_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_uservideo_newest_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 173 - Fetch User Item when User press Load More Button

function grab_uservideos_items_onload($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_onload($pdo);
    $sql = "SELECT count(*) as number_rows FROM ot_users_video WHERE item_status = '1'  and item_pause = '1'  and item_id < ".$_GET['id']." and user_id = '".$userId."' order by item_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ot_users_video WHERE item_status='1' and item_pause = '1'  and item_id < ".$_GET['id']." and user_id = '".$userId."' order by item_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if(empty($itemId)){
			$itemId = "";
		}
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_uservideo_new_item" id="show_more_uservideo_new_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_uservideo_newest_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 174 - Fetch User Bestseller Item on Default by Username

function grab_uservideos_items_bestseller_default($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id order by item_sale desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
    
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '
                        <div class="row no-gutters w-100 mt-n5">
                          <div class="col-lg-8">
                            
                          </div>
                          <div class="col-lg-4">
                            <select class="form-control mt-3" onchange="location = this.value;">
                                <option value="'.BASE_URL.'uservideos/'.$username.'" >New Releases</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&seller=bestseller" selected>Best Sellers</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&price=lowest" >Lowest Price</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&highprice=highest" >Highest Price</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&rating=top" >Highest Rating</option>
                                
                            </select>
                          </div>
                        </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_uservideo_bestseller_item" id="show_more_uservideo_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_moreall_uservideo_bestseller_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 175 -  Fetch User Bestseller Item by Username when User Press Load More Button

function grab_uservideos_items_bestseller_onload($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id order by item_sale desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
    
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_uservideo_bestseller_item" id="show_more_uservideo_bestseller_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_moreall_uservideo_bestseller_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 176 - Fetch User Lowest Price Items by Username 

function grab_uservideos_items_lowprice_default($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id order by item_price asc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
    
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '
                        <div class="row no-gutters w-100 mt-n5">
                          <div class="col-lg-8">
                            
                          </div>
                          <div class="col-lg-4">
                            <select class="form-control mt-3" onchange="location = this.value;">
                                <option value="'.BASE_URL.'uservideos/'.$username.'" >New Releases</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&seller=bestseller" >Best Sellers</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&price=lowest" selected>Lowest Price</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&highprice=highest" >Highest Price</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&rating=top" >Highest Rating</option>
                                
                            </select>
                          </div>
                        </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_uservideo_lowestprice_item" id="show_more_uservideo_lowestprice_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_moreall_uservideo_lowestprice_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 177 - Fetch User Lowest Price Items by Username when User Pressed Load More Button

function grab_uservideos_items_lowprice_onload($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id order by item_price asc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
    
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_uservideo_lowestprice_item" id="show_more_uservideo_lowestprice_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_moreall_uservideo_lowestprice_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}


// 177 - Fetch User Highest Price Items by Username 

function grab_uservideos_items_highprice_default($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id order by item_price desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
    
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '
                        <div class="row no-gutters w-100 mt-n5">
                          <div class="col-lg-8">
                            
                          </div>
                          <div class="col-lg-4">
                            <select class="form-control mt-3" onchange="location = this.value;">
                                <option value="'.BASE_URL.'uservideos/'.$username.'" >New Releases</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&seller=bestseller" >Best Sellers</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&price=lowest" >Lowest Price</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&highprice=highest" selected>Highest Price</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&rating=top" >Highest Rating</option>
                                
                            </select>
                          </div>
                        </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_uservideo_highestprice_item" id="show_more_uservideo_highestprice_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_moreall_uservideo_highestprice_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 178 - Fetch User Highest Price Items by Username when User Pressed Load More Button

function grab_uservideos_items_highprice_onload($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id order by item_price desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
    
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_uservideo_highestprice_item" id="show_more_uservideo_highestprice_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_moreall_uservideo_highestprice_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}


// 179 - Fetch User Highest Rating Items by Username 

function grab_uservideos_items_highrating_default($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_default($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id order by item_price desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit ".$limit."";
    
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '
                        <div class="row no-gutters w-100 mt-n5">
                          <div class="col-lg-8">
                            
                          </div>
                          <div class="col-lg-4">
                            <select class="form-control mt-3" onchange="location = this.value;">
                                <option value="'.BASE_URL.'uservideos/'.$username.'" >New Releases</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&seller=bestseller" >Best Sellers</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&price=lowest" >Lowest Price</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&highprice=highest" selected>Highest Price</option>
                                <option value="'.BASE_URL.'uservideos/'.$username.'&rating=top" >Highest Rating</option>
                                
                            </select>
                          </div>
                        </div>
                    <div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_uservideo_toprating_item" id="show_more_uservideo_toprating_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_moreall_uservideo_toprating_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 180 - Fetch User Highest Rating Items by Username when User Pressed Load More Button

function grab_uservideos_items_highrating_onload($pdo,$username) {
    $userId = userid_by_username($pdo,$username) ;
    $limit = get_limit_onload($pdo);
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(item_id) FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT item_sale,item_id, item_preview_image, item_category, item_price, item_rating FROM ot_users_video WHERE item_status='1' and item_pause = '1' and user_id = '".$userId."' GROUP BY item_id order by item_rating desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > ".$_GET['id']."  limit ".$limit."";
    
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
	if($total > 0){
        $output .= '<div class="row mt-2">';
        foreach($result as $row) {
            $additionalId = _e($row['additional_id']) ;
            $itemId = _e($row['item_id']);
            $imageName = _e($row['item_preview_image']) ;
            $itemTitle = short_title_by_id($pdo,$itemId) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $catId = _e($row['item_category']) ;
            $itemSales = _e($row['item_sale']) ;
            if($itemSales > 0) {
               $itemSales = '&ensp;<b class="text-muted"><i class="fas fa-shopping-cart"></i> '._e($row['item_sale']).'</b>&ensp;' ;
            } else {
                $itemSales = "" ;
            }
            $output .= inside_preview_design($pdo,$itemId,$itemTitle,$itemUrlTitle,$catId,$imageName,$itemSales);
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_uservideo_toprating_item" id="show_more_uservideo_toprating_item'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_moreall_uservideo_toprating_item btn btn-primary btn-sm ann'.$username.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        $output .= '</div> ';
    }
    return $output ;
}

// 181 - Grab User ID by Item ID

function find_user_id_by_itemid($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_id']) ;
    }
    return $output ;
}

// 182 - Count Comment by Item ID

function count_comment_by_itemid($pdo,$itemId) {
    $query = "SELECT count(comment_id) as totalComment FROM ot_comments WHERE comment_item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['totalComment']) ;
    }
    return $output ;
}

// 183 - Find Badges by Username

function grab_all_badges_by_username($pdo,$username) {
    $output = '';
    $output .= get_membership_badge($pdo,$username).get_power_elite_author_badge($pdo,$username). get_elite_author_badge($pdo,$username).get_author_badge($pdo,$username).get_authorlevel_badge($pdo,$username).get_featuredfile_badge($pdo,$username).get_trending_badge($pdo,$username).get_uploader_king_badge($pdo,$username).get_uploaderlevel_badge($pdo,$username).get_follower_rockstar_badge($pdo,$username).get_followerlevel_badge($pdo,$username).get_community_superstar_badge($pdo,$username).get_counsellorlevel_badge($pdo,$username).get_power_elite_buyer_badge($pdo,$username).get_elite_buyer_badge($pdo,$username).get_buyerlevel_badge($pdo,$username) ;
    
    return($output) ;
}

// 184 - Find User Purchased the Specific Item

function find_user_purchased_item($pdo,$userId,$itemId){
    $query = "SELECT * FROM ot_user_purchases WHERE purchase_item_id='".$itemId."' and purchase_user_id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    
        foreach($result as $row)
        {
            
                $output .= '&ensp;<button class="btn btn-success btn-sm" disabled><i class="fas fa-shopping-cart"></i> Purchased</button>' ;
            
            
        }
        
    return $output ;
}

// 185 - Find Comment Date by Comment Id

function grab_comment_date($pdo,$commentId){
    $query = "SELECT comment_time FROM ot_comments WHERE comment_id='".$commentId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $commentTime = _e($row['comment_time']) ;
        $commentTime = date('d F, Y',strtotime($commentTime));
        $output .= $commentTime ;
        
    }
    return $output ;
}

// 186 - Grab All Comments on Item

function grab_all_comments_default($pdo,$itemId) {
    
    $limit = get_limit_default($pdo);
    $sql = "SELECT count(*) as number_rows FROM ot_comments WHERE comment_item_id='".$itemId."' order by comment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_comments WHERE comment_item_id='".$itemId."' order by comment_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    
    if($total > 0){
        
        foreach($result as $row)
        {
            $commentReport = _e($row['author_report']) ;
            $commentId = _e($row['comment_id']) ;
            $output .= '<div class="card p-2 mt-2 oldComment'.$commentId.'">';
            if($commentReport == 0){
            
            $comment = strip_tags($row['comment']) ;
            $userId = find_user_id_by_commentitemid($pdo,$commentId) ;
            $username = username_by_id($pdo,$userId) ;
            $badges = grab_all_badges_by_username($pdo,$username) ;
            $purchasedBadge = find_user_purchased_item($pdo,$userId,$itemId) ;
            $commentDate = grab_comment_date($pdo,$commentId) ;
            $report = '';
            $authorId = find_user_id_by_itemid($pdo,$itemId) ;
            if($authorId == $_SESSION['unprofessional']['id']) {
                $report = '<button class="reportComment btn btn-danger btn-sm" id="'.$commentId.'" ><i class="fas fa-flag"></i> Report</button>' ;
            }
            $replyForm = '' ;
            if(!empty($_SESSION['unprofessional'])){
                $replyForm = '<form method="post" class="postReply" enctype="multipart/form-data" id="postReplyId'.$commentId.'"><div class="row mb-3">
                               <div class="col-lg-1 mt-1 text-center"></div>
                                   <div class="col-lg-9 mt-1 ml-lg-n3 text-center">
                                        <textarea class="form-control textareaMedium" name="commentReply" maxlength="1000" placeholder="Post Your Reply within 1000 Character"></textarea>
                                   </div>
                                   <div class="col-lg-2 mt-1 text-center">
                                       <input type="hidden" name="itemId" value="'.$itemId.'" ><input type="hidden" name="commentId" value="'.$commentId.'" ><input type="hidden" name="btn_action" value="saveCommentReply" >
                                       <button type="submit" class="btn btn-primary btn-sm " >Post Reply</button>
                                       <a href="#!" class="btn btn-info btn-sm mt-1 viewReplies changeReply'.$commentId.'" id="'.$commentId.'" >View Replies <i class="fas fa-chevron-circle-down"></i></a>
                                   </div>
                               </div>
                               </form>
                             ' ;
            } else {
                $replyForm = '<div class="row mb-3">
                               <div class="col-lg-1 mt-1 text-center"></div>
                                   <div class="col-lg-9 mt-1 ml-lg-n3 text-center">
                                        <textarea class="form-control textareaMedium" name="commentReply" maxlength="1000" placeholder="Post Your Reply within 1000 Character"></textarea>
                                   </div>
                                   <div class="col-lg-2 mt-1 text-center">
                                        <a href="'.BASE_URL.'login" class="btn btn-danger btn-sm " >Please Login</a>
                                       <a href="#!" class="btn btn-info btn-sm mt-1 viewReplies changeReply'.$commentId.'" id="'.$commentId.'" >View Replies <i class="fas fa-chevron-circle-down"></i></a>
                                   </div>
                               </div>
                             ' ;
            }
            $thread = grab_all_replies_to_comment($pdo, $commentId, $itemId) ;
            
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
                                <div class="col-lg-12 mt-2">
                                    '.$report.'
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
                $output .= '<span class="commentReplyToggle showReply'.$commentId.'">' ;
                $output .= $thread ;
                $output .= '</span>';
                $output .= '<div class="jQueryGrabAllReply'.$commentId.'"></div>' ;
                $output .= $replyForm ;
                
               } else {
                $output .= '<div class="row ">
                                <div class="col-lg-4 mt-1 text-center">
                                    <div class="col-lg-12">
                                        <img src="'.BASE_URL.'img/profile.png" class="img-fluid w-50 rounded-circle">
                                    </div>
                                </div>
                                <div class="col-lg-8 mt-1 text-center mt-5">
                                <h4 class="text-danger"><i class="fas fa-exclamation-circle fa-lg text-danger"></i>&ensp;This Comment is Reported & Under Review</h4>
                                </div>
                            </div>
                            ';
            } 
            
            $output .= '</div>' ;
            
        }
        
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_item_comments" id="show_more_item_comments'.$commentId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$commentId.'" class="show_moreall_item_comments btn btn-primary btn-sm ann'.$itemId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        
        
    }
    return($output) ;
}

// 187 - Grab User ID by Comment ID

function find_user_id_by_commentitemid($pdo,$commentId) {
    $query = "SELECT * FROM ot_comments WHERE comment_id='".$commentId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['comment_user_id']) ;
    }
    return $output ;
}

// 188 - Grab All Replies to the Comment 

function grab_all_replies_to_comment($pdo, $commentId, $itemId){
    $query = "SELECT * FROM ot_comment_thread WHERE thread_comment_id='".$commentId."' order by comment_thread_id asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $threadId = _e($row['comment_thread_id']) ;
        $newUserId = _e($row['thread_user_id']) ;
        $newUsername =  username_by_id($pdo,$newUserId) ;
        $newpurchasedBadge = find_user_purchased_item($pdo,$newUserId,$itemId) ;
        $authorId = find_user_id_by_itemid($pdo,$itemId) ;
        $reportReply = '';
            if($authorId == $newUserId) {
                $newpurchasedBadge = '&ensp;<button class="btn btn-info btn-sm" disabled><i class="fas fa-check-circle"></i> Author</button>' ;
                
            } 
        if($authorId == $_SESSION['unprofessional']['id']){
                $reportReply = '<button class="reportReply btn btn-danger btn-sm" id="'.$threadId.'" ><i class="fas fa-flag"></i> Report</button>'  ;
            }
        $commentReplyDate = _e($row['thread_time']) ;
        $commentReply = strip_tags($row['thread_comment']) ;
        $commentReplyDate = date('d F, Y',strtotime($commentReplyDate));
        $commentReplyReport = _e($row['thread_report']) ;
        
        $output .= '<div class="row oldReply'.$threadId.'">' ;
        if($commentReplyReport == 0) {
                $output .= '<div class="col-lg-4 mt-1 text-center ">
                                <div class="col-lg-12">
                                    <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$newUsername).'" class="img-fluid w-25 rounded-circle">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <p>@'.$newUsername.'</p>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <a href="'.BASE_URL.'user/'.$newUsername.'" class="btn btn-sm btn-primary">View Profile</a>'.$newpurchasedBadge.'
                                </div>
                                <div class="col-lg-12 mt-2">
                                    Posted On : '.$commentReplyDate.'
                                </div>
                                <div class="col-lg-12 mt-2">
                                    '.$reportReply.'
                                </div>

                            </div>' ;
                $output .= '<div class="col-lg-6 mt-1 ">
                                <div class="col-lg-12">
                                    <i class="fas fa-comments"></i> Reply
                                </div>
                                <div class="col-lg-12 mt-3 p-3 ml-3">
                                    '.nl2br($commentReply).'
                                </div>
                            </div>' ;
            } else {
            $output .= '<div class="col-lg-4 mt-1 text-center"><div class="col-lg-12"><img src="'.BASE_URL.'img/profile.png" class="img-fluid w-25 rounded-circle"></div></div><div class="col-lg-8 mt-1 text-center mt-3"><h4 class="text-danger"><i class="fas fa-exclamation-circle fa-lg text-danger"></i>&ensp;This Reply is Reported & Under Review</h4></div>' ;
        }
                $output .= '<span class="commentDivider border-top "></span>' ;
                $output .= '</div>' ;
        
    }
    return $output ;
}

// 189 - Find Comment Reply Date by Comment Reply Id

function grab_comment_reply_date($pdo,$commentReplyId){
    $query = "SELECT thread_time FROM ot_comment_thread WHERE comment_thread_id='".$commentReplyId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $commentReplyTime = _e($row['thread_time']) ;
        $commentReplyTime = date('d F, Y',strtotime($commentReplyTime));
        $output .= $commentReplyTime ;
        
    }
    return $output ;
}

// 190 - Grab Single Reply to Comment

function grab_single_replies_to_comment($pdo, $commentReplyId, $username, $purchasedBadge,$itemId,$userId) {
    $query = "SELECT * FROM ot_comment_thread WHERE comment_thread_id='".$commentReplyId."' limit 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $commentReplyDate = _e($row['thread_time']) ;
        $commentReply = strip_tags($row['thread_comment']) ;
        $commentReplyDate = date('d F, Y',strtotime($commentReplyDate));
        $authorId = find_user_id_by_itemid($pdo,$itemId) ;
            if($authorId == $userId) {
                $purchasedBadge = '&ensp;<button class="btn btn-info btn-sm" disabled><i class="fas fa-check-circle"></i> Author</button>' ;
                
            }
        $output .= '<div class="row replyId'.$commentReplyId.'">' ;
                $output .= '<div class="col-lg-4 mt-1 text-center">
                                <div class="col-lg-12">
                                    <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" class="img-fluid w-25 rounded-circle">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <p>@'.$username.'</p>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>'.$purchasedBadge.'
                                </div>
                                <div class="col-lg-12 mt-2">
                                    Posted On : '.$commentReplyDate.'
                                </div>

                            </div>' ;
                $output .= '<div class="col-lg-8 mt-1">
                                <div class="col-lg-12">
                                    <i class="fas fa-comments"></i> Reply
                                </div>
                                <div class="col-lg-12 mt-3 p-3 ml-3">
                                    '.nl2br($commentReply).'
                                </div>
                            </div>' ;
                $output .= '<span class="commentDivider border-top"></span>' ;
                $output .= '</div>' ;
    }
    return $output ;
}

// 191 - Grab More Comments on Item when User Presses Load More Button

function grab_all_comments_onload($pdo,$itemId) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT count(*) as number_rows FROM ot_comments WHERE comment_id  < ".$_GET['id']."  and  comment_item_id='".$itemId."' order by comment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_comments WHERE comment_id  < ".$_GET['id']."  and comment_item_id='".$itemId."' order by comment_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    
    if($total > 0){
        
        foreach($result as $row)
        {
            $commentReport = _e($row['author_report']) ;
            $commentId = _e($row['comment_id']) ;
            $output .= '<div class="card p-2 mt-2 oldComment'.$commentId.'">';
            if($commentReport == 0){
            
            $comment = strip_tags($row['comment']) ;
            $userId = find_user_id_by_commentitemid($pdo,$commentId) ;
            $username = username_by_id($pdo,$userId) ;
            $badges = grab_all_badges_by_username($pdo,$username) ;
            $purchasedBadge = find_user_purchased_item($pdo,$userId,$itemId) ;
            $commentDate = grab_comment_date($pdo,$commentId) ;
            $authorId = find_user_id_by_itemid($pdo,$itemId) ;
            $report = "";
            if($authorId == $_SESSION['unprofessional']['id']) {
                $report = '<button class="reportComment btn btn-danger btn-sm" id="'.$commentId.'" ><i class="fas fa-flag"></i> Report</button>' ;
            }
            $replyForm = '' ;
            if(!empty($_SESSION['unprofessional'])){
                $replyForm = '<form method="post" class="postReply" enctype="multipart/form-data" id="postReplyId'.$commentId.'"><div class="row mb-3">
                               <div class="col-lg-1 mt-1 text-center"></div>
                                   <div class="col-lg-9 mt-1 ml-lg-n3 text-center">
                                        <textarea class="form-control textareaMedium" name="commentReply" maxlength="1000" placeholder="Post Your Reply within 1000 Character"></textarea>
                                   </div>
                                   <div class="col-lg-2 mt-1 text-center">
                                       <input type="hidden" name="userId" value="'.$_SESSION['unprofessional']['id'].'" ><input type="hidden" name="itemId" value="'.$itemId.'" ><input type="hidden" name="commentId" value="'.$commentId.'" ><input type="hidden" name="btn_action" value="saveCommentReply" >
                                       <button type="submit" class="btn btn-primary btn-sm " >Post Reply</button>
                                       <a href="#!" class="btn btn-info btn-sm mt-1 viewReplies changeReply'.$commentId.'" id="'.$commentId.'" >View Replies <i class="fas fa-chevron-circle-down"></i></a>
                                   </div>
                               </div>
                               </form>
                             ' ;
            }
            $thread = grab_all_replies_to_comment($pdo, $commentId, $itemId) ;
            
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
                                <div class="col-lg-12 mt-2">
                                    '.$report.'
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
                $output .= '<span class="commentReplyToggle showReply'.$commentId.'">' ;
                $output .= $thread ;
                $output .= '</span>';
                $output .= '<div class="jQueryGrabAllReply'.$commentId.'"></div>' ;
                $output .= $replyForm ;
                
               } else {
                $output .= '<div class="row ">
                                <div class="col-lg-4 mt-1 text-center">
                                    <div class="col-lg-12">
                                        <img src="'.BASE_URL.'img/profile.png" class="img-fluid w-50 rounded-circle">
                                    </div>
                                </div>
                                <div class="col-lg-8 mt-1 text-center mt-5">
                                <h4 class="text-danger"><i class="fas fa-exclamation-circle fa-lg text-danger"></i>&ensp;This Comment is Reported & Under Review</h4>
                                </div>
                            </div>
                            ';
            } 
            
            $output .= '</div>' ;
            
        }
        
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_item_comments" id="show_more_item_comments'.$commentId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$commentId.'" class="show_moreall_item_comments btn btn-primary btn-sm ann'.$itemId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        
        
    }
    return($output) ;
}


// 192 - Checking User has Rated before or Not

function check_rated_before($pdo,$userId,$itemId){
    $query = "SELECT * FROM ot_ratings WHERE rating_item_id='".$itemId."' and rating_user_id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    return $total ;
}

// 193 - Grab How many Users Rated of Item

function grab_rated_by($pdo,$itemId){
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row) {
        $output .= _e($row['item_rated_by']) ;
    }
    return $output ;
}

// 194 - Grab Rating of an Item

function grab_rating_ofitem($pdo,$itemId){
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row) {
        $output .= _e($row['item_rating']) ;
    }
    return $output ;
}

// 195 - Find User Rating of an Item

function grab_user_item_rating($pdo,$userId,$itemId){
    $query = "SELECT * FROM ot_ratings WHERE rating_item_id='".$itemId."' and rating_user_id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row) {
        $output .= _e($row['rating_star']) ;
    }
    return $output ;
}

// 195 - Find User Rating Comment of an Item

function grab_user_item_rating_comment($pdo,$userId,$itemId){
    $query = "SELECT * FROM ot_ratings WHERE rating_item_id='".$itemId."' and rating_user_id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row) {
        $output .= strip_tags($row['rating_comment']) ;
    }
    return $output ;
}

// 196 - Checking User Purchased the Specific Item

function checking_user_purchased_item($pdo,$userId,$itemId){
    $query = "SELECT * FROM ot_user_purchases WHERE purchase_item_id='".$itemId."' and purchase_user_id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();        
    return $total ;
}

// 197 - Grab Reviews on Item Page

function grab_item_reviews_default($pdo,$itemId) {
    $limit = get_limit_default($pdo);
    $sql = "SELECT count(*) as number_rows FROM ot_ratings WHERE  rating_item_id='".$itemId."' " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_ratings WHERE rating_item_id='".$itemId."' order by rating_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $ratingId = _e($row['rating_id']) ;
        $ratingDate = _e($row['rating_time']) ;
        $ratingComment = strip_tags($row['rating_comment']) ;
        $ratingDate = date('d F, Y',strtotime($ratingDate));
        $userId = _e($row['rating_user_id']) ;
        $username =  username_by_id($pdo,$userId) ;
        $purchasedBadge = find_user_purchased_item($pdo,$userId,$itemId) ;
        $authorId = find_user_id_by_itemid($pdo,$itemId) ;
        $authorUsername = username_by_id($pdo,$authorId) ;
        $ratingReport = _e($row['rating_report']) ;
        $authorReply = '';
        $report = "";
            if($authorId == $_SESSION['unprofessional']['id']) {
                $report = '<button class="reportRating btn btn-danger btn-sm" id="'.$ratingId.'" ><i class="fas fa-flag"></i> Report Rating</button>' ;
            }
        if(checking_author_replied_on_rating($pdo,$userId,$itemId) > 0){
            $newpurchasedBadge = '&ensp;<button class="btn btn-info btn-sm" disabled><i class="fas fa-check-circle"></i> Author</button>' ;
            $authorReply = '<span class="commentDivider border-top"></span>
                            <div class="col-lg-4 mt-1 text-center">
                                <div class="col-lg-12">
                                    <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$authorUsername).'" class="img-fluid w-25 rounded-circle">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <p>@'.$username.'</p>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <a href="'.BASE_URL.'user/'.$authorUsername.'" class="btn btn-sm btn-primary">View Profile</a>'.$newpurchasedBadge.'
                                </div>

                            </div>
                            <div class="col-lg-8 mt-1">
                                <div class="col-lg-12 mt-3">
                                    Author Response
                                </div>
                                <div class="col-lg-12 mt-3 p-3 ">
                                    '.nl2br(grab_author_reply_on_rating($pdo,$userId,$itemId)).'
                                </div>
                            </div>
                            ';
        } else {
            if($authorId == $_SESSION['unprofessional']['id']) {
            $authorReply = '<span class="commentDivider border-top"></span>
                            <div class="col-lg-12 showAuthorReply'.$ratingId.'">
                            <form method="post" class="postAuthorReply" enctype="multipart/form-data" id="postAuthorReplyId'.$ratingId.'"><div class="row mb-3">
                               <div class="col-lg-1 mt-1 text-center"></div>
                                   <div class="col-lg-9 mt-1 ml-lg-n3 text-center">
                                        <textarea class="form-control textareaMedium" name="authorReply" maxlength="300" placeholder="Post Your Reply within 300 Character"></textarea>
                                   </div>
                                   <div class="col-lg-2 mt-1 text-center">
                                       <input type="hidden" name="userId" value="'.$userId.'" ><input type="hidden" name="itemId" value="'.$itemId.'" ><input type="hidden" name="ratingId" value="'.$ratingId.'" ><input type="hidden" name="authorId" value="'.$authorId.'" ><input type="hidden" name="btn_action" value="saveAuthorReply" >
                                       <button type="submit" class="btn btn-primary btn-sm mt-3" >Post Reply</button>
                                   </div>
                               </div>
                               </form>
                            <div class="jQueryAuthorReply'.$ratingId.'"></div>
                            </div>
                               ';
            } 
        }
        $star = _e($row['rating_star']) ;
        $ratingDesign = '';
        if($star == '1'){
            $ratingDesign = '<i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Poor" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Poor" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Very Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Excellent" ></i>';
        }
        if($star == '2'){
            $ratingDesign = '<i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Poor" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Very Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Excellent" ></i>';
        }
        if($star == '3'){
            $ratingDesign = '<i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Very Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Excellent" ></i>';
        }
        if($star == '4'){
            $ratingDesign = '<i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Good" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Excellent" ></i>';
        }
        if($star == '5'){
            $ratingDesign = '<i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Good" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Good" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Excellent" ></i>';
        }
        $authorId = find_user_id_by_itemid($pdo,$itemId) ;
            if($authorId == $userId) {
                $purchasedBadge = '&ensp;<button class="btn btn-info btn-sm" disabled><i class="fas fa-check-circle"></i> Author</button>' ;
                
            }
        $output .= '<div class="card p-2 mt-2 showUserRating'.$ratingId.'">';
        if($ratingReport == 0) { 
        $output .= '<div class="row">' ;
                $output .= '<div class="col-lg-4 mt-1 text-center">
                                <div class="col-lg-12">
                                    <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" class="img-fluid w-25 rounded-circle">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <p>@'.$username.'</p>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>'.$purchasedBadge.'
                                </div>
                                <div class="col-lg-12 mt-2">
                                    Rated On : '.$ratingDate.'
                                </div>
                                <div class="col-lg-12">
                                    '.$report.' 
                                </div>

                            </div>' ;
                $output .= '<div class="col-lg-8 mt-1">
                                <div class="col-lg-12 mt-3">
                                    '.$ratingDesign.'
                                </div>
                                <div class="col-lg-12 mt-3 p-3 ">
                                    '.nl2br($ratingComment).'
                                </div>
                            </div>' ;
                $output .= $authorReply ;
                $output .= '</div>' ;
        } else {
            $output .= '<div class="row">' ;
                $output .= '<div class="col-lg-4 mt-1 text-center">
                                <div class="col-lg-12">
                                    <img src="'.BASE_URL.'img/profile.png" class="img-fluid w-25 rounded-circle">
                                </div>
                            </div>
                            <div class="col-lg-8 mt-3">
                                <h4 class="text-danger"><i class="fas fa-exclamation-circle text-danger fa-lg"></i> This Rating is Reported & Under Review.</h4>
                            </div>
                            ' ;
                $output .= '</div>' ;
        }
        $output .= '</div>' ;
    }
    if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_ratings" id="show_more_ratings'.$ratingId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$ratingId.'" class="show_moreall_ratings btn btn-primary btn-sm ann'.$itemId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
    return $output ;
}

// 198 - Checking Author Replied to Review Comment or Not

function checking_author_replied_on_rating($pdo,$userId,$itemId){
    $query = "SELECT * FROM ot_ratings WHERE rating_item_id='".$itemId."' and rating_user_id = '".$userId."' and rating_author_reply != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();        
    return $total ;
}

// 199 - Grab Author Reply to Review Comment or Not

function grab_author_reply_on_rating($pdo,$userId,$itemId){
    $query = "SELECT * FROM ot_ratings WHERE rating_item_id='".$itemId."' and rating_user_id = '".$userId."' and rating_author_reply != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();        
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row){
        $output .= strip_tags($row['rating_author_reply']) ;
    }
    return $output ;
}

// 200 - Checking User Rating has Reported by Author

function check_rating_report($pdo,$userId,$itemId){
    $query = "SELECT * FROM ot_ratings WHERE rating_item_id='".$itemId."' and rating_user_id = '".$userId."' and rating_report = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    return $total ;
}

// 201 - Grab Reviews on Item Page when User Press Load More Button

function grab_item_reviews_onload($pdo,$itemId) {
    $limit = get_limit_onload($pdo);
    $sql = "SELECT count(*) as number_rows FROM ot_ratings WHERE rating_id < '".$_GET['id']."' and rating_item_id='".$itemId."' " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_ratings WHERE rating_id < '".$_GET['id']."' and  rating_item_id='".$itemId."' order by rating_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $ratingId = _e($row['rating_id']) ;
        $ratingDate = _e($row['rating_time']) ;
        $ratingComment = strip_tags($row['rating_comment']) ;
        $ratingDate = date('d F, Y',strtotime($ratingDate));
        $userId = _e($row['rating_user_id']) ;
        $username =  username_by_id($pdo,$userId) ;
        $purchasedBadge = find_user_purchased_item($pdo,$userId,$itemId) ;
        $authorId = find_user_id_by_itemid($pdo,$itemId) ;
        $authorUsername = username_by_id($pdo,$authorId) ;
        $ratingReport = _e($row['rating_report']) ;
        $authorReply = '';
        $report = "";
            if($authorId == $_SESSION['unprofessional']['id']) {
                $report = '<button class="reportRating btn btn-danger btn-sm" id="'.$ratingId.'" ><i class="fas fa-flag"></i> Report Rating</button>' ;
            }
        if(checking_author_replied_on_rating($pdo,$userId,$itemId) > 0){
            $newpurchasedBadge = '&ensp;<button class="btn btn-info btn-sm" disabled><i class="fas fa-check-circle"></i> Author</button>' ;
            $authorReply = '<span class="commentDivider border-top"></span>
                            <div class="col-lg-4 mt-1 text-center">
                                <div class="col-lg-12">
                                    <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$authorUsername).'" class="img-fluid w-25 rounded-circle">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <p>@'.$username.'</p>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <a href="'.BASE_URL.'user/'.$authorUsername.'" class="btn btn-sm btn-primary">View Profile</a>'.$newpurchasedBadge.'
                                </div>

                            </div>
                            <div class="col-lg-8 mt-1">
                                <div class="col-lg-12 mt-3">
                                    Author Response
                                </div>
                                <div class="col-lg-12 mt-3 p-3 ">
                                    '.nl2br(grab_author_reply_on_rating($pdo,$userId,$itemId)).'
                                </div>
                            </div>
                            ';
        } else {
            if($authorId == $_SESSION['unprofessional']['id']) {
            $authorReply = '<span class="commentDivider border-top"></span>
                            <div class="col-lg-12 showAuthorReply'.$ratingId.'">
                            <form method="post" class="postAuthorReply" enctype="multipart/form-data" id="postAuthorReplyId'.$ratingId.'"><div class="row mb-3">
                               <div class="col-lg-1 mt-1 text-center"></div>
                                   <div class="col-lg-9 mt-1 ml-lg-n3 text-center">
                                        <textarea class="form-control textareaMedium" name="authorReply" maxlength="300" placeholder="Post Your Reply within 300 Character"></textarea>
                                   </div>
                                   <div class="col-lg-2 mt-1 text-center">
                                       <input type="hidden" name="userId" value="'.$userId.'" ><input type="hidden" name="itemId" value="'.$itemId.'" ><input type="hidden" name="ratingId" value="'.$ratingId.'" ><input type="hidden" name="authorId" value="'.$authorId.'" ><input type="hidden" name="btn_action" value="saveAuthorReply" >
                                       <button type="submit" class="btn btn-primary btn-sm mt-3" >Post Reply</button>
                                   </div>
                               </div>
                               </form>
                            <div class="jQueryAuthorReply'.$ratingId.'"></div>
                            </div>
                               ';
            } 
        }
        $star = _e($row['rating_star']) ;
        $ratingDesign = '';
        if($star == '1'){
            $ratingDesign = '<i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Poor" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Poor" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Very Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Excellent" ></i>';
        }
        if($star == '2'){
            $ratingDesign = '<i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Poor" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Very Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Excellent" ></i>';
        }
        if($star == '3'){
            $ratingDesign = '<i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Very Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Excellent" ></i>';
        }
        if($star == '4'){
            $ratingDesign = '<i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Good" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Good" ></i><i class="fas fa-star fa-lg" data-toggle="tooltip" data-placement="top" title="Excellent" ></i>';
        }
        if($star == '5'){
            $ratingDesign = '<i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Poor" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Good" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Very Good" ></i><i class="fas fa-star fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Excellent" ></i>';
        }
        $authorId = find_user_id_by_itemid($pdo,$itemId) ;
            if($authorId == $userId) {
                $purchasedBadge = '&ensp;<button class="btn btn-info btn-sm" disabled><i class="fas fa-check-circle"></i> Author</button>' ;
                
            }
        $output .= '<div class="card p-2 mt-2 showUserRating'.$ratingId.'">';
        if($ratingReport == 0) { 
        $output .= '<div class="row">' ;
                $output .= '<div class="col-lg-4 mt-1 text-center">
                                <div class="col-lg-12">
                                    <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" class="img-fluid w-25 rounded-circle">
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <p>@'.$username.'</p>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>'.$purchasedBadge.'
                                </div>
                                <div class="col-lg-12 mt-2">
                                    Rated On : '.$ratingDate.'
                                </div>
                                <div class="col-lg-12">
                                    '.$report.' 
                                </div>

                            </div>' ;
                $output .= '<div class="col-lg-8 mt-1">
                                <div class="col-lg-12 mt-3">
                                    '.$ratingDesign.'
                                </div>
                                <div class="col-lg-12 mt-3 p-3 ">
                                    '.nl2br($ratingComment).'
                                </div>
                            </div>' ;
                $output .= $authorReply ;
                $output .= '</div>' ;
        } else {
            $output .= '<div class="row">' ;
                $output .= '<div class="col-lg-4 mt-1 text-center">
                                <div class="col-lg-12">
                                    <img src="'.BASE_URL.'img/profile.png" class="img-fluid w-25 rounded-circle">
                                </div>
                            </div>
                            <div class="col-lg-8 mt-3">
                                <h4 class="text-danger"><i class="fas fa-exclamation-circle text-danger fa-lg"></i> This Rating is Reported & Under Review.</h4>
                            </div>
                            ' ;
                $output .= '</div>' ;
        }
        $output .= '</div>' ;
    }
    if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_ratings" id="show_more_ratings'.$ratingId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$ratingId.'" class="show_moreall_ratings btn btn-primary btn-sm ann'.$itemId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
    return $output ;
}

// 201 - Grab Active Item Preview Image by ID as small icon

function active_itempreview_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<div class="p-2"><img src='.BASE_URL.'mainImg/'._e($row['item_preview_image']).' class="img-fluid w-50" ></div>' ;
    }
    return $output ;
}

// 202 - Grab Active Item Status by ID as small icon

function active_itemstatus_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."' and item_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    return $total ;
}

// 203 - Main Purchased File Download Item ID

function active_mainfile_download_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $FileSize = _e($row['item_mainfile_size']) ;
        $FileName = _e($row['item_mainfile']) ; 
        $output .= '<form method="POST" action="'.BASE_URL.'mainfiledownload" enctype="multipart/form-data">
                        <input type="hidden" name="mainfile_name" value="'.$FileName.'" >
                        <input type="submit" name="SaveMainfile" value="Download Main File" class="btn btn-primary btn-block" >
                    </form>';
    }
    return $output ;
}

// 204 - Grab  Item ID by Main File Name

function grab_item_id_by_filename($pdo,$name) {
    $query = "SELECT * FROM ot_users_video WHERE item_mainfile='".$name."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_id']) ;
    }
    return $output ;
}

//205 - Count Pending Item Notification for Users

function count_pending_item($pdo) {
    $query = "SELECT count(temp_id) as ct FROM ot_users_temp_video WHERE user_id='".$_SESSION['unprofessional']['id']."' and upload_success = '0' and (item_category = '0' or item_main_file = '' or item_preview_img = '' or item_demo_video = '')";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= '&ensp;<span class="badge badge-primary w-25 mt-n1">'._e($row['ct']).'</span>' ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 206 - Checking Pending Item Uploaded Successfully.

function checking_pendingitem_item($pdo,$tempId) {
    $query = "SELECT * FROM ot_users_temp_video WHERE temp_id='".$tempId."' and upload_success='0' and user_id = '".$_SESSION['unprofessional']['id']."' and (item_category = '0' or item_main_file = '' or item_preview_img = '' or item_demo_video = '')";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
	if($total == 0){
        header("location: ".BASE_URL."pending");
    } else {
        foreach($result as $row)
        {
            $upload_date = _e($row['item_time']);
            $created_date =  date('d F, Y',strtotime($upload_date));
            $time = date("Y-m-d h:i:s") ;        
            $start_date = new DateTime($upload_date);
            $since_start = $start_date->diff(new DateTime($time));
            $minutes = $since_start->days * 24 * 60;
            $minutes += $since_start->h * 60;
            $minutes += $since_start->i;
            if($minutes > 30){
                header("location: ".BASE_URL."pending");
            }
        }
        
    }
}

//205 - Count Pending Item Notification for Admin

function count_pending_item_for_admin($pdo) {
    $query = "SELECT count(temp_id) as ct FROM ot_users_temp_video WHERE upload_success = '0' and (item_category = '0' or item_main_file = '' or item_preview_img = '' or item_demo_video = '') and ((TIMESTAMPDIFF(MINUTE,temp_time,NOW()) > 30))";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

//206 - Count Active Item View

function count_active_item_view($pdo,$itemId) {
    $query = "SELECT item_viewed, user_id FROM ot_users_video WHERE item_id = '".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        $itemView = _e($row['item_viewed']) ;
        $userId = _e($row['user_id']) ;
        if(empty($_SESSION['unprofessional'])){
            $output .= ($itemView + 1) ;
        } else {
            if($userId != $_SESSION['unprofessional']['id']){
                $output .= ($itemView + 1) ;
            } else {
                $output .= $itemView ;
            }
        }
        
    }
    return $output ;
}

//207 - Increase Active Item View

function increase_active_item_view($pdo,$itemId) {
    $itemView = count_active_item_view($pdo,$itemId) ;
    $query = "update ot_users_video set item_viewed = '".$itemView."' WHERE item_id = '".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    return true ;
}

// 208 - Grab Active Item Status by ID as small icon

function active_itempause_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."' and item_pause = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    return $total ;
}

// 209 - Checking Edit Item which is not disabled by admin and not pause for sale

function checking_edit_item($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE user_id = '".$_SESSION['unprofessional']['id']."' and item_id='".$itemId."' and item_pause = '1' and item_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    if($total == 0){
         header("location: ".BASE_URL."activeitems");
    }
}

// 210 - Grab Item Tags by Active Item ID

function active_itemtags_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_tags']) ;
    }
    return $output ;
}

// 211 - Choose other category by Item id

function choose_category_by_itemid($pdo,$itemId) {
    $catId = find_cat_id_active_item($pdo,$itemId) ; 
    $query = "SELECT * FROM ot_category WHERE category_status='1' and id != '".$catId."' order by category_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'._e($row['id']).'">'._e($row['category_name']).'</option>' ;
    }
    return $output ;
}

// 212 - Choose other category by Item id

function selected_old_category_by_itemid($pdo,$itemId) {
    $catId = find_cat_id_active_item($pdo,$itemId) ; 
    $query = "SELECT * FROM ot_category WHERE category_status='1' and id = '".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'._e($row['id']).'">'._e($row['category_name']).'</option>' ;
    }
    return $output ;
}

// 213 - Grab Category ID by Item ID

function find_cat_id_active_item($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_category']) ;
    }
    return $output ;
}

// 208 - Checking Edit Item Update is Pending

function checking_update_pending($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video_update WHERE update_item_id='".$itemId."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    return $total ;
}

// 209 - Grab Edit Item Image Name 

function find_edit_image($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video_update WHERE update_item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['update_preview_image']) ;
    }
    return $output ;
}

// 210 - Grab Edit Item Video Name 

function find_edit_video($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video_update WHERE update_item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['update_demo_file']) ;
    }
    return $output ;
}

// 211 - Grab Edit Main File Name 

function find_edit_file($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video_update WHERE update_item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['update_main_file']) ;
    }
    return $output ;
}

// 212 - Count Pending Item Updates Notification for Users

function count_pending_updates($pdo) {
    $query = "SELECT count(status_id) as ct FROM ot_users_update_status WHERE status_user_id='".$_SESSION['unprofessional']['id']."' and status_approved = 'Pending'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= '&ensp;<span class="badge badge-primary w-25 mt-n1">'._e($row['ct']).'</span>' ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 213 - Count Pending Item Updates Notification for Admin

function count_item_updates_for_admin($pdo) {
    $query = "SELECT count(status_id) as ct FROM ot_users_update_status WHERE status_approved = 'Pending'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 214 - Checking Update Item for Admin if User not cancel the update

function checking_update_item_list($pdo,$itemId){
    $query = "SELECT * FROM ot_users_video_update WHERE update_item_id='".$itemId."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    if($total == 0){
        header("location: ".ADMIN_URL."itemupdates");
    }
}

// 215 - Grab Edit Category ID

function find_updatecategory_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video_update WHERE update_item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['update_item_category']) ;
    }
    return $output ;
}

// 216 -  Grab Active Item Preview Image by ID as Big icon

function active_itempreview_big_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<div class="p-2"><img src='.BASE_URL.'mainImg/'._e($row['item_preview_image']).' class="img-fluid" ></div>' ;
    }
    return $output ;
}

// 217 - Grab Item Demo Video Update by Original ID

function update_itemdemovideo_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video_update WHERE update_item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<div class="col-lg-12 p-0">
                        <div class="embed-responsive embed-responsive-16by9 rounded">
                         <video controls>
                              <source src="'.BASE_URL.'tmpVideos/'._e($row['update_demo_file']).'">
                              Your browser does not support the video tag.
                        </video>
                        </div> 
                    </div>' ;
    }
    return $output ;
}

// 218 -  Main Updated File Download to check by Admin via Item ID

function update_mainfile_download_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video_update WHERE update_item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $FileSize = _e($row['zip_size']) ;
        $mainFileName = _e($row['update_main_file']) ; 
        $output .= '<form method="POST" action="'.ADMIN_URL.'tempdownload" enctype="multipart/form-data">
                        <input type="hidden" name="mainfile_name" value="'.$mainFileName.'" >
                        <input type="submit" name="SaveMainfile" value="Download New Main File - '.$FileSize.' MB" class="btn btn-primary btn-block" >
                    </form>';
    }
    return $output ;
}

// 219 -  Main Old File Download to check by Admin via Item ID

function live_mainfile_download_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $FileSize = _e($row['item_mainfile_size']) ;
        $mainFileName = _e($row['item_mainfile']) ; 
        $output .= '<form method="POST" action="'.ADMIN_URL.'livedownload" enctype="multipart/form-data">
                        <input type="hidden" name="mainfile_name" value="'.$mainFileName.'" >
                        <input type="submit" name="SaveMainfile" value="Download Old Main File - '.$FileSize.' MB" class="btn btn-primary btn-block" >
                    </form>';
    }
    return $output ;
}

// 220 - Grab Comment to Reviewer by Item ID

function update_reviewercomment_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video_update WHERE update_item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= (strip_tags($row['update_comment'])) ;
    }
    return $output ;
}

// 221 - Grab Live Image Name by Item ID

function find_live_image($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_preview_image']) ;
    }
    return $output ;
}

// 223 - Grab Live Video Name by Item ID

function find_live_video($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_demo_video']) ;
    }
    return $output ;
}

// 223 - Grab Live Main File Name by Item ID

function find_live_file($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['item_mainfile']) ;
    }
    return $output ;
}

// 224 - Grab Updated Item Main File Size by Item ID

function updated_mainfilesize_by_id($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video_update WHERE update_item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['zip_size']) ;
    }
    return $output ;
}

// 225 - Count Paused Item for Users

function count_paused_item($pdo) {
    $query = "SELECT count(item_id) as ct FROM ot_users_video WHERE user_id='".$_SESSION['unprofessional']['id']."' and item_pause = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        if($row['ct'] > 0){
            $output .= '&ensp;<span class="badge badge-primary w-25 mt-n1">'._e($row['ct']).'</span>' ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 226 -  Show Forum Active Category First Slider should be active 

function show_forumactive_category_first_slider($pdo){
    $query = "SELECT max(forum_cat_id) as id FROM ot_forum_category WHERE  forum_cat_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    if($total > 0) {
        foreach($result as $row)
        {
                
                $catId = _e($row['id']) ;
                $catName = forum_category_name($pdo,$catId) ;
                $output .= '<div class="carousel-item active">
                                
                                <div class="col-md-4 text-center ">
                                    <div class="card card-body decorationNone bg-primary text-white">
                                    <a href="'.BASE_URL.'forumcategory/'.$catId.'" class="text-white">
                                        <h5 class="mt-2">'.$catName.'</h5>
                                        <p class="mt-2"><b><i class="fa fa-comments"></i> '.count_forum_topic($pdo,$catId).' Topics</b></p>
                                    </a>
                                    </div>
                                </div>
                                
                            </div>';   


        }
    } else {
            $output .= '' ;
        }
	return ($output);
}

// 227 -  Show Forum Active Category Slider 

function show_forumactive_category_slider($pdo){
    $query = "SELECT * FROM ot_forum_category WHERE forum_cat_id != (select max(forum_cat_id) from ot_forum_category) and forum_cat_status = '1' order by forum_cat_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
    if($total > 0) {
        foreach($result as $row)
        {
                
                $catId = _e($row['forum_cat_id']) ;
                $catName = forum_category_name($pdo,$catId) ;
                $output .= '<div class="carousel-item ">
                                <div class="col-md-4 text-center  ">
                                    <div class="card card-body decorationNone bg-primary text-white">
                                    <a href="'.BASE_URL.'forumcategory/'.$catId.'" class="text-white">
                                        <h5 class="mt-2">'.$catName.'</h5>
                                        <p class="mt-2"><b><i class="fa fa-comments"></i> '.count_forum_topic($pdo,$catId).' Topics</b></p>
                                    </div>
                                    </a>
                                </div>
                            </div>';   


        }
    } else {
            $output .= '' ;
        }
	return ($output);
}

// 228 -  Forum Category Name

function forum_category_name($pdo,$catId){
    $query = "SELECT * FROM ot_forum_category WHERE forum_cat_id='".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['forum_cat_name']) ;
    }
    return $output ;
}

// 229 -  Forum Category Topic Count

function count_forum_topic($pdo,$catId){
    $query = "SELECT count(topic_id) as total_topic FROM ot_forum_topic WHERE topic_cat_id='".$catId."' and topic_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['total_topic']) ;
    }
    return $output ;
}

// 230 - Choose Active Forum Category Options for User

function choose_forum_category($pdo){
    $query = "SELECT * FROM ot_forum_category WHERE forum_cat_status='1' order by forum_cat_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'._e($row['forum_cat_id']).'">'._e($row['forum_cat_name']).'</option>' ;
    }
    return $output ;
}

// 231 - Grab Short Forum Title for URL

function forum_urltitle_by_id($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic WHERE topic_id='".$topicId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $topicTitle = _e($row['topic_title']) ;
        $topicUrlTitle = preg_replace("/[^\w]+/", "-", $topicTitle);
        $topicUrlTitle = strtolower($topicUrlTitle)  ;
        $output .= strtolower($topicUrlTitle) ;
    }
    return $output ;
}

// 232 - Grab Full Forum Topic Title by Id

function forum_title_by_id($pdo,$topicId){
    $query = "SELECT * FROM ot_forum_topic WHERE topic_id='".$topicId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $topicTitle = strip_tags($row['topic_title']) ;
        $output .= $topicTitle ;
    }
    return $output ;
}


// 233 - Grab UserId by Topic Id

function forum_userid_by_titleid($pdo,$topicId){
    $query = "SELECT * FROM ot_forum_topic WHERE topic_id='".$topicId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['topic_user_id']) ;
    }
    return $output ;
}

// 234 - Find Topic Date by Topic Id

function grab_topic_date($pdo,$topicId){
    $query = "SELECT topic_time FROM ot_forum_topic WHERE topic_id='".$topicId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $topicTime = _e($row['topic_time']) ;
        $topicTime = date('d F, Y',strtotime($topicTime));
        $output .= $topicTime ;
        
    }
    return $output ;
}

// 235 - Grab Topic Description by Topic ID

function topicdescription_by_id($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic WHERE topic_id='".$topicId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['topic_description']) ;
    }
    return $output ;
}

// 236 - Grab Topic Solved by Topic ID

function topicsolved_by_id($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic WHERE topic_id='".$topicId."' and topic_solved = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
	if($total > 0 ) {
        $output .= '&ensp;<button class="btn btn-sm btn-success" disabled><i class="fas fa-check-circle"></i> Solved</button>' ;
    } else {
        $output .= '&ensp;<button class="btn btn-sm btn-danger" disabled><i class="fas fa-times-circle"></i> Not Solved</button>' ;
    }
    return $output ;
}

// 237 - Grab Last 10 Forum Topics on Forum Page

function grab_forum_topics_for_user($pdo) {
    $query = "SELECT * FROM ot_forum_topic WHERE topic_status = '1' order by topic_updated_time desc limit 10";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '';
    if($total > 0 ) {
        foreach($result as $row)
            {
                $topicId = _e($row['topic_id']) ;
                $catId = _e($row['topic_cat_id']) ;
                $catName = forum_category_name($pdo,$catId) ; 
                $output .= '<div class="section-header"><div class="row w-100">' ;
                $output .= '<div class="col-lg-8">' ;
                $output .= '<div class="col-lg-12"><a href="'.BASE_URL.'topic/'.$topicId.'/'.forum_urltitle_by_id($pdo,$topicId).'"><i class="fas fa-question-circle "></i> <b>'.short_topictitle_by_id($pdo,$topicId).'</b></a></div><div class="col-lg-12 mt-2 ml-1"><a href="'.BASE_URL.'forumcategory/'.$catId.'"><i class="fas fa-bookmark"></i> '.$catName.'</a>&ensp;<small>( Posted On : '.grab_topic_date($pdo,$topicId).' )</small></div>' ;
                $output .= '</div>' ;
                $output .= '<div class="col-lg-4 mt-2 p-2">'.topicsolved_by_id($pdo,$topicId) .''. topicanswersdesign_by_id($pdo,$topicId).' ' ;
                $output .= '</div>' ;
                $output .= '</div></div>' ;
            }
    }
    return $output ;
}

// 238 - Grab Short Topic Title 

function short_topictitle_by_id($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic WHERE topic_id='".$topicId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $strLength = strip_tags($row['topic_title']);
		if(strlen($strLength) > 70) {
			$dot = "...";
		} else {
			$dot = "";
		}
        $output .= strip_tags(substr_replace($row['topic_title'], $dot, 70)) ;
    }
    return $output ;
}


// 239 - Count Topic Answers by Topic ID

function topicanswersdesign_by_id($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic WHERE topic_id='".$topicId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row){
        $topicId = _e($row['topic_id']) ;
        $output .= '&ensp;<a href="'.BASE_URL.'topic/'.$topicId.'/'.forum_urltitle_by_id($pdo,$topicId).'" class="btn btn-sm btn-success"><i class="fas fa-comments"></i> '.$row['topic_answers'].' Answers</a>' ;
    }
        
   return $output ;
}

// 240 - Count Topic Answers by Topic ID

function topicanswerscount_by_id($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic WHERE topic_id='".$topicId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row){
        $output .=  _e($row['topic_answers']) ;
    }
        
   return $output ;
}

// 241 - Show Forum Topic Answers by Default 

function show_topic_answer_default($pdo,$topicId) {
    $sql = "SELECT count(*) as number_rows FROM ot_forum_topic_answers WHERE answer_topic_id='".$topicId."' and is_solution = '0' " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ot_forum_topic_answers WHERE answer_topic_id='".$topicId."' and is_solution = '0' order by answer_id asc limit 5";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row){
        $answerId = _e($row['answer_id']) ;
        $replyDate = _e($row['answer_time']) ;
        $replyDate = date('d F, Y',strtotime($replyDate));      
        $reply = strip_tags($row['user_answer']) ;
        $userId = _e($row['answer_user_id']) ;
        $username = username_by_id($pdo,$userId) ; 
        $solution = "";
        if(find_topicsolved_by_id($pdo,$topicId) == 0) {
            if(forum_userid_by_titleid($pdo,$topicId) == $_SESSION['unprofessional']['id']) {
                if($userId != $_SESSION['unprofessional']['id']) {
                    $solution = '&ensp;<button class="btn btn-success btn-sm markSolution" id='.$answerId.' ><i class="fas fa-check-circle"></i> Mark Solved</button>';
                }
            }
        }
        $output .= '<div class="section-header"><div class="row w-100"><div class="col-lg-12 p-2"><div class="row">';
        $output .= '<div class="col-lg-4 text-center ">
                        <div class="col-lg-12">
                            <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" class="img-fluid w-25 rounded-circle" >
                        </div>
                        <div class="col-lg-12 mt-2">
                            <p>@'.$username.'</p>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>'.$solution.'
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
    }
    if($totalRows > 5){
        $output .= '<div class="col-lg-12 justify-content-center mb-3">
					<div class="show_more_topic_reply" id="show_more_topic_reply'.$answerId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$answerId.'" class="show_moreall_topic_reply btn btn-primary btn-sm ann'.$topicId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
    }
        
   return $output ;
    
}


// 242 - Show Forum Topic Answers On Load 

function show_topic_answer_onload($pdo,$topicId) {
    $sql = "SELECT count(*) as number_rows FROM ot_forum_topic_answers WHERE answer_topic_id='".$topicId."' and is_solution = '0' and answer_id > ".$_GET['id']." " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ot_forum_topic_answers WHERE answer_topic_id='".$topicId."' and is_solution = '0' and answer_id > ".$_GET['id']." order by answer_id asc limit 5";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row){
        $answerId = _e($row['answer_id']) ;
        $replyDate = _e($row['answer_time']) ;
        $replyDate = date('d F, Y',strtotime($replyDate));      
        $reply = strip_tags($row['user_answer']) ;
        $userId = _e($row['answer_user_id']) ;
        $username = username_by_id($pdo,$userId) ; 
        $solution = "";
        if(find_topicsolved_by_id($pdo,$topicId) == 0) {
            if(forum_userid_by_titleid($pdo,$topicId) == $_SESSION['unprofessional']['id']) {
                if($userId != $_SESSION['unprofessional']['id']) {
                    $solution = '&ensp;<button class="btn btn-success btn-sm markSolution" id='.$answerId.' ><i class="fas fa-check-circle"></i> Mark Solved</button>';
                }
            }
        }
        $output .= '<div class="section-header"><div class="row w-100"><div class="col-lg-12 p-2"><div class="row">';
        $output .= '<div class="col-lg-4 text-center ">
                        <div class="col-lg-12">
                            <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" class="img-fluid w-25 rounded-circle" >
                        </div>
                        <div class="col-lg-12 mt-2">
                            <p>@'.$username.'</p>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>'.$solution.'
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
    }
    if($totalRows > 5){
        $output .= '<div class="col-lg-12 justify-content-center mb-3">
					<div class="show_more_topic_reply" id="show_more_topic_reply'.$answerId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$answerId.'" class="show_moreall_topic_reply btn btn-primary btn-sm ann'.$topicId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
    }
        
   return $output ;
    
}

// 243 - Grab User Id by Answer Id

function find_userid_by_answerid($pdo,$answerId) {
    $query = "SELECT * FROM ot_forum_topic_answers WHERE answer_id='".$answerId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row){
        $output .=  _e($row['answer_user_id']) ;
    }
        
   return $output ;
}

// 244 - Grab Topic Id by Answer Id

function find_topicid_by_answerid($pdo,$answerId) {
    $query = "SELECT * FROM ot_forum_topic_answers WHERE answer_id='".$answerId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row){
        $output .=  _e($row['answer_topic_id']) ;
    }
        
   return $output ;
}

// 244 - Count How many Problem Solved by User

function count_problemsolved_by_userid($pdo,$userId) {
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row){
        $output .=  _e($row['community_problem_solved']) ;
    }
        
   return $output ;
}

// 245 - Find Topic Solved by Topic ID

function find_topicsolved_by_id($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic WHERE topic_id='".$topicId."' and topic_solved = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 246 - Show Forum Topic Solved Problem Answer

function show_forum_topic_solution($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic_answers WHERE answer_topic_id='".$topicId."' and is_solution = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row){
        $answerId = _e($row['answer_id']) ;
        $replyDate = _e($row['answer_time']) ;
        $replyDate = date('d F, Y',strtotime($replyDate));      
        $reply = strip_tags($row['user_answer']) ;
        $userId = _e($row['answer_user_id']) ;
        $username = username_by_id($pdo,$userId) ; 
        $solution = '&ensp;<button class="btn btn-success btn-sm" ><i class="fas fa-check-circle"></i> Solution</button>';
        
        $output .= '<div class="section-header"><div class="row w-100"><div class="col-lg-12 p-2"><div class="row">';
        $output .= '<div class="col-lg-4 text-center ">
                        <div class="col-lg-12">
                            <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" class="img-fluid w-25 rounded-circle" >
                        </div>
                        <div class="col-lg-12 mt-2">
                            <p>@'.$username.'</p>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>'.$solution.'
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
    }
        
   return $output ;
    
}

// 247 - Checking Forum Category is Active otherwise Access Denied

function checking_active_forumcategory($pdo,$catId) {
    $query = "SELECT * FROM ot_forum_category WHERE forum_cat_id='".$catId."' and forum_cat_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	if($total == 0){
        header("location: ".BASE_URL."error");
    }
    return $total ; 
}

// 248 - Checking Forum Topic is Active otherwise Access Denied

function checking_active_forumtopic($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic WHERE topic_id = '".$topicId."' and topic_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	if($total == 0){
        header("location: ".BASE_URL."error");
    }
    return $total ; 
}

// 249 - Grab Last 5 Forum Topics on Forum Category Page by Default 

function grab_forum_topics_for_category($pdo,$catId) {
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(topic_id) FROM ot_forum_topic WHERE  topic_status = '1' and topic_cat_id = '".$catId."' GROUP BY topic_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT topic_id, topic_cat_id, topic_updated_time FROM ot_forum_topic WHERE topic_status = '1' and topic_cat_id = '".$catId."' GROUP BY topic_id order by topic_updated_time desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE 1  limit 5";
    
    
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '';
    if($total > 0 ) {
        foreach($result as $row)
            {
                $additionalId = _e($row['additional_id']) ;
                $topicId = _e($row['topic_id']) ;
                $catId = _e($row['topic_cat_id']) ;
                $catName = forum_category_name($pdo,$catId) ; 
                $output .= '<div class="section-header"><div class="row w-100">' ;
                $output .= '<div class="col-lg-8">' ;
                $output .= '<div class="col-lg-12"><a href="'.BASE_URL.'topic/'.$topicId.'/'.forum_urltitle_by_id($pdo,$topicId).'"><i class="fas fa-question-circle "></i> <b>'.short_topictitle_by_id($pdo,$topicId).'</b></a></div><div class="col-lg-12 mt-2 ml-1"><a href="'.BASE_URL.'forumcategory/'.$catId.'"><i class="fas fa-bookmark"></i> '.$catName.'</a>&ensp;<small>( Posted On : '.grab_topic_date($pdo,$topicId).' )</small></div>' ;
                $output .= '</div>' ;
                $output .= '<div class="col-lg-4 mt-2 p-2">'.topicsolved_by_id($pdo,$topicId) .''. topicanswersdesign_by_id($pdo,$topicId).' ' ;
                $output .= '</div>' ;
                $output .= '</div></div>' ;
            }
    }
    if($totalRows > 5){
        $output .= '<div class="col-lg-12 justify-content-center mb-3">
					<div class="show_more_forumcategory_topic" id="show_more_forumcategory_topic'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_moreall_forumcategory_topic btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
    }
    return $output ;
}

// 250 - Grab 5 More Forum Topics on Forum Category Page when User Pressed Load More Button

function grab_forum_topics_for_category_onload($pdo,$catId) {
    $sql = "SELECT COUNT(additional_id) as number_rows FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT count(topic_id) FROM ot_forum_topic WHERE  topic_status = '1' and topic_cat_id = '".$catId."' GROUP BY topic_id ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > '".$_GET['id']."'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "SELECT * FROM ( SELECT @a:=@a+1 additional_id, output.* FROM (SELECT topic_id, topic_cat_id, topic_updated_time FROM ot_forum_topic WHERE topic_status = '1' and topic_cat_id = '".$catId."' GROUP BY topic_id order by topic_updated_time desc ) output CROSS JOIN (SELECT @a:=0) init_variable ) AS subquery WHERE additional_id > '".$_GET['id']."'  limit 5";
    
    
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '';
    if($total > 0 ) {
        foreach($result as $row)
            {
                $additionalId = _e($row['additional_id']) ;
                $topicId = _e($row['topic_id']) ;
                $catId = _e($row['topic_cat_id']) ;
                $catName = forum_category_name($pdo,$catId) ; 
                $output .= '<div class="section-header"><div class="row w-100">' ;
                $output .= '<div class="col-lg-8">' ;
                $output .= '<div class="col-lg-12"><a href="'.BASE_URL.'topic/'.$topicId.'/'.forum_urltitle_by_id($pdo,$topicId).'"><i class="fas fa-question-circle "></i> <b>'.short_topictitle_by_id($pdo,$topicId).'</b></a></div><div class="col-lg-12 mt-2 ml-1"><a href="'.BASE_URL.'forumcategory/'.$catId.'"><i class="fas fa-bookmark"></i> '.$catName.'</a>&ensp;<small>( Posted On : '.grab_topic_date($pdo,$topicId).' )</small></div>' ;
                $output .= '</div>' ;
                $output .= '<div class="col-lg-4 mt-2 p-2">'.topicsolved_by_id($pdo,$topicId) .''. topicanswersdesign_by_id($pdo,$topicId).' ' ;
                $output .= '</div>' ;
                $output .= '</div></div>' ;
            }
    }
    if($totalRows > 5){
        $output .= '<div class="col-lg-12 justify-content-center mb-3">
					<div class="show_more_forumcategory_topic" id="show_more_forumcategory_topic'.$additionalId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$additionalId.'" class="show_moreall_forumcategory_topic btn btn-primary btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
    }
    return $output ;
}

// 251 - Grab Forum Topic Search by default 

function fetch_searchalltopic_foruser($pdo,$topicsearch) {
    $limit = "5";
	$sql = "SELECT count(*) as number_rows FROM `ot_forum_topic` WHERE topic_status ='1'  and (topic_title LIKE '%$topicsearch%')" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM `ot_forum_topic` WHERE topic_status='1' and (topic_title LIKE '%$topicsearch%') order by topic_id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = $statement->rowCount();
	$output = '';
	if($total > 0) {
        foreach($result as $row){
            $topicId = _e($row['topic_id']) ;
            $catId = _e($row['topic_cat_id']) ;
            $catName = forum_category_name($pdo,$catId) ; 
            $output .= '<div class="section-header"><div class="row w-100">' ;
            $output .= '<div class="col-lg-8">' ;
            $output .= '<div class="col-lg-12"><a href="'.BASE_URL.'topic/'.$topicId.'/'.forum_urltitle_by_id($pdo,$topicId).'"><i class="fas fa-question-circle "></i> <b>'.short_topictitle_by_id($pdo,$topicId).'</b></a></div><div class="col-lg-12 mt-2 ml-1"><a href="'.BASE_URL.'forumcategory/'.$catId.'"><i class="fas fa-bookmark"></i> '.$catName.'</a>&ensp;<small>( Posted On : '.grab_topic_date($pdo,$topicId).' )</small></div>' ;
            $output .= '</div>' ;
            $output .= '<div class="col-lg-4 mt-2 p-2">'.topicsolved_by_id($pdo,$topicId) .''. topicanswersdesign_by_id($pdo,$topicId).' ' ;
            $output .= '</div>' ;
            $output .= '</div></div>' ;
            
        }
        if($totalRows > $limit){
        $output .= '<div class="col-lg-12 justify-content-center mb-3">
					<div class="show_more_search_topic" id="show_more_search_topic'.$topicId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$topicId.'" class="show_moreall_search_topic btn btn-primary btn-sm ann'.$topicsearch.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
        }
        
    } else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> Sorry, Nothing Found. Try with other Search Term.</h3>';
	}
	return ($output);
    
}

// 251 - Grab Forum Topic Search when User Pressed Load More Button

function fetch_searchalltopic_foruser_onload($pdo,$topicsearch) {
    $limit = "5";
	$sql = "SELECT count(*) as number_rows FROM `ot_forum_topic` WHERE topic_id < '".$_GET['id']."' and topic_status ='1'  and (topic_title LIKE '%$topicsearch%')" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM `ot_forum_topic` WHERE topic_id < '".$_GET['id']."' and topic_status='1' and (topic_title LIKE '%$topicsearch%') order by topic_id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = $statement->rowCount();
	$output = '';
	if($total > 0) {
        foreach($result as $row){
            $topicId = _e($row['topic_id']) ;
            $catId = _e($row['topic_cat_id']) ;
            $catName = forum_category_name($pdo,$catId) ; 
            $output .= '<div class="section-header"><div class="row w-100">' ;
            $output .= '<div class="col-lg-8">' ;
            $output .= '<div class="col-lg-12"><a href="'.BASE_URL.'topic/'.$topicId.'/'.forum_urltitle_by_id($pdo,$topicId).'"><i class="fas fa-question-circle "></i> <b>'.short_topictitle_by_id($pdo,$topicId).'</b></a></div><div class="col-lg-12 mt-2 ml-1"><a href="'.BASE_URL.'forumcategory/'.$catId.'"><i class="fas fa-bookmark"></i> '.$catName.'</a>&ensp;<small>( Posted On : '.grab_topic_date($pdo,$topicId).' )</small></div>' ;
            $output .= '</div>' ;
            $output .= '<div class="col-lg-4 mt-2 p-2">'.topicsolved_by_id($pdo,$topicId) .''. topicanswersdesign_by_id($pdo,$topicId).' ' ;
            $output .= '</div>' ;
            $output .= '</div></div>' ;
            
        }
        if($totalRows > $limit){
        $output .= '<div class="col-lg-12 justify-content-center mb-3">
					<div class="show_more_search_topic" id="show_more_search_topic'.$topicId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$topicId.'" class="show_moreall_search_topic btn btn-primary btn-sm ann'.$topicsearch.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
        }
        
    } else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> Sorry, Nothing Found. Try with other Search Term.</h3>';
	}
	return ($output);
    
}

// 252 -  Count Unseen Forum Topic for Admin

function count_forumtopic_unseen($pdo){
    $query = "SELECT count(topic_id) as ct FROM ot_forum_topic WHERE topic_admin_seen = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 253 - Show Forum Topic Solved Problem Answer for Admin

function show_forum_topic_solution_foradmin($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic_answers WHERE answer_topic_id='".$topicId."' and is_solution = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row){
        $answerId = _e($row['answer_id']) ;
        $replyDate = _e($row['answer_time']) ;
        $replyDate = date('d F, Y',strtotime($replyDate));      
        $reply = strip_tags($row['user_answer']) ;
        $userId = _e($row['answer_user_id']) ;
        $username = username_by_id($pdo,$userId) ; 
        $solution = '&ensp;<button class="btn btn-success btn-sm" ><i class="fas fa-check-circle"></i> Solution</button>';
        
        $output .= '<div class="section-header"><div class="row w-100"><div class="col-lg-12 p-2"><div class="row">';
        $output .= '<div class="col-lg-4 text-center ">
                        <div class="col-lg-12">
                            <img src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" class="img-fluid w-25 rounded-circle" >
                        </div>
                        <div class="col-lg-12 mt-2">
                            <p>@'.$username.'</p>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-primary">View Profile</a>'.$solution.'
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
    }
        
   return $output ;
    
}

// 254 - Show Forum Topic All Answers for Admin

function show_topic_allanswer_foradmin($pdo,$topicId) {
    $query = "SELECT * FROM ot_forum_topic_answers WHERE answer_topic_id='".$topicId."' and is_solution = '0' order by answer_id asc ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row){
        $answerId = _e($row['answer_id']) ;
        $replyDate = _e($row['answer_time']) ;
        $replyDate = date('d F, Y',strtotime($replyDate));      
        $reply = strip_tags($row['user_answer']) ;
        $userId = _e($row['answer_user_id']) ;
        $username = username_by_id($pdo,$userId) ;
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
                        <div class="col-lg-12 mt-2">
                            <button class="btn btn-danger btn-sm deleteAnswer" id="'.$answerId.'">Delete</button>
                        </div>
                   </div>
                   <div class="col-lg-8">
                        '.nl2br($reply).'
                   </div>
                   ' ;
        $output .= '</div></div></div></div>' ;
    }
    
        
   return $output ;
    
}

// 255 -  Fetch User want Email when comment on their item

function want_email_on_item_comment($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['email_comment']) ;
    }
    return $output ;
}

// 256 -  Fetch Admin Name

function admin_name($pdo){
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['adm_name']) ;
    }
    return $output ;
}

// 257 -  Fetch Copyright Name

function admin_copyright_name($pdo){
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['copyright_name']) ;
    }
    return $output ;
}

// 258 - Grab Hard Reject Title for User

function grab_hr_title_for_user($pdo,$hardRejectTitleId){
    $query = "SELECT * FROM ot_hr_title WHERE hr_id='".$hardRejectTitleId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        
        $output .= strip_tags(nl2br($row['hr_title'])) ;
    }
    return $output ;
}

// 259 - Check & Show Payment Option to User

function payment_method($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$payPal = _e($row['paypal_on']) ;
		$stripe = _e($row['stripe_on']) ;
		
		if($payPal == '1') {
			$output .= '<option value="1">Paypal</option>';
		}
		if($stripe == '1') {
			$output .= '<option value="2">Stripe</option>';
		}
        $output .= '<option value="3">Wallet</option>';
	}
	return ($output);
}

// 260 -  Fetch Author want Email when Sale of their Item

function want_email_on_item_sales($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['email_sale']) ;
    }
    return $output ;
}

// 261 - Grab User Total Purchase Count

function count_user_all_purchases($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    
        foreach($result as $row)
        {
            
                $output .= _e($row['user_purchased_items']) ;
            
            
        }
        
    return $output ;
}

// 262 - Grab User Total Sold Amount

function count_author_sold_amount($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    
        foreach($result as $row)
        {
            
                $output .= _e($row['user_sold_price']) ;
            
            
        }
        
    return $output ;
}

// 263 - Grab Total Item Sold in Particular Month

function grab_author_item_sold_monthly($pdo,$userId,$startDate,$endDate) {
    $startTimeStamp = " 00:00:00" ;
    $endTimeStamp = " 23:59:59" ;
    $startDate = $startDate.$startTimeStamp ;
    $endDate = $endDate.$endTimeStamp ;
    $query = "select * from ot_author_statement where author_id = '".$userId."' and s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}


// 264 - Grab Total Amount for Authors in Particular Month

function grab_author_total_amount_monthly($pdo,$userId,$startDate,$endDate) {
    $startTimeStamp = " 00:00:00" ;
    $endTimeStamp = " 23:59:59" ;
    $startDate = $startDate.$startTimeStamp ;
    $endDate = $endDate.$endTimeStamp ;
    $query = "select * from ot_author_statement where author_id = '".$userId."' and s_time >= '".$startDate."' and s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $statementId = _e($row['statement_id']) ;
        $newStatement = $pdo->prepare("select * from ot_author_statement where statement_id = '".$statementId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $paid = _e($newrow['s_paid']) ;
            $type = _e($newrow['s_type']) ;
            $earning = _e($newrow['s_author_earning']) ;
            if($paid == '1'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning = -$earning ;
                }
            }
            if($paid == '0'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning =  0 ;
                    
                }
            }
            
          $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}

// 265 - Grab Author Earning which is Unpaid

function grab_author_unpaid_earning($pdo,$userId) {
    $query = "select * from ot_author_statement where author_id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $statementId = _e($row['statement_id']) ;
        $newStatement = $pdo->prepare("select * from ot_author_statement where statement_id = '".$statementId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $paid = _e($newrow['s_paid']) ;
            $type = _e($newrow['s_type']) ;
            $earning = _e($newrow['s_author_earning']) ;
            if($paid == '1'){
                if($type == '1'){
                    $earning = 0 ;
                }
                if($type != '1'){
                    $earning = -$earning ;
                }
            }
            if($paid == '0'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning =  0 ;
                    
                }
            }
            
          $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}


// 266 - Grab Author Total Number of Payout that have been paid from all time.

function count_author_total_payouts($pdo,$userId) {
    $query = "select * from ot_author_payouts where p_author_id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 267 - Grab Author Total Number of Payout Amount that have been paid from all time.

function count_author_total_paid_payouts($pdo,$userId) {
    $query = "select sum(payout_amt) as totalPaidAmount from ot_author_payouts where p_author_id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "0" ;
    if($total >0){
      foreach($result as $row){
            $output = _e($row['totalPaidAmount']) ;
        }  
    }
        
    return $output ;    
}

// 267 - Grab Author Monthly Paid Payout List

function grab_payout_list($pdo,$userId) {
    $query = "select * from ot_author_payouts where p_author_id = '".$userId."' order by payout_id desc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $sum = 0 ;
    if($total >0){
        foreach($result as $row){
            $sum = $sum + 1 ;
            $date = _e($row['payout_time']);
		    $date =  date('d F, Y',strtotime($date));
            $payoutMonth = _e($row['p_month'])."&ensp;"._e($row['p_year']) ;
            $output .= '<td>'.$sum.'</td>
                        <td>'.$date.'</td>
                        <td>'._e($row['p_txn_id']).'</td>
                        <td>'.$payoutMonth.'</td>
                        <td>'._e($row['payout_method']).'</td>
                        <td>'._e($row['paypal_email']).'</td>
                        <td><b>$'._e($row['payout_amt']).'</b></td>
                        ' ;
        }  
    } else {
        $output .= '<td colspan="7" class="text-danger text-center">Sorry, No Payouts have been found. Seems, Either You have 0 Sale or Unpaid Earning for the First Time.</td>';
    }
        
    return $output ;    
}

// 268 - Grab 5 Latest Notification for Users

function grab_notifications($pdo) {
    $query = "select * from ot_notifications where n_user_id = '".$_SESSION['unprofessional']['id']."' order by notification_id desc limit 5";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "";
    if($total > 0 ){
        foreach($result as $row){
            $id = _e($row['notification_id']) ;
            $seen = _e($row['n_seen']) ;
            $link = _e($row['n_link']);
            if($seen == '1'){
                $seen = "" ;
            } else {
                $seen = "dropdown-item-unread" ;
            }
            $type = _e($row['n_type']) ;
            $notificationType = "" ;
            if($type == '1'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-shopping-cart"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        Awesome, You have 1 New Sale.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '2'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-times"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        Your Item is Hard Rejected.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '3'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-warning text-white">
                                        <i class="fas fa-exclamation"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        Oops, Your Item is Soft Rejected.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '4'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-video"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        Your Item Update is Approved.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '5'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-video"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        Your Item Update is Rejected.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '6'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-comment"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        User comment on Your Item.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '7'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-comments"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        User replied on Your Item Comment.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '8'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-question"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        User added a New Reply on Forum Topic.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '9'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-warning text-white">
                                        <i class="fas fa-star"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        You received a New Rating on Your Item.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '10'){
                $notificationType = '<a href="'.$link.'" class="seenNotification dropdown-item '.$seen.'" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-heart"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        Someone Loves Your Item.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '11'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-comments"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        User replied to Your Comment.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '12'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-comment"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        Author replied to Your Comment.
                                      </div>
                                    </a>
                                   ';
            }
            if($type == '13'){
                $notificationType = '<a href="'.$link.'" class="dropdown-item '.$seen.' seenNotification" id="'.$id.'">
                                      <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-video"></i>
                                      </div>
                                      <div class="dropdown-item-desc text-muted h-100 mt-2">
                                        Congrats! Your Item is Approved.
                                      </div>
                                    </a>
                                   ';
            }
            $output .= $notificationType ;
        }
    } else {
        $output .= '<a href="#!" class="dropdown-item dropdown-item-unread">
                      <div class="dropdown-item-icon bg-danger text-white">
                        <i class="fas fa-exclamation"></i>
                      </div>
                      <div class="dropdown-item-desc text-muted">
                        You have No New Notification at This Moment.
                      </div>
                    </a>
                  ';
    }
    return $output ;
}

// 269 - Count Unseen Notification for Users

function count_unseen_notifications($pdo) {
    $query = "select * from ot_notifications where n_user_id = '".$_SESSION['unprofessional']['id']."' and n_seen = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 270 - Count Seen Notification for Users

function count_seen_notifications($pdo) {
    $query = "select * from ot_notifications where n_user_id = '".$_SESSION['unprofessional']['id']."' and n_seen = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 271 - Count Total Notification for Users

function count_total_notifications($pdo) {
    $query = "select * from ot_notifications where n_user_id = '".$_SESSION['unprofessional']['id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 272 - Find Notification Link for Users

function find_notification_link($pdo, $notificationId){
    $query = "select * from ot_notifications where n_user_id = '".$_SESSION['unprofessional']['id']."' and notification_id = '".$notificationId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "";
    
    foreach($result as $row){
        $output .= $row['n_link'] ;
    }
    return $output ;
}

// 273 - Grab Notifications Default for Users on Notification Page

function grab_notifications_default($pdo) {
    $limit = "5" ;
    $sql = "SELECT count(*) as number_rows FROM `ot_notifications` WHERE n_user_id = '".$_SESSION['unprofessional']['id']."'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "select * from ot_notifications where n_user_id = '".$_SESSION['unprofessional']['id']."' order by notification_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "";
    if($total > 0 ){
        foreach($result as $row){
            $id = _e($row['notification_id']) ;
            $seen = _e($row['n_seen']) ;
            $link = _e($row['n_link']);
            if($seen == '1'){
                $seen = "" ;
            } else {
                $seen = "unreadNotification" ;
            }
            $type = _e($row['n_type']) ;
            $notificationType = "" ;
            if($type == '1'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-success text-white"><i class="fa fa-shopping-cart "></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Awesome, You have 1 New Sale.</h6>
                                            </div>
                                        </div>
                                     </a>
                                    ';
            }
            if($type == '2'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-danger text-white"><i class="fa fa-times"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Your Item is Hard Rejected.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '3'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-warning text-white"><i class="fa fa-exclamation"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Oops, Your Item is Soft Rejected.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '4'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-success text-white"><i class="fa fa-video"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Your Item Update is Approved.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '5'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-danger text-white"><i class="fa fa-video"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Your Item Update is Rejected.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '6'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-info text-white"><i class="fa fa-comment"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">User comment on Your Item.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '7'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-primary text-white"><i class="fa fa-comments"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">User replied on Your Item Comment.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '8'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-info text-white"><i class="fa fa-question"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">User added a New Reply on Forum Topic.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '9'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-warning text-white"><i class="fa fa-star"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">You received a New Rating on Your Item.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '10'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-danger text-white"><i class="fa fa-heart"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Someone Loves Your Item.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '11'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-primary text-white"><i class="fa fa-comments"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">User replied to Your Comment.</h3>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '12'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-info text-white"><i class="fa fa-comment"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Author replied to Your Comment.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '13'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-success text-white"><i class="fa fa-video"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Congrats! Your Item is Approved.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            $output .= $notificationType ;
        }
        if($totalRows > $limit){
            $output .= '<div class="col-lg-12 justify-content-center">
                        <div class="show_more_notifications  mb-3 mt-3" id="show_more_notifications'.$id.'">

                                <div class="col text-center p-2">
                                <div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
                                <button id="'.$id.'" class="show_more_allnotifications btn btn-primary btn-sm">Load More</button>
                                </div>

                        </div>
                        </div>
                        ';
        }
    } else {
        $output .= '<a href="#!">
                        <div class="media unreadNotification p-2 border border-top-0 border-left-0 border-right-0">
                            <span class="roundedIcon bg-success text-white"><i class="fa fa-video"></i></span>
                            <div class="media-body">
                                <h5 class="mt-2 ml-2 text-primary">You have No New Notification at This Moment.</h5>
                            </div>
                        </div>
                     </a>
                  ';
    }
    return $output ;
}

// 273 - Grab Notifications Default for Users on Notification Page

function grab_notifications_onload($pdo) {
    $limit = "5" ;
    $sql = "SELECT count(*) as number_rows FROM `ot_notifications` WHERE n_user_id = '".$_SESSION['unprofessional']['id']."' and notification_id < '".$_GET['id']."'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    $query = "select * from ot_notifications where n_user_id = '".$_SESSION['unprofessional']['id']."' and notification_id < '".$_GET['id']."' order by notification_id desc limit ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "";
    if($total > 0 ){
        foreach($result as $row){
            $id = _e($row['notification_id']) ;
            $seen = _e($row['n_seen']) ;
            $link = _e($row['n_link']);
            if($seen == '1'){
                $seen = "" ;
            } else {
                $seen = "unreadNotification" ;
            }
            $type = _e($row['n_type']) ;
            $notificationType = "" ;
            if($type == '1'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-success text-white"><i class="fa fa-shopping-cart "></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Awesome, You have 1 New Sale.</h6>
                                            </div>
                                        </div>
                                     </a>
                                    ';
            }
            if($type == '2'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-danger text-white"><i class="fa fa-times"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Your Item is Hard Rejected.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '3'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-warning text-white"><i class="fa fa-exclamation"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Oops, Your Item is Soft Rejected.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '4'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-success text-white"><i class="fa fa-video"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Your Item Update is Approved.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '5'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-danger text-white"><i class="fa fa-video"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Your Item Update is Rejected.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '6'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-info text-white"><i class="fa fa-comment"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">User comment on Your Item.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '7'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-primary text-white"><i class="fa fa-comments"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">User replied on Your Item Comment.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '8'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-info text-white"><i class="fa fa-question"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">User added a New Reply on Forum Topic.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '9'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-warning text-white"><i class="fa fa-star"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">You received a New Rating on Your Item.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '10'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-danger text-white"><i class="fa fa-heart"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Someone Loves Your Item.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '11'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-primary text-white"><i class="fa fa-comments"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">User replied to Your Comment.</h3>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '12'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-info text-white"><i class="fa fa-comment"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Author replied to Your Comment.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            if($type == '13'){
                $notificationType = '<a href="'.$link.'" class=" seenNotificationOne" id="'.$id.'">
                                        <div class="media '.$seen.' p-2 border border-top-0 border-left-0 border-right-0">
                                            <span class="roundedIcon bg-success text-white"><i class="fa fa-video"></i></span>
                                            <div class="media-body">
                                                <h6 class="mt-2 ml-3 text-primary">Congrats! Your Item is Approved.</h6>
                                            </div>
                                        </div>
                                     </a>
                                     ';
            }
            $output .= $notificationType ;
        }
        if($totalRows > $limit){
            $output .= '<div class="col-lg-12 justify-content-center">
                        <div class="show_more_notifications  mb-3 mt-3" id="show_more_notifications'.$id.'">

                                <div class="col text-center p-2">
                                <div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid img-loader" /></div>
                                <button id="'.$id.'" class="show_more_allnotifications btn btn-primary btn-sm">Load More</button>
                                </div>

                        </div>
                        </div>
                        ';
        }
    } else {
        $output .= '<a href="#!">
                        <div class="media unreadNotification p-2 border border-top-0 border-left-0 border-right-0">
                            <span class="roundedIcon bg-success text-white"><i class="fa fa-video"></i></span>
                            <div class="media-body">
                                <h5 class="mt-2 ml-2 text-primary">You have No New Notification at This Moment.</h5>
                            </div>
                        </div>
                     </a>
                  ';
    }
    return $output ;
}

// 274 -  Fetch User want Email when Item Update is Approved

function want_email_on_item_update_approved($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['email_itemupdate_approve']) ;
    }
    return $output ;
}

// 275 -  Fetch User want Email when Item Update is Reject

function want_email_on_item_update_reject($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['email_itemupdate_reject']) ;
    }
    return $output ;
}

// 276 -  Fetch User want Email when Author Reply to Comment

function want_email_on_author_reply($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['email_author_reply']) ;
    }
    return $output ;
}


// 277 -  Fetch User want Email when Other User Reply to Comment

function want_email_on_commentuser_reply($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['email_user_reply']) ;
    }
    return $output ;
}

// 278 -  Fetch User want Email when New Rating to Their Item

function want_email_on_item_rating($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['email_item_rating']) ;
    }
    return $output ;
}

// 279 -  Fetch User want Email when Someone Loves Their Item

function want_email_on_item_love($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['email_item_love']) ;
    }
    return $output ;
}

// 280 -  Fetch User want Email when their Payout Released

function want_email_on_payout_release($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['email_payout_release']) ;
    }
    return $output ;
}

// 281 -  Fetch User want Email when Other User Reply on their Forum Topic

function want_email_on_forum_topic($pdo,$userId){
    $query = "SELECT * FROM ot_users WHERE id='".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['email_forum_topic']) ;
    }
    return $output ;
}

// 282 -  Find Maximum Days of Refund of Item

function find_max_refund_day($pdo){
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['refund_max_day']) ;
    }
    return $output ;
}

// 283 - Check Real Transaction Id for User Refund Form

function checking_txn_id($pdo,$txnId) {
    $query = "select * from ot_payments where p_user_id = '".$_SESSION['unprofessional']['id']."' and txn_id = '".$txnId."' and payment_status = 'Completed'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 284 -  Find Item Id via Transaction ID

function find_itemid_by_txnid($pdo,$txnId){
    $query = "select * from ot_payments where txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['p_item_id']) ;
    }
    return $output ;
}

// 285 -  Find Buyer Id via Transaction ID

function find_buyerid_by_txnid($pdo,$txnId){
    $query = "select * from ot_payments where txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['p_user_id']) ;
    }
    return $output ;
}


// 286 -  Find Author Id via Transaction ID

function find_authorid_by_txnid($pdo,$txnId){
    $query = "select * from ot_payments where txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['p_author_id']) ;
    }
    return $output ;
}

// 287 -  Find Paid Amt via Transaction ID

function find_paidamt_by_txnid($pdo,$txnId){
    $query = "select * from ot_payments where txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['p_total_amt']) ;
    }
    return $output ;
}

// 288 - Prevent Duplicate Refund

function prevent_duplicate_refund($pdo,$txnId) {
    $query = "select * from ot_refunds where r_user_id = '".$_SESSION['unprofessional']['id']."' and r_txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 289 -  Refund Status

function find_refund_status($pdo,$txnId) {
    $query = "select * from ot_refunds where r_txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '';
	foreach($result as $row)
	{
        $output .= _e($row['r_status']) ;
    }
    return $output ;
}

// 290 -  Author Decision on Refund

function find_author_refund_decision($pdo,$txnId) {
    $query = "select * from ot_refunds where r_txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '';
	foreach($result as $row)
	{
        $output .= _e($row['r_author_declined']) ;
    }
    return $output ;
}

// 291 -  Find Purchase Date via Transaction ID

function find_purchasedate_txnid($pdo,$txnId){
    $query = "select * from ot_payments where txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $date =  _e($row['payment_time']) ;
        $date =  date('d F, Y',strtotime($date));
        $output .= $date ;
    }
    return $output ;
}

//292 - Count Pending Refunds for Authors

function count_pending_refunds($pdo) {
    $query = "SELECT count(refund_id) as ct FROM ot_refunds WHERE r_author_id='".$_SESSION['unprofessional']['id']."' and r_author_declined = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= '&ensp;<span class="badge badge-primary w-25 mt-n1">'._e($row['ct']).'</span>' ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 293 - Check User has Downloaded the Item or Not

function checking_user_downloaded($pdo,$buyerId,$itemId) {
    $query = "select * from ot_user_purchases where purchase_user_id = '".$buyerId."' and purchase_item_id = '".$itemId."' and user_downloaded = '1' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 294 - Check Transaction ID is correct

function check_strong_transactionid($pdo,$txnId) {
    $query = "select * from ot_refunds where r_txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 295 - Check Transaction ID Dispute

function check_dispute_transactionid($pdo,$txnId) {
    $query = "select * from ot_refunds where r_txn_id = '".$txnId."' and r_disputed = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 296 - Count Dispute for Admin

function count_disputes($pdo) {
    $query = "SELECT count(refund_id) as ct FROM ot_refunds WHERE r_status='0' and r_disputed = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 297 - User Wallet Amount 

function find_userwallet_amt($pdo,$userId){
    $query = "select * from ot_users where id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_wallet']) ;
    }
    return $output ;
}

// 298 - Check Transaction ID is Paid to Author or Not

function check_transactionid_paid($pdo,$txnId) {
    $query = "select * from ot_author_statement where s_txn_id = '".$txnId."' and s_paid = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 299 - Check Transaction ID is Paid to Author or Not

function get_authorearned_by_transactionid($pdo,$txnId) {
    $query = "select * from ot_author_statement where s_txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '';
	foreach($result as $row)
	{
        $output .= _e($row['s_author_earning']) ;
    }
    return $output ;
}

// 300 - Check User is Author or Not

function check_user_is_author($pdo,$userId) {
    $query = "select * from ot_users_video where user_id = '".$userId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}


// 301 - Find Minimum Recharge Amount

function find_min_wallet($pdo) {
    $query = "select * from ot_admin where id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '';
	foreach($result as $row)
	{
        $output .= _e($row['min_wallet']) ;
    }
    return $output ;
}

// 302 - Find Maximum Recharge Amount

function find_max_wallet($pdo) {
    $query = "select * from ot_admin where id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '';
	foreach($result as $row)
	{
        $output .= _e($row['max_wallet']) ;
    }
    return $output ;
}


// 303 - Generate Unique Wallet Transaction ID

function generate_wallet_txn_id($pdo) {
    $txnId = "WT".walletcode(8)  ;
    $query = "select count(payment_id) as total from ot_payments where txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '';
    foreach($result as $row){
        $totalCount = _e($row['total']) ;
        if($totalCount == 0){
            $output .= trim($txnId) ;
        } else {
            generate_wallet_txn_id($pdo) ;
        }
    }
	
    return $output ;
}

// 304 - Wallet Code

function walletcode($no_of_char){
		$code='';
		$possible_char="0123456789";
		while($no_of_char>0)
			{
				$code.=substr($possible_char, rand(0, strlen($possible_char)-1), 1);
				$no_of_char--;
			}
		return $code;
}

// 305 - Check User Status is Verified & Active

function check_user_registration_status($pdo){
	$query = "SELECT * FROM ot_users WHERE user_status = '1' and id='".$_SESSION['unprofessional']['id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

// 306 - Check User Chance

function check_user_chance($pdo){
	$query = "SELECT * FROM ot_users WHERE user_blocked = '0' and user_status ='0' and id='".$_SESSION['unprofessional']['id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['u_chance']) ;
		}
	
	return _e($output) ;
}

// 307 - Check & Show Payment Option to User

function wallet_payment_method($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$payPal = _e($row['paypal_on']) ;
		$stripe = _e($row['stripe_on']) ;
		
		if($payPal == '1') {
			$output .= '<option value="1">Paypal</option>';
		}
		if($stripe == '1') {
			$output .= '<option value="2">Stripe</option>';
		}
	}
	return ($output);
}


// 308 - Get User Payout Email

function user_payout_email($pdo){
	$query = "SELECT * FROM ot_users WHERE id='".$_SESSION['unprofessional']['id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['user_payout_email']) ;
		}
	
	return _e($output) ;
}

// 308 - Grab Minimum Payout

function grab_minimum_payout($pdo){
	$query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['minimum_payout']) ;
		}
	
	return _e($output) ;
}

// 308 - Grab Payout Date

function grab_payouts_date($pdo){
	$query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['send_payout_day']) ;
		}
	
	return _e($output) ;
}


// 309 - Check User has Purchase the Item or Not

function checking_user_purchased($pdo,$buyerId,$itemId) {
    $query = "select * from ot_user_purchases where purchase_user_id = '".$buyerId."' and purchase_item_id = '".$itemId."'  ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 309 - Grab Show Community Earning or Not

function check_show_community_earning($pdo){
	$query = "SELECT * FROM ot_admin WHERE id='1' and show_community_earning = '1' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return $total ;
}

// 310 - Grab Community Earning

function grab_community_earning($pdo){
	$query = "SELECT * FROM ot_author_statement WHERE s_type='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $result = $statement->fetchAll();
	$total = $statement->rowCount();
	$output = '';
    $communityEarning = 0 ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
        
    }	
	return $output ;
}

// 311 - Grab Item Sold Count

function count_communityitem_sold($pdo){
	$query = "SELECT * FROM ot_author_statement WHERE s_type='1' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return $total ;
}

// 312 Remove Http or Https from URL

function remove_http($url) {
   $disallowed = array('http://', 'https://');
   foreach($disallowed as $d) {
      if(strpos($url, $d) === 0) {
         return str_replace($d, '', $url);
      }
   }
   return $url;
}

// 313 -  Fetch Quick Link Name

function quicklink_name($pdo){
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['link_name']) ;
    }
    return $output ;
}

// 314 -  Fetch About Us Name

function aboutus_name($pdo){
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['about_us_name']) ;
    }
    return $output ;
}

// 315 -  Instagram Follow Link for Admin

function get_insta_url($pdo){
	$query = "SELECT insta_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['insta_url'])){
			$output = '<a href="'.strip_tags($row['insta_url']).'" target="_blank"><i class="fa fa-instagram fa-lg text-primary "></i></a>&ensp;' ;
			} 
		}
	}
	return ($output) ;
}

// 316 -  FB Follow Link for Admin

function get_fb_url($pdo){
	$query = "SELECT fb_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['fb_url'])){
			$output = '<a href="'.strip_tags($row['fb_url']).'" target="_blank"><i class="fab fa-facebook fa-lg text-primary "></i></a>&ensp;' ;
			} 
		}
	}
	return ($output) ;
}

// 317 -  Twitter Follow Link for Admin

function get_twitter_url($pdo){
	$query = "SELECT twitter_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['twitter_url'])){
			$output = '<a href="'.strip_tags($row['twitter_url']).'" target="_blank"><i class="fab fa-twitter-square fa-lg text-primary"></i></a>&ensp;' ; 
			}
		}
	}
	return ($output) ;
}

// 318 -  Linkedin Follow Link for Admin

function get_linkedin_url($pdo){
	$query = "SELECT linkedin_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['linkedin_url'])){
			$output = '<a href="'.strip_tags($row['linkedin_url']).'" target="_blank"><i class="fab fa-linkedin-square fa-lg text-primary "></i></a>&ensp;' ; 
			}
		}
	}
	return ($output) ;
}

// 319 -  Behance Follow Link for Admin

function get_behance_url($pdo){
	$query = "SELECT behance_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['behance_url'])){
			$output = '<a href="'.strip_tags($row['behance_url']).'" target="_blank"><i class="fab fa-behance-square fa-lg text-primary " ></i></a>&ensp;' ;
			} 
		}
	}
	return ($output) ;
}

// 320 -  Dribbble Follow Link for Admin

function get_dribble_url($pdo){
	$query = "SELECT dribble_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['dribble_url'])){
				$output = '<a href="'.strip_tags($row['dribble_url']).'" target="_blank"><i class="fab fa-dribbble fa-lg text-primary " ></i></a>&ensp;' ;
			} 
		}
	}
	return ($output) ;
}

// 321 -  VK Follow Link for Admin

function get_vk_url($pdo){
	$query = "SELECT vk_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['vk_url'])){
			$output = '<a href="'.strip_tags($row['vk_url']).'" target="_blank"><i class="fab fa-vk fa-lg text-primary " ></i></a>&ensp;' ; 
			}
		}
	}
	return ($output) ;
}

// 322 -  Instagram Follow Link for Admin

function get_insta_url_link($pdo){
	$query = "SELECT insta_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output .= _($row['insta_url']) ;
		}
	}
	return ($output) ;
}

// 323 -  FB Follow Link for Admin

function get_fb_url_link($pdo){
	$query = "SELECT fb_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output .= _e($row['fb_url']) ;
		}
	}
	return ($output) ;
}

// 324 -  Twitter Follow Link for Admin

function get_twitter_url_link($pdo){
	$query = "SELECT twitter_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output .= _e($row['twitter_url']) ; 
		}
	}
	return ($output) ;
}

// 325 -  Linkedin Follow Link for Admin

function get_linkedin_url_link($pdo){
	$query = "SELECT linkedin_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output .= _e($row['linkedin_url']) ; 
		}
	}
	return ($output) ;
}

// 326 -  Behance Follow Link for Admin

function get_behance_url_link($pdo){
	$query = "SELECT behance_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output .= _e($row['behance_url']) ;
		}
	}
	return ($output) ;
}

// 327 -  Dribbble Follow Link for Admin

function get_dribble_url_link($pdo){
	$query = "SELECT dribble_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
				$output .= _e($row['dribble_url']) ;
		}
	}
	return ($output) ;
}

// 328 -  VK Follow Link for Admin

function get_vk_url_link($pdo){
	$query = "SELECT vk_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output .= _e($row['vk_url']) ; 
		}
	}
	return ($output) ;
}

// 329 -  Checking Google Analytics Turn On for Admin

function ga_on_admin($pdo){
	$query = "SELECT admin_on FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row){
        $output .= _e($row['admin_on']) ; 
    }
	return ($output) ;
}

// 330 -  Checking Google Analytics Turn On for User

function ga_on_user($pdo){
	$query = "SELECT user_on FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row){
        $output .= _e($row['user_on']) ; 
    }
	return ($output) ;
}

// 331 - Grab Google Analytics Code

function ga_code($pdo){
	$query = "SELECT g_code FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row){
        $output .= base64_decode($row['g_code']) ; 
    }
	return ($output) ;
}

// 332 - Check Page Slug for User

function check_slug_for_user($pdo){
	$query = "SELECT * FROM ot_admin_pages WHERE  page_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

// 333 - Find Active Pages

function fetch_active_pages_foruser($pdo){
	$query = "SELECT * FROM ot_admin_pages WHERE page_status = '1' order by page_name ASC";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<a  href="'.BASE_URL.'page/'._e($row["page_slug"]).'"><i class="icon fa fa-caret-right"></i> &ensp;'._e($row["page_name"]).'</a><br>';
	}
	return ($output);
}

// 334 -  Page Title 

function get_page_title($pdo,$pageSlug){
	$query = "SELECT * FROM ot_admin_pages WHERE page_status = '1' and page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row["page_name"]) ;
	}
	return ($output);
}

// 335 - Check Active Page Slug 

function check_activepage_for_user($pdo,$pageSlug){
	$query = "SELECT * FROM ot_admin_pages WHERE  page_status = '1' and page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

// 336 - Get Page Content 

function get_page_content($pdo,$pageSlug){
	$query = "SELECT * FROM ot_admin_pages WHERE page_status = '1' and page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= base64_decode($row["page_text"]) ;
	}
	return ($output);
}

// 337 - Check Page Slug for Admin

function check_page_slug($pdo,$pageSlug){
	$query = "SELECT * FROM ot_admin_pages WHERE  page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

// 338 - Check Page Slug by Page ID 

function check_page_slug_byId($pdo,$pageSlug,$pageId){
	$query = "SELECT * FROM ot_admin_pages WHERE  page_slug = '".$pageSlug."' and page_id != '".$pageId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

// 339 - Grab Total Amount for Authors in Particular Time for Admin

function grab_author_total_unpaidamount_monthly($pdo,$userId,$endDate) {
    $endTimeStamp = " 23:59:59" ;
    $endDate = $endDate.$endTimeStamp ;
    $query = "select * from ot_author_statement where author_id = '".$userId."' and  s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $statementId = _e($row['statement_id']) ;
        $newStatement = $pdo->prepare("select * from ot_author_statement where statement_id = '".$statementId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $paid = _e($newrow['s_paid']) ;
            $type = _e($newrow['s_type']) ;
            $earning = _e($newrow['s_author_earning']) ;
            if($paid == '1'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning = -$earning ;
                }
            }
            if($paid == '0'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning =  0 ;
                    
                }
            }
            
          $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}

// 340 - Unpaid Breakups

function grab_author_unpaid_breakups($pdo,$authorId,$endDate) {
    $endDate = base64_decode($endDate) ;
    $endTimeStamp = " 23:59:59" ;
    $endTimeStamp = $endDate.$endTimeStamp ;
    $statement = $pdo->prepare("select * from ot_author_statement where author_id = '".$authorId."' and s_time <= '".$endTimeStamp."' order by statement_id desc") ;
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "";
    $sum = 0 ;
    $preview = '<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table  class="table table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Date</th>
                                                    <th>Item Name</th>
                                                    <th>Type</th>
                                                    <th>Earning ($)</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                    
                ' ;
    foreach($result as $row){
        $sum = $sum + 1 ;
        $saleDate = _e($row['s_time']) ;
        $saleDate =  date('d F, Y',strtotime($saleDate));
        $itemId = _e($row['s_item_id']) ;
        $itemName = long_title_by_id($pdo,$itemId) ; 
        $earning = _e($row['s_author_earning']) ;
        $type = _e($row['s_type']) ;
        $paid = _e($row['s_paid']) ;
        if($paid == '0') {
            $paid = "<b class='text-danger'>Not Paid</b>" ;
        } else {
            $paid = "<b class='text-success'>Paid</b>" ;
        }
        $statusType = "" ;
        if($type == '1'){
            $earning = _e($row['s_author_earning']) ;
            $statusType = '<button class="btn btn-success btn-xs" disabled>Sale</button>' ;
        }
        if($type == '0'){
            $earning = "-".$earning ;
            $statusType = '<button class="btn btn-danger btn-xs" disabled>Sale Reversal</button>' ;
        }
        if($type == '2'){
            $earning = "-".$earning ;
            $statusType = '<button class="btn btn-danger btn-xs" disabled>Refund</button>' ;
        }
        $preview .= '<tr>
                        <td>'.$sum.'</td>
                        <td>'.$saleDate.'</td>
                        <td>'.$itemName.'</td>
                        <td>'.$statusType.'</td>
                        <td>'.$earning.'</td>
                        <td>'.$paid.'</td>                                           
                    </tr>        
                    ' ;
    }
    $preview .= '</tbody></table></div></div></div></div></div></div>' ;
    
    $output .= $preview ;
    return $output ;
    
}

// 341 - Paid Breakups

function grab_author_paid_breakups($pdo,$authorId,$endDate) {
    $endDate = base64_decode($endDate) ;
    $endTimeStamp = " 23:59:59" ;
    $endTimeStamp = $endDate.$endTimeStamp ;
    $statement = $pdo->prepare("select * from ot_author_statement where author_id = '".$authorId."' and s_time <= '".$endTimeStamp."'  order by statement_id desc") ;
    $statement->execute();
    $result = $statement->fetchAll();
    $output = "";
    $sum = 0 ;
    $preview = '<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table  class="table table-bordered table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Date</th>
                                                    <th>Item Name</th>
                                                    <th>Type</th>
                                                    <th>Earning ($)</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                    
                ' ;
    foreach($result as $row){
        $sum = $sum + 1 ;
        $saleDate = _e($row['s_time']) ;
        $saleDate =  date('d F, Y',strtotime($saleDate));
        $itemId = _e($row['s_item_id']) ;
        $itemName = long_title_by_id($pdo,$itemId) ; 
        $earning = _e($row['s_author_earning']) ;
        $type = _e($row['s_type']) ;
        $paid = _e($row['s_paid']) ;
        if($paid == '0') {
            $paid = "<b class='text-danger'>Not Paid</b>" ;
        } else {
            $paid = "<b class='text-success'>Paid</b>" ;
        }
        $statusType = "" ;
        if($type == '1'){
            $earning = _e($row['s_author_earning']) ;
            $statusType = '<button class="btn btn-success btn-xs" disabled>Sale</button>' ;
        }
        if($type == '0'){
            $earning = "-".$earning ;
            $statusType = '<button class="btn btn-danger btn-xs" disabled>Sale Reversal</button>' ;
        }
        if($type == '2'){
            $earning = "-".$earning ;
            $statusType = '<button class="btn btn-danger btn-xs" disabled>Refund</button>' ;
        }
        $preview .= '<tr>
                        <td>'.$sum.'</td>
                        <td>'.$saleDate.'</td>
                        <td>'.$itemName.'</td>
                        <td>'.$statusType.'</td>
                        <td>'.$earning.'</td>
                        <td>'.$paid.'</td>                                           
                    </tr>        
                    ' ;
    }
    $preview .= '</tbody></table></div></div></div></div></div></div>' ;
    
    $output .= $preview ;
    return $output ;
    
}

// 342 - Grab User Payout Email for Admin

function user_payout_email_for_admin($pdo,$authorId){
	$query = "SELECT * FROM ot_users WHERE id='".$authorId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['user_payout_email']) ;
		}
	
	return _e($output) ;
}

// 343 - Grab Total Paid Amount for Admin

function grab_totalpayout_paid_for_admin($pdo){
	$query = "SELECT sum(payout_amt) as totalPaidAmt FROM ot_author_payouts WHERE 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['totalPaidAmt']) ;
		}
	
	return _e($output) ;
}

// 344 - Grab Total No. of Paid Payout for Admin

function count_totalpayout_paid_for_admin($pdo){
	$query = "SELECT count(payout_id) as totalPaidId FROM ot_author_payouts WHERE 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['totalPaidId']) ;
		}
	
	return _e($output) ;
}

// 345 - Grab Item ID from Txn ID for Admin

function itemid_via_txnid_for_admin($pdo,$txnId){
	$query = "SELECT p_item_id FROM ot_payments WHERE txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['p_item_id']) ;
		}
	
	return _e($output) ;
}

// 346 - Grab Payment Method from Txn ID for Admin

function paymethod_via_txnid_for_admin($pdo,$txnId){
	$query = "SELECT payment_method FROM ot_payments WHERE txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['payment_method']) ;
		}
	
	return _e($output) ;
}

// 347 - Grab Payment Status from Txn ID for Admin

function paystatus_via_txnid_for_admin($pdo,$txnId){
	$query = "SELECT payment_status FROM ot_payments WHERE txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['payment_status']) ;
		}
	
	return _e($output) ;
}

// 348 - Grab Admin Commission % from Txn ID for Admin

function commission_via_txnid_for_admin($pdo,$txnId){
	$query = "SELECT p_commission FROM ot_payments WHERE txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['p_commission']) ;
		}
	
	return _e($output) ;
}


// 349 - Grab Author Earning from Txn ID for Admin

function authorearning_via_txnid_for_admin($pdo,$txnId){
	$query = "SELECT p_author_earning FROM ot_payments WHERE txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['p_author_earning']) ;
		}
	
	return _e($output) ;
}

// 350 - Grab Admin Earning from Txn ID for Admin

function adminearning_via_txnid_for_admin($pdo,$txnId){
	$query = "SELECT p_admin_earning FROM ot_payments WHERE txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['p_admin_earning']) ;
		}
	
	return _e($output) ;
}

// 351 - Check Transaction ID is in author statement

function check_strong_statement_transactionid($pdo,$txnId) {
    $query = "select * from ot_author_statement where s_txn_id = '".$txnId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 352 - Checking Username 

function checking_user_is_blocked($pdo) {
    $query = "SELECT * FROM ot_users WHERE id='".$_SESSION['unprofessional']['id']."' and  user_blocked = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
    if($total > 0){
      header("location: ".BASE_URL."logout");
      exit;  
    }
	   
}

// 353 - Grab Author Profile Picture Name

function get_author_profilepic_name_url($pdo,$authorId){
    $query = "SELECT user_dp FROM ot_users WHERE id='".$authorId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
    $output = '';
	foreach($result as $row)
		{
            $userDp = _e($row['user_dp']) ;
            if($userDp != ''){
                $output .='profilePic/'.$userDp ;
            } else {
                $output .='img/profile.png' ;
            } 
		}
	return ($output) ;
}

// 354 -  Count Unseen Comments Report for Admin

function count_reportedcomment_unseen($pdo){
    $query = "SELECT count(comment_id) as ct FROM ot_comments WHERE author_report = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 354 -  Count Unseen Comments Reply Report for Admin

function count_reportedcommentreply_unseen($pdo){
    $query = "SELECT count(comment_thread_id) as ct FROM ot_comment_thread WHERE thread_report = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 355 -  Count Unseen Ratings Report for Admin

function count_reportedratings_unseen($pdo){
    $query = "SELECT count(rating_id) as ct FROM ot_ratings WHERE rating_report = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
	$output = '';
    foreach($result as $row)
    {
        if($row['ct'] > 0){
            $output .= _e($row['ct']) ;
        } else {
            $output = "" ;
        }
    }
    return $output ;
}

// 356 - Count Today Total No. of Sales for Admin

function count_todaytotal_sales($pdo){
    $todayStart = date("Y-m-d");
    $startDate .= $todayStart." 00:00:00" ;
    $endDate = $todayStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 357 - Count Today Total Sales Amount for Admin

function count_todaytotal_sales_amount($pdo){
    $todayStart = date("Y-m-d");
    $startDate .= $todayStart." 00:00:00" ;
    $endDate = $todayStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

// 358 - Grab Today Total Amount of All Authors for Admin

function grab_today_totalamount_ofauthor($pdo) {
    $todayStart = date("Y-m-d");
    $startDate .= $todayStart." 00:00:00" ;
    $endDate = $todayStart." 23:59:59" ;
    $query = "select * from ot_author_statement where  s_time >= '".$startDate."' and  s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $statementId = _e($row['statement_id']) ;
        $newStatement = $pdo->prepare("select * from ot_author_statement where statement_id = '".$statementId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $paid = _e($newrow['s_paid']) ;
            $type = _e($newrow['s_type']) ;
            $earning = _e($newrow['s_author_earning']) ;
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning = -$earning ;
                }
            
            
          $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}

// 359 - Grab Today Total Amount of Admin Earning for Admin

function grab_today_totalamount_ofadmin($pdo) {
    $todayStart = date("Y-m-d");
    $startDate .= $todayStart." 00:00:00" ;
    $endDate = $todayStart." 23:59:59" ;
    $query = "select * from ot_author_statement where  s_time >= '".$startDate."' and  s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $txnId = _e($row['s_txn_id']) ;
        $type = _e($row['s_type']) ;
        $newStatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $earning = _e($newrow['p_admin_earning']) ;
            if($type == '1'){
                $earning = $earning ;
            }
            if($type != '1'){
                $earning = -$earning ;
            }
           $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}

// 360 - Count This Month Total No. of Sales for Admin

function count_curmonthtotal_sales($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 361 - Count This Month Total Sales Amount for Admin

function count_curmonthtotal_sales_amount($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}


// 362 - Grab This Month Total Amount of All Authors for Admin

function grab_curmonth_totalamount_ofauthor($pdo) {
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    $query = "select * from ot_author_statement where  s_time >= '".$startDate."' and  s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $statementId = _e($row['statement_id']) ;
        $newStatement = $pdo->prepare("select * from ot_author_statement where statement_id = '".$statementId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $paid = _e($newrow['s_paid']) ;
            $type = _e($newrow['s_type']) ;
            $earning = _e($newrow['s_author_earning']) ;
            if($paid == '1'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning = -$earning ;
                }
            }
            if($paid == '0'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning =  0 ;
                    
                }
            }
            
            
          $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}

// 363 - Grab This Month Total Amount of Admin Earning for Admin

function grab_curmonth_totalamount_ofadmin($pdo) {
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    $query = "select * from ot_author_statement where  s_time >= '".$startDate."' and  s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $txnId = _e($row['s_txn_id']) ;
        $type = _e($row['s_type']) ;
        $paid = _e($row['s_paid']) ;
        $newStatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $earning = _e($newrow['p_admin_earning']) ;
            if($paid == '1'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning = -$earning ;
                }
            }
            if($paid == '0'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning =  0 ;
                    
                }
            }
            
          $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}

// 364 - Count This Month Total No. of Sales including Refund & Reversal for Admin

function count_curmonthalltotal_sales($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 365 - Count This Month Total Sales Amount including Refund & Reversal for Admin

function count_curmonthalltotal_sales_amount($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

// 366 - Count Total Refund for Admin

function count_curmonthalltotal_refunds($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 367 - Count Total Refund  Amount for Admin

function count_curmonthalltotal_refundsamt($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

// 368 - Count Total Reversal for Admin

function count_curmonthalltotal_reversal($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 369 - Count Total Refund  Amount for Admin

function count_curmonthalltotal_reversalamt($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

//******************************************

// 370 - Count Given Month Total No. of Sales for Admin

function viewcount_curmonthalltotal_sales($pdo,$startDate,$endDate){
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 371 - Count Given Month Total Sales Amount including Refund & Reversal for Admin

function viewcount_curmonthalltotal_sales_amount($pdo,$startDate,$endDate){
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

// 372 - Count Given Month Total Refund for Admin

function viewcount_curmonthalltotal_refunds($pdo,$startDate,$endDate){
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 373 - Count Given Month Total Refund  Amount for Admin

function viewcount_curmonthalltotal_refundsamt($pdo,$startDate,$endDate){
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

// 374 - Count Given Month Total Reversal for Admin

function viewcount_curmonthalltotal_reversal($pdo,$startDate,$endDate){    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 375 - Count Given Month Total Refund  Amount for Admin

function viewcount_curmonthalltotal_reversalamt($pdo,$startDate,$endDate){
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

// 376 - Count Given Month  Total No. of Sales for Admin

function viewcount_curmonthtotal_sales($pdo,$startDate,$endDate){    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 377 - Count  Given Month  Total Sales Amount for Admin

function viewcount_curmonthtotal_sales_amount($pdo,$startDate,$endDate){
    
    $query = "select * from ot_author_statement where s_time >= '".$startDate."' and s_time <= '".$endDate."' and s_type = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

// 378 - Grab Given Month Total Amount of Admin Earning for Admin

function viewgrab_curmonth_totalamount_ofadmin($pdo,$startDate,$endDate) {
    $query = "select * from ot_author_statement where  s_time >= '".$startDate."' and  s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $txnId = _e($row['s_txn_id']) ;
        $type = _e($row['s_type']) ;
        $paid = _e($row['s_paid']) ;
        $newStatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $earning = _e($newrow['p_admin_earning']) ;
            if($paid == '1'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning = -$earning ;
                }
            }
            if($paid == '0'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning =  0 ;
                    
                }
            }
            
          $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}

// 379 - Grab Given Month Total Amount of All Authors for Admin

function viewgrab_curmonth_totalamount_ofauthor($pdo,$startDate,$endDate) {
    $query = "select * from ot_author_statement where  s_time >= '".$startDate."' and  s_time <= '".$endDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $statementId = _e($row['statement_id']) ;
        $newStatement = $pdo->prepare("select * from ot_author_statement where statement_id = '".$statementId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $paid = _e($newrow['s_paid']) ;
            $type = _e($newrow['s_type']) ;
            $earning = _e($newrow['s_author_earning']) ;
            if($paid == '1'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning = -$earning ;
                }
            }
            if($paid == '0'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning =  0 ;
                    
                }
            }
            
            
          $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}

//******************************************

// 380 - Count Lifetime Total No. of Sales for Admin

function count_lifetimetotal_sales($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_type = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 381 - Count Lifetime Total Sales Amount for Admin

function count_lifetimetotal_sales_amount($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_type = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}


// 382 - Grab Lifetime Total Amount of All Authors for Admin

function grab_lifetime_totalamount_ofauthor($pdo) {
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    $query = "select * from ot_author_statement where  1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $statementId = _e($row['statement_id']) ;
        $newStatement = $pdo->prepare("select * from ot_author_statement where statement_id = '".$statementId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $paid = _e($newrow['s_paid']) ;
            $type = _e($newrow['s_type']) ;
            $earning = _e($newrow['s_author_earning']) ;
            if($paid == '1'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning = -$earning ;
                }
            }
            if($paid == '0'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning =  0 ;
                    
                }
            }
            
            
          $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}

// 383 - Grab Lifetime Total Amount of Admin Earning for Admin

function grab_lifetime_totalamount_ofadmin($pdo) {
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    $query = "select * from ot_author_statement where  1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = "" ;
    $totalEarning = "0" ;
    foreach($result as $row)
    {
        $txnId = _e($row['s_txn_id']) ;
        $type = _e($row['s_type']) ;
        $paid = _e($row['s_paid']) ;
        $newStatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."' ") ;
        $newStatement->execute();
	    $newresult = $newStatement->fetchAll();
        foreach($newresult as $newrow)
        {
            $earning = _e($newrow['p_admin_earning']) ;
            if($paid == '1'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning = -$earning ;
                }
            }
            if($paid == '0'){
                if($type == '1'){
                    $earning = $earning ;
                }
                if($type != '1'){
                    $earning =  0 ;
                    
                }
            }
            
          $totalEarning = $totalEarning + $earning  ;
        }
        
    }
    $output .= $totalEarning ; 
    return $output ;
}

// 384 - Count Lifetime Total No. of Sales including Refund & Reversal for Admin

function count_lifetimealltotal_sales($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 385 - Count Lifetime Total Sales Amount including Refund & Reversal for Admin

function count_lifetimealltotal_sales_amount($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

// 386 - Count Lifetime Total Refund for Admin

function count_lifetimealltotal_refunds($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_type = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 387 - Count Lifetime Total Refund  Amount for Admin

function count_lifetimealltotal_refundsamt($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_type = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

// 388 - Count Lifetime Total Reversal for Admin

function count_lifetimealltotal_reversal($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_type = '2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 389 - Count Lifetime Total Refund  Amount for Admin

function count_lifetimealltotal_reversalamt($pdo){
    $todayStart = date("Y-m-01");
    $startDate .= $todayStart." 00:00:00" ;
    $endStart = date("Y-m-t") ;
    $endDate = $endStart." 23:59:59" ;
    
    $query = "select * from ot_author_statement where s_type = '2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '' ;
    foreach($result as $row){
        $txnId = _e($row['s_txn_id']) ;
        $newstatement = $pdo->prepare("select * from ot_payments where txn_id = '".$txnId."'");
        $newstatement->execute();
        $newresult = $newstatement->fetchAll(PDO::FETCH_ASSOC);
        foreach($newresult as $newrow){
            $communityEarning = ($communityEarning + $newrow['p_total_amt']) ;
            $output = $communityEarning ;
            
        }
    }
    return $output ;
}

// 390 - Count Total Items for Admin

function count_totalitems($pdo){    
    $query = "select * from ot_users_video where 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 391 - Count Total Active Items for Admin

function count_totalitems_active($pdo){    
    $query = "select * from ot_users_video where item_status = '1' and item_pause = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 392 - Count Total Pause Items for Admin

function count_totalitems_pause($pdo){    
    $query = "select * from ot_users_video where item_pause = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 392 - Count Total Disabled Items for Admin

function count_totalitems_disabled($pdo){    
    $query = "select * from ot_users_video where item_status = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 393 - Count Total Users for Admin

function count_totalusers($pdo){    
    $query = "select * from ot_users where 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 394 - Count Total Active Users for Admin

function count_totalusers_active($pdo){    
    $query = "select * from ot_users where user_status = '1' and user_blocked = '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 395 - Count Total Blocked Users for Admin

function count_totalusers_blocked($pdo){    
    $query = "select * from ot_users where user_blocked = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 396 - Count Total Authors for Admin

function count_totalusers_authors($pdo){    
    $query = "SELECT user_id FROM `ot_users_video` WHERE item_status='1' GROUP by user_id";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 398 - Grab Short Item Title for Admin Dashboard

function short_title_by_id_foradmin($pdo,$itemId) {
    $query = "SELECT * FROM ot_users_video WHERE item_id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $strLength = strip_tags($row['item_title']);
		if(strlen($strLength) > 17) {
			$dot = "...";
		} else {
			$dot = "";
		}
        $output .= strip_tags(substr_replace($row['item_title'], $dot, 17)) ;
    }
    return $output ;
}

// 398 - Top 5 Sold Items for Admin 

function topfive_items($pdo){
    $query = "SELECT * FROM `ot_users_video` WHERE item_status='1' and item_pause = '1' order by item_sale desc limit 5";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    $output = '';
    foreach($result as $row){
        $itemId = _e($row['item_id']);
        $imageName = _e($row['item_preview_image']) ;
        $itemTitle = short_title_by_id_foradmin($pdo,$itemId) ;
        $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
        $itemSales = _e($row['item_sale']) ;
        $price = _e($row['item_price']) ;
        $username = get_username_by_itemid($pdo,$itemId) ;
        $output .= '<li class="media">
                        <a href="'.BASE_URL.'video/'.$itemId.'/'.$itemUrlTitle.'" target="_blank">
                            <img class="mr-3 rounded img-fluid" src="'.BASE_URL.'mainImg/'.$imageName.'" alt="Item" width="50">
                        </a>
                        <div class="media-body">
                            <div class="media-right">$'.$price.'</div>
                            <div class="media-title"><a href="'.BASE_URL.'video/'.$itemId.'/'.$itemUrlTitle.'" target="_blank">'.$itemTitle.'</a></div>
                            <div class="text-muted text-small">
                                by <a href="'.BASE_URL.'user/'.$username.'" target="_blank">'.$username.'</a>
                                <div class="bullet"></div> '.$itemSales.' Sales

                            </div>
                        </div>
                    </li>';
    }
    
    return $output ;
}

// 399 - Top 5 Authors for Admin 

function topfive_authors($pdo){
    $newquery = "SELECT user_id FROM `ot_users_video` WHERE item_status='1' GROUP by user_id";
	$newstatement = $pdo->prepare($newquery);
	$newstatement->execute();
	$newresult = $newstatement->fetchAll();
    $newtotal = $newstatement->rowCount();
    $output = '';
    foreach($newresult as $newrow){
        $authorId = _e($newrow['user_id']) ;
        $query = "SELECT * FROM `ot_users` WHERE id = '".$authorId."' and user_status='1' and user_blocked = '0' order by user_sold_price desc limit 5";
        $statement = $pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total = $statement->rowCount();

        foreach($result as $row){
            $username = username_by_id($pdo,$authorId) ;
            $price = _e($row['user_sold_price']) ;
            $soldItems  = _e($row['user_sold_items']) ;
            $output .= '<li class="media">
                            <a href="'.BASE_URL.'user/'.$username.'" target="_blank">
                                <img class="mr-3 rounded-circle img-fluid" src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" alt="Profile" width="50">
                            </a>
                            <div class="media-body">
                                <div class="media-title"><a href="'.BASE_URL.'user/'.$username.'" target="_blank">'.$username.'</a></div>
                                <div class="text-muted text-small">
                                    Sold Amount : $'.$price.'<div class="bullet"></div> '.$soldItems.' Sales

                                </div>
                            </div>
                        </li>';
        }
    }
    
    
    return $output ;
}

// 400 - Top 5 Buyers for Admin 

function topfive_buyers($pdo){
    $query = "SELECT * FROM `ot_users` WHERE user_status='1' and user_blocked = '0' order by user_purchased_items desc limit 5";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total = $statement->rowCount();

    foreach($result as $row){
        $userId = _e($row['id']) ;
        $username = username_by_id($pdo,$userId) ;
        $purchasedItems  = _e($row['user_purchased_items']) ;
        $output .= '<li class="media">
                        <a href="'.BASE_URL.'user/'.$username.'" target="_blank">
                            <img class="mr-3 rounded-circle img-fluid" src="'.BASE_URL.get_user_profilepic_name_url_username($pdo,$username).'" alt="Profile" width="50">
                        </a>
                        <div class="media-body">
                            <div class="media-title"><a href="'.BASE_URL.'user/'.$username.'" target="_blank">'.$username.'</a></div>
                            <div class="text-muted text-small">
                                Total Purchases : '.$purchasedItems.'

                            </div>
                        </div>
                    </li>';
    }
   
    return $output ;
}

// 401 - Find Admin Commission % for Setting

function admin_commission_forsettings($pdo){
	$query = "SELECT commission FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= _e($row['commission']) ;
		}
	
	return _e($output) ;
}

// 402 -  Find User Panel is OFF / ON

function show_userpanel($pdo){
    $query = "SELECT * FROM ot_admin WHERE id='1' and show_user_panel = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 403 - User Panel Message

function show_userpanel_msg($pdo){
	$query = "SELECT user_panel_message FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
		foreach($result as $row){
			$output .= strip_tags($row['user_panel_message']) ;
		}
	
	return $output ;
}

// 404 - Checking If User Panel is OFF then redirect users to under maintentance page.

function checking_userpanel($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1' and show_user_panel = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	if($total == 0){
        header("location: ".BASE_URL."undermaintenance");
    }
}

// 405 -  Fetch Admin Login Email

function admin_login_email($pdo){
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['adm_email']) ;
    }
    return $output ;
}

// 406 -  Check Blocked User due to Sale Reversal for Admin

function checking_salereversal_users($pdo,$userId){
    $query = "SELECT purchase_user_id FROM `ot_user_purchases` WHERE purchase_user_id = '".$userId."' and download_block = '1' GROUP by purchase_user_id";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    $total = $statement->rowCount();
    return $total ;
}

// 405 -  Fetch How many chances gives to User to verify their SignUp OTP by Admin

function admin_user_chances($pdo){
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_chance']) ;
    }
    return $output ;
}

// 406 - Stripe On

function payment_stripeon($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1' and stripe_on = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	return ($total);
}

// 407 - Paypal On

function payment_paypalon($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1' and paypal_on = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	return ($total);
}

// 408 -  Category Active 

function check_start_category($pdo){
    $query = "SELECT * FROM ot_category WHERE category_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = $statement->rowCount();
    return $total ;
}


?>