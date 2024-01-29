<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_temp_video WHERE upload_success = '1' and item_soft_reject = '0' order by item_time asc");
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
        $catId = _e($row['item_category']) ;
        $categoryName = category_name($pdo,$catId) ;
		$image = "<img src=".BASE_URL.'tmpImg/'._e($row['item_preview_img'])." class='img-fluid img-thumbnail w-75' >";
		$statuss = "In Review";
        $comment = nl2br(strip_tags($row['reviewer_comment'])) ;
		$created_date = _e($row['item_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $action = '<a href="'.ADMIN_URL.'tempreview/'.$tempId.'" class="btn btn-sm btn-primary "><i class="fa fa-eye d-inline"></i>Review</a>';
		$output['data'][] = array( 	
		$sum,	
        $tempId,
        $userId,
        $userName,
        $userEmail,
        $catId,
        $categoryName,
		$title,
        $image,
        $created_date,
        $action
		); 	
	}
}
echo json_encode($output);
?>