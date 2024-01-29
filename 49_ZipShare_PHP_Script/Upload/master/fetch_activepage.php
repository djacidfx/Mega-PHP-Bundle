<?php
ob_start();
session_start();
include("../config/database.php") ;
include("../functions.php") ;
include("../language/lang.php") ;
include("../mode/mode.php") ;
check_admin_logged_in($pdo);
$Statement = $pdo->prepare("SELECT * FROM ot_pages WHERE page_status = '1' order by page_id desc");
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
        $id = _e($row['page_id']) ;
        $pageName = strip_tags($row['page_name']) ;
        $pageSlug = strip_tags($row['page_slug']) ;
        $created_date = _e($row['page_date']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $status = _e($row['page_status']) ;
        if($status == 0){
            $statusButton = '<button class="btn btn-sm btn-success enablePage ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('activate').' '.userlang('singlepage').'" id="'.$id.'" ><i class="bi bi-check"></i></button>';
        } else {
            $statusButton = '<button class="btn btn-sm btn-danger disablePage ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('deactivate').' '.userlang('singlepage').'" id="'.$id.'" ><i class="bi bi-slash-circle"></i></button>';
        }
        $activeButton = '<a href="'.ADMIN_URL.'edit_page/'.$pageSlug.'" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('edit').' '.userlang('singlepage').'" id="'.$id.'" ><i class="bi bi-pencil"></i></a>'.$statusButton.'<button class="btn btn-sm btn-danger delPage ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('delete').' '.userlang('singlepage').'" id="'.$id.'" ><i class="bi bi-trash"></i></button>' ;
                
		$output['data'][] = array( 	
            $sum,
            $created_date,
            $id,
            $pageName,
            $activeButton
		); 	
	}
}
echo json_encode($output);
?>