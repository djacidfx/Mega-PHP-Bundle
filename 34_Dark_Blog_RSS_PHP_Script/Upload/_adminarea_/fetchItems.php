<?php
ob_start();
session_start();
include("db/config.php");
include("db/post_functions.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
}
$Statement = $pdo->prepare("SELECT * FROM anony_post WHERE 1 order by id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$postId = _e($row['id']);
		$catId = _e($row['cat_id']) ;
        $categoryName = find_category_name($pdo,$catId) ;
		$post_title = strip_tags($row['post_title']);
		$created_date = _e($row['post_date']);
		$created_date =  date('d F, Y',strtotime($created_date));
		$statuss = _e($row['post_status']);
		$featured = _e($row['post_featured']);
        $trending = _e($row['post_trending']);
        $featureLabel = "";
        $makeFeatured = "";
        $trendingLabel = "" ;
        $makeTrending = "";
		
		$like = _e($row['post_like']);
		$love = _e($row['post_love']);
		$view = _e($row['post_view']);
		if($statuss == 1) {
			// Deactivate Item
			$statuss = "<b class='text-success'>Active</b>";
			$activate_deactivate = '<button type="button" name="changeItemStatus" id="'.$postId.'" class="btn btn-danger btn-sm changeItemStatus" data-status="0"><i class="fa fa-ban"></i></button>';
            if($featured == '1') {
                $featureLabel = '<button class="btn btn-sm btn-warning" disabled="disabled">Featured</button>';
                $makeFeatured = '<button type="button" name="unFeaturedStatus" id="'.$postId.'" class="btn btn-danger btn-sm unFeaturedStatus">Unfeatured</button>';
            } else {
                $featureLabel = "";
                $makeFeatured = '<button type="button" name="changeFeaturedStatus" id="'.$postId.'" class="btn btn-success btn-sm changeFeaturedStatus">MakeFeatured</button>';
            }
            if($trending == '1') {
                $trendingLabel = '<button class="btn btn-sm btn-warning" disabled="disabled">Trending</button>';
                $makeTrending = '<button type="button" name="unTrendingStatus" id="'.$postId.'" class="btn btn-danger btn-sm unTrendingStatus">Untrending</button>';
            } else {
                $trendingLabel = "";
                $makeTrending = '<button type="button" name="changeTrendingStatus" id="'.$postId.'" class="btn btn-success btn-sm changeTrendingStatus">MakeTrending</button>';
            }
		} else {
			// Activate Item
			$statuss = "<b class='text-danger'>Deactive</b>";
			$activate_deactivate = '<button type="button" name="changePostStatus" id="'.$postId.'" class="btn btn-success btn-sm changePostStatus" data-status="1"><i class="fa fa-check"></i></button>';
		}
		
		$edit = '<a href="'.ADMIN_URL.'createblog.php?id='.$postId.'" class="btn btn-light btn-sm" ><i class="fa fa-pencil-alt"></i></a>';
        $deletePost = '<button type="button" name="deletePost" id="'.$postId.'" class="btn btn-danger btn-sm deletePost" ><i class="fa fa-trash"></i></button>';
		$output['data'][] = array( 	
            $sum,
            $postId,
            $post_title,
            $categoryName,
            $created_date,
            $love,
            $like,
            $view,
            $statuss,
            $featureLabel,
            $makeFeatured,
            $trendingLabel,
            $makeTrending,
            $edit,
            $activate_deactivate,
            $deletePost
		); 	
	}
}
echo json_encode($output);
?>