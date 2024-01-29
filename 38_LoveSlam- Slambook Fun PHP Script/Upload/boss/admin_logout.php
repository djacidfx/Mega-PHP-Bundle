<?php 
ob_start();
session_start();
include 'database.php'; 
unset($_SESSION['boss']);
header("location: ".ADMIN_URL."");
?>