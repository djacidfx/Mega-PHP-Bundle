<?php
header('Content-Type: application/json');
ob_start();
session_start();

include("db/config.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
$sql = $pdo->prepare("SELECT post_love as lovedCount, post_title as item_name FROM anony_post WHERE post_status = '1' and post_love > 0 group by id order by post_love DESC LIMIT 5");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$data = array();
foreach ($result as $row) {
	$data[] = $row ;	
}
echo json_encode($data);
?>