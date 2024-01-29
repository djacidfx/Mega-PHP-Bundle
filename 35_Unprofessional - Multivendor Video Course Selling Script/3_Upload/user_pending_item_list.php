<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_temp_video WHERE user_id='".$_SESSION['unprofessional']['id']."' and upload_success = '0' and (item_category = '0' or item_main_file = '' or item_preview_img = '' or item_demo_video = '') order by temp_id asc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $tempId = _e($row['temp_id']) ;
		$title = strip_tags($row['item_title']);
		$upload_date = _e($row['item_time']);
		$created_date =  date('d F, Y',strtotime($upload_date));
        $time = date("Y-m-d h:i:s") ;        
        $start_date = new DateTime($upload_date);
        $since_start = $start_date->diff(new DateTime($time));
        $minutes = $since_start->days * 24 * 60;
        $minutes += $since_start->h * 60;
        $minutes += $since_start->i;
        if($minutes > 30){
            $minutes = '<button class="btn btn-danger btn-sm" disabled>30 Minutes Times Up</button>';
        } else {
            $minutes = '<a href="'.BASE_URL.'pendingupload/'.$tempId.'" class="btn btn-success btn-sm">Complete Upload</a>' ;
        }
		$output['data'][] = array( 	
		$sum,	
		$created_date,
		$title,
        $minutes
		); 	
	}
}
echo json_encode($output);
?>