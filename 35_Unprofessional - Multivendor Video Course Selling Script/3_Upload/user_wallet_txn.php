<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_wallet WHERE w_user_id = '".$_SESSION['unprofessional']['id']."' order by wallet_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $id = _e($row['wallet_id']) ;
        $amount = "<b>$"._e($row['w_amt'])."</b>" ;
        $txnId = _e($row['w_txn_id']) ;
        $method = _e($row['w_payment_method']) ;
        $status = _e($row['w_payment_status']) ;
		$created_datetime = _e($row['w_payment_time']);
		$created_date =  date('d F, Y',strtotime($created_datetime));
        
        
		$output['data'][] = array( 	
            $sum,	
            $created_date,
            $amount,
            $txnId,
            $method,
            $status
		); 	
	}
}
echo json_encode($output);
?>