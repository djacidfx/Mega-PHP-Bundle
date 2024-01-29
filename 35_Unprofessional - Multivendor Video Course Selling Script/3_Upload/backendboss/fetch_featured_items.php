<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_featured WHERE 1 order by featured_id desc ");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$active = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$itemId = _e($row['featured_item_id']) ;
		$title = long_title_by_id($pdo,$itemId) ;
		$price = "$".find_activeitem_price($pdo,$itemId)  ;
        $sales = active_itemsales_by_id($pdo,$itemId) ;
        $love = count_loves($pdo,$itemId) ;
        $view = count_active_item_view($pdo,$itemId) ;
        $shortUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
        $link = '<a href="'.BASE_URL.'video/'.$id.'/'.$shortUrlTitle.'" target="_blank" ><i class="fa fa-eye"></i></a>' ;
        $makeFeaturedAgain = '<button type="button" name="makeFeaturedAgain" id="'.$itemId.'" class="btn btn-success btn-sm makeFeaturedAgain">MakeFeaturedAgain</button>';		
		$output['data'][] = array( 		
            $sum,
            $itemId,
            $title,
            $price,
            $sales,
            $love,
            $view,
            $link,
            $makeFeaturedAgain
		); 	
	}
}
echo json_encode($output);
?>