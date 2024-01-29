<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
if(isset($_POST['btn_action'])){
    if($_POST['btn_action'] == 'getNotify'){
        echo grab_notifications($pdo) ; 
    }
}
?>
<script src="<?php echo BASE_URL ; ?>js/readnotificationtwo.js"></script>