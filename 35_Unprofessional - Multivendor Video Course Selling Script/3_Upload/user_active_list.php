<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_video WHERE user_id = '".$_SESSION['unprofessional']['id']."' and item_pause = '1' and item_delete = '1' order by item_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
        $itemId = _e($row['item_id']) ;
        $catId = _e($row['item_category']) ;
        $catName = category_name($pdo,$catId) ;
        $price = "<b>$ "._e($row['item_price']).'</b>' ;
        $sales = _e($row['item_sale']) ;
        $rating = _e($row['item_rating'])." Star" ;
        $ratedBy = _e($row['item_rated_by'])." User" ;
        $lovedBy = _e($row['item_love'])." Love" ;
        $views = _e($row['item_viewed']) ;
        $shortUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
        $itemLink = '' ;
		$sum = $sum + 1 ;
		$title = strip_tags($row['item_title']);
		$image = "<img src=".BASE_URL.'mainImg/'._e($row['item_preview_image'])." class='img-fluid' >";
		$statuss = _e($row['item_status']);
        $edit = '';
        if($statuss == '1' ){
            $statuss = "Active" ;
            $itemLink = '<a href="'.BASE_URL.'video/'.$itemId.'/'.$shortUrlTitle.'" class="btn btn-success btn-sm"><i class="fas fa-link"></i></a>' ;
            $edit = '<a href="'.BASE_URL.'edititem/'.$itemId.'" class="btn btn-sm btn-light"><i class="fas fa-pencil-alt"></i></a>';
        } else {
            $statuss = '<button class="btn btn-danger btn-sm d-inline-block" disabled>DisabledByAdmin</button>';
            $itemLink = '<button class="btn btn-danger btn-sm" disabled>LinkNotAvailable</button>' ;
            $edit = '';
        }
        $comments = count_comments($pdo,$itemId) ;
		$created_date = _e($row['item_created_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $update_date = _e($row['item_updated_time']);
		$update_date =  date('d F, Y',strtotime($update_date));
        
        $action = '<button class="btn btn-danger btn-sm pauseItem" id="'.$itemId.'">Pause</button>';
        $mainfile = active_mainfile_download_by_id($pdo,$itemId);
		$output['data'][] = array( 	
            $sum,
            $itemId,
            $created_date,
            $image,
            $title,
            $catName,
            $update_date,
            $price,
            $sales,
            $rating,
            $ratedBy,
            $lovedBy,
            $views,
            $comments,
            $statuss,
            $itemLink,
            $action,
            $edit,
            $mainfile
		); 	
	}
}
echo json_encode($output);
?>