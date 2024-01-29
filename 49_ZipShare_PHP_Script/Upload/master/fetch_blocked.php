<?php
ob_start();
session_start();
include("../config/database.php") ;
include("../functions.php") ;
include("../language/lang.php") ;
include("../mode/mode.php") ;
check_admin_logged_in($pdo);
$Statement = $pdo->prepare("SELECT * FROM ot_blocked_ip WHERE 1 order by blocked_ip desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
$activeButton = "" ;
if($total > 0) {
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $id = _e($row['blocked_ip']) ;
        $ip = _e($row['ip_address']) ;
        $created_date = _e($row['block_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        
        $activeButton = '<button class="btn btn-sm btn-danger unBlockIp ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('unblock_ip').'" id="'.$id.'" ><i class="bi bi-trash"></i></button>' ;
                
		$output['data'][] = array( 	
            $sum,
            $created_date,
            $ip,
            $activeButton
		); 	
	}
}
echo json_encode($output);
?>