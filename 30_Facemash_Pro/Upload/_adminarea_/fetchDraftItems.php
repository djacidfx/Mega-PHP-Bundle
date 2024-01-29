<?php
ob_start();
session_start();
include("db/config.php");
include("db/img_functions.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
$Statement = $pdo->prepare("SELECT * FROM ot_admin_pics WHERE pic_status='0' order by pic_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$picId = _e($row['pic_id']);
		$thumbnail = get_pic_thumbnail_image($pdo,$picId) ; 
		$picName = strip_tags($row['pic_caption']);
		$points = _e($row['pic_vote']);
		$wins = _e($row['pic_wins']);
		$date = _e($row['pic_date']);
		$date =  date('d F, Y',strtotime($date));
		$statuss = _e($row['pic_status']);
		if($statuss == 1) {
			// Deactivate Item
			$statuss = "<b class='text-success'>Active</b>";
			$activate_deactivate = '<button type="button" name="changePostStatus" id="'.$picId.'" class="btn btn-danger btn-sm changePostStatus" data-status="0"><i class="fa fa-ban"></i></button>';
		} else {
			// Activate Item
			$statuss = "<b class='text-danger'>Deactive</b>";
			$activate_deactivate = '<button type="button" name="changePostStatus" id="'.$picId.'" class="btn btn-success btn-sm changePostStatus" data-status="1"><i class="fa fa-check"></i></button>';
		}
		$editPost = '<a href="'.ADMIN_URL.'upload?img_id='.$picId.'" class="btn btn-light btn-sm" ><i class="fa fa-pencil-alt"></i></a>';
		$output['data'][] = array( 	
		$sum,
		$picId,
		$thumbnail,
		$picName,
		$points,
		$wins,
		$date,
		$statuss,
		$editPost,
		$activate_deactivate
		); 	
	}
}
echo json_encode($output);
?>