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


if(!empty($_FILES['mainfile']))
{
	$FileSize = number_format($_POST['FileSize'] * 1024, 2);
	$item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
	$targetDir = "../admin_images/"; 
	$allowTypes = array('png', 'jpg', 'jpeg'); 
	$fileName = filter_var($_FILES["mainfile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["mainfile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	//delete old file if exist
	$statement = $pdo->prepare("select pic_image from ot_admin_pics where pic_id = '".$item_id."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) {
		$mainfile_name = _e($row['pic_image']) ;
	} 
	if(in_array($fileType, $allowTypes)){ 
		
		
		//delete old file
		unlink($targetDir.$mainfile_name);
		
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			$upd = $pdo->prepare("update ot_admin_pics set pic_image = '".$newfilename."' where pic_id = '".$item_id."'");
			$upd->execute();
			
        } 
    } 
} 


?>