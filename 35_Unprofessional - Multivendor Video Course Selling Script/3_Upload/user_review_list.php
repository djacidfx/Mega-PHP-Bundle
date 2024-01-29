<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_temp_video WHERE user_id = '".$_SESSION['unprofessional']['id']."' and upload_success = '1' order by item_time desc");
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
		$image = "<img src=".BASE_URL.'tmpImg/'._e($row['item_preview_img'])." class='img-fluid img-thumbnail w-50' >";
		$statuss = "In Review";
        $comment = nl2br(strip_tags($row['reviewer_comment'])) ;
		$created_date = _e($row['item_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
		$output['data'][] = array( 	
		$sum,	
		$created_date,
        $image,
		$title,
        $comment,
        $statuss
		); 	
	}
}
echo json_encode($output);
?>