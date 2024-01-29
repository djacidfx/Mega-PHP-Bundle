<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_wallet WHERE 1 order by wallet_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
$payBtn = "" ;
foreach($result as $row) {
    $sum = $sum + 1 ;
    $txnId = _e($row['w_txn_id']) ;
    $buyerId = _e($row['w_user_id']) ;
    $buyerEmail = useremail_by_id($pdo,$buyerId) ;
    $buyerUsername = username_by_id($pdo,$buyerId) ;
    $paidDate = _e($row['w_payment_time']) ;
    $paidDate =  date('d F, Y',strtotime($paidDate));
    $method = _e($row['w_payment_method']) ; 
    $payStatus = _e($row['w_payment_status']) ; 
    $totalAmt = "<b>$"._e($row['w_amt'])."</b>" ;
    $currentWalletBalance = "<b>$".find_userwallet_amt($pdo,$buyerId)."</b>";
    $output['data'][] = array( 		
        $sum,
        $buyerId,
        $buyerUsername,
        $buyerEmail,
        $currentWalletBalance,
        $paidDate,
        $totalAmt,
        $txnId,
        $method,
        $payStatus

    ); 	
}
echo json_encode($output);
?>