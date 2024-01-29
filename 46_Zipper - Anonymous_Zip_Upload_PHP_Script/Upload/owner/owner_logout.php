<?php 
ob_start();
session_start();
include 'db.php'; 
unset($_SESSION['owner']);
header("location: ".ADMIN_URL."");
?>