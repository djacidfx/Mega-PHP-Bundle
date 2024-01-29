<?php 
ob_start();
session_start();
include 'backendboss/config/db.php'; 
unset($_SESSION['unprofessional']);
header("location: ".BASE_URL."");
?>