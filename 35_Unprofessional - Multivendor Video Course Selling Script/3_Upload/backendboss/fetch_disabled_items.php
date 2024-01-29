<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_video WHERE item_status = '0'  order by item_id desc ");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$active = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$itemId = _e($row['item_id']) ;
        $authorId = find_user_id_by_itemid($pdo,$itemId) ;
        $username = get_username_by_itemid($pdo,$itemId) ;
        $itemImage = '<img src='.BASE_URL.'mainImg/'._e($row['item_preview_image']).' class="img-fluid " >' ;
		$title = long_title_by_id($pdo,$itemId) ;
		$price = "$".find_activeitem_price($pdo,$itemId)  ;
        $sales = active_itemsales_by_id($pdo,$itemId) ;
        $love = count_loves($pdo,$itemId) ;
        $view = count_active_item_view($pdo,$itemId) ;
        $shortUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
        $created = _e($row['item_created_time']) ;
        $created = date('d F, Y',strtotime($created));
        $updated = _e($row['item_updated_time']) ;
        $updated = date('d F, Y',strtotime($updated));
        $rating = "<b>"._e($row['item_rating'])." Star</b>" ;
        $ratedBy = _e($row['item_rated_by'])." Users" ;
        $featured = _e($row['item_featured']) ;
        $delete = "" ;
        if($featured == '1'){
            $featured = "<b>Featured Item</b>" ;
        } else {
            $featured = "" ;
        }
        $status = _e($row['item_status']) ;
        if($status == '0'){
            if($row['item_delete'] == '1' ){
                $status = '<button type="button" id="'.$itemId.'" class="btn btn-success btn-sm enableItem">Enable</button>';
                $delete = '<button type="button" id="'.$itemId.'" class="btn btn-danger btn-sm deleteDisabledItem"><i class="fa fa-trash"></i></button>';
            } else {
                $status = '<button class="btn btn-danger btn-xs" disabled>Deleted</button>';
            }
            	
        } 
        	
        
		$output['data'][] = array( 		
            $sum,
            $authorId,
            $username,
            $itemId,
            $title,
            $itemImage,
            $created,
            $updated,
            $price,
            $sales,
            $love,
            $view,
            $rating,
            $ratedBy,
            $featured,
            $status,
            $delete
		); 	
	}
}
echo json_encode($output);
?>