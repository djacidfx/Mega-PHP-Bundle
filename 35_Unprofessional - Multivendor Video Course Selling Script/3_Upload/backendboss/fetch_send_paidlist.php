<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_author_payouts WHERE 1 order by payout_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
$payBtn = "" ;
foreach($result as $row) {
    $sum = $sum + 1 ;
    $authorId = _e($row['p_author_id']) ;
    $authorEmail = useremail_by_id($pdo,$authorId) ;
    $authorUsername = username_by_id($pdo,$authorId) ;
    $authorPayoutEmail = _e($row['paypal_email']) ;
    $method = _e($row['payout_method']) ;
    $month = _e($row['p_month'])."&ensp;"._e($row['p_year']) ;
    $txnId = _e($row['p_txn_id']) ;
    $paidDate = _e($row['payout_time']) ;
    $paidDate =  date('d F, Y',strtotime($paidDate));
    $payoutAmt = "<b>$"._e($row['payout_amt'])."</b>" ;
    $output['data'][] = array( 		
        $sum,
        $authorId,
        $authorUsername,
        $authorEmail,
        $authorPayoutEmail,
        $txnId,
        $paidDate,
        $month,
        $payoutAmt

    ); 	
}
echo json_encode($output);
?>