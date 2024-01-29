<?php
ob_start();
session_start();
include("db/config.php");
include("db/post_functions.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
$Statement = $pdo->prepare("SELECT * FROM anony_category WHERE 1 order by id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$catId = _e($row['id']);
		$catName = strip_tags($row['category_name']);
		$statuss = _e($row['category_status']);
        $activate_deactivate = "" ;
		if($statuss == 1) {
			// Deactivate Category
			$statuss = "<b class='text-success'>Active</b>";
			$activate_deactivate = '<button type="button" name="deactiveCategory" id="'.$catId.'" class="btn btn-danger btn-sm deactiveCategory" data-status="0"><i class="fa fa-ban"></i></button>';
		} else {
			// Activate Item
			$statuss = "<b class='text-danger'>Deactive</b>";
			$activate_deactivate = '<button type="button" name="activeCategory" id="'.$catId.'" class="btn btn-success btn-sm activeCategory" data-status="1"><i class="fa fa-check"></i></button>';
		}
		$editCategory = '<button type="button" name="editCategory" id="'.$catId.'" class="btn btn-light btn-sm editCategory" ><i class="fa fa-pencil-alt"></i></button>';
		$output['data'][] = array( 	
		$sum,
		$catId,
		$catName,
		$statuss,
		$editCategory,
		$activate_deactivate
		); 	
	}

echo json_encode($output);
?>