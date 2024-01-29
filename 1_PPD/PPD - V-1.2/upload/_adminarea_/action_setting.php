<?php
ob_start();
session_start();
include("db/config.php");
include("db/item_functions.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
} 
if(isset($_POST['sub_submit_pr'])){
	if($_POST['sub_submit_pr'] == 'Submit') {
		$adminName = filter_var($_POST['adminName'], FILTER_SANITIZE_STRING) ;
		$quickLinkName = filter_var($_POST['quickLinkName'], FILTER_SANITIZE_STRING) ;
		$aboutusName = filter_var($_POST['aboutusName'], FILTER_SANITIZE_STRING) ;
		$aboutUsInfo =  filter_var($_POST['aboutUsInfo'], FILTER_SANITIZE_STRING) ;
		$copyrightName = filter_var($_POST['copyrightName'], FILTER_SANITIZE_STRING) ;
		$adminEmail = filter_var($_POST['adminEmail'], FILTER_SANITIZE_EMAIL) ;
		$pay_email = filter_var($_POST['pay_email'], FILTER_SANITIZE_NUMBER_INT) ;
		$mainfile_email = filter_var($_POST['mainfile_email'], FILTER_SANITIZE_NUMBER_INT) ;
		$chance = filter_var($_POST['chance'], FILTER_SANITIZE_NUMBER_INT) ;
		$msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING) ;
		$on_load = filter_var($_POST['on_load'], FILTER_SANITIZE_NUMBER_INT) ;
		$default_load = filter_var($_POST['default_load'], FILTER_SANITIZE_NUMBER_INT) ;
		$statement = $pdo->prepare("update ot_admin set rec_email = '".$adminEmail."' ,  pay_email = '".$pay_email."' , mainfile_email = '".$mainfile_email."' , user_chance = '".$chance."' , unblock_msg = '".$msg."', adm_name = '".$adminName."', link_name = '".$quickLinkName."', about_us_name = '".$aboutusName."', about_us_info = '".$aboutUsInfo."', copyright_name = '".$copyrightName."', on_load = '".$on_load."', default_load = '".$default_load."'   where id = '1'");
		$statement->execute() ;
		$form_message = "Settings Updated Successfully.";
		$output = array( 
						'form_message' => $form_message
					) ;
		echo json_encode($output);
		
	}
} 
if(isset($_POST['social_submit_pr'])){
	if($_POST['social_submit_pr'] == 'Submit') {
	$fbUrl = filter_var($_POST['fbUrl'], FILTER_SANITIZE_URL) ;
	$twitterUrl = filter_var($_POST['twitterUrl'], FILTER_SANITIZE_URL) ;
	$linkedinUrl = filter_var($_POST['linkedinUrl'], FILTER_SANITIZE_URL) ;
	$behanceUrl = filter_var($_POST['behanceUrl'], FILTER_SANITIZE_URL) ;
	$dribbleUrl = filter_var($_POST['dribbleUrl'], FILTER_SANITIZE_URL) ;
	$vkUrl = filter_var($_POST['vkUrl'], FILTER_SANITIZE_URL) ;
	
	$upd = $pdo->prepare("update ot_admin set fb_url = '".$fbUrl."', twitter_url = '".$twitterUrl."', linkedin_url = '".$linkedinUrl."', behance_url = '".$behanceUrl."', dribble_url = '".$dribbleUrl."', vk_url = '".$vkUrl."' where id = '1'") ;
	$upd->execute();
	
	$form_message = "Social Settings Updated Successfully.";
		$output = array( 
						'form_message' => $form_message
					) ;
		echo json_encode($output);
	
	}
}
if(isset($_POST['google_submit_pr'])){
	if($_POST['google_submit_pr'] == 'Submit') {
	$gCode = base64_encode($_POST['gCode']) ;
	$gCode = filter_var($gCode, FILTER_SANITIZE_STRING) ;
	$userOn = filter_var($_POST['userOn'], FILTER_SANITIZE_NUMBER_INT) ;
	$adminOn = filter_var($_POST['adminOn'], FILTER_SANITIZE_NUMBER_INT) ;
	
	$upd = $pdo->prepare("update ot_admin set g_code = '".$gCode."', admin_on = '".$adminOn."', user_on = '".$userOn."' where id = '1'") ;
	$upd->execute();
	
	$form_message = "Google Analytics Settings Updated Successfully.";
		$output = array( 
						'form_message' => $form_message
					) ;
		echo json_encode($output);
	
	}
}
?>
