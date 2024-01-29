<?php
ob_start();
session_start();
include("../config/database.php") ;
include("../functions.php") ;
include("../language/lang.php") ;
include("../mode/mode.php") ;
check_admin_logged_in($pdo);
$Statement = $pdo->prepare("SELECT * FROM ot_blogs WHERE blog_status = '0' order by blog_id desc");
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
        $id = _e($row['blog_id']) ;
        $blogName = strip_tags($row['blog_title']) ;
        $blogSlug = strip_tags($row['blog_slug']) ;
        $blogImage = '<img src="'.BASE_URL.'blogimages/'._e($row['blog_image']).'" class="img-fluid smallblogthumbnail spotlight mouse">';
        $created_date = _e($row['blog_date']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $status = _e($row['blog_status']) ;
        if($status == 0){
            $statusButton = '<button class="btn btn-sm btn-success enableBlog ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('activate').' '.userlang('singleblog').'" id="'.$id.'" ><i class="bi bi-check"></i></button>';
        } else {
            $statusButton = '<button class="btn btn-sm btn-danger disableBlog ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('deactivate').' '.userlang('singleblog').'" id="'.$id.'" ><i class="bi bi-slash-circle"></i></button>';
        }
        $activeButton = '<a href="'.ADMIN_URL.'edit_blog/'.$blogSlug.'" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('edit').' '.userlang('singleblog').'" id="'.$id.'" ><i class="bi bi-pencil"></i></a>'.$statusButton.'<button class="btn btn-sm btn-danger delBlog ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('delete').' '.userlang('singleblog').'" id="'.$id.'" ><i class="bi bi-trash"></i></button>' ;
                
		$output['data'][] = array( 	
            $sum,
            $created_date,
            $id,
            $blogName,
            $blogImage,
            $activeButton
		); 	
	}
}
echo json_encode($output);
?>