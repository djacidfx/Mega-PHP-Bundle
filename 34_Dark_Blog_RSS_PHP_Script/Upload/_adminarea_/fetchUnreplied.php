<?php
ob_start();
session_start();
include("db/config.php");
include("db/post_functions.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
} 
$Statement = $pdo->prepare("SELECT * FROM anony_comment WHERE admin_reply is NULL order by comment_id desc ");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$active = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$id = _e($row['comment_id']) ;
		$userName = strip_tags($row['user_name']);
		$email = _e($row['user_email']) ;
        $postId = _e($row['post_id']) ;
        $postTitle = get_post_title($pdo,$postId) ;
        $delete = '<button type="button" name="deleteComment" id="'.$id.'" class="btn btn-danger btn-sm deleteComment"><i class="fa fa-trash"></i></button>';
        $view = '<a href="'.BASE_URL.'post/'.$postId.'" target="_blank" class="btn btn-sm btn-light"><i class="fa fa-eye"></i></a>';	
		$edit = '<a href="'.ADMIN_URL.'editcomment.php?id='.$id.'" class="btn btn-sm btn-light"><i class="fa fa-pencil-alt"></i></a>';
		
		$output['data'][] = array( 		
            $sum,
            $id,
            $userName,
            $email,
            $postTitle,
            $view,
            $edit,
            $delete
		); 	
	}
}
echo json_encode($output);
?>