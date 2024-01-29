<?php
// Error Reporting Turn On
//===============Do Not Change Me Start=======================//
ini_set('error_reporting', E_ALL);
ini_set('post_max_size', '256M');
ini_set('upload_max_filesize', '256M');
//===============Do Not Change Me End========================//

//=============== CHANGE Me Carefully Start =======================//

// Host Name 99% Web Hosting Hostname is localhost
$dbhost = 'YOUR_DATABASE_HOSTNAME' ;

// Database Name
$dbname = 'YOUR_DATABASE_NAME' ;

// Database Username
$dbuser = 'YOUR_DATABASE_USERNAME' ;

// Database Password
$dbpass = 'YOUR_DATABASE_USERNAME_PASSWORD' ;

//=============== CHANGE Me Carefully End  =======================//

// +++++++++++++++++++READ ME CAREFULLY++++++++++++++++++++++++++

// 1) Defining base url , replace https://www.yourwebsite.com/ with your website name
// 2) Whatever your folder name just replace payment/ with yourfoldername/ , 
// 3) Note : put forward slash / at the end of your folder name otherwise script won't work. 
// 4) https website is mandatory for Stripe Payment Gateway
// 5) If you want to Put this script in your Root Folder without any folder then your BASE_URL line is below
// 6) define("BASE_URL", "https://www.yourwebsite.com/");

//=============== CHANGE Me Carefully Start =======================//
define("BASE_URL", "https://www.yourwebsite.com/folder_name/");
//=============== CHANGE Me Carefully End  =======================//

// Defining Admin url Note : Do not change this otherwise script won't work.

//===============Do Not Change Me Start=======================//
define("ADMIN_URL", BASE_URL . "_adminarea_/");
//===============Do Not Change Me End========================//


try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}
?>