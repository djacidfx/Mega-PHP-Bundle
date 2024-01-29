<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_temp_video WHERE  upload_success = '0' and (item_category = '0' or item_main_file = '' or item_preview_img = '' or item_demo_video = '') and (TIMESTAMPDIFF(MINUTE,temp_time,NOW()) > 30) order by temp_id asc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$title = strip_tags($row['item_title']);
        $tempId = _e($row['temp_id']) ;
        $userId = _e($row['user_id']) ;
        $user_fullname = user_fullname_by_id($pdo,$userId) ;
        $userName = username_by_id($pdo,$userId) ;
        $userEmail = useremail_by_id($pdo,$userId) ;
        $action = '<button class="btn btn-sm btn-danger deletePendingItem" id="'.$tempId.'"><i class="fa fa-trash-alt d-inline"></i></a>';
		$output['data'][] = array( 	
		$sum,	
        $tempId,
        $userId,
        $userName,
        $userEmail,
		$title,
        $action
		); 	
	}
}
echo json_encode($output);
?>