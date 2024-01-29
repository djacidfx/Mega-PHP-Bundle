<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;
$data = STRIPE_PUBLISHABLE_KEY  ;
echo $data ;
?>