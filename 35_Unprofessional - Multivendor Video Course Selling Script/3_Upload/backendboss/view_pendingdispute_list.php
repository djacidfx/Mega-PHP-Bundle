<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_refunds WHERE r_status='0' and r_disputed = '1' order by r_time asc");
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
        $buyerEmail = useremail_by_id($pdo,$buyerId) ;
        $amount = "<b>$"._e($row['r_amount'])."</b>" ;
        $txnId = _e($row['r_txn_id']) ;
        $itemId = find_itemid_by_txnid($pdo,$txnId) ;
        $itemTitle = long_title_by_id($pdo,$itemId) ;
        $authorId = find_user_id_by_itemid($pdo,$itemId) ;
        $authorEmail = useremail_by_id($pdo,$authorId) ;
		$created_datetime = _e($row['r_time']);
		$created_date =  date('d F, Y',strtotime($created_datetime));
        $purchaseDate = find_purchasedate_txnid($pdo,$txnId) ; 
        
        $itemDownloaded = checking_user_downloaded($pdo,$buyerId,$itemId); 
        if($itemDownloaded > 0){
            $itemDownloaded = '<b>Yes</b>' ;
        } else {
            $itemDownloaded = '<b>No</b>' ;
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
            $refundStatus = '<b>Refunded. Refund Decision in favor of Buyer</b>' ;
        }
        if($refundStatus == 2){
            $refundStatus = '<b>Cannot Be Refunded. Refund Decision goes in favor of Author.</b>' ;
        }
        
        $actionBtn = '<button class="btn btn-sm btn-danger adminRefundAction" id="'.$txnId.'">TakeDecision</button>';
               
        
        
		$output['data'][] = array( 	
            $sum,
            $buyerEmail,
            $authorEmail,
            $created_date,
            $itemTitle,
            $purchaseDate,
            $txnId,
            $amount,
            $itemDownloaded,
            $refundStatus,
            $authorDecisonMsg,
            $actionBtn
		); 	
	}
}
echo json_encode($output);
?>