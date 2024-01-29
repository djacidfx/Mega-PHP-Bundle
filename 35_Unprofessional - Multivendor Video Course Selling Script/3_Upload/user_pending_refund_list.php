<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;
define('DAY',60*60*24, true);
define('MONTH',DAY*30, true);
define('YEAR',DAY*365, true);

$Statement = $pdo->prepare("SELECT * FROM ot_refunds WHERE r_author_id = '".$_SESSION['unprofessional']['id']."' order by r_time desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $id = _e($row['payment_id']) ;
        $buyerId = _e($row['r_user_id']) ;
        $amount = "<b>$"._e($row['r_amount'])."</b>" ;
        $txnId = _e($row['r_txn_id']) ;
        $itemId = find_itemid_by_txnid($pdo,$txnId) ;
        $itemTitle = long_title_by_id($pdo,$itemId) ;
        $method = _e($row['payment_method']) ;
        $status = _e($row['payment_status']) ;
		$created_datetime = _e($row['r_time']);
        $purchaseDate = find_purchasedate_txnid($pdo,$txnId) ; 
        $thenTimestamp = strtotime($created_datetime);        
        $now = time();
        $difference = $now - $thenTimestamp;
        $days = floor($difference / (60*60*24) );
		$created_date =  date('d F, Y',strtotime($created_datetime));
        $refundDay = find_max_refund_day($pdo) ;
        $actionBtn = "";
        $actionDispute = _e($row['r_disputed']) ;
        $itemDownloaded = checking_user_downloaded($pdo,$buyerId,$itemId); 
        if($itemDownloaded > 0){
            $itemDownloaded = '<b>Yes</b>' ;
        } else {
            $itemDownloaded = '<b>No</b>' ;
        }
        if($actionDispute == '0'){
            $actionDispute = '<b>No</b>' ;
        } else {
            $actionDispute = '<b>Yes</b>' ;
        }
            $refundStatus = find_refund_status($pdo,$txnId) ;
            $authorDecison = find_author_refund_decision($pdo,$txnId);
        $authorDecisonMsg = "";
            if($authorDecison == 0){
                $authorDecisonMsg = '<b>Waiting for Author Response.</b>' ;
            }
            if($authorDecison == 1){
                $authorDecisonMsg = '<b>Author Accepted Refund Request.</b>' ;
                
            }
            if($authorDecison == 2){
                $authorDecisonMsg = '<b>Author Declined Refund Request.</b>' ;
            }
            if($refundStatus == 0){
                $refundStatus = '<b>Pending</b>' ;
            }
            if($refundStatus == 1){
                $refundStatus = '<b>Refunded</b>' ;
            }
            if($refundStatus == 2){
                $refundStatus = '<b>Cannot Be Refunded. Refund Decision goes in favor of Author.</b>' ;
            }
        
           if($days > $refundDay){
               if($authorDecison == 0){
                $actionBtn = '<button class="btn btn-sm btn-warning " disabled>DecisionTimeOver</button>';
               } else {
                   $actionBtn = '<button class="btn btn-sm btn-warning " disabled>DecisionTaken</button>';
               }
            } else {
               if($authorDecison == 0){
                   $actionBtn = '<button class="btn btn-sm btn-danger refundAction" id="'.$txnId.'">TakeDecision</button>';
               } else {
                   $actionBtn = '<button class="btn btn-sm btn-warning " disabled>DecisionTaken</button>';
               }
            } 
        
        
		$output['data'][] = array( 	
            $sum,	
            $created_date,
            $itemTitle,
            $purchaseDate,
            $amount,
            $itemDownloaded,
            $refundStatus,
            $actionDispute,
            $authorDecisonMsg,
            $actionBtn
		); 	
	}
}
echo json_encode($output);
?>