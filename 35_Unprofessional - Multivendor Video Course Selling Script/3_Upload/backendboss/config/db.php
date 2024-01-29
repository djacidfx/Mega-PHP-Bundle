<?php

// Error Reporting Turn On
//===============Do Not Change Me Start=======================//
ini_set('error_reporting', E_ALL);
//===============Do Not Change Me End========================//


//=============== CHANGE Me Carefully Start =======================//


//=============== DATABASE CREDENTIALS CHANGE START =======================//

// Host Name 99% Web Hosting Hostname is localhost
$dbhost = 'CHANGE_ONLY_ME_I_AM_YOUR_DATABASE_HOSTNAME' ;

// Database Name
$dbname = 'CHANGE_ONLY_ME_I_AM_YOUR_DATABASE_NAME' ;

// Database Username
$dbuser = 'CHANGE_ONLY_ME_I_AM_YOUR_DATABASE_USERNAME' ;

// Database Password
$dbpass = 'CHANGE_ONLY_ME_I_AM_YOUR_DATABASE_PASSWORD' ;

//=============== DATABASE CREDENTIALS CHANGE END =======================//

//=============== Google ReCaptcha Verification Start=======================//

// Login to your Google Account, Go to https://www.google.com/recaptcha/admin/create , Read Documentation and Update this File

// Google ReCaptcha V2 Site Key
define("SITE_KEY", "CHANGE_ONLY_ME_I_AM_YOUR_GOOGLE_RECAPTCHA_V2_SITE_KEY");

// Google ReCaptcha V2 Secret Key
define("SECRET_KEY", "CHANGE_ONLY_ME_I_AM_YOUR_GOOGLE_RECAPTCHA_V2_SECRET_KEY");

//=============== Google ReCaptcha Verification End=======================//


//=============== CHANGE ME PAYMENT SETUP START =======================//

// Stripe API configuration (You will find it in https://dashboard.stripe.com/apikeys with Option after Developer View Test Data On means Testing Mode Otherwise Live Mode

//Stripe API KEY : Note - If you want to test in sandbox mode your api keys should be starts with sk_test_ & pk_test_ & In Live mode it starts with sk_live_ & pk_live_

define('STRIPE_API_KEY', 'CHANGE_ONLY_ME_I_AM_YOUR_STRIPE_API_KEY');

//Stripe API KEY : Note - If you want to test in sandbox mode your Publishable key should be starts with pk_test_ & In Live mode it starts with pk_live_ 

define('STRIPE_PUBLISHABLE_KEY', 'CHANGE_ONLY_ME_I_AM_YOUR_STRIPE_PUBLISHABLE_KEY'); 

// PAYPAL BUSINESS EMAIL
define('PAYPAL_BUSINESS_EMAIL', 'CHANGE_ONLY_ME_I_AM_YOUR_PAYPAL_BUSINESS_EMAIL') ;

// For Paypal Sandbox Testing , Open paypal_verification.php & paypalpayment.php in root folder [ not in backendboss folder ]. Go to line no. 8 i.e.

// $enableSandbox = false;
// For Sandbox, change it to true i.e.

// For Sandbox line no. 8 in both files => 
// $enableSandbox = true;

// For Live Paypal line no. 8 in both files => 
// $enableSandbox = false;


//=============== CHANGE ME PAYMENT SETUP END =======================//


//=============== CHANGE ME IMAGE & FILE MAXIMUM SIZE SETUP START =======================//

// Maximum Size of Preview Image in MB only = 0.5 means 500 KB 
// Example = 500 kb means 0.5 MB (Do not write MB only user number i.e. 0.5)
define('preview_image_max_size', '0.5') ;

// Maximum Size of Demo Video in MB only = 2 Means 2 MB , 50 means 50 MB
define('demo_video_max_size', '50') ;

//=======================Read Me Carefully I am very Important ============================ //

// Maximum Size of Main Zip File which contains all video in MB only = 256 Means 256 MB, 1000 = 1 GB

// If you want to increase the size of Main Zip File like 1 gb then replace 256 to 1000 and after that open .user file (in upload folder , note : not in backendboss folder only root folder .user file ) in text editor replace first line i.e.
// upload_max_filesize = 256M 

// remove 256M and write 1000M and save it. 
// after that change below line , replace 256 to 1000 

define('main_zip_max_size', '256') ;

//=============== CHANGE ME IMAGE & FILE MAXIMUM SIZE SETUP END =======================//


//=============== CHANGE Me Carefully End  =======================//




// +++++++++++++++++++READ ME CAREFULLY++++++++++++++++++++++++++

// 1) Defining base url , replace https://yourwebsite.com/ with your website name
// 2) Whatever your folder name just replace payment/ with yourfoldername/ , 
// 3) Note : put forward slash / at the end of your folder name otherwise script won't work. 
// 4) https website is mandatory for Stripe Payment Gateway
// 5) If you want to Put this script in your Root Folder without any folder then your BASE_URL line is below
// 6) define("BASE_URL", "https://yourwebsite.com/");
// 7) If you want to put this script inside any subfolder like folder name is course then url BASE_URL is below
// 8) define("BASE_URL", "https://yourwebsite.com/course/");
// 9) Do not change ADMIN_URL Line 

//=============== CHANGE Me Carefully Start =======================//
define("BASE_URL", "https://yourwebsite.com/");
//=============== CHANGE Me Carefully End  =======================//

// Defining Admin url Note : Do not change this otherwise script won't work.

//===============Do Not Change Me Start=======================//

define("ADMIN_URL", BASE_URL . "backendboss/");

//===============Do Not Change Me End========================//


try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}
?>