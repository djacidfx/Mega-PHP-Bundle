<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_forum_topic WHERE topic_admin_seen = '1' order by topic_updated_time desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$topicId = _e($row['topic_id']);
		$title = strip_tags($row['topic_title']);
		$created_date = _e($row['topic_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $updated_date = _e($row['topic_updated_time']);
		$updated_date =  date('d F, Y',strtotime($updated_date));
        $replies = _e($row['topic_answers']) ;
        $solved = _e($row['topic_solved']) ;
        if($solved == '1'){
            $solved = "<b>Yes</b>" ;
        } else {
            $solved = "No" ;
        }
		$action = '<a href="'.ADMIN_URL.'readtopic/'.$topicId.'" class="btn btn-light btn-sm "><i class="fa fa-eye text-muted"></i></a>';
		$output['data'][] = array( 	
		$sum,	
		$topicId,
		$title,
        $created_date,
        $updated_date,
        $replies,
        $solved,
        $action
		); 	
	}
}
echo json_encode($output);
?>