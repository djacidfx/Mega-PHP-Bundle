<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_hr_subject WHERE 1 order by hr_sub_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$reason = nl2br($row['hr_sub_title']);
        $hrId = _e($row['hr_sub_id']) ;
		$statuss = _e($row['hr_sub_status']);
        if($statuss == '1'){
            $statuss = "Active" ;
            $edit = '<button class="btn btn-sm btn-danger deactivateHrSubTitle" id="'.$hrId.'"><i class="fa fa-ban d-inline"></i>Deactivate</button>';
        } else{
            $statuss = "Deactive" ;
            $edit = '<button class="btn btn-sm btn-success activateHrSubTitle" id="'.$hrId.'"><i class="fa fa-check d-inline"></i>Activate</button>';
        }
        
        $action = '<button class="btn btn-sm btn-primary editHrSubTitle" id="'.$hrId.'"><i class="fa fa-pencil-alt d-inline"></i>Edit</button>';
		$output['data'][] = array( 	
		$sum,
        $hrId,
		$reason,
        $statuss,
        $edit,
        $action
		); 	
	}
}
echo json_encode($output);
?>