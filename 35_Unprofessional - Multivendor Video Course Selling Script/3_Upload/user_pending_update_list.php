<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_update_status WHERE status_user_id = '".$_SESSION['unprofessional']['id']."' order by status_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
        $itemId = _e($row['status_item_id']) ;
        $itemTitle = long_title_by_id($pdo,$itemId) ;
		$sum = $sum + 1 ;
		$statuss = _e($row['status_approved']);
        $reviewerComments = strip_tags($row['status_reviewer_comment']) ;
		$created_date = _e($row['status_update_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $itemImage = active_itempreview_by_id($pdo,$itemId) ;
        if($statuss == 'Pending'){
            $cancelUpdate = '<button class="btn btn-danger btn-lg btn-sm cancelUpdateItemOld" id="'.$itemId.'"><i class="fas fa-trash"></i></button>';
        } else {
            $cancelUpdate = '';
        }
		$output['data'][] = array( 	
            $sum,
            $itemImage,
            $itemId,
            $itemTitle,
            $created_date,
            $statuss,
            $reviewerComments,
            $cancelUpdate
		); 	
	}
}
echo json_encode($output);
?>