<?php
include("database.php") ;
$Statement = $pdo->prepare("SELECT * FROM ot_secrets WHERE 1 order by id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$postId = _e($row['id']);
		$post_title = strip_tags($row['title']);
		$created_date = _e($row['secret_date']);
		$created_date =  date('d F, Y',strtotime($created_date));
        $userip = _e($row['user_ip']) ;
        $views = _e($row['views']) ;
        $loves = _e($row['loves']) ;
        $comments = count_comment($pdo,$postId) ;
        $status = "" ;
        $action = "" ;
		$featured = _e($row['featured']) ;
		$trending = _e($row['trending']) ;
		$seen = _e($row['admin_seen']) ;
        $blockIp = base64_encode($userip) ;
        if($seen == '1') {
            $seen = '<button class="btn btn-sm btn-grey" data-bs-toggle="tooltip" data-bs-placement="top" title="Seen"><i class="bi bi-eye text-warning"></i></button>' ;
        } else {
            $seen = '<button class="btn btn-sm btn-grey" data-bs-toggle="tooltip" data-bs-placement="top" title="Unseen"><i class="bi bi-eye-slash text-danger"></i></button>' ;
        }
        if($featured == '1') {
            $status = '<button class="btn btn-sm btn-grey" data-bs-toggle="tooltip" data-bs-placement="top" title="Featured" id="'.$postId.'"><i class="bi bi-bookmark-star text-warning"></i></button>' ;
            $action = '<button class="btn btn-sm btn-danger makeOnlyUnfeatured" data-bs-toggle="tooltip" data-bs-placement="top" title="Make UnFeatured" id="'.$postId.'"><i class="bi bi-bookmark-x-fill text-white"></i></button>
                        &ensp;
                        <button class="btn btn-sm btn-danger makeUnfeaturedTrending" data-bs-toggle="tooltip" data-bs-placement="top" title="Make Unfeatured & Make Trending" id="'.$postId.'"><i class="bi bi-graph-up text-white"></i></button>
                        &ensp;
                        <a href="'.ADMIN_URL.'edit?id='.$postId.'" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="View / Edit" ><i class="bi bi-pencil-square text-white"></i></a>
                        &ensp;
                        <button class="btn btn-sm btn-danger deletePost" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently Delete" id="'.$postId.'"><i class="bi bi-trash-fill text-white"></i></button>
                        &ensp;
                        <button class="btn btn-sm btn-danger deletePostBlock" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Post & Block IP" id="'.$postId.'" data-status = '.$blockIp.'><i class="bi bi-person-x-fill text-white"></i></button>
            ' ;
        }
        if($trending == '1') {
            $status = '<button class="btn btn-sm btn-grey" data-bs-toggle="tooltip" data-bs-placement="top" title="Trending" id="'.$postId.'"><i class="bi bi-graph-up text-success"></i></button>' ;
            $action = '<button class="btn btn-sm btn-danger makeOnlyUntrending" data-bs-toggle="tooltip" data-bs-placement="top" title="Make UnTrending" id="'.$postId.'"><i class="bi bi-graph-down text-white"></i></button>
                        &ensp;
                        <button class="btn btn-sm btn-danger makeUnTrendingFeatured" data-bs-toggle="tooltip" data-bs-placement="top" title="Make UnTrending & Make Featured" id="'.$postId.'"><i class="bi bi-bookmark-star text-white"></i></button>
                        &ensp;
                        <a href="'.ADMIN_URL.'edit?id='.$postId.'" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="View / Edit" ><i class="bi bi-pencil-square text-white"></i></a>
                        &ensp;
                        <button class="btn btn-sm btn-danger deletePost" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently Delete" id="'.$postId.'"><i class="bi bi-trash-fill text-white"></i></button>
                        &ensp;
                        <button class="btn btn-sm btn-danger deletePostBlock" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Post & Block IP" id="'.$postId.'" data-status = '.$blockIp.'><i class="bi bi-person-x-fill text-white"></i></button>
            ' ;
        }
        if(($featured == '0') && ($trending == 0)){
            $status = "" ;
            $action = '<button class="btn btn-sm btn-danger makeOnlyFeatured" data-bs-toggle="tooltip" data-bs-placement="top" title="Make Featured" id="'.$postId.'"><i class="bi bi-bookmark-star text-white"></i></button>
                        &ensp;
                        <button class="btn btn-sm btn-danger makeOnlyTrending" data-bs-toggle="tooltip" data-bs-placement="top" title="Make Trending" id="'.$postId.'"><i class="bi bi-graph-up text-white"></i></button>
                        &ensp; 
                        <a href="'.ADMIN_URL.'edit?id='.$postId.'" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="View / Edit" ><i class="bi bi-pencil-square text-white"></i></a>
                        &ensp;
                        <button class="btn btn-sm btn-danger deletePost" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently Delete" id="'.$postId.'"><i class="bi bi-trash-fill text-white"></i></button>
                        &ensp;
                        <button class="btn btn-sm btn-danger deletePostBlock" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Post & Block IP" id="'.$postId.'" data-status = '.$blockIp.'><i class="bi bi-person-x-fill text-white"></i></button>
            ' ;
        }
		$output['data'][] = array( 	
            $sum,
            $userip,
            $postId,
            $post_title,
            $created_date,
            $views,
            $loves,
            $comments,
            $seen,
            $status,
            $action
		); 	
	}
}
echo json_encode($output);
?>