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
$sql = $pdo->prepare("SELECT pic_vote as lovedCount, pic_caption as item_name FROM ot_admin_pics WHERE pic_status = '1' and pic_vote > 0  order by pic_vote DESC LIMIT 5");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$data = array();
foreach ($result as $row) {
	$data[] = $row ;	
}
echo json_encode($data);
?>