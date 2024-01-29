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
if(!empty($_FILES['uploadFile']))
{
	$targetDir = "../postImage/" ; 
	$allowTypes = array( 'jpg', 'png', 'jpeg'); 
	$fileName = filter_var($_FILES["uploadFile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["uploadFile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	$date = filter_var(date("Y-m-d"), FILTER_SANITIZE_STRING) ;
	$caption = filter_var($_POST['caption'], FILTER_SANITIZE_STRING) ;
    if(check_duplicate_caption($pdo,$caption) == 0){
    $catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT) ;
	if(in_array($fileType, $allowTypes)){ 
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			$upd = $pdo->prepare("insert into anony_post (post_type, cat_id, post_title, post_image, post_date, post_status) values ('1', '".$catId."','".$caption."','".$newfilename."','".$date."', '1')");
			$upd->execute();
            echo "Photo Uploaded Successfully & Live Now." ;
        } 
    } 
    } else {
        echo "Duplicate Caption is not Allowed. Please Use Another Caption." ;
    }
}
if(!empty($_POST['postId']) && !empty($_FILES['uploadReplaceFile']))
{
	$postId = filter_var($_POST['postId'], FILTER_SANITIZE_NUMBER_INT) ;
	$statement = $pdo->prepare("select post_image from anony_post where id = '".$postId."'");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row) {
		$image_name = _e($row['post_image']) ;
	} 
	$targetDir = "../postImage/" ; 
	
	$allowTypes = array( 'jpg', 'png', 'jpeg'); 
	$fileName = filter_var($_FILES["uploadReplaceFile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
	$tmpFileName = filter_var($_FILES["uploadReplaceFile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	if(in_array($fileType, $allowTypes)){ 
		//delete old image
		unlink($targetDir.$image_name);
        // Upload file to the server 
        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
			$upd = $pdo->prepare("update anony_post set  post_image = '".$newfilename."' where id = '".$postId."'");
			$upd->execute();
        } 
    } 
} 
?>