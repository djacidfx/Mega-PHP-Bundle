<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_video WHERE item_status = '1' and item_pause = '1' and item_featured = '0' order by item_id asc ");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$active = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$id = _e($row['item_id']) ;
		$title = strip_tags($row['item_title']);
		$price = "$"._e($row['item_price']) ;
        $sales = _e($row['item_sale']) ;
        $love = _e($row['item_love']) ;
        $view = _e($row['item_viewed']) ;
        $shortUrlTitle = item_urltitle_by_id($pdo,$id) ;
        $link = '<a href="'.BASE_URL.'video/'.$id.'/'.$shortUrlTitle.'" target="_blank" ><i class="fa fa-eye"></i></a>' ;
        $makeFeatured = '<button type="button" name="makeFeatured" id="'.$id.'" class="btn btn-success btn-sm makeFeatured">MakeFeatured</button>';		
		$output['data'][] = array( 		
            $sum,
            $id,
            $title,
            $price,
            $sales,
            $love,
            $view,
            $link,
            $makeFeatured
		); 	
	}
}
echo json_encode($output);
?>