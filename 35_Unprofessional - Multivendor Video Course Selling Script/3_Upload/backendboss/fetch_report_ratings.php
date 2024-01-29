<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_ratings WHERE rating_report = '1' order by rating_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
foreach($result as $row) {
    $sum = $sum + 1 ;
    $id = _e($row['rating_id']) ;
    $buyerRating = _e($row['rating_star']) ;
    $buyerComment = _e($row['rating_comment']) ;
    $itemId = _e($row['rating_item_id']) ;
    $shortUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
    $sales = active_itemsales_by_id($pdo,$itemId) ; 
    $price = "<b>$".find_activeitem_price($pdo,$itemId)."</b>" ;
    $itemTitle = long_title_by_id($pdo,$itemId) ;
    $rating = "<b>".grab_rating_ofitem($pdo,$itemId)." Star</b>" ;
    $ratedBy = "<b>".grab_rated_by($pdo,$itemId)." Users</b>" ;
    $view = '<a href="'.BASE_URL.'video/'.$itemId.'/'.$shortUrlTitle.'" class="btn btn-light btn-sm"><i class="fa fa-eye"></i></a>' ;
    $delete = '<button class="btn btn-danger btn-sm deleteRatingRep" id="'.$id.'"><i class="fa fa-trash"></i></button>';
    $deny = '<button class="btn btn-success btn-sm denyDeleteRatingRep" id="'.$id.'">DenyReport</button>';
    $output['data'][] = array( 		
        $sum,
        $itemTitle,
        $price,
        $sales,
        $rating,
        $ratedBy,
        $view,
        $buyerRating,
        $buyerComment,
        $delete,
        $deny

    ); 	
}
echo json_encode($output);
?>