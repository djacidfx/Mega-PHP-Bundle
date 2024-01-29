<?php
// Error Reporting Turn On
ini_set('error_reporting', E_ALL);

// Host Name
$dbhost = 'YOUR_LOCALHOST_NAME' ;

// Database Name
$dbname = 'YOUR_DATABASE_NAME' ;

// Database Username
$dbuser = 'YOUR_DATABASE_USERNAME' ;

// Database Password
$dbpass = 'YOUR_DATABASE_PASSWORD' ;

// Defining base url , replace https://www.yourwebsite.com/ with your website name
// Whatever your folder name just replace payment/ with yourfoldername/ , Note : put forward slash / at the end of your folder name otherwise script won't work. https website is mandatory for Stripe Payment Gateway
define("BASE_URL", "https://www.yourwebsite.com/payment/");

// Defining Admin url Note : Do not change this otherwise script won't work.
define("ADMIN_URL", BASE_URL . "admin");

// Stripe API configuration (You will find it in https://dashboard.stripe.com/apikeys with Option after Developer View Test Data On means Testing Mode Otherwise Live Mode
//Stripe API KEY : Note - If you want to test in sandbox mode your api key should be starts with sk_test_ & In Live mode it starts with sk_live_ 
define('STRIPE_API_KEY', 'sk_test_51HO09HGWktjtqpmOBlgDei6RCJY9Mo94bvi0WoKWD2AcQYSg1znudNaTXMkKABJV2fiO2ng0GkAgXLpkIUCk9dce002MdY6ujH'); 
//Stripe API KEY : Note - If you want to test in sandbox mode your Publishable key should be starts with pk_test_ & In Live mode it starts with pk_live_ 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51HO09HGWktjtqpmO6l6bBZfYc6zyt1Akimeh99cjcFh8L28aukjiioSJvhuKEhjB2mQwz5b40LAQ1QFeAe5kgpnR00RECyD4uv'); 

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}
?>