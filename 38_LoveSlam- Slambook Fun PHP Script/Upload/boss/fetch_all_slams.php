<?php
include("database.php") ;
$Statement = $pdo->prepare("SELECT * FROM ot_slambook WHERE 1 order by slambook_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $id = _e($row['slambook_id']) ;
        $urlTitle =  urltitle_by_id($pdo,$id) ; 
        $name = strip_tags($row['username']) ;
        $userIp = filter_var($row['user_ip'], FILTER_VALIDATE_IP) ;
        $blockIp = base64_encode($userIp) ;
        $created_date = _e($row['slambook_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $action = '<a href="'.BASE_URL.'slam/'.$id.'/'.$urlTitle.'" target="_blank" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="View Slambook" ><i class="bi bi-eye text-white"></i></a>
        &ensp;
        <button class="btn btn-sm btn-danger blockIp" data-bs-toggle="tooltip" data-bs-placement="top" title="Block User IP" id="'.$blockIp.'"><i class="bi bi-slash-circle text-white"></i></button>
                    &ensp;
                    <button class="btn btn-sm btn-danger deleteSlam" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Slam & Answers" id="'.$id.'"><i class="bi bi-trash-fill text-white"></i></button>
                    
        
        ';
        $output['data'][] = array( 	
            $sum,
            $created_date,
            $userIp,
            $name,
            $action
		);
    }
}
echo json_encode($output);
?>