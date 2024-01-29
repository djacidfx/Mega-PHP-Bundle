<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_hard_rejects WHERE user_id = '".$_SESSION['unprofessional']['id']."' order by hard_reject_time desc");
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
        $comment = strip_tags(nl2br($row['user_comment'])) ;
        $catId = _e($row['cat_id']) ;
        $categoryName = category_name($pdo,$catId) ;
		$created_date = _e($row['hard_reject_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $reason = strip_tags(nl2br($row['reason'])) ;
        $instruction = strip_tags(nl2br($row['instruction'])) ;
		$output['data'][] = array( 	
		$sum,	
		$created_date,
		$title,
        $categoryName,
        $comment,
        $reason,
        $instruction
		); 	
	}
}
echo json_encode($output);
?>