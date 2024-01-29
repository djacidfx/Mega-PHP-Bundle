<?php 
ob_start();
session_start();
include("setup.php") ; 
$data = STRIPE_PUBLISHABLE_KEY  ;
echo $data ;
?>