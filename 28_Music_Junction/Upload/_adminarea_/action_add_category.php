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
			echo "Artist / Category is live now.";
		} else {
			echo "Artist / Category Name should not be Empty.";
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
				echo "Artist / Category is deactivated & All the Music belongs to this Artist / Category is also Deactivated.";
			
		} else {
			echo "Artist / Category ID should not be Empty.";
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
			echo "Artist / Category is activated & All the Music belongs to this Artist / Category is Activated & Live Now.";
		} else {
			echo "Artist / Category ID should not be Empty.";
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
			echo "Error : Artist / Category Id is mandatory." ;
		}
	}
	if($_POST['btn_action_cat'] == 'EditCategory')
	{	
		if(!empty($_POST['catId']) && !empty($_POST['cat'])){
			$categoryName = filter_var($_POST['cat'], FILTER_SANITIZE_STRING) ;
			$categoryId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update item_category set c_name = '".$categoryName."' where c_id = '".$categoryId."'") ;
			$upd->execute();
			echo "Artist / Category Name is Updated Successfully";
			
		} else {
			echo "Error : Category Id & Name is mandatory." ;
		}
	}
	
}
?>