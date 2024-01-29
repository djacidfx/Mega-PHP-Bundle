<?php
ob_start();
session_start();
include("config/database.php") ;
include("functions.php") ;
if (!empty($_GET['mode'])) {
    $getMode = trim(filter_var(htmlentities($_GET['mode']),FILTER_SANITIZE_STRING));
    $_SESSION['mode'] = $getMode;
}
include("mode/mode.php") ;
if (!empty($_GET['redirect'])) {
    $redirectUrl = filter_var($_GET['redirect'] , FILTER_SANITIZE_URL) ;
    header("location: ".$redirectUrl."") ;
} else{
    header("location: ".BASE_URL."") ;
}
?> 