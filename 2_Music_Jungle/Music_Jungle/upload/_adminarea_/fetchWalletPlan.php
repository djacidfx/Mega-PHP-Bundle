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
$Statement = $pdo->prepare("SELECT * FROM ot_wallet_plan WHERE 1 order by plan_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$c_id = _e($row['plan_id']);
		$c_name = strip_tags($row['plan_name']);
		$c_date = _e($row['plan_date']);
		$statuss = _e($row['plan_status']);
		$c_date =  date('d F, Y',strtotime($c_date));
		$planAmt = "$".(int)_e($row['plan_amt']);
		$bonusAmt = "$".(int)_e($row['bonus_amt']);
		if($statuss == 1) {
			// Deactivate Category
			$statuss = "<b>Active</b>";
			$activate_deactivate = '<button type="button" name="changePlanStatusToDeactive" id="'.$c_id.'" class="btn btn-danger btn-sm changePlanStatusToDeactive" data-status="0"><i class="fa fa-ban"></i></button>';
		} else {
			// Activate Category
			$statuss = "Not Active";
			$activate_deactivate = '<button type="button" name="changePlanStatusToActive" id="'.$c_id.'" class="btn btn-success btn-sm changePlanStatusToActive" data-status="1"><i class="fa fa-check"></i></button>';
		}
		$editPlan = '<button type="button" name="editPlan" id="'.$c_id.'" class="btn btn-light btn-sm editPlan"><i class="fa fa-pencil-alt text-muted"></i></button>';
		$output['data'][] = array( 	
		$sum,	
		$c_id,
		$c_date,
		$statuss,
		$c_name,
		$planAmt,
		$bonusAmt,
		$editPlan,
		$activate_deactivate
		); 	
	}
}
echo json_encode($output);
?>