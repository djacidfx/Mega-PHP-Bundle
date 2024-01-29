<?php
ob_start();
session_start();
include("../config/database.php") ;
include("../functions.php") ;
include("../language/lang.php") ;
include("../mode/mode.php") ;
check_admin_logged_in($pdo);
$Statement = $pdo->prepare("SELECT * FROM ot_zip WHERE zip_status = '1' order by zip_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
$statusName = "" ;
$activeButton = "" ;
$featuredDesign = "";
$popularDesign = "";
$makeFeatured = "";
$makePopular = "" ;
$approve = "";
$action = "";
if($total > 0) {
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $id = _e($row['zip_id']) ;
        $ip = _e($row['user_ip']) ;
        $zipName = _e($row['zip_name']) ;
        $zipDescription = _e($row['zip_description']) ;
        $created_date = _e($row['zip_date']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $status = _e($row['zip_status']) ;
        $featured = _e($row['zip_featured']) ;
        $popular = _e($row['zip_popular']) ;
        $zipFile = _e($row['zip_file']) ;
        $download = '<form action="'.ADMIN_URL.'download" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="zipfile" value="'.$zipFile.'">
                            <button type="submit" name="submit" class="btn btn-sm btn-success"><i class="bi bi-download me-1"></i>'.userlang('download').'</button>
                        </form>';
        if($status > '0'){
            $statusName = "<b class='text-success'>".userlang('active')."</b>" ;
        } else {
            $approve = '<button class="btn btn-sm btn-success approveZip" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('approve').' '.userlang('zip').'" id="'.$id.'" ><i class="bi bi-check"></i></button>' ;
            $statusName = "<b class='text-danger'>".userlang('pending')."</b>" ;
        }
        if($featured > '0'){
            $featuredDesign = "<b class='".colormode('default_text')."'>".userlang('featured')."</b>" ;
            $makeFeatured = '<button class="btn btn-sm btn-danger makeUnfeatured ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('make').' '.userlang('unfeatured').'" id="'.$id.'" ><i class="bi bi-bookmark-x"></i></button>' ;
        } else {
            $featuredDesign = "";
            $makeFeatured = '<button class="btn btn-sm btn-success makeFeatured ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('make').' '.userlang('featured').'" id="'.$id.'" ><i class="bi bi-bookmark"></i></button>' ;
        }
        if($popular > '0'){
            $popularDesign = "<b class='".colormode('default_text')."'>".userlang('popular')."</b>" ;
            $makePopular = '<button class="btn btn-sm btn-danger makeUnpopular ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('make').' '.userlang('unpopular').'" id="'.$id.'" ><i class="bi bi-reception-2"></i></button>' ;
        } else {
            $popularDesign = "";
            $makePopular = '<button class="btn btn-sm btn-success makePopular ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('make').' '.userlang('popular').'" id="'.$id.'" ><i class="bi bi-reception-4"></i></button>' ;
        }
        if(!empty($zipDescription)){
            $view = '<button class="btn btn-sm btn-primary viewNote" id="'.$id.'" ><i class="bi bi-eye"></i>'.userlang("view").' '.userlang("description").'</button>' ;
        } else {
            $view = "";
        }
        
        $activeButton = '<button class="btn btn-sm btn-danger delZip ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('delete_zip').'" id="'.$id.'" ><i class="bi bi-trash"></i></button>' ;
        $activeButton .= '<button class="btn btn-sm btn-danger delZipBlockIp ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('delete_zip_with_ip').'" id="'.$id.'" ><i class="bi bi-slash-circle"></i></button>' ;
        
        $action = $approve.$makeFeatured.$makePopular.$activeButton;
                
		$output['data'][] = array( 	
            $sum,
            $created_date,
            $id,
            $zipName,
            $ip,
            $view,
            $featuredDesign,
            $popularDesign,
            $statusName,
            $download,
            $action
		); 	
	}
}
echo json_encode($output);
?>