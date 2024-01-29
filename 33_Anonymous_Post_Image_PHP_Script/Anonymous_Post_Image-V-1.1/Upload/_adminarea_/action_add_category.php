<?php
ob_start();
session_start();
include("db/config.php");
include("db/post_functions.php") ;
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'SaveCategory')
	{
		if(!empty($_POST['catName'])){
			$categoryName = filter_var($_POST['catName'], FILTER_SANITIZE_STRING) ;
			$ins = $pdo->prepare("insert into anony_category (category_name) values ('".$categoryName."')") ;
			$ins->execute();
			echo "Category is live now.";
		} else {
			echo "Category Name should not be Empty.";
		}
	}
	
	if($_POST['btn_action'] == 'changeCatStatusToDeactive')
	{
		if(!empty($_POST['catId']) ){
			$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT) ;
			$categoryId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT) ;
				$ins = $pdo->prepare("update anony_category set category_status = '0' where id = '".$categoryId."'") ;
				$ins->execute();
				$upd = $pdo->prepare("update anony_post set post_status = '0' where cat_id = '".$categoryId."'") ;
                $upd->execute() ;
				echo "Category is deactivated & All the Images belongs to this Category is also Deactivated.";
			
		} else {
			echo "Category ID should not be Empty.";
		}
	}
	if($_POST['btn_action'] == 'changeCatStatusToActive')
	{
		if(!empty($_POST['catId']) ){
			$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT) ;
			$categoryId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT) ;
			
			$ins = $pdo->prepare("update anony_category set category_status = '1' where id = '".$categoryId."'") ;
			$ins->execute();
            $upd = $pdo->prepare("update anony_post set post_status = '1' where cat_id = '".$categoryId."'") ;
            $upd->execute() ;
			echo "Category is activated & All the Images belongs to this Category is Activated & Live Now.";
		} else {
			echo "Category ID should not be Empty.";
		}
	}
	
	
	if($_POST['btn_action'] == 'fetch_category')
	{	
		if(!empty($_POST['catId'])){
			$catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from anony_category where id = ?");
			$announce->execute(array($catId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['catId'] = _e($row['id']);
				$output['categoryName'] = strip_tags($row['category_name']);
			}
			echo json_encode($output) ;
		} else {
			echo "Error : Category Id is mandatory." ;
		}
	}
	if($_POST['btn_action'] == 'EditCategory')
	{	
		if(!empty($_POST['catId']) && !empty($_POST['catName'])){
			$categoryName = filter_var($_POST['catName'], FILTER_SANITIZE_STRING) ;
			$categoryId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update anony_category set category_name = '".$categoryName."' where id = '".$categoryId."'") ;
			$upd->execute();
			echo "Category Name is Edited Successfully";
			
			
		} else {
			echo "Error : Category Id & Name is mandatory." ;
		}
	}
	
}
?>