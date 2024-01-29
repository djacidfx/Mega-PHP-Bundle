<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_comment_thread WHERE thread_report = '1' order by comment_thread_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
$payBtn = "" ;
foreach($result as $row) {
    $sum = $sum + 1 ;
    $id = _e($row['comment_thread_id']) ;
    $commentReply = nl2br($row['thread_comment']) ;
    $delete = '<button class="btn btn-danger btn-sm deleteCommentReply" id="'.$id.'"><i class="fa fa-trash"></i></button>';
    $deny = '<button class="btn btn-success btn-sm denyDeleteReply" id="'.$id.'">Deny Report</button>';
    $output['data'][] = array( 		
        $sum,
        $commentReply,
        $delete,
        $deny

    ); 	
}
echo json_encode($output);
?>