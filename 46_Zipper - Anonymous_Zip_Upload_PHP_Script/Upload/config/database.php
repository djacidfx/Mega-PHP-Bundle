<?php

// Error Reporting Turn On
//===============Do Not Change Me Start=======================//
ini_set('error_reporting', 0);
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
define("META_SITE_TITLE", "Zipper - Send Anonymous Zip File") ;

// Meta Site Description 
define("META_SITE_DESCRIPTION", "Send Anonymous Private Note with zip file to your friends & relatives in a minute with Password. No one can view it.") ;

// Copyright Owner Name 
define("COPYRIGHT_NAME", "CodeDaddy") ;

// ZIP File Size Limit in KB, 1024 KB = 1 MB , 100 means 100 kb
define("ZIP_LIMIT", "100") ;

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

//===============Do Not Change Me Below=======================//

define("ADMIN_URL", BASE_URL . "owner/");

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}
?>