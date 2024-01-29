<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_category WHERE 1 order by id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$c_id = _e($row['id']);
		$c_name = strip_tags($row['category_name']);
		$image = "<img src=".BASE_URL.'catImg/'._e($row['category_image'])." class='img-fluid img-thumbnail w-50' >";
		$statuss = _e($row['category_status']);
        $views = _e($row['category_view']) ;
        $courses = _e($row['category_video']) ;
		if($statuss == 1) {
			// Deactivate Category
			$statuss = "<b>Active</b>";
			$activate_deactivate = '<button type="button" name="changeCatStatusToDeactive" id="'.$c_id.'" class="btn btn-danger btn-sm changeCatStatusToDeactive" data-status="0"><i class="fa fa-ban"></i></button>';
		} else {
			// Activate Category
			$statuss = "Not Active";
			$activate_deactivate = '<button type="button" name="changeCatStatusToActive" id="'.$c_id.'" class="btn btn-success btn-sm changeCatStatusToActive" data-status="1"><i class="fa fa-check"></i></button>';
		}
		$editCategory = '<a href="'.ADMIN_URL.'category?edit='.$c_id.'" class="btn btn-light btn-sm"><i class="fa fa-pencil-alt text-muted"></i></a>';
		$output['data'][] = array( 	
		$sum,	
		$c_id,
        $image,
		$c_name,
        $views,
        $courses,
        $statuss,
        $editCategory,
        $activate_deactivate
		); 	
	}
}
echo json_encode($output);
?>