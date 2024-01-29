<?php 
ob_start();
session_start();
include 'db.php'; 
unset($_SESSION['master']);
header("location: ".ADMIN_URL."");
?>