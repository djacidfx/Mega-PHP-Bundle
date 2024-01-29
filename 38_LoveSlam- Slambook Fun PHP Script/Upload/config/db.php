<?php

// Error Reporting Turn On
//===============Do Not Change Me Start=======================//
ini_set('error_reporting', 0);
//===============Do Not Change Me End========================//


//=============== CHANGE Me Carefully Start =======================//


//=============== DATABASE CREDENTIALS CHANGE START =======================//

// Host Name 99% Web Hosting Hostname is localhost
$dbhost = 'CHANGE_ME_I_AM_YOUR_DATABASE_HOSTNAME' ;

// Database Name
$dbname = 'CHANGE_ME_I_AM_YOUR_DATABASE_NAME' ;

// Database Username
$dbuser = 'CHANGE_ME_I_AM_YOUR_DATABASE_USERNAME' ;

// Database Password
$dbpass = 'CHANGE_ME_I_AM_YOUR_DATABASE_PASSWORD' ;

//=============== DATABASE CREDENTIALS CHANGE END =======================//

//=============== Google ReCaptcha Verification Start=======================//

// Login to your Google Account, Go to https://www.google.com/recaptcha/admin/create , Read Documentation and Update this File

// Google ReCaptcha V2 Site Key
define("SITE_KEY", "CHANGE_ME_I_AM_YOUR_GOOGLE_RECAPTCH_V2_SITE_KEY");

// Google ReCaptcha V2 Secret Key
define("SECRET_KEY", "CHANGE_ME_I_AM_YOUR_GOOGLE_RECAPTCH_V2_SECRET_KEY");

//=============== Google ReCaptcha Verification End=======================//


// +++++++++++++++++++READ ME CAREFULLY++++++++++++++++++++++++++

// 1) Defining base url , replace https://www.yourwebsite.com/ with your website name
// 2) Whatever your folder name just replace payment/ with yourfoldername/ , 
// 3) Note : put forward slash / at the end of your folder name otherwise script won't work. 
// 4) https website is mandatory for Stripe Payment Gateway
// 5) If you want to Put this script in your Root Folder without any folder then your BASE_URL line is below
// 6) define("BASE_URL", "https://www.yourwebsite.com/");

//=============== CHANGE Me Carefully Start =======================//
define("BASE_URL", "https://yourwebsite.com/");
//=============== CHANGE Me Carefully End  =======================//

// Defining Admin url Note : Do not change this otherwise script won't work.

//===============Do Not Change Me Start=======================//
define("ADMIN_URL", BASE_URL . "boss/");
//===============Do Not Change Me End========================//


try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}
?>