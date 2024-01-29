<?php
$ga = $pdo->prepare("select g_code from ot_admin where id = '1' and admin_on = '1'") ;
$ga->execute();
$totalGa = $ga->rowCount();
$result = $ga->fetchAll();
if($totalGa > 0) {
	foreach($result as $row) {
		$GA = base64_decode($row['g_code']);
		echo $GA ;
	}
}
?>