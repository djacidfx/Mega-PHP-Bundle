<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;
define('DAY',60*60*24, true);
define('MONTH',DAY*30, true);
define('YEAR',DAY*365, true);

$Statement = $pdo->prepare("SELECT * FROM ot_payments WHERE p_user_id = '".$_SESSION['unprofessional']['id']."' order by payment_time desc");
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
        $itemId = _e($row['p_item_id']) ;
        $itemTitle = long_title_by_id($pdo,$itemId) ;
        $amount = "<b>$"._e($row['p_total_amt'])."</b>" ;
        $txnId = _e($row['txn_id']) ;
        $method = _e($row['payment_method']) ;
        $status = _e($row['payment_status']) ;
		$created_datetime = _e($row['payment_time']);
        $thenTimestamp = strtotime($created_datetime);
        
        $now = time();
        $difference = $now - $thenTimestamp;
        $days = floor($difference / (60*60*24) );
		$created_date =  date('d F, Y',strtotime($created_datetime));
        $refundDay = find_max_refund_day($pdo) ;
        $refundBtn = "";
        $refundStatus = "";
        $authorDecison = "" ;
        $actionDispute = "" ;
        $isDispute = check_dispute_transactionid($pdo,$txnId) ; 
        if(prevent_duplicate_refund($pdo,$txnId) > 0){
            $refundStatus = find_refund_status($pdo,$txnId) ;
            $authorDecison = find_author_refund_decision($pdo,$txnId);
            if($authorDecison == 0){
                $authorDecison = '<b>Waiting for Author Response.</b>' ;
                if($days > $refundDay){
                    $actionDispute = '<button class="btn btn-sm btn-warning raiseDispute" id="'.$txnId.'">RaiseDispute</button>';
                } else {
                    $actionDispute = '<b>Dispute Button will be available If Author Declined Refund Request / Not Respond within '.$refundDay.' Days.</b>' ;
                }
            }
            if($authorDecison == 1){
                $authorDecison = '<b>Author Accept Your Refund Request.</b>' ;
                
            }
            if($authorDecison == 2){
                $authorDecison = '<b>Author Declined Your Refund Request.</b>' ;
                if(check_dispute_transactionid($pdo,$txnId) > 0){
                    $actionDispute = '<button class="btn btn-sm btn-danger" disabed>Disputed</button>';
                } else {
                    $actionDispute = '<button class="btn btn-sm btn-warning raiseDispute" id="'.$txnId.'">RaiseDispute</button>';
                }
                
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
            $refundBtn = '<button class="btn btn-sm btn-warning " disabled>RefundSubmitted</button>';
        } else {
           if($days > $refundDay){
                $refundBtn = '<button class="btn btn-sm btn-warning " disabled>RefundTimeOver</button>';
            } else {
                $refundBtn = '<button class="btn btn-sm btn-danger refundRaise" id="'.$txnId.'">Refund</button>';
            } 
        }
        
		$output['data'][] = array( 	
            $sum,	
            $created_date,
            $itemTitle,
            $amount,
            $txnId,
            $method,
            $status,
            $refundStatus,
            $authorDecison,
            $actionDispute,
            $refundBtn
		); 	
	}
}
echo json_encode($output);
?>