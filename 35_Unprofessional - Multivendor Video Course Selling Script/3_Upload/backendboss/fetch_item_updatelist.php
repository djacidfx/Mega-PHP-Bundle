<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_video_update WHERE update_upload_success = '1' order by update_id asc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $itemId = _e($row['update_item_id']) ;
        $itemTitle = long_title_by_id($pdo,$itemId) ;
        $userId = _e($row['update_user_id']) ;
        $user_fullname = user_fullname_by_id($pdo,$userId) ;
        $userName = username_by_id($pdo,$userId) ;
        $userEmail = useremail_by_id($pdo,$userId) ;
        $comment = nl2br(strip_tags($row['update_comment'])) ;
		$created_date = _e($row['update_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $catId = find_cat_id_active_item($pdo,$itemId) ;
        $categoryUpdate = _e($row['update_item_category']);
        
        if($catId == $categoryUpdate){
            $categoryUpdate = "No" ;
        } else {
            $categoryUpdate = "Yes" ;
        }
        
        $previewUpdate = _e($row['update_preview_image']);
        if(empty($previewUpdate)){
            $previewUpdate = "No" ;
        } else {
            $previewUpdate = "Yes" ;
        }
        
        $demoUpdate = _e($row['update_demo_file']);
        if(empty($demoUpdate)){
            $demoUpdate = "No" ;
        } else {
            $demoUpdate = "Yes" ;
        }
        
        $mainfileUpdate = _e($row['update_main_file']);
        if(empty($mainfileUpdate)){
            $mainfileUpdate = "No" ;
        } else {
            $mainfileUpdate = "Yes" ;
        }
        $action = '<a href="'.ADMIN_URL.'updatereview/'.$itemId.'" class="btn btn-sm btn-primary "><i class="fa fa-eye d-inline"></i>Review</a>';
		$output['data'][] = array( 	
		$sum,	
        $userId,
        $userName,
        $userEmail,
        $created_date,
        $itemId,
        $itemTitle,
		$categoryUpdate,
        $previewUpdate,
        $demoUpdate,
        $mainfileUpdate,
        $comment,
        $action
		); 	
	}
}
echo json_encode($output);
?>