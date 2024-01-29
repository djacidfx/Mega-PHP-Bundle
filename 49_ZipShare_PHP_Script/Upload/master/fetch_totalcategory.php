<?php
ob_start();
session_start();
include("../config/database.php") ;
include("../functions.php") ;
include("../language/lang.php") ;
include("../mode/mode.php") ;
check_admin_logged_in($pdo);
$Statement = $pdo->prepare("SELECT * FROM ot_category WHERE 1 order by cat_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
$activeButton = "" ;
$statusButton = "" ;
if($total > 0) {
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $id = _e($row['cat_id']) ;
        $catName = _e($row['category_name']) ;
        $created_date = _e($row['category_date']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $status = _e($row['category_status']) ;
        if($status == 0){
            $statusButton = '<button class="btn btn-sm btn-success enableCategory ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('activate').' '.userlang('category').'" id="'.$id.'" ><i class="bi bi-check"></i></button>';
        } else {
            $statusButton = '<button class="btn btn-sm btn-danger disableCategory ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('deactivate').' '.userlang('category').'" id="'.$id.'" ><i class="bi bi-slash-circle"></i></button>';
        }
        $activeButton = '<button class="btn btn-sm btn-success editCategory" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('edit').' '.userlang('category').'" id="'.$id.'" ><i class="bi bi-pencil"></i></button>'.$statusButton.'<button class="btn btn-sm btn-danger delCategory ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('delete').' '.userlang('category').'" id="'.$id.'" ><i class="bi bi-trash"></i></button>' ;
                
		$output['data'][] = array( 	
            $sum,
            $created_date,
            $id,
            $catName,
            $activeButton
		); 	
	}
}
echo json_encode($output);
?>