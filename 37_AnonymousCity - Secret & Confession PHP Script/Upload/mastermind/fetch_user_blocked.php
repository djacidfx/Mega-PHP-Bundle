<?php
include("database.php") ;
$Statement = $pdo->prepare("SELECT * FROM ot_ip_blocked WHERE 1 order by ip_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $id = _e($row['ip_id']) ;
        $userip = _e($row['blocked_ip']) ;
        $blockIp = base64_encode($userip) ;
        $action = '<button class="btn btn-sm btn-danger unblockManualBlock" data-bs-toggle="tooltip" data-bs-placement="top" title="Unblock IP & Delete from Blacklist" id="'.$id.'" data-status = '.$blockIp.'><i class="bi bi-person-x-fill text-white"></i></button>' ;
        
		$output['data'][] = array( 	
            $sum,
            $userip,
            $action
		); 	
	}
}
echo json_encode($output);
?>