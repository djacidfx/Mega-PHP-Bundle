<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
$data = main_zip_max_size  ;
echo $data ;
?>