<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_video WHERE user_id = '".$_SESSION['unprofessional']['id']."' and item_pause = '0' and item_delete = '1' order by item_id desc");
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
		$sum = $sum + 1 ;
		$title = strip_tags($row['item_title']);
		$image = "<img src=".BASE_URL.'mainImg/'._e($row['item_preview_image'])." class='img-fluid' >";
		$statuss = _e($row['item_status']);
        if($statuss == '1' ){
            $statuss = "Paused" ;
        } else {
            $statuss = '<button class="btn btn-danger btn-sm d-inline-block" disabled>DisabledByAdmin</button>';
        }
        $comments = count_comments($pdo,$itemId) ;
		$created_date = _e($row['item_created_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $update_date = _e($row['item_updated_time']);
		$update_date =  date('d F, Y',strtotime($update_date));
        
        $action = '<button class="btn btn-success btn-sm unpauseItem" id="'.$itemId.'">Unpause</button>';
        $delete = '<button type="button" id="'.$itemId.'" class="btn btn-danger btn-sm deleteUserPausedItem"><i class="fa fa-trash"></i></button>';
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
            $action,
            $delete
		); 	
	}
}
echo json_encode($output);
?>