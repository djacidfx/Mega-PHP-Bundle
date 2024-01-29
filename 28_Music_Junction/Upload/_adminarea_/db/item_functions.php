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
function music_for_index_page($pdo){
	$limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM item_db WHERE item_status = '1' order by item_Id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM item_db WHERE item_status = '1' order by item_Id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$albumName = _e($row['item_album_name']);
		if(!empty($albumName)) {
			$albumName = ' - '._e($row['item_album_name']);
		} else {
			$albumName = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		$output .= '<li song="'.strip_tags($row['item_name']).'" file="'.$row['item_mainfile'].'" album="'.$albumName.'" artist="'.$CatName.'" cover="" class="list-group-item">
						<div class="song-meta">
						  <span><i class="fa fa-play-circle"></i>&ensp;</span>
						  <span class="song-title">'.strip_tags($row['item_name']).'</span>
						  <span class="song-artist"> - '.$CatName.'</span>
						</div>
						<div style="clear: both;"></div>
					</li>
		
		';
		
	}
	if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$itemId.'">
					<div class="show_more_new_item" id="show_more_new_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> No Music Found. </h3>';
	}
	return ($output);
}
function fetch_newallmusic_load_foruser($pdo){
	$limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM item_db WHERE item_status='1' and item_Id < ".$_GET['id']." order by item_Id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id < ".$_GET['id']." order by item_Id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$albumName = _e($row['item_album_name']);
		if(!empty($albumName)) {
			$albumName = ' - '._e($row['item_album_name']);
		} else {
			$albumName = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		$output .= '<li song="'.strip_tags($row['item_name']).'" file="'.$row['item_mainfile'].'" album="'.$albumName.'" artist="'.$CatName.'" cover="" class="list-group-item">
						<div class="song-meta">
						  <span><i class="fa fa-play-circle"></i>&ensp;</span>
						  <span class="song-title">'.strip_tags($row['item_name']).'</span>
						  <span class="song-artist"> - '.$CatName.'</span>
						</div>
						<div style="clear: both;"></div>
					</li>
		
		';
		
	}
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$itemId.'">
					<div class="show_more_new_item" id="show_more_new_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		} else {
			$output .='<div class="empty"></div>';
		}
	return ($output);
}
function fetch_searchallmusic_foruser($pdo,$search) {
	
	$limit = get_limit_default($pdo);
	$newstring = implode(", ", preg_split("/[\s]+/", $search));
	$sql = "SELECT count(*) as number_rows FROM `item_db` WHERE item_status ='1' and (item_name LIKE '%$search%' OR item_tags LIKE '%$newstring%')" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM `item_db` WHERE item_status ='1' and (item_name LIKE '%$search%' OR item_tags LIKE '%$newstring%') order by item_Id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = $statement->rowCount();
	$output = '';
	if($total > 0) {
	
	foreach($result as $row)
	{
		
		$itemId = _e($row['item_Id']);
		$albumName = _e($row['item_album_name']);
		if(!empty($albumName)) {
			$albumName = ' - '._e($row['item_album_name']);
		} else {
			$albumName = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		$output .= '<li song="'.strip_tags($row['item_name']).'" file="'.$row['item_mainfile'].'" album="'.$albumName.'" artist="'.$CatName.'" cover="" class="list-group-item">
						<div class="song-meta">
						  <span><i class="fa fa-play-circle"></i>&ensp;</span>
						  <span class="song-title">'.strip_tags($row['item_name']).'</span>
						  <span class="song-artist"> - '.$CatName.'</span>
						</div>
						<div style="clear: both;"></div>
					</li>
		
		';
		
	
	}
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center ap'.$itemId.'">
					<div class="show_more_new_search" id="show_more_new_search'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_search btn btn-primary btn-sm ann'.$search.'" >Load More</button>
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
function fetch_searchallmusic_foruser_onload($pdo,$search,$itemId){
	$limit =  get_limit_onload($pdo);
	$newstring = implode(", ", preg_split("/[\s]+/", $search));
	$sql = "SELECT count(*) as number_rows FROM `item_db` WHERE item_status ='1' and item_Id < ".$itemId." and (item_name LIKE '%$search%' OR item_tags LIKE '%$newstring%')" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM `item_db` WHERE item_status ='1' and item_Id < ".$itemId."  and (item_name LIKE '%$search%' OR item_tags LIKE '%$newstring%') order by item_Id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$albumName = _e($row['item_album_name']);
		if(!empty($albumName)) {
			$albumName = ' - '._e($row['item_album_name']);
		} else {
			$albumName = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		$output .= '<li song="'.strip_tags($row['item_name']).'" file="'.$row['item_mainfile'].'" album="'.$albumName.'" artist="'.$CatName.'" cover="" class="list-group-item">
						<div class="song-meta">
						  <span><i class="fa fa-play-circle"></i>&ensp;</span>
						  <span class="song-title">'.strip_tags($row['item_name']).'</span>
						  <span class="song-artist"> - '.$CatName.'</span>
						</div>
						<div style="clear: both;"></div>
					</li>
		
		';
		
	}
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center ap'.$itemId.'">
					<div class="show_more_new_search" id="show_more_new_search'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_search btn btn-primary btn-sm ann'.$search.'" >Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	return ($output);
}
function fetch_music_by_category_foruser($pdo,$catId) {

	$limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM item_db WHERE item_status = '1' and main_category = '".$catId."' order by item_Id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM item_db WHERE item_status = '1'  and main_category = '".$catId."' order by item_Id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	foreach($result as $row)
	{
	
		
		$itemId = _e($row['item_Id']);
		$albumName = _e($row['item_album_name']);
		if(!empty($albumName)) {
			$albumName = ' - '._e($row['item_album_name']);
		} else {
			$albumName = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		$output .= '<li song="'.strip_tags($row['item_name']).'" file="'.$row['item_mainfile'].'" album="'.$albumName.'" artist="'.$CatName.'" cover="" class="list-group-item">
						<div class="song-meta">
						  <span><i class="fa fa-play-circle"></i>&ensp;</span>
						  <span class="song-title">'.strip_tags($row['item_name']).'</span>
						  <span class="song-artist"> - '.$CatName.'</span>
						</div>
						<div style="clear: both;"></div>
					</li>
		
		';
		
	
	
	}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center  ap'.$itemId.'">
					<div class="show_more_cat_item" id="show_more_cat_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_category_item btn btn-primary btn-sm ann'.$catId.'" >Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	$output .= '</div>';
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> No Music Found. </h3>';
	}
	return ($output);


}
function fetch_categorymusic_load_foruser($pdo,$itemId,$catId){
	$limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM item_db WHERE item_status='1' and main_category = '".$catId."' and item_Id < ".$_GET['ID']." order by item_Id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	$output .= '<div class="row" id="report2">';
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM item_db WHERE item_status = '1' and main_category = '".$catId."' and item_Id < ".$_GET['ID']." order by item_Id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
	
		
		$itemId = _e($row['item_Id']);
		$albumName = _e($row['item_album_name']);
		if(!empty($albumName)) {
			$albumName = ' - '._e($row['item_album_name']);
		} else {
			$albumName = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		$output .= '<li song="'.strip_tags($row['item_name']).'" file="'.$row['item_mainfile'].'" album="'.$albumName.'" artist="'.$CatName.'" cover="" class="list-group-item">
						<div class="song-meta">
						  <span><i class="fa fa-play-circle"></i>&ensp;</span>
						  <span class="song-title">'.strip_tags($row['item_name']).'</span>
						  <span class="song-artist"> - '.$CatName.'</span>
						</div>
						<div style="clear: both;"></div>
					</li>
		
		';
		
	
	
	}
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center  ap'.$itemId.'">
					<div class="show_more_cat_item" id="show_more_cat_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_category_item btn btn-primary btn-sm ann'.$catId.'" >Load More</button>
							</div>
							
					</div>
					</div>
					';
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
function fetch_active_category_name($pdo,$id){
	$query = "SELECT * FROM item_category WHERE c_status = '1' and c_id = '".$id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value='._e($row["c_id"]).'>'._e($row["c_name"]).'</option>';
	}
	return ($output);
}
function get_active_category_selected($pdo,$id){
	$query = "SELECT * FROM item_category WHERE c_status = '1' and c_id != '".$id."' order by c_id desc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value='._e($row["c_id"]).'>'._e($row["c_name"]).'</option>';
	}
	return ($output);
}
function get_active_category($pdo){
	$query = "SELECT * FROM item_category WHERE c_status = '1' order by c_id desc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value='._e($row["c_id"]).'>'._e($row["c_name"]).'</option>';
	}
	return ($output);
}
function count_total_item($pdo){
	$query = "SELECT * FROM item_db WHERE 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_total_active_item($pdo){
	$query = "SELECT * FROM item_db WHERE item_status='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_total_deactive_item($pdo){
	$query = "SELECT * FROM item_db WHERE item_status='0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}





function set_item_to_deactive($pdo,$categoryId) {
	$query = "SELECT * FROM item_db WHERE main_category = '".$categoryId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0){
		foreach($result as $row){
			$itemId = _e($row['item_Id']) ;
			$upd = $pdo->prepare("update item_db set item_status = '0' where item_Id = '".$itemId."'");
			$upd->execute();
		}
	}
	return $total ;
}
function set_item_to_active($pdo,$categoryId) {
	$query = "SELECT * FROM item_db WHERE main_category = '".$categoryId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0){
		foreach($result as $row){
			$itemId = _e($row['item_Id']) ;
			$upd = $pdo->prepare("update item_db set item_status = '1' where item_Id = '".$itemId."'");
			$upd->execute();
		}
	}
	return $total ;
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


function item_tag_link($pdo,$itemId){
	$query = "SELECT * FROM ot_tags WHERE tag_item_id='".$itemId."' order by tag_name asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$output.='<div class="row p-3 justify-content-center">';
	foreach($result as $row)
	{
		$output .= '<a href="'.BASE_URL.'search/'.trim(_e($row['tag_name'])).'">'._e($row['tag_name']).'</a>&ensp;';
	}
	$output .='</div>';
	return ($output);
}


function check_item_foruser($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function get_item_title($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row['item_name']);
	}
	return ($output);
}
function get_item_tags($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e(strtoupper($row['item_tags']));
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
function get_category_name_foritem($pdo,$item_id){
	$query = "SELECT c_name FROM item_db left join item_category on (item_category.c_id = item_db.main_category) WHERE item_Id = '".$item_id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row["c_name"]);
	}
	return ($output);
}
function get_category_id_foritem($pdo,$item_id){
	$query = "SELECT c_id FROM item_db left join item_category on (item_category.c_id = item_db.main_category) WHERE item_Id = '".$item_id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row["c_id"]);
	}
	return ($output);
}
function fetchcategory_name($pdo,$id){
	$query = "SELECT * FROM item_category WHERE c_id = '".$id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row["c_name"]) ;
	}
	return ($output);
}
function get_category_name_and_link($pdo){
	$query = "SELECT c_name, c_id FROM item_category WHERE c_status = '1' order by c_name ASC";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<li class="text-center border border-muted border-top-0 border-right-0 border-left-0">
                       <a href="'.BASE_URL.'artist/'._e($row["c_id"]).'" class="d-flex border-bottom">
                       	  <div class="msg-body">
                             <h6 class="h5 msg-nav-h6"> <i class="fa fa-music"></i> '._e($row['c_name']).'</h6>
                          </div>
                        </a>
                     </li>
		
		';
	}
	return ($output);
}


function check_category_foruser($pdo,$catId){
	$query = "SELECT * FROM item_category WHERE c_status = '1' and c_id='".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function get_item_created_date($pdo,$itemId) {
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id = '".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	foreach($result as $row)
	{
		$output .= date('d F, Y',strtotime(_e($row['created_date'])));;
	}
	return ($output);
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

?>