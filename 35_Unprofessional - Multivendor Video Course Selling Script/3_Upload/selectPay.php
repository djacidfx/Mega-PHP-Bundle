<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

if(isset($_POST['btn_action'])){
	if($_POST['btn_action'] == 'selectPayment') {
		if(!empty($_POST['itemNumber']) && !empty($_POST['userId']) && !empty($_POST['itemAmount']) && !empty($_POST['paymentMethod'])){
			$itemNumber = filter_var($_POST['itemNumber'], FILTER_SANITIZE_NUMBER_INT);
			$itemAmount = filter_var($_POST['itemAmount'], FILTER_SANITIZE_NUMBER_INT);
			$paymentMethod = filter_var($_POST['paymentMethod'], FILTER_SANITIZE_NUMBER_INT);
            $userId = $_SESSION['unprofessional']['id'] ;
            $userWallet = find_userwallet_amt($pdo,$_SESSION['unprofessional']['id']) ;
            if($paymentMethod == '3'){
                if($itemAmount > $userWallet){
                    $output['paymentMethod'] = 0 ;
                    echo json_encode($output) ; 
                } else {
                    $output['itemNumber'] = $itemNumber ;
                    $output['userId'] = $userId ;
                    $output['itemAmount'] = $itemAmount ;
                    $output['paymentMethod'] = $paymentMethod ;
                    echo json_encode($output) ; 
                }
            } else {
               $output['itemNumber'] = $itemNumber ;
				$output['userId'] = $userId ;
				$output['itemAmount'] = $itemAmount ;
				$output['paymentMethod'] = $paymentMethod ;
				echo json_encode($output) ; 
            }
				
			
		}
	}
} 
?>