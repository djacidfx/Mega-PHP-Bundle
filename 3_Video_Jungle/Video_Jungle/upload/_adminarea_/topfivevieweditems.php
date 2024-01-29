<?php
header('Content-Type: application/json');
ob_start();
session_start();

include("db/config.php");
include("db/item_functions.php") ;
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
$sql = $pdo->prepare("SELECT item_viewed as viewCount, item_name FROM item_db WHERE item_status = '1' and item_viewed > 0 group by item_Id order by viewCount DESC LIMIT 5");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$data = array();
foreach ($result as $row) {
	$data[] = $row ;	
}
echo json_encode($data);
?>