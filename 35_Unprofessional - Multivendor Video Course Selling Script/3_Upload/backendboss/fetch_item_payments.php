<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_author_statement WHERE 1 order by statement_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
$payBtn = "" ;
foreach($result as $row) {
    $sum = $sum + 1 ;
    $txnId = _e($row['s_txn_id']) ;
    $authorId = _e($row['author_id']) ;
    $authorEmail = useremail_by_id($pdo,$authorId) ;
    $authorUsername = username_by_id($pdo,$authorId) ;
    $buyerId = find_buyerid_by_txnid($pdo,$txnId) ;
    $buyerEmail = useremail_by_id($pdo,$buyerId) ;
    $buyerUsername = username_by_id($pdo,$buyerId) ;
    $itemId = itemid_via_txnid_for_admin($pdo,$txnId) ;
    $itemTitle = long_title_by_id($pdo,$itemId) ;
    $paidDate = _e($row['s_time']) ;
    $paidDate =  date('d F, Y',strtotime($paidDate));
    $method = paymethod_via_txnid_for_admin($pdo,$txnId) ;
    $payStatus = paystatus_via_txnid_for_admin($pdo,$txnId); 
    $type = _e($row['s_type']) ;
    $totalAmt = "<b>$".find_paidamt_by_txnid($pdo,$txnId)."</b>" ;
    $commissionPercent = commission_via_txnid_for_admin($pdo,$txnId)."%" ;
    $authorEarning = "<b>$".authorearning_via_txnid_for_admin($pdo,$txnId)."</b>" ;
    $adminEarning = "<b>$".adminearning_via_txnid_for_admin($pdo,$txnId)."</b>" ;
    $saleReversal = "" ;
    $statusType = "" ;
    $paid = _e($row['s_paid']) ;
    if($paid == '1'){
        $paid = '<button class="btn btn-success btn-xs" disabled>Paid</button>' ;
    } else {
        $paid = '<button class="btn btn-danger btn-xs" disabled>Unpaid</button>' ;
    }
    if($type == '1'){
        $statusType = '<button class="btn btn-success btn-xs" disabled>Sale</button>' ;
        $saleReversal = '<button class="btn btn-danger btn-sm saleReversal" id="'.$txnId.'">ReverseSale</button>' ;
    }
    if($type == '0'){
        $statusType = '<button class="btn btn-danger btn-xs" disabled>SaleReversal</button>' ;
    }
    if($type == '2'){
        $statusType = '<button class="btn btn-danger btn-xs" disabled>Refund</button>' ;
    }
    
    $output['data'][] = array( 		
        $sum,
        $buyerId,
        $buyerUsername,
        $buyerEmail,
        $authorId,
        $authorUsername,
        $authorEmail,
        $itemId,
        $itemTitle,
        $paidDate,
        $txnId,
        $method,
        $statusType,
        $paid,
        $payStatus,
        $totalAmt,
        $commissionPercent,
        $authorEarning,
        $adminEarning,
        $saleReversal

    ); 	
}
echo json_encode($output);
?>