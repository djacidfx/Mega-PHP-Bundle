<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;
if(isset($_POST['SaveMainfile'])){
	
		$name = filter_var($_POST['mainfile_name'], FILTER_SANITIZE_STRING) ;
        $filname = '../tmpFiles/'.$name ;
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
} else{
	echo "You are not authorize to Direct Access.";
}
?>