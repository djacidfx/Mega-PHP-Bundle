<?php

// Error Reporting Turn On
//===============Do Not Change Me Start=======================//
ini_set('error_reporting', 1);
//===============Do Not Change Me End========================//


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

// Meta Site Title 
define("META_SITE_TITLE", "Privy - Send Anonymous Private Note") ;

// Meta Site Description 
define("META_SITE_DESCRIPTION", "Send Anonymous Private Note to your friends & relatives in a minute with Password. No one can view it.") ;

// Copyright Owner Name 
define("COPYRIGHT_NAME", "CodeDaddy") ;

// +++++++++++++++++++READ ME CAREFULLY++++++++++++++++++++++++++

// 1) Defining base url , replace https://www.yourwebsite.com/ with your website name
// 2) If your this script inside a folder then whatever your folder name just add yourfoldername/ , like https://www.example.com/folder/
// 3) Note : put forward slash / at the end of your folder name otherwise script won't work. 
// 4) If you want to Put this script in your Root Folder without any folder then your BASE_URL line is below
// 5) define("BASE_URL", "https://www.yourwebsite.com/");

// Base URL means Your default website address followed by forward slash / 
define("BASE_URL", "https://www.yourwebsite.com/") ;

// Set default mode, For light mode = light or For dark mode = dark , write only in double inverted comma "  "
define("DEFAULT_MODE", "dark") ;


// See List of language and their word so you can easily put your default language when user visited to your website. Write only in double inverted comma "  "
// For English  = english
// For Afrikaans  = afrikaans
// For Arabic  = arabic
// For Chinese Simplified  = chinesesimplified
// For Chinese Traditional  = chinesetraditional
// For Croatian  = croatian
// For Czech  = czech
// For Dutch  = dutch
// For French  = french
// For German  = german
// For Hindi  = hindi
// For Italian  = italian
// For Japanese  = japanese
// For Kazakh  = kazakh
// For Korean  = korean
// For Nepali  = nepali
// For Polish  = polish
// For Portuguese  = portuguese
// For Russian  = russian
// For Spanish  = spanish
// For Swedish  = swedish
// For Thai  = thai
// For Turkish  = turkish
// For Ukrainian  = ukrainian
// For Urdu  = urdu
// For Vietnamese  = vietnamese

// Set default language, For English  = english  , write only in double inverted comma "  "
define("DEFAULT_LANGUAGE", "english") ;

/* Google Ad Setup

Step : 1 => Unzip the downloaded folder and Open Upload folder

Step : 2 => Ad Setup => Open 3 Files i.e. ad_desktop_leftside.php , ad_desktop_rightside.php & ad_mobile.php 

Step : 3 => Desktop Ad : 300 x 600 Pixel : Paste Google Ad Javascript code in ad_desktop_leftside.php & ad_desktop_rightside.php for Desktop Ad

Step : 4 => Mobile Ad : 300 x 50 Pixel : Paste Google Ad Javascript code in ad_mobile.php 

*/

//===============Do Not Change Me Below Lines=======================//

define("ADMIN_URL", BASE_URL . "owner/");

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}
?>