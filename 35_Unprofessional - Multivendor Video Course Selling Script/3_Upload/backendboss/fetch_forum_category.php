<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_forum_category WHERE 1 order by forum_cat_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$c_id = _e($row['forum_cat_id']);
		$c_name = strip_tags($row['forum_cat_name']);
		$statuss = _e($row['forum_cat_status']);
		if($statuss == 1) {
			// Deactivate Category
			$statuss = "<b>Active</b>";
			$activate_deactivate = '<button type="button" name="changeForumCatStatusToDeactive" id="'.$c_id.'" class="btn btn-danger btn-sm changeForumCatStatusToDeactive" data-status="0"><i class="fa fa-ban"></i></button>';
		} else {
			// Activate Category
			$statuss = "Not Active";
			$activate_deactivate = '<button type="button" name="changeForumCatStatusToActive" id="'.$c_id.'" class="btn btn-success btn-sm changeForumCatStatusToActive" data-status="1"><i class="fa fa-check"></i></button>';
		}
		$editCategory = '<button class="btn btn-light btn-sm editForumCategory" id="'.$c_id.'"><i class="fa fa-pencil-alt text-muted"></i></button>';
		$output['data'][] = array( 	
		$sum,	
		$c_id,
		$c_name,
        $statuss,
        $editCategory,
        $activate_deactivate
		); 	
	}
}
echo json_encode($output);
?>