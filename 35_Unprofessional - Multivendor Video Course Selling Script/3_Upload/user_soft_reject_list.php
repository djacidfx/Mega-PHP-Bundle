<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users_temp_video WHERE user_id = '".$_SESSION['unprofessional']['id']."' and item_soft_reject = '1' and upload_success = '0' order by item_time desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
        $tempId = _e($row['temp_id']) ;
		$title = strip_tags($row['item_title']);
        $comment = strip_tags(nl2br($row['reviewer_comment'])) ;
        $catId = _e($row['item_category']) ;
        $categoryName = category_name($pdo,$catId) ;
		$created_date = _e($row['item_time']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $instruction = strip_tags(nl2br($row['additonal_instruction'])) ;
        $titleIssue = _e($row['title_issue']) ;
        if($titleIssue == '1'){
            $titleIssue = 'Yes' ;
        } else {
            $titleIssue = 'No' ;
        }
        $priceIssue = _e($row['price_issue']) ;
        if($priceIssue == '1'){
            $priceIssue = 'Yes' ;
        } else {
            $priceIssue = 'No' ;
        }
        $descriptionIssue = _e($row['description_issue']) ;
        if($descriptionIssue == '1'){
            $descriptionIssue = 'Yes' ;
        } else {
            $descriptionIssue = 'No' ;
        }
        $tagsIssue = _e($row['tags_issue']) ;
        if($tagsIssue == '1'){
            $tagsIssue = 'Yes' ;
        } else {
            $tagsIssue = 'No' ;
        }
        $categoryIssue = _e($row['category_issue']) ;
        if($categoryIssue == '1'){
            $categoryIssue = 'Yes' ;
        } else {
            $categoryIssue = 'No' ;
        }
        $previewIssue = _e($row['preview_issue']) ;
        if($previewIssue == '1'){
            $previewIssue = 'Yes' ;
        } else {
            $previewIssue = 'No' ;
        }
        $demoIssue = _e($row['demo_issue']) ;
        if($demoIssue == '1'){
            $demoIssue = 'Yes' ;
        } else {
            $demoIssue = 'No' ;
        }
        $mainfileIssue = _e($row['mainfile_issue']) ;
        if($mainfileIssue == '1'){
            $mainfileIssue = 'Yes' ;
        } else {
            $mainfileIssue = 'No' ;
        }
        $edit = '<a href="'.BASE_URL.'softreject/'.$tempId.'" class="btn btn-sm btn-warning">Edit</a>' ;
		$output['data'][] = array( 	
            $sum,	
            $created_date,
            $title,
            $categoryName,
            $comment,
            $instruction,
            $titleIssue,
            $priceIssue,
            $descriptionIssue,
            $tagsIssue,
            $categoryIssue,
            $previewIssue,
            $demoIssue,
            $mainfileIssue,
            $edit
		); 	
	}
}
echo json_encode($output);
?>