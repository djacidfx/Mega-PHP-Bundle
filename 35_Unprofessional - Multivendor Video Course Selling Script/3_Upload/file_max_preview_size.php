<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
$data = preview_image_max_size  ;
echo $data ;
?>