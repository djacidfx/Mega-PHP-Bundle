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
$admin = $pdo->prepare("SELECT * FROM ot_admin WHERE id = '1'");
$admin->execute();   
$admin_result = $admin->fetchAll(PDO::FETCH_ASSOC);
$total = $admin->rowCount();
foreach($admin_result as $adm) {
//escape all  data
	$mainfile_email = _e($adm['mainfile_email']);
	$rec_email = _e($adm['rec_email']);
	$adminName = _e($adm['adm_name']);
	$admin_email   = _e($adm['adm_email']);
}
$headers = "";


if(!empty($_FILES['mainfile']))
{
	$FileSize = number_format($_POST['FileSize'] * 1024, 2);
	$item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
	$targetDir = "../media/"; 
	$allowTypes = array('mp3', 'm4a', 'ogg', 'wav'); 
	$fileName = filter_var($_FILES["mainfile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["mainfile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	//delete old file if exist
	$statement = $pdo->prepare("select item_mainfile from item_db where item_id = '".$item_id."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) {
		$mainfile_name = _e($row['item_mainfile']) ;
	} 
	if(in_array($fileType, $allowTypes)){ 
		
		
		//delete old file
		unlink($targetDir.$mainfile_name);
		
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			$upd = $pdo->prepare("update item_db set item_mainfile = '".$newfilename."', item_filesize = '".$FileSize."' where item_Id = '".$item_id."'");
			$upd->execute();
			
        } 
    } 
} 


?>