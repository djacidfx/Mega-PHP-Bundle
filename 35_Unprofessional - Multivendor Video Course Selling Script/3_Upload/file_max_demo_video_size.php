<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
$data = demo_video_max_size  ;
echo $data ;
?>