<?php
ob_start();
session_start();
include("db/config.php");
include("db/function_xss.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."/login.php"); 
	exit;
}
$Statement = $pdo->prepare("SELECT * FROM country WHERE 1 ");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
if($total > 0) {
	$activeCountry = "";
	foreach($result as $row) {
		$countryId = _e($row['id']) ;
		$countryName = _e($row['country_name']);
		$countryCode = _e($row['phonecode']);
		$activeCountry = _e($row['active_country']);
		if($activeCountry == 1) {
			// deactivate country
			$status ="<b>Active</b>";
			$myLink = '<button type="button" name="changeCountryStatus" id="'.$countryId.'" class="btn btn-danger btn-sm changeCountryStatus" data-status="0">Deactivate</button>';
		} else {
			// activate country
			$status ="Deactive";
			$myLink = '<button type="button" name="changeCountryStatus" id="'.$countryId.'" class="btn btn-success btn-sm changeCountryStatus" data-status="1">Activate</button>';
		} 
		$output['data'][] = array( 		
		$countryName,
		$countryCode,
		$status,
		$myLink
		); 	
	}
}
echo json_encode($output);
?>