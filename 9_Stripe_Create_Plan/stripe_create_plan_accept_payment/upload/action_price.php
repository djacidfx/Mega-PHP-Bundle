<?php
ob_start();
session_start();
require_once("admin/db/config.php");
require_once("admin/db/function_xss.php");
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'load_price')
	{
		if(!empty($_POST['sub_id'])){
			echo fill_subscription_price($pdo, filter_var($_POST['sub_id'], FILTER_SANITIZE_NUMBER_INT));
		} 
	}
}
?>