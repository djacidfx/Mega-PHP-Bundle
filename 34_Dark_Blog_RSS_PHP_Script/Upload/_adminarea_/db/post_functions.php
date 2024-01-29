<?php
function _e($string) {
	return htmlentities(strip_tags($string), ENT_QUOTES, 'UTF-8');
}
function code($no_of_char){
		$code='';
		$possible_char="0123456789";
		while($no_of_char>0)
			{
				$code.=substr($possible_char, rand(0, strlen($possible_char)-1), 1);
				$no_of_char--;
			}
		return $code;
}
function get_official_post($pdo){
	$limit = "3";
	$sql = "SELECT count(*) as number_rows FROM anony_post WHERE post_status = '1' and post_trending = '1' order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_post WHERE post_status = '1'  and post_trending = '1' order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	$output .= '<div class="col-lg-12 border border-top-0 border-left-0 border-right-0 border-light mb-3 "><h2 class="text-light"><i class="fa fa-signal text-warning"></i> Trending
				<a class="btn btn-success btn-sm float-right" href="'.BASE_URL.'trending"> Browse All</a>
				</h2>
                </div>
				<hr>
				';
	foreach($result as $row)
	{
		$postId = strip_tags($row['id']);
		$postTitle = get_post_title($pdo,$postId) ;
		$postDate = get_post_date($pdo,$postId) ;
		$trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-signal newFontTag"></i>  Trending</span>' ;
		$output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
		';
		
	}
	
    }
    
	return ($output);
}

function get_featured_post($pdo){
    $limit = "3" ;
	$query = "SELECT * FROM anony_post WHERE post_status = '1' and post_featured= '1'  order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
    $output .= '<div class="col-lg-12 border border-top-0 border-left-0 border-right-0 border-light mb-3 mt-3"><h2 class="text-light"><i class="fa fa-diamond text-warning"></i> Featured
				<a class="btn btn-success btn-sm float-right" href="'.BASE_URL.'featured"> Browse All</a>
				</h2>
                </div>
				<hr>
				';
        foreach($result as $row)
        {
            $postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
            $postImage = '<a href="'.BASE_URL.'postImage/'._e($row['post_image']).'" class="spotlight" data-title="'.$postTitle.'" ><img src="'.BASE_URL.'postImage/'._e($row['post_image']).'" class="img-fluid postImage w-100" ></a>' ;
            $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-diamond newFontTag"></i>  Featured</span>' ;
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';
        }
    }
	return ($output);
}

function get_official_post_default($pdo) {
    $limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM anony_post WHERE post_status = '1' and post_trending = '1'  order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_post WHERE post_status = '1'  and post_trending = '1' order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	$output .= '<div class="col-lg-12 border border-top-0 border-left-0 border-right-0 border-light mb-3 mt-3"><h2 class="text-light"><i class="fa fa-signal text-warning"></i> Trending Blogs
				</h2>
                </div>
				<hr>
				';
        foreach($result as $row)
        {
            $postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
            $postImage = '<a href="'.BASE_URL.'postImage/'._e($row['post_image']).'" class="spotlight" data-title="'.$postTitle.'" ><img src="'.BASE_URL.'postImage/'._e($row['post_image']).'" class="img-fluid postImage w-100" ></a>' ;
            $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-signal newFontTag"></i>  Trending</span>' ;
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$postId.'">
					<div class="show_more_official_item" id="show_more_official_item'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_allofficial_item btn btn-dark btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    }
    
	return ($output);
}

function get_official_post_onload($pdo) {

	$limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM anony_post WHERE post_status='1'  and post_trending = '1' and id < ".$_GET['id']." order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_post WHERE post_type = '1' and post_status = '1' and post_trending = '1' and id < ".$_GET['id']." order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    
	foreach($result as $row)
	{
		$postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
        $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-signal newFontTag"></i>  Trending</span>' ;
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';
		
	}
    
	if(empty($postId)){
			$postId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$postId.'">
					<div class="show_more_official_item" id="show_more_official_item'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_allofficial_item btn btn-dark btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		} else {
			$output .='<div class="empty"></div>';
		}
	return ($output);

}

function get_featured_post_default($pdo) {
    $limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM anony_post WHERE post_status = '1'   and post_featured = '1' order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_post WHERE post_status = '1'   and post_featured = '1' order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	$output .= '<div class="col-lg-12 border border-top-0 border-left-0 border-right-0 border-light mb-3 mt-3"><h2 class="text-light"><i class="fa fa-diamond text-warning"></i> Featured Blogs
				</h2>
                </div>
				<hr>
				';
        foreach($result as $row)
        {
            $postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
            $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-diamond newFontTag"></i>  Featured</span>' ;
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$postId.'">
					<div class="show_more_featured_item" id="show_more_featured_item'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_allfeatured_item btn btn-dark btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    }
    
	return ($output);
}

function get_featured_post_onload($pdo) {

	$limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM anony_post WHERE  post_status='1'  and post_featured = '1' and id < ".$_GET['id']." order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_post WHERE  post_status = '1' and post_featured = '1' and id < ".$_GET['id']." order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    
	foreach($result as $row)
	{
		$postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
        $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-diamond newFontTag"></i>  Featured</span>' ;
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';
		
	}
    
	if(empty($postId)){
			$postId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$postId.'">
					<div class="show_more_featured_item" id="show_more_featured_item'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_allfeatured_item btn btn-dark btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		} else {
			$output .='<div class="empty"></div>';
		}
	return ($output);

}

function get_user_post_default($pdo){
	$limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM anony_post WHERE post_status = '1'  and post_featured != '1' and post_trending != '1' order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_post WHERE post_status = '1'  and post_featured != '1' and post_trending != '1' order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	$output .= '<div class="col-lg-12 border border-top-0 border-left-0 border-right-0 border-light mb-3 mt-3"><h2 class="text-light"><i class="fa fa-star text-warning"></i> New
				
				</h2>
                </div>
				<hr>
				';
        foreach($result as $row)
        {
            $postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
            $postImage = '<a href="'.BASE_URL.'postImage/'._e($row['post_image']).'" class="spotlight" data-title="'.$postTitle.'" ><img src="'.BASE_URL.'postImage/'._e($row['post_image']).'" class="img-fluid postImage w-100" ></a>' ;
            $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-star newFontTag"></i>  New</span>' ;
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$postId.'">
					<div class="show_more_new_item" id="show_more_new_item'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_newest_item btn btn-dark btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    }
    
	return ($output);
}

function get_other_post_onload($pdo) {

	$limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM anony_post WHERE   post_status='1' and post_trending != '1'  and post_featured != '1' and id < ".$_GET['id']." order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_post WHERE  post_status = '1' and post_trending != '1' and post_featured != '1' and id < ".$_GET['id']." order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    
	foreach($result as $row)
	{
		$postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
            $postImage = '<a href="'.BASE_URL.'postImage/'._e($row['post_image']).'" class="spotlight" data-title="'.$postTitle.'" ><img src="'.BASE_URL.'postImage/'._e($row['post_image']).'" class="img-fluid postImage w-100" ></a>' ;
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';
		
	}
    
	if(empty($postId)){
			$postId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$postId.'">
					<div class="show_more_new_item" id="show_more_new_item'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_newest_item btn btn-dark btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		} else {
			$output .='<div class="empty"></div>';
		}
	return ($output);

}

function get_category_post_default($pdo,$catId) {
    $limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM anony_post WHERE post_status = '1' and cat_id = '".$catId."' order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_post WHERE post_status = '1'  and cat_id = '".$catId."' order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
    $categoryName = find_category_name($pdo,$catId) ; 
	if($total > 0) {
	$output .= '<div class="col-lg-12 border border-top-0 border-left-0 border-right-0 border-light mb-3 mt-3"><h2 class="text-light"><i class="fa fa-bookmark text-warning"></i> '.$categoryName.'
				
				</h2>
                </div>
				<hr>
				';
        foreach($result as $row)
        {
            $postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
            
            $featured = _e($row['post_featured']) ;
            $official = _e($row['post_trending']) ;
            $trendingBadge = "";
            if($featured == '1' || $official == '1'){
               $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-diamond newFontTag"></i>  Featured</span>' ; 
            }
            if($official == '1' && $featured == '0'){
                $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-signal newFontTag"></i>  Trending</span>' ; 
            }
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$postId.'">
					<div class="show_more_category_item" id="show_more_category_item'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_allcategory_item btn btn-dark btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    }
    
	return ($output);
}

function get_category_post_onload($pdo,$catId) {

	$limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM anony_post WHERE cat_id = '".$catId."'  and post_status='1'  and id < ".$_GET['id']." order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_post WHERE cat_id = '".$catId."'  and post_status = '1'  and id < ".$_GET['id']." order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    
	foreach($result as $row)
	{
		$postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
            
            $featured = _e($row['post_featured']) ;
            $official = _e($row['post_trending']) ;
            $trendingBadge = "";
            if($featured == '1' || $official == '1'){
               $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-diamond newFontTag"></i>  Featured</span>' ; 
            }
            if($official == '1' && $featured == '0'){
                $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-signal newFontTag"></i>  Trending</span>' ; 
            }
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';
		
	}
    
	if(empty($postId)){
			$postId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$postId.'">
					<div class="show_more_category_item" id="show_more_category_item'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_allcategory_item btn btn-dark btn-sm ann'.$catId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		} else {
			$output .='<div class="empty"></div>';
		}
	return ($output);

}

function get_searched_post($pdo,$search){	
	$limit = get_limit_default($pdo);
	$newstring = implode(", ", preg_split("/[\s]+/", $search));
	$sql = "SELECT count(*) as number_rows FROM `anony_post` WHERE post_status ='1' and (post_title LIKE '%$search%' OR post_description LIKE '%$newstring%')" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM `anony_post` WHERE post_status ='1' and (post_title LIKE '%$search%' OR post_description LIKE '%$newstring%') order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = $statement->rowCount();
	$output = '';
	if($total > 0) {
	
	foreach($result as $row)
	{
		$postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
        $featured = _e($row['post_featured']) ;
        $official = _e($row['post_trending']) ;
            $trendingBadge = "";
            if($featured == '1' || $official == '1'){
               $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-diamond newFontTag"></i>  Featured</span>' ; 
            }
            if($official == '1' && $featured == '0'){
                $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-signal newFontTag"></i>  Trending</span>' ; 
            }
        
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';
		
	
	}
	if(empty($postId)){
			$postId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_search" id="show_more_new_search'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_newest_search btn btn-dark btn-sm ann'.$search.'" >Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> Sorry, Nothing Found. Try with other Search Term.</h3>';
	}
	return ($output);
}
function get_searched_post_onload($pdo,$search,$postId){
	
	$limit = get_limit_default($pdo);
	$newstring = implode(", ", preg_split("/[\s]+/", $search));
	$sql = "SELECT count(*) as number_rows FROM `anony_post` WHERE post_status ='1' and id < '".$postId."' and (post_title LIKE '%$search%' OR post_description LIKE '%$newstring%')" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM `anony_post` WHERE post_status ='1' and id < '".$postId."' and (post_title LIKE '%$search%' OR post_description LIKE '%$newstring%') order by id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = $statement->rowCount();
	$output = '';
	if($total > 0) {
	
	foreach($result as $row)
	{
		$postId = strip_tags($row['id']);
            $postTitle = get_post_title($pdo,$postId) ;
            $postDate = get_post_date($pdo,$postId) ;
        $featured = _e($row['post_featured']) ;
        $official = _e($row['post_trending']) ;
            $trendingBadge = "";
            if($featured == '1' || $official == '1'){
               $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-diamond newFontTag"></i>  Featured</span>' ; 
            }
            if($official == '1' && $featured == '0'){
                $trendingBadge = '<span class="notify-badge bg-warning text-dark newFontTag"><i class="fa fa-signal newFontTag"></i>  Trending</span>' ; 
            }
            $output .= '<div class="col-lg-4  shadow mt-2">
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					'.$trendingBadge.'
					  <div class="card-header bg-dark text-white"><h6 class="card-title">'.$postDate.'</h6></div>
					  <div class="card-body postH">
						<a href="'.BASE_URL.'post/'.$postId.'" class="text-white">'.$postTitle.'</a>
					  </div>
					  <div class="card-footer">
					  <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span>&ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).'  &ensp; <a href="'.BASE_URL.'post/'.$postId.'"><i class="fa fa-external-link-square myFa text-white"></i></a> &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a> &ensp;
					  
					  </div>
					</div>
		            </div>
            ';
		
	
	}
	if(empty($postId)){
			$postId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_search" id="show_more_new_search'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_newest_search btn btn-dark btn-sm ann'.$search.'" >Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	} 
	return ($output);

}
function check_duplicate_caption($pdo,$caption){
	$query = "SELECT * FROM anony_post WHERE post_title = '".$caption."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function get_selected_category($pdo,$postId){
    $query = "SELECT * FROM anony_post WHERE id = '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $catId = _e($row['cat_id']) ;
		$output .= '<option value="'._e($row['id']).'">'.strip_tags(find_category_name($pdo,$catId)).'</option>"';
	}
	return ($output);
}
function not_selected_category($pdo,$catId){
    $query = "SELECT * FROM anony_category WHERE id != '".$catId."' and category_status = '1' order by category_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        
		$output .= '<option value="'._e($row['id']).'">'.strip_tags($row['category_name']).'</option>"';
	}
	return ($output);
}

function active_category_select($pdo){
    $query = "SELECT * FROM anony_category WHERE category_status = '1' order by category_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        
		$output .= '<option value="'._e($row['id']).'">'.strip_tags($row['category_name']).'</option>"';
	}
	return ($output);
}

function find_image_name($pdo,$postId){
    $query = "SELECT * FROM anony_post WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
	{
        
		$output .= _e($row['post_image']) ;
	}
	return ($output);
}

function find_image_for_metatags($pdo,$postId){
    $query = "SELECT * FROM anony_post WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
	{
        
		$output .= '<img src="'.BASE_URL.'postImage/'._e($row['post_image']).'"> '  ;
	}
	return ($output);
}

function find_category_name($pdo,$catId){
    $query = "SELECT * FROM anony_category WHERE id='".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
	{
        
		$output .= _e($row['category_name']) ;
	}
	return ($output);
}

function find_category_by_postid($pdo,$postId){
    $query = "SELECT * FROM anony_post WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
	{
        
		$output .= _e($row['cat_id']) ;
	}
	return ($output);
}

function check_category_status($pdo,$catId){
   $query = "SELECT * FROM anony_category WHERE category_status='1' and id='".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ; 
}
    
function count_total_post($pdo){
	$query = "SELECT * FROM anony_post WHERE 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_total_active_post($pdo){
	$query = "SELECT * FROM anony_post WHERE post_status='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_total_deactive_post($pdo){
	$query = "SELECT * FROM anony_post WHERE post_status='0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_comments($pdo){
	$query = "SELECT * FROM anony_comment WHERE 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_total_replied_comment($pdo){
	$query = "SELECT * FROM anony_comment WHERE admin_reply != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_total_unreplied_comment($pdo){
	$query = "SELECT * FROM anony_comment WHERE admin_reply is NULL";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function approve_message($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row['approve_message']);
	}
	return ($output);
}
function already_liked_message($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row['already_liked']);
	}
	return ($output);
}
function already_loved_message($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row['already_loved']);
	}
	return ($output);
}
function get_limit_default($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row["default_load"]) ;
	}
	return ($output);
}
function get_limit_onload($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row["on_load"]) ;
	}
	return ($output);
}
function get_header_color($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= ($row['header_color']);
	}
	return ($output);
}
function get_footer_color($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= ($row['footer_color']);
	}
	return ($output);
}
function get_footerText_color($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= ($row['footer_text_color']);
	}
	return ($output);
}
function get_admin_name($pdo){
	$query = "SELECT adm_name FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output = strip_tags($row['adm_name']) ; 
		}
	}
	return _e($output) ;
}
function get_aboutus_name($pdo){
	$query = "SELECT about_us_name FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output = strip_tags($row['about_us_name']) ; 
		}
	}
	return _e($output) ;
}
function get_copyright_name($pdo){
	$query = "SELECT copyright_name FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output = strip_tags($row['copyright_name']) ; 
		}
	}
	return _e($output) ;
}
function get_aboutus_info($pdo){
	$query = "SELECT about_us_info FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output = strip_tags($row['about_us_info']) ; 
		}
	}
	return ($output) ;
}
function get_linkname($pdo){
	$query = "SELECT link_name FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output = strip_tags($row['link_name']) ; 
		}
	}
	return _e($output) ;
}
function get_insta_url($pdo){
	$query = "SELECT insta_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['insta_url'])){
			$output = '<a href="'.strip_tags($row['insta_url']).'" target="_blank"><i class="fa fa-instagram fa-2x" style="color:'.get_footerText_color($pdo).';"></i></a>&ensp;' ;
			} 
		}
	}
	return ($output) ;
}
function get_fb_url($pdo){
	$query = "SELECT fb_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['fb_url'])){
			$output = '<a href="'.strip_tags($row['fb_url']).'" target="_blank"><i class="fa fa-facebook-square  fa-2x" style="color:'.get_footerText_color($pdo).';"></i></a>&ensp;' ;
			} 
		}
	}
	return ($output) ;
}
function get_twitter_url($pdo){
	$query = "SELECT twitter_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['twitter_url'])){
			$output = '<a href="'.strip_tags($row['twitter_url']).'" target="_blank"><i class="fa fa-twitter-square fa-2x" style="color:'.get_footerText_color($pdo).';"></i></a>&ensp;' ; 
			}
		}
	}
	return ($output) ;
}
function get_linkedin_url($pdo){
	$query = "SELECT linkedin_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['linkedin_url'])){
			$output = '<a href="'.strip_tags($row['linkedin_url']).'" target="_blank"><i class="fa fa-linkedin-square fa-2x" style="color:'.get_footerText_color($pdo).';"></i></a>&ensp;' ; 
			}
		}
	}
	return ($output) ;
}
function get_behance_url($pdo){
	$query = "SELECT behance_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['behance_url'])){
			$output = '<a href="'.strip_tags($row['behance_url']).'" target="_blank"><i class="fa fa-behance-square fa-2x" style="color:'.get_footerText_color($pdo).';"></i></a>&ensp;' ;
			} 
		}
	}
	return ($output) ;
}
function get_dribble_url($pdo){
	$query = "SELECT dribble_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['dribble_url'])){
				$output = '<a href="'.strip_tags($row['dribble_url']).'" target="_blank"><i class="fa fa-dribbble fa-2x" style="color:'.get_footerText_color($pdo).';"></i></a>&ensp;' ;
			} 
		}
	}
	return ($output) ;
}
function get_vk_url($pdo){
	$query = "SELECT vk_url FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			if(!empty($row['vk_url'])){
			$output = '<a href="'.strip_tags($row['vk_url']).'" target="_blank"><i class="fa fa-vk fa-2x" style="color:'.get_footerText_color($pdo).';"></i></a>&ensp;' ; 
			}
		}
	}
	return ($output) ;
}
function check_slug_for_user($pdo){
	$query = "SELECT * FROM ot_admin_pages WHERE  page_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function fetch_active_pages_foruser($pdo){
	$query = "SELECT * FROM ot_admin_pages WHERE page_status = '1' order by page_name ASC";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<a style="color:'.get_footerText_color($pdo).';" href="'.BASE_URL.'page/'._e($row["page_slug"]).'"><i class="icon fa fa-caret-right" style="color:'.get_footerText_color($pdo).';"></i> &ensp;'._e($row["page_name"]).'</a><br>';
	}
	return ($output);
}
function get_page_title($pdo,$pageSlug){
	$query = "SELECT * FROM ot_admin_pages WHERE page_status = '1' and page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row["page_name"]) ;
	}
	return ($output);
}
function check_activepage_for_user($pdo,$pageSlug){
	$query = "SELECT * FROM ot_admin_pages WHERE  page_status = '1' and page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function get_page_content($pdo,$pageSlug){
	$query = "SELECT * FROM ot_admin_pages WHERE page_status = '1' and page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= base64_decode($row["page_text"]) ;
	}
	return ($output);
}
function check_page_slug($pdo,$pageSlug){
	$query = "SELECT * FROM ot_admin_pages WHERE  page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function check_page_slug_byId($pdo,$pageSlug,$pageId){
	$query = "SELECT * FROM ot_admin_pages WHERE  page_slug = '".$pageSlug."' and page_id != '".$pageId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_blog_title_byId($pdo,$blogTitle,$postId){
	$query = "SELECT * FROM anony_post WHERE  post_title = '".$blogTitle."' and id != '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function get_approve_post($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['auto_approve']);
	}
	return ($output);
}
function get_post_title($pdo,$postId) {
	$query = "SELECT * FROM anony_post WHERE id = '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row['post_title']);
	}
	return ($output);
}
function get_post_description($pdo,$postId) {
	$query = "SELECT * FROM anony_post WHERE id = '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row['post_description']);
	}
	return ($output);
}
function get_post_date($pdo,$postId) {
	$query = "SELECT * FROM anony_post WHERE id = '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= date('d F, Y',strtotime(_e($row['post_date'])));
		
	}
	return ($output);
}
function get_post_like($pdo,$postId) {
	$query = "SELECT * FROM anony_post WHERE id = '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['post_like']);
		
	}
	return ($output);
}
function get_post_love($pdo,$postId) {
	$query = "SELECT * FROM anony_post WHERE id = '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['post_love']);
		
	}
	return ($output);
}
function get_post_view($pdo,$postId) {
	$query = "SELECT * FROM anony_post WHERE id = '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['post_view']);
		
	}
	return ($output);
}
function check_userlike_post($pdo,$postId,$userIp){
	$query = "SELECT * FROM anony_like WHERE like_post_id = '".$postId."' and like_ip = '".$userIp."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function check_userlove_post($pdo,$postId,$userIp){
	$query = "SELECT * FROM anony_love WHERE love_post_id = '".$postId."' and love_ip = '".$userIp."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function check_post_foruser($pdo,$postId) {
	$query = "SELECT * FROM anony_post WHERE id = '".$postId."' and post_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function post_trending($pdo){
	$query = "SELECT sum(post_view + post_like + post_love) as total, id FROM anony_post WHERE post_featured != '1' GROUP BY id order by total desc limit 10 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$ids = array(); 
	$output = '';
	foreach($result as $row)
	{
		$total = _e($row['total']) ;
		if($total > 0) {
			
			$ids[] = _e($row['id']) ;
		} else {
			$output .= "";
		}
		
	}
	$output .= implode(", ", $ids);
	
	return ($output);
}
function get_sidebar_category($pdo){
	$query = "SELECT * from anony_category where category_status = '1' order by category_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
			$catId = _e($row['id']) ;
			$strLength = strip_tags($row['category_name']);
			if(strlen($strLength) > 24) {
				$dot = "...";
			} else {
				$dot = "";
			}
			$output.='<li ><a href="'.BASE_URL.'category/'.$catId.'" class="text-white " ><i class="fa fa-bookmark"></i>&ensp; '.strip_tags(substr_replace($row['category_name'], $dot, 24)).'</a></li>';
		
		
	}
	
	return ($output);
}
function get_single_post($pdo,$postId) {
	$query = "SELECT * FROM anony_post WHERE post_status = '1' and id= '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$postId = strip_tags($row['id']);
		$postTitle = get_post_title($pdo,$postId) ;
		$postDate = get_post_date($pdo,$postId) ;
		$output .= '
					<div class="card w-100 rounded post-shadow bg-dark text-white">
					  <div class="card-footer">
                      <div class="row">
					  <div class="col-lg-9 mt-2">
                        <i class="fa fa-thumbs-o-up myFa userLike pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLi'.$postId.'">'.get_post_like($pdo,$postId).'</span> &ensp; <i class="fa fa-heart-o myFa userLove pointerCursor" id="'.$postId.'" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.get_post_love($pdo,$postId).'</span> &ensp; <i class="fa fa-comments-o myFa "></i> '.count_comments($pdo, $postId).' &ensp; <a href="http://www.facebook.com/share.php?u='.BASE_URL.'post/'.$postId.'" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url='.BASE_URL.'post/'.$postId.'&text='.$postTitle.'" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text='.BASE_URL.'post/'.$postId.'" class="text-white"><i class="fa fa-whatsapp myFa"></i></a>
                      </div>
					  <div class="col-lg-3 mt-2 text-lg-right">
                        <button class="btn btn-sm btn-light pComment text-muted "><i class="fa fa-comment"></i> Add Comment</button>
                        &ensp;
                        <small class="text-muted ">'.$postDate.'</small>
                      </div>
                      </div>
					   
					  
					  </div>
					</div>
		
		';
	}
	return ($output);


}


function count_comments($pdo, $postId){
    $query = "SELECT * FROM anony_comment WHERE post_id = '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function get_comments_default($pdo,$postId) {
    $limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM anony_comment WHERE post_id = '".$postId."' order by comment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_comment WHERE post_id = '".$postId."' order by comment_id desc LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $postId  = _e($row['post_id']);
            $commentId = _e($row['comment_id']);
            $commentDate = date('d F, Y',strtotime(_e($row['comment_time'])));
            $name = _e($row['user_name']) ;
            $comment = base64_decode($row['comment']) ;
            $adminReply = base64_decode($row['admin_reply']) ;
            if(!empty($adminReply)){
                $adminReply = '<div class="col-lg-12 mt-2 text-warning">
                                <i class="fa myFa fa-user-secret text-warning"></i>&ensp; <b>Admin</b> <i class="fa fa-check-circle text-success"></i>
                              </div>
                              <div class="col-lg-12 p-2 mt-2 border border-bottom-0 border-left-0 border-right-0 border-light ">
                                <div class="ml-2 mt-2">'.$adminReply.'</div>
                              </div>
                
                ';
            } else {
                $adminReply = "" ;
            }
            $output .= '<div class="card w-100 rounded post-shadow bg-dark text-white mt-5">
					  <div class="card-footer">
                          <div class="row">
                              <div class="col-lg-9 mt-2">
                                <i class="fa myFa fa-user"></i>&ensp; '.$name.'
                              </div>
                              <div class="col-lg-3 mt-2 text-lg-right">
                                <small class="text-muted ">'.$commentDate.'</small>
                              </div>
                              <div class="col-lg-12 p-2 mt-2 border border-bottom-0 border-left-0 border-right-0 border-light ">
                                <div class="ml-2 mt-2">'.$comment.'</div>
                              </div>
                              '.$adminReply.'
                          </div>
					  </div>
					</div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_comment" id="show_more_comment'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_allcomment btn btn-dark btn-sm ann'.$commentId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    }
    
	return ($output);
}


function get_comments_onload($pdo,$postId) {
    $limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM anony_comment WHERE post_id = '".$postId."' and comment_id < '".$_GET['id']."' order by comment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM anony_comment WHERE post_id = '".$postId."'  and comment_id < '".$_GET['id']."' order by comment_id desc LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $postId  = _e($row['post_id']);
            $commentId = _e($row['comment_id']);
            $commentDate = date('d F, Y',strtotime(_e($row['comment_time'])));
            $name = _e($row['user_name']) ;
            $comment = base64_decode($row['comment']) ;
            $adminReply = base64_decode($row['admin_reply']) ;
            if(!empty($adminReply)){
                $adminReply = '<div class="col-lg-12 mt-2 text-warning">
                                <i class="fa myFa fa-user-secret text-warning"></i>&ensp; <b>Admin</b> <i class="fa fa-check-circle text-success"></i>
                              </div>
                              <div class="col-lg-12 p-2 mt-2 border border-bottom-0 border-left-0 border-right-0 border-light ">
                                <div class="ml-2 mt-2">'.$adminReply.'</div>
                              </div>
                
                ';
            } else {
                $adminReply = "" ;
            }
            $output .= '<div class="card w-100 rounded post-shadow bg-dark text-white mt-5">
					  <div class="card-footer">
                          <div class="row">
                              <div class="col-lg-9 mt-2">
                                <i class="fa myFa fa-user"></i>&ensp; '.$name.'
                              </div>
                              <div class="col-lg-3 mt-2 text-lg-right">
                                <small class="text-muted ">'.$commentDate.'</small>
                              </div>
                              <div class="col-lg-12 p-2 mt-2 border border-bottom-0 border-left-0 border-right-0 border-light ">
                                <div class="ml-2 mt-2">'.$comment.'</div>
                              </div>
                              '.$adminReply.'
                          </div>
					  </div>
					</div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_comment" id="show_more_comment'.$postId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$postId.'" class="show_more_allcomment btn btn-dark btn-sm ann'.$commentId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    }
    
	return ($output);
}
?>