<?php

// Error Reporting Turn On
//===============Do Not Change Me Start=======================//
ini_set('error_reporting', 0);
//===============Do Not Change Me End========================//


//=============== CHANGE Me Carefully Start =======================//

// This is your Email , where after Donation you will get notified
define("ADMIN_NAME", "CHANGE_ONLY_ME_I_AM_ADMIN_NAME");

// This is your Email , where after Donation you will get notified
define("ADMIN_EMAIL", "CHANGE_ONLY_ME_I_AM_ADMIN_EMAIL");

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

//=============== CHANGE ME PAYMENT SETUP END =======================//


//=============== CHANGE Me Carefully End  =======================//




// +++++++++++++++++++READ ME CAREFULLY++++++++++++++++++++++++++

// 1) Defining base url , replace https://www.yourwebsite.com/ with your website name
// 2) Whatever your folder name just replace payment/ with yourfoldername/ , 
// 3) Note : put forward slash / at the end of your folder name otherwise script won't work. 
// 4) https website is mandatory for Stripe Payment Gateway
// 5) If you want to Put this script in your Root Folder without any folder then your BASE_URL line is below
// 6) define("BASE_URL", "https://www.yourwebsite.com/");

//=============== CHANGE Me Carefully Start =======================//
define("BASE_URL", "https://yourwebsite.com/foldername/");
//=============== CHANGE Me Carefully End  =======================//

//=============== CHANGE Me Carefully Start =======================//

// Your Website Meta Title
define("META_SITE_TITLE", "Stripe Donation");

// Your Website Meta Description
define("META_SITE_DESCRIPTION", "Easy Donate with Stripe");

// Maximum Donation Amount
define("MIN_DONATION_AMOUNT", "5");

// Maximum Donation Amount 
define("MAX_DONATION_AMOUNT", "100");

// This is the Currency you want to accept , Use only shortcode of currency code 
// Go to the https://stripe.com/docs/currencies 
define("CURRENCY_TYPE" , "INR") ;
    
// Name Heading you can write in your Country Language 
// Example Name , Nombre , Nome , Nom , 名称 , etc.
define("NAME_HEADING" , "Name");

// Email Heading you can write in your Country Language 
define("EMAIL_HEADING" , "Email");

// Donation Amount Heading you can write in your Country Language 
define("DONATION_AMT_HEADING" , "Donation Amount");

// Donation Box Header Heading you can write in your Country Language 
define("DONATION_BOX_HEADER" , "Donation Box");

// Prove, You are Human Heading you can write in your Country Language 
define("PROVE_HUMAN_HEADING" , "Prove, You are Human");

//Thank You Message to User After Successful Donation in your Country Language 
define("THANK_YOU_MESSAGE" , "Thanks for the Donation. Your Unconditional Support makes us Stronger to Fulfill all of your Desire.") ;

//Retry Donation Message to User If Transaction is not Successful in your Country Language
define("RETRY_DONATION_MESSAGE" , "It seems your Transaction is not Successful. Please, Try to Donate once again. Thanks.") ;

// Button Heading you can write in your Country Language 
define("BUTTON_HEADING" , "Donate via Stripe") ;

// Error Message : If ReCaptcha is not verified you can write in your Country Language 
define("RECAPTCHA_ERROR" , "Spammer is not allowed") ;

// Error Message : If Any Mandatory Field is missing you can write in your Country Language 
define("MANDATORY_ERROR" , "Any Mandatory Field is Missing. Try Again.") ;

// Error Message : Minimum or Maximum Donation Amount Error you can write in your Country Language 
define("AMOUNT_ERROR" , "Donation Amount is wrong.") ;

// Message : Donation Successful & Unsuccessful Heading you can write in your Country Language 
define("SUCCESSFUL_HEADING" , "Donation Successful.") ;
define("UNSUCCESSFUL_HEADING" , "Donation Unsuccessful.") ;

//=============== CHANGE Me Carefully End  =======================//


?>