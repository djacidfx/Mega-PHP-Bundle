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
$Statement = $pdo->prepare("SELECT * FROM anony_post WHERE post_status='0' and post_type = '0' order by id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$postId = _e($row['id']);
		$catId = _e($row['cat_id']) ;
        $categoryName = find_category_name($pdo,$catId) ;
		$post_title = strip_tags($row['post_title']);
		$post_image = '<a href="'.BASE_URL.'postImage/'._e($row['post_image']).'" class="spotlight" data-title="'.$post_title.'" ><img src="'.BASE_URL.'postImage/'._e($row['post_image']).'" class="img-fluid w-100"></a> ';
		$created_date = _e($row['post_date']);
		$created_date =  date('d F, Y',strtotime($created_date));
		$statuss = _e($row['post_status']);
		$like = _e($row['post_like']);
		$love = _e($row['post_love']);
		$view = _e($row['post_view']);
		if($statuss == 1) {
			// Deactivate Item
			$statuss = "<b class='text-success'>Active</b>";
			$activate_deactivate = '<button type="button" name="changePostStatus" id="'.$postId.'" class="btn btn-danger btn-sm changePostStatus" data-status="0"><i class="fa fa-ban"></i></button>';
		} else {
			// Activate Item
			$statuss = "<b class='text-danger'>Deactive</b>";
			$activate_deactivate = '<button type="button" name="changePostStatus" id="'.$postId.'" class="btn btn-success btn-sm changePostStatus" data-status="1"><i class="fa fa-check"></i></button>';
		}
		$editCategory = '<button type="button" name="changeCategory" id="'.$postId.'" class="btn btn-light btn-sm changeCategory" >ChangeCategory</button>';
        $editCaption = '<button type="button" name="editCaption" id="'.$postId.'" class="btn btn-light btn-sm editCaption" >EditCaption</button>';
		$editImage = '<button type="button" name="editPost" id="'.$postId.'" class="btn btn-light btn-sm editPost" >ReplaceImage</button>';
        $deletePost = '<button type="button" name="deletePost" id="'.$postId.'" class="btn btn-danger btn-sm deletePost" ><i class="fa fa-trash"></i></button>';
		$output['data'][] = array( 	
		    $sum,
            $postId,
            $post_title,
            $post_image,
            $categoryName,
            $created_date,
            $love,
            $like,
            $view,
            $statuss,
            $editCategory,
            $editCaption,
            $editImage,
            $activate_deactivate,
            $deletePost
		); 	
	}
}
echo json_encode($output);
?>