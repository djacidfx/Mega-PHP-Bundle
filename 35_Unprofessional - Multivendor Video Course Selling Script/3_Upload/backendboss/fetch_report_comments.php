<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_comments WHERE author_report = '1' order by comment_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
$payBtn = "" ;
foreach($result as $row) {
    $sum = $sum + 1 ;
    $id = _e($row['comment_id']) ;
    $itemId = _e($row['comment_item_id']) ;
    $shortUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
    $comment = nl2br($row['comment']) ;
    $view = '<a href="'.BASE_URL.'comments/'.$itemId.'/'.$shortUrlTitle.'" class="btn btn-light btn-sm"><i class="fa fa-eye"></i></a>' ;
    $delete = '<button class="btn btn-danger btn-sm deleteComment" id="'.$id.'"><i class="fa fa-trash"></i></button>';
    $deny = '<button class="btn btn-success btn-sm denyDelete" id="'.$id.'">Deny Report</button>';
    $output['data'][] = array( 		
        $sum,
        $comment,
        $view,
        $delete,
        $deny

    ); 	
}
echo json_encode($output);
?>