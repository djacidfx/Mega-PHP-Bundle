<?php
include("database.php") ;
$Statement = $pdo->prepare("SELECT * FROM ot_questions WHERE 1 order by quest_id asc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $id = _e($row['quest_id']) ;
        $question = strip_tags($row['question']) ;
        $created_date = _e($row['question_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $action = '<button class="btn btn-sm btn-danger editQuest" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Question" id="'.$id.'"><i class="bi bi-pencil-square text-white"></i></button>
                    &ensp;
                    <button class="btn btn-sm btn-danger deleteQuest" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Question" id="'.$id.'"><i class="bi bi-trash-fill text-white"></i></button>
                    
        
        ';
        $output['data'][] = array( 	
            $sum,
            $created_date,
            $question,
            $action
		);
    }
}
echo json_encode($output);
?>