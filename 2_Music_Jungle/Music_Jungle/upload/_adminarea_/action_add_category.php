<?php
ob_start();
session_start();
include("db/config.php");
include("db/item_functions.php") ;
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
if(isset($_POST['btn_action_cat']))
{
	if($_POST['btn_action_cat'] == 'SaveCategory')
	{
		if(!empty($_POST['cat'])){
			$categoryName = filter_var($_POST['cat'], FILTER_SANITIZE_STRING) ;
			$date = date("Y-m-d") ;
			$ins = $pdo->prepare("insert into item_category (c_name,c_date) values (?,?)") ;
			$ins->execute(array($categoryName,$date));
			echo "Category is live now.";
		} else {
			echo "Category Name should not be Empty.";
		}
	}
	
	if($_POST['btn_action_cat'] == 'changeCatStatusToDeactive')
	{
		if(!empty($_POST['catId']) ){
			$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT) ;
			$categoryId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT) ;
				$ins = $pdo->prepare("update item_category set c_status = '0' where c_id = '".$categoryId."'") ;
				$ins->execute();
				set_item_to_deactive($pdo,$categoryId) ;
				echo "Category is deactivated & All the Items belongs to this Category is also Deactivated.";
			
		} else {
			echo "Category ID should not be Empty.";
		}
	}
	if($_POST['btn_action_cat'] == 'changeCatStatusToActive')
	{
		if(!empty($_POST['catId']) ){
			$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT) ;
			$categoryId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT) ;
			
			$ins = $pdo->prepare("update item_category set c_status = '1' where c_id = '".$categoryId."'") ;
			$ins->execute();
			set_item_to_active($pdo,$categoryId) ;
			echo "Category is activated & All the Items belongs to this Category is Activated & Live Now.";
		} else {
			echo "Category ID should not be Empty.";
		}
	}
	
	
	if($_POST['btn_action_cat'] == 'fetch_category')
	{	
		if(!empty($_POST['catId'])){
			$catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from item_category where c_id = ?");
			$announce->execute(array($catId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['catId'] = _e($row['c_id']);
				$output['categoryName'] = strip_tags($row['c_name']);
			}
			echo json_encode($output) ;
		} else {
			echo "Error : Category Id is mandatory." ;
		}
	}
	if($_POST['btn_action_cat'] == 'EditCategory')
	{	
		if(!empty($_POST['catId']) && !empty($_POST['cat'])){
			$categoryName = filter_var($_POST['cat'], FILTER_SANITIZE_STRING) ;
			$categoryId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update item_category set c_name = '".$categoryName."' where c_id = '".$categoryId."'") ;
			$upd->execute();
			echo "Category Name is Updated Successfully";
			
		} else {
			echo "Error : Category Id & Name is mandatory." ;
		}
	}
	
}
if(isset($_POST['btn_action_plan']))
{
	if($_POST['btn_action_plan'] == 'changePlanStatusToDeactive')
	{
		if(!empty($_POST['planId'])){
			$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT) ;
			$planId = filter_var($_POST['planId'], FILTER_SANITIZE_NUMBER_INT) ;
			$upd = $pdo->prepare("update ot_wallet_plan set plan_status = '".$status."' where plan_id = '".$planId."'");
			$upd->execute();
			echo "Wallet Plan Deactivated Successfully.";
		} else {
			echo "Mandatory Field is Missing. Try Again.";
		}
	}
	if($_POST['btn_action_plan'] == 'changePlanStatusToActive')
	{
		if(!empty($_POST['planId'])){
			$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT) ;
			$planId = filter_var($_POST['planId'], FILTER_SANITIZE_NUMBER_INT) ;
			$upd = $pdo->prepare("update ot_wallet_plan set plan_status = '".$status."' where plan_id = '".$planId."'");
			$upd->execute();
			echo "Wallet Plan Activated Successfully.";
		} else {
			echo "Mandatory Field is Missing. Try Again.";
		}
	}
	if($_POST['btn_action_plan'] == 'fetch_plan')
	{	
		if(!empty($_POST['planId'])){
			$planId = filter_var($_POST['planId'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from ot_wallet_plan where plan_id = ?");
			$announce->execute(array($planId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['planId'] = _e($row['plan_id']);
				$output['planName'] = strip_tags($row['plan_name']);
				$output['bonusAmt'] = (int)strip_tags($row['bonus_amt']);
				$output['planAmt'] = (int)strip_tags($row['plan_amt']);
			}
			echo json_encode($output) ;
		} else {
			echo "Error : Plan Id is mandatory." ;
		}
	}
	if($_POST['btn_action_plan'] == 'EditPlan')
	{	
		if(!empty($_POST['planId']) && !empty($_POST['planName']) && !empty($_POST['planAmt']) ){
			$planName = filter_var($_POST['planName'], FILTER_SANITIZE_STRING) ;
			$planId = filter_var($_POST['planId'], FILTER_SANITIZE_NUMBER_INT);
			$planAmt = filter_var($_POST['planAmt'], FILTER_SANITIZE_NUMBER_INT);
			$bonusAmt = filter_var($_POST['bonusAmt'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_wallet_plan set plan_name = '".$planName."', bonus_amt = '".$bonusAmt."' , plan_amt = '".$planAmt."' where plan_id = '".$planId."'") ;
			$upd->execute();
			echo "Wallet Plan is Updated Successfully";
			
		} else {
			echo "Error : Plan Id, Name & Plan Amount is mandatory." ;
		}
	}
	if($_POST['btn_action_plan'] == 'SavePlan')
	{	
		if( !empty($_POST['planName']) && !empty($_POST['planAmt']) ){
			$planName = filter_var($_POST['planName'], FILTER_SANITIZE_STRING) ;
			$planAmt = filter_var($_POST['planAmt'], FILTER_SANITIZE_NUMBER_INT);
			$bonusAmt = filter_var($_POST['bonusAmt'], FILTER_SANITIZE_NUMBER_INT);
			$date = date("Y-m-d");
			$upd = $pdo->prepare("insert into ot_wallet_plan  (plan_name,bonus_amt,plan_amt,plan_date) values ('".$planName."', '".$bonusAmt."' ,'".$planAmt."','".$date."')") ;
			$upd->execute();
			echo "Wallet Plan is Added Successfully";
			
		} else {
			echo "Error : Plan Name & Plan Amount is mandatory." ;
		}
	}
}
?>