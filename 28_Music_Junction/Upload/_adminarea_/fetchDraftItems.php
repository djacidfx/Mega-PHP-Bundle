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
$Statement = $pdo->prepare("SELECT * FROM item_db WHERE item_status='0' order by item_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$item_id = _e($row['item_Id']);
		$c_id = _e($row['main_category']);
		$c_name = fetchcategory_name($pdo,$c_id) ;
		$created_date = _e($row['created_date']);
		$created_date =  date('d F, Y',strtotime($created_date));
		$updated_date = _e($row['updated_date']);
		$updated_date =  date('d F, Y',strtotime($updated_date));
		$item_name = strip_tags($row['item_name']);
		$statuss = _e($row['item_status']);
		$mainfile = _e($row['item_mainfile']);
		
		if(empty($mainfile)){
			$mainfile = "";
		} else {
			$mainfile = '<form method="POST" action="'.ADMIN_URL.'download.php" enctype="multipart/form-data">
							<input type="hidden" name="item_id" value="'.$item_id.'" >
							<input type="hidden" name="main_file" value="'.$mainfile.'" >
							<input type="submit" name="SaveMainfile" value="Download Music" class="btn btn-sm btn-success" ></form>';
		}
		
		if($statuss == 1) {
			// Deactivate Item
			$statuss = "<b class='text-success'>Active</b>";
		} else {
			// Activate Item
			$statuss = "<b class='text-danger'>Deactive</b>";
		}
		$editItem = '<a href="'.ADMIN_URL.'upload.php?item_id='.$item_id.'" class="btn btn-sm btn-info">Edit</a>';
		$output['data'][] = array( 	
		$sum,	
		$c_id,
		$c_name,
		$item_id,
		$item_name,
		$created_date,
		$updated_date,
		$statuss,
		$editItem,
		$mainfile
		); 	
	}
}
echo json_encode($output);
?>