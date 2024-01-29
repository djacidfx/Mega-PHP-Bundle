<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
include("setup.php") ;
if(!empty($_GET["id"]) ){
    $limit = MORE_SITE_LOAD ;
	echo load_more_site($pdo,$limit) ;
}
?>