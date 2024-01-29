<?php
ob_start();
session_start();
include("db/config.php");
include("db/function_xss.php");
// Checking Admin is logged in or not
if( empty($_SESSION['admin']['id'])  ){
	header('location: '.ADMIN_URL.'/index.php');
	exit;
}
if($_POST['btn-action']){
	if($_POST['btn-action'] == 'msg') {
		$msg = filter_var($_POST['successmsg'], FILTER_SANITIZE_STRING) ;
		$ins = $pdo->prepare("update subscription_admin set success_message = '".$msg."' where id = '1'") ;
		$ins->execute();
		$output = '' ;
		$form_message = "Success Message Updated Successfully.";
					$output = array( 
							'form_message' => $form_message,
							'successmsg'   => $msg
							) ;
					echo json_encode($output);
	}
}
?>