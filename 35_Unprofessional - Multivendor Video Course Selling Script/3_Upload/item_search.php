<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
$search = filter_var($_POST['search_keyword'], FILTER_SANITIZE_STRING) ;
str_replace('?search_keyword=', '', $search) ;
header("location: ".BASE_URL."search/".$search."");
?>