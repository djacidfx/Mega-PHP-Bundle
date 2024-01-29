<?php

// Error Reporting Turn On
//===============Do Not Change Me Start=======================//
ini_set('error_reporting', 0);
//===============Do Not Change Me End========================//


// +++++++++++++++++++READ ME CAREFULLY++++++++++++++++++++++++++

// 1) Defining base url , replace https://www.yourwebsite.com/ with your website name
// 2) Whatever your folder name just replace payment/ with yourfoldername/ ,
// 3) Note : put forward slash / at the end of your folder name otherwise script won't work.
// 4) https website is mandatory for Stripe Payment Gateway
// 5) If you want to Put this script in your Root Folder without any folder then your BASE_URL line is below
// 6) define("BASE_URL", "https://www.yourwebsite.com/");

//=============== CHANGE Me Carefully Start =======================//
define("BASE_URL", "https://www.yourwebsite.com/");
//=============== CHANGE Me Carefully End  =======================//

//=============== CHANGE Me Carefully Start =======================//

// Your Website Meta Title
define("META_SITE_TITLE", "Linky");

// Your Website Meta Description
define("META_SITE_DESCRIPTION", "Link Shortener PHP Script");

// Placeholder Line of Box
define("BOX_PLACEHOLDER", "Shorten Your Link...") ;

// Placeholder Line of Box
define("BUTTON_NAME", "Shorten") ;

// Index Page Heading Line
define("INDEX_HEADING", "Linky") ;

// Footer Copyright Name
define("COPYRIGHT_NAME", "CodeDaddy") ;

// Wrong URL Message - If someone try to create short url without domain name like abcd then this message will appear
define("WRONG_MESSAGE", "Please Use Correct Domain to shorten URL") ;

// Custom URL Length . Keep it 6 to 9 because in Large cases it is good to make automatic URL Length for Users
define("URL_LENGTH", "6") ;

// Delay (In Seconds) on advertising page and after redirect users to Original URL ==> For No Delay set 0 [zero] seconds
define("DELAY_SECONDS", "10") ;

// Delay Message to users
define("DELAY_MESSAGE", "Please Wait ! Redirecting to Original Link...") ;

//=============== CHANGE Me Carefully End  =======================//


?>
