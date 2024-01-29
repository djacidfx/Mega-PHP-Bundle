<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_video WHERE user_id = '".$_SESSION['unprofessional']['id']."' and item_status = '0' and item_delete = '0' order by item_id desc");
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
		$sum = $sum + 1 ;
		$title = strip_tags($row['item_title']);
		$statuss = _e($row['item_status']);
        if($statuss == '0' ){
            if($row['item_delete'] == '0'){
               $statuss = '<button class="btn btn-danger btn-xs" disabled>Deleted</button>' ; 
            }
            
        } 
        $comments = count_comments($pdo,$itemId) ;
        
		$output['data'][] = array( 	
            $sum,
            $itemId,
            $title,
            $catName,
            $price,
            $sales,
            $rating,
            $ratedBy,
            $lovedBy,
            $views,
            $comments,
            $statuss
		); 	
	}
}
echo json_encode($output);
?>