<?php
// Error Reporting Turn On
ini_set('error_reporting', E_ALL);
ini_set('post_max_size', '256M');
ini_set('upload_max_filesize', '256M');

// Host Name 99% Web Hosting Hostname is localhost
$dbhost = 'YOUR_HOSTNAME' ;

// Database Name
$dbname = 'YOUR_DATABASE_NAME' ;

// Database Username
$dbuser = 'YOUR_DATABASE_USERNAME' ;

// Database Password
$dbpass = 'YOUR_DATABASE_USERNAME_PASSWORD' ;

// Defining base url , replace https://www.yourwebsite.com/ with your website name
// Whatever your folder name just replace payment/ with yourfoldername/ , Note : put forward slash / at the end of your folder name otherwise script won't work. https website is mandatory for Stripe Payment Gateway
define("BASE_URL", "https://www.yourwebsite.com/folder_name/");

// Defining Admin url Note : Do not change this otherwise script won't work.
define("ADMIN_URL", BASE_URL . "_adminarea_/");



try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}
?>