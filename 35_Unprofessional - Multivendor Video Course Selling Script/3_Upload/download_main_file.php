<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ; 
check_user_logged_in($pdo) ;
if(isset($_POST['SaveMainfile'])){
	
		$name = filter_var($_POST['mainfile_name'], FILTER_SANITIZE_STRING) ;
        $filname = 'mainFiles/'.$name ;
        $userId = $_SESSION['unprofessional']['id'] ;
        $itemId = grab_item_id_by_filename($pdo,$name) ;
        $authorId = find_user_id_by_itemid($pdo,$itemId) ;
    if(checking_user_purchased_item($pdo,$_SESSION['unprofessional']['id'],$itemId) > 0){
        $upd = $pdo->prepare("update ot_user_purchases set user_downloaded = '1' where purchase_item_id = '".$itemId."' and purchase_user_id = '".$userId."'");
        $upd->execute();
		if (headers_sent()) {
			echo 'HTTP header already sent';
		} else {
			if (!is_file($filname)) {
				header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
				echo 'File not found';
			} else if (!is_readable($filname)) {
				header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
				echo 'File not readable';
			} else {
				header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
				header("Content-Type: application/zip");
				header("Content-Transfer-Encoding: Binary");
				header("Content-Length: ".filesize($filname));
				header("Content-Disposition: attachment; filename=\"".basename($filname)."\"");
				readfile($filname);
				exit;
			}
		}	
    }
    if($authorId == $userId){
        if (headers_sent()) {
			echo 'HTTP header already sent';
		} else {
			if (!is_file($filname)) {
				header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
				echo 'File not found';
			} else if (!is_readable($filname)) {
				header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
				echo 'File not readable';
			} else {
				header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
				header("Content-Type: application/zip");
				header("Content-Transfer-Encoding: Binary");
				header("Content-Length: ".filesize($filname));
				header("Content-Disposition: attachment; filename=\"".basename($filname)."\"");
				readfile($filname);
				exit;
			}
		}
    }
} else{
	echo "You are not authorize to Direct Access.";
}
?>