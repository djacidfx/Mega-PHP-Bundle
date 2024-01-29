<?php
ob_start();
session_start();
include("../config/database.php") ;
include("../functions.php") ;
include("../language/lang.php") ;
include("../mode/mode.php") ;
check_admin_logged_in($pdo);
$Statement = $pdo->prepare("SELECT * FROM ot_notes WHERE note_status = '0' order by note_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
$statusName = "" ;
$activeButton = "" ;
$password = "" ;
$download = "" ;
if($total > 0) {
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $id = _e($row['note_id']) ;
        $ip = _e($row['user_ip']) ;
        $noteUniqueId = _e($row['note_unique_id']) ;
        $created_date = _e($row['note_date']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $zipFile = _e($row['zip_file']) ;
        $status = _e($row['note_status']) ;
        if($status > '0'){
            $statusName = "<b class='text-success'>".userlang('read')."</b>" ;
            $download = '<button class="btn btn-danger btn-sm disabled">'.userlang("download_deleted").'</button>' ;
        } else {
            $statusName = "<b class='text-danger'>".userlang('unread')."</b>" ;
            $download = '<form action="'.ADMIN_URL.'download" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="zipfile" value="'.$zipFile.'">
                            <button type="submit" name="submit" class="btn btn-sm btn-success"><i class="bi bi-download me-1"></i> '.userlang('download').'</button>
                        </form>';
        }
        if(!empty($row['note_password'])){
            $password = "<b class='".colormode('default_text')."'>".userlang('yes')."</b>" ;
        } else {
            $password = "<b class='".colormode('default_text')."'>".userlang('no')."</b>" ;
        }
        $view = '<button class="btn btn-sm btn-primary viewNote" id="'.$id.'" ><i class="bi bi-eye"></i> '.userlang("view_note").'</button>' ;
        $activeButton = '<button class="btn btn-sm btn-danger delNote" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('delete_note').'" id="'.$id.'" ><i class="bi bi-trash"></i></button>' ;
        $activeButton .= '<button class="btn btn-sm btn-danger delNoteBlockIp ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('delete_note_with_ip').'" id="'.$id.'" ><i class="bi bi-slash-circle"></i></button>' ;
                
		$output['data'][] = array( 	
            $sum,
            $created_date,
            $id,
            $noteUniqueId,
            $ip,
            $view,
            $password,
            $statusName,
            $download,
            $activeButton
		); 	
	}
}
echo json_encode($output);
?>