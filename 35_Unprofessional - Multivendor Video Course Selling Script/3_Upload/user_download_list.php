<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_user_purchases WHERE purchase_user_id = '".$_SESSION['unprofessional']['id']."' and download_block = '0'  order by purchase_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $itemId = _e($row['purchase_item_id']) ;
        $itemImage = active_itempreview_by_id($pdo,$itemId) ;
		$title = long_title_by_id($pdo,$itemId) ;
        $shortUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
        $statuss = "";
        $download = "";
        $pause = '';
        $link = "" ;
        if(active_itemstatus_by_id($pdo,$itemId) > 0 ){
            if(active_itempause_by_id($pdo,$itemId) > 0){
                $link = '<a href="'.BASE_URL.'video/'.$itemId.'/'.$shortUrlTitle.'" class="btn btn-success btn-sm"><i class="fas fa-link"></i></a>';
                $statuss = '<button class="btn btn-success btn-sm" disabled >Active</button>';
            } else {
                $link = '<button class="btn btn-danger btn-sm" disabled >LinkNotAvailable</button>';
                $statuss = '<button class="btn btn-danger btn-sm" disabled >Paused</button>';
            }
           $download = active_mainfile_download_by_id($pdo,$itemId) ;
            
        } else {
            $statuss = '<button class="btn btn-danger btn-sm" disabled >Disabled/Deleted</button>';
            $download = '<button class="btn btn-danger btn-sm" disabled >DownloadNotAvailable</button>';
            $link = '<button class="btn btn-danger btn-sm" disabled >NotAvailable</button>';
        }
		$output['data'][] = array( 	
		$sum,	
		$itemImage,
		$title,
        $link,
        $statuss,
        $download
		); 	
	}
}
echo json_encode($output);
?>