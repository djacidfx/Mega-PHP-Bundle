<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

if(isset($_POST['btn_action'])){
	if($_POST['btn_action'] == 'selectWalletPayment') {
		if(!empty($_POST['rechargeAmt']) && !empty($_POST['walletpaymentMethod'])){
            $minAmt = find_min_wallet($pdo) ;
            $maxAmt = find_max_wallet($pdo) ;
            $rechargeAmt = filter_var($_POST['rechargeAmt'], FILTER_SANITIZE_NUMBER_INT);
			$paymentMethod = filter_var($_POST['walletpaymentMethod'], FILTER_SANITIZE_NUMBER_INT);
            
            if(($rechargeAmt < $minAmt) || ($rechargeAmt > $maxAmt) ){
               $output['paymentMethod'] = 0 ;
               echo json_encode($output) ;  
            } else{
                $output['rechargeAmt'] = $rechargeAmt ;
                $output['paymentMethod'] = $paymentMethod ;
                echo json_encode($output) ; 
            }
		} 
	}
} 
?>