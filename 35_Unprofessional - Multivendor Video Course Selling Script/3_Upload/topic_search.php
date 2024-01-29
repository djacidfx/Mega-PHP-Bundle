<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
$topicsearch = filter_var($_POST['search_topickeyword'], FILTER_SANITIZE_STRING) ;
str_replace('?search_topickeyword=', '', $topicsearch) ;
header("location: ".BASE_URL."searchtopic/".$topicsearch."");
?>