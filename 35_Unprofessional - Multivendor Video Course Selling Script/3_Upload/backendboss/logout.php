<?php 
ob_start();
session_start();
include 'config/db.php'; 
unset($_SESSION['boss']);
header("location: ".ADMIN_URL."");
?>