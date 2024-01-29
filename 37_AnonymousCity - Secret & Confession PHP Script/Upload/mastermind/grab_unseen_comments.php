<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
include("database.php") ;
if(!empty($_GET["id"])){
	$oldcommentId = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT) ;
	echo get_unseencomments_onload($pdo,$oldcommentId) ;
}
?>
<script src="<?php echo ADMIN_URL ; ?>js/bodytooltip.js"></script>
<script src="<?php echo ADMIN_URL ; ?>js/tinymce_editor.js"></script>