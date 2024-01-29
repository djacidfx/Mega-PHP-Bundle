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
function count_total_post($pdo){
	$query = "SELECT * FROM ot_admin_pics WHERE 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_total_active_post($pdo){
	$query = "SELECT * FROM ot_admin_pics WHERE pic_status='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_total_deactive_post($pdo){
	$query = "SELECT * FROM ot_admin_pics WHERE pic_status='0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function random_two_image($pdo){
	$query = "SELECT * FROM ot_admin_pics WHERE pic_status = '1' order by rand() limit 2";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$picId = _e($row['pic_id']) ;
		$oldVote = get_old_vote($pdo, $picId) ;
		$oldWins = get_old_wins($pdo, $picId) ;
		$picImage = _e($row['pic_image']) ;
		$picName = strip_tags($row['pic_caption']);
		$output .= '<div class="col-lg-6 p-2 text-center">
						<a href="#!" class="imgVote" id="'.$picId.'"><img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid  newImg img-thumbnail rounded-circle" /></a>
						<h3 class="text-muted">'.$picName.'</h3>
						<small class="text-muted">Points : '.$oldVote.'&ensp;|&ensp;Wins : '.$oldWins.'</small>
					</div>
		
		';
	}
	return ($output);
}
function get_old_vote($pdo, $id) {
	$query = "SELECT * FROM ot_admin_pics WHERE pic_id='".$id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "0";
	foreach($result as $row)
	{
		$output = _e($row['pic_vote']) ;
	}
	return $output ;
}
function get_old_wins($pdo, $id) {
	$query = "SELECT * FROM ot_admin_pics WHERE pic_id='".$id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "0";
	foreach($result as $row)
	{
		$output = _e($row['pic_wins']) ;
	}
	return $output ;
}
function get_points($pdo) {
	$query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "";
	foreach($result as $row)
	{
		$output = _e($row['points']) ;
	}
	return $output ;
}
function get_winner_name($pdo, $id){
	$query = "SELECT * FROM ot_admin_pics WHERE pic_id='".$id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "";
	foreach($result as $row)
	{
		$output .= strip_tags($row['pic_caption']) ;
	}
	return $output ;
}
function check_pic_foruser($pdo,$picId) {
	$query = "SELECT * FROM ot_admin_pics WHERE pic_id = '".$picId."' and pic_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function get_other_images($pdo, $id){
	$oldVote = get_old_vote($pdo, $id) ;
	$newVote = $oldVote + get_points($pdo) ; 
	$oldWins = get_old_wins($pdo, $id) ;
	$newWins = $oldWins + 1 ; 
	$upd = $pdo->prepare("update ot_admin_pics set pic_vote = '".$newVote."', pic_wins = '".$newWins."' where pic_id = '".$id."'") ;
	$upd->execute();
	$query = "SELECT * FROM ot_admin_pics WHERE pic_id != '".$id."' and pic_status = '1' order by rand() limit 2";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$picId = _e($row['pic_id']) ;
		$oldVote = get_old_vote($pdo, $picId) ;
		$oldWins = get_old_wins($pdo, $picId) ;
		$picImage = _e($row['pic_image']) ;
		$picName = strip_tags($row['pic_caption']);
		$output .= '<div class="col-lg-6 p-2 text-center">
						<a href="#!" class="imgVote" id="'.$picId.'"><img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid  newImg img-thumbnail rounded-circle" /></a>
						<h3 class="text-muted">'.$picName.'</h3>
						<small class="text-muted">Points : '.$oldVote.'&ensp;|&ensp;Wins : '.$oldWins.'</small>
					</div>
		
		';
	}
	return ($output);
}

function get_top_points($pdo){
	$sql = "SELECT count(*) as number_rows FROM ot_admin_pics WHERE pic_vote != '0' and pic_status = '1' order by pic_vote desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM ot_admin_pics WHERE pic_vote != '0' and pic_status = '1' order by pic_vote desc limit 4 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$picId = _e($row['pic_id']) ;
		$picName = strip_tags($row['pic_caption']);
		$picImage = _e($row['pic_image']) ;
		$oldVote = get_old_vote($pdo, $picId) ;
		$image = '<img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid img-thumbnail rounded-circle " />';
		$output.='<li >
					<a href="'.BASE_URL.'playagainst/'.$picId.'" class="w-100">
					<div class="row">
						<div class="col-lg-4">
							'.$image.'
						</div>
						<div class="col-lg-8 p-0">
							<div class="col-lg-12 text-white">
							'.$picName.'
							</div>
							<div class="col-lg-12">
							Point : '.$oldVote.'
							</div>
						</div>
					</div>
					</a>
		</li>';
		
	}
	if($totalRows > 4){
		$output .= '<div class="row p-5 text-center"><a href="'.BASE_URL.'toppers/" class="btn btn-block btn-warning text-dark">View All</a></div>';
	}
	
	return ($output);
}

function get_top_winner($pdo){
	$sql = "SELECT count(*) as number_rows FROM ot_admin_pics WHERE pic_wins != '0' and pic_status = '1' order by pic_wins desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM ot_admin_pics WHERE pic_wins != '0' and pic_status = '1' order by pic_wins desc limit 4 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$picId = _e($row['pic_id']) ;
		$picName = strip_tags($row['pic_caption']);
		$picImage = _e($row['pic_image']) ;
		$oldWins = get_old_wins($pdo, $picId) ;
		$image = '<img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid img-thumbnail rounded-circle " />';
		$output.='<li >
					<a href="'.BASE_URL.'playagainst/'.$picId.'" class="w-100">
					<div class="row">
						<div class="col-lg-4">
							'.$image.'
						</div>
						<div class="col-lg-8 p-0">
							<div class="col-lg-12 text-white">
							'.$picName.'
							</div>
							<div class="col-lg-12">
							Win : '.$oldWins.'
							</div>
						</div>
					</div>
					</a>
		</li>';
		
	}
	if($totalRows > 4){
		$output .= '<div class="row p-5 text-center"><a href="'.BASE_URL.'topwinners/" class="btn btn-block btn-warning text-dark">View All</a></div>';
	}
	
	return ($output);
}
function get_top_winners($pdo) {
	$limit = get_limit_default($pdo); 
	$sql = "SELECT count(*) as number_rows FROM ot_admin_pics WHERE  pic_status = '1' order by pic_wins desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "select * from ( SELECT @s:=@s+1 serial_number, pic_id, pic_caption, pic_image, pic_wins FROM ot_admin_pics, (SELECT @s:= 0) AS s WHERE pic_status = '1' order by pic_wins desc ) as foo where 1 limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$picId = _e($row['pic_id']) ;
		$picName = strip_tags($row['pic_caption']);
		$picImage = _e($row['pic_image']) ;
		$oldWins = get_old_wins($pdo, $picId) ;
		$oldVote = get_old_vote($pdo, $picId) ;
		$id = _e($row['serial_number']) ;
		$image = '<img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid img-thumbnail rounded-circle " />';
		$output.='<div class="col-lg-6 p-3 text-center">
						<a href="'.BASE_URL.'admin_images/'.$picImage.'" class="spotlight" ><img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid  newImg img-thumbnail rounded-circle" alt="'.$picName.'" /></a>
						<h3 class="text-muted">'.$picName.'</h3>
						<small class="text-muted">Points : '.$oldVote.'&ensp;|&ensp;Wins : '.$oldWins.'</small>
						<a href="'.BASE_URL.'playagainst/'.$picId.'" class="btn btn-warning btn-block text-dark">Play Against '.$picName.'</a>
				 </div>
				';
		
	}
	if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$id.'">
					<div class="show_more_winner_img" id="show_more_winner_img'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_won_img btn btn-dark btn-sm">Load More</button>
							</div>
							
					</div>
					</div>';
	}
	
	return ($output);
}

function get_top_winners_onload($pdo) {

	$limit = get_limit_onload($pdo);
	
	$sql = "select * from ( SELECT @s:=@s+1 serial_number FROM ot_admin_pics, (SELECT @s:= 0) AS s WHERE pic_status = '1' order by pic_wins desc ) as foo where serial_number > ".$_GET['id']."" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$totalRows = $newitem->rowCount();
	$query = "select * from ( SELECT @s:=@s+1 serial_number, pic_id, pic_caption, pic_image, pic_wins FROM ot_admin_pics, (SELECT @s:= 0) AS s WHERE pic_status = '1' order by pic_wins desc ) as foo where serial_number >  ".$_GET['id']." limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$picId = _e($row['pic_id']) ;
		$picName = strip_tags($row['pic_caption']);
		$picImage = _e($row['pic_image']) ;
		$oldWins = get_old_wins($pdo, $picId) ;
		$oldVote = get_old_vote($pdo, $picId) ;
		$id = _e($row['serial_number']) ;
		$image = '<img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid img-thumbnail rounded-circle " />';
		$output.='<div class="col-lg-6 p-3 text-center">
						<a href="'.BASE_URL.'admin_images/'.$picImage.'" class="spotlight" ><img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid  newImg img-thumbnail rounded-circle" alt="'.$picName.'" /></a>
						<h3 class="text-muted">'.$picName.'</h3>
						<small class="text-muted">Points : '.$oldVote.'&ensp;|&ensp;Wins : '.$oldWins.'</small>
						<a href="'.BASE_URL.'playagainst/'.$picId.'" class="btn btn-warning btn-block text-dark">Play Against '.$picName.'</a>
				 </div>
				';
		
	}
	if(empty($id)){
			$id = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$id.'">
					<div class="show_more_winner_img" id="show_more_winner_img'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_won_img btn btn-dark btn-sm">Load More</button>
							</div>
							
					</div>
					</div>';
	}
	
	return ($output);
}

function get_top_point_holder($pdo) {
	$limit = get_limit_default($pdo); 
	$sql = "SELECT count(*) as number_rows FROM ot_admin_pics WHERE  pic_status = '1' order by pic_vote desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "select * from ( SELECT @s:=@s+1 serial_number, pic_id, pic_caption, pic_image, pic_wins FROM ot_admin_pics, (SELECT @s:= 0) AS s WHERE pic_status = '1' order by pic_vote desc ) as foo where 1 limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$picId = _e($row['pic_id']) ;
		$picName = strip_tags($row['pic_caption']);
		$picImage = _e($row['pic_image']) ;
		$oldWins = get_old_wins($pdo, $picId) ;
		$oldVote = get_old_vote($pdo, $picId) ;
		$id = _e($row['serial_number']) ;
		$image = '<img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid img-thumbnail rounded-circle " />';
		$output.='<div class="col-lg-6 p-3 text-center">
						<a href="'.BASE_URL.'admin_images/'.$picImage.'" class="spotlight" ><img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid  newImg img-thumbnail rounded-circle" alt="'.$picName.'" /></a>
						<h3 class="text-muted">'.$picName.'</h3>
						<small class="text-muted">Points : '.$oldVote.'&ensp;|&ensp;Wins : '.$oldWins.'</small>
						<a href="'.BASE_URL.'playagainst/'.$picId.'" class="btn btn-warning btn-block text-dark">Play Against '.$picName.'</a>
				 </div>
				';
		
	}
	if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$id.'">
					<div class="show_more_topper_img" id="show_more_topper_img'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_top_img btn btn-dark btn-sm">Load More</button>
							</div>
							
					</div>
					</div>';
	}
	
	return ($output);


}

function get_top_toppers_onload($pdo) {

	$limit = get_limit_onload($pdo);
	
	$sql = "select * from ( SELECT @s:=@s+1 serial_number FROM ot_admin_pics, (SELECT @s:= 0) AS s WHERE pic_status = '1' order by pic_vote desc ) as foo where serial_number > ".$_GET['id']."" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$totalRows = $newitem->rowCount();
	$query = "select * from ( SELECT @s:=@s+1 serial_number, pic_id, pic_caption, pic_image, pic_wins FROM ot_admin_pics, (SELECT @s:= 0) AS s WHERE pic_status = '1' order by pic_vote desc ) as foo where serial_number >  ".$_GET['id']." limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$picId = _e($row['pic_id']) ;
		$picName = strip_tags($row['pic_caption']);
		$picImage = _e($row['pic_image']) ;
		$oldWins = get_old_wins($pdo, $picId) ;
		$oldVote = get_old_vote($pdo, $picId) ;
		$id = _e($row['serial_number']) ;
		$image = '<img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid img-thumbnail rounded-circle " />';
		$output.='<div class="col-lg-6 p-3 text-center">
						<a href="'.BASE_URL.'admin_images/'.$picImage.'" class="spotlight" ><img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid  newImg img-thumbnail rounded-circle" alt="'.$picName.'" /></a>
						<h3 class="text-muted">'.$picName.'</h3>
						<small class="text-muted">Points : '.$oldVote.'&ensp;|&ensp;Wins : '.$oldWins.'</small>
						<a href="'.BASE_URL.'playagainst/'.$picId.'" class="btn btn-warning btn-block text-dark">Play Against '.$picName.'</a>
				 </div>
				';
		
	}
	if(empty($id)){
			$id = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="hiddenItem col-lg-12 justify-content-center ap'.$id.'">
					<div class="show_more_topper_img" id="show_more_topper_img'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_top_img btn btn-dark btn-sm">Load More</button>
							</div>
							
					</div>
					</div>';
	}
	
	return ($output);


}

function get_pic_previewImage_formetatags($pdo,$picId) {
	$query = "SELECT * FROM ot_admin_pics WHERE pic_id='".$picId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "";
	foreach($result as $row)
	{
		$picImage = _e($row['pic_image']) ;
		$output .= '<img src="'.BASE_URL.'admin_images/'.$picImage.'" />' ;
	}
	return $output ;
}

function random_one_image($pdo, $oldId){
	$oldId = filter_var($_GET['pid'], FILTER_SANITIZE_NUMBER_INT) ;
	$new = "SELECT * FROM ot_admin_pics WHERE pic_status = '1' and pic_id != '".$oldId."' order by rand() limit 1";
	$newstatement = $pdo->prepare($new);
	$newstatement->execute();
	$newresult = $newstatement->fetchAll();
	foreach($newresult as $newrow)
	{
		$newId = _e($newrow['pic_id']);
	}
	$query = "SELECT * FROM ot_admin_pics WHERE pic_status = '1' and pic_id = '".$oldId."' or pic_id = '".$newId."' limit 2";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$picId = _e($row['pic_id']) ;
		$oldVote = get_old_vote($pdo, $picId) ;
		$oldWins = get_old_wins($pdo, $picId) ;
		$picImage = _e($row['pic_image']) ;
		$picName = strip_tags($row['pic_caption']);
		$output .= '<div class="col-lg-6 p-2 text-center">
						<a href="#!" class="imgVoteOne" id="'.$picId.'" data-status="'.$oldId.'"><img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid  newImg img-thumbnail rounded-circle" /></a>
						<h3 class="text-muted">'.$picName.'</h3>
						<small class="text-muted">Points : '.$oldVote.'&ensp;|&ensp;Wins : '.$oldWins.'</small>
					</div>
		
		';
	}
	return ($output);
}

function get_singleother_images($pdo,$id,$oldId) {
	$oldVote = get_old_vote($pdo, $id) ;
	$newVote = $oldVote + get_points($pdo) ; 
	$oldWins = get_old_wins($pdo, $id) ;
	$newWins = $oldWins + 1 ; 
	$upd = $pdo->prepare("update ot_admin_pics set pic_vote = '".$newVote."', pic_wins = '".$newWins."' where pic_id = '".$id."'") ;
	$upd->execute();
	$new = "SELECT * FROM ot_admin_pics WHERE pic_status = '1' and (pic_id != '".$id."' and pic_id != '".$oldId."') order by rand() limit 1";
	$newstatement = $pdo->prepare($new);
	$newstatement->execute();
	$newresult = $newstatement->fetchAll();
	foreach($newresult as $newrow)
	{
		$newId = _e($newrow['pic_id']);
	}
	$query = "SELECT * FROM ot_admin_pics WHERE pic_status = '1' and pic_id = '".$oldId."' or pic_id = '".$newId."' limit 2";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$picId = _e($row['pic_id']) ;
		$oldVote = get_old_vote($pdo, $picId) ;
		$oldWins = get_old_wins($pdo, $picId) ;
		$picImage = _e($row['pic_image']) ;
		$picName = strip_tags($row['pic_caption']);
		$output .= '<div class="col-lg-6 p-2 text-center">
						<a href="#!" class="imgVoteOne" id="'.$picId.'" data-status="'.$oldId.'"><img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid  newImg img-thumbnail rounded-circle" /></a>
						<h3 class="text-muted">'.$picName.'</h3>
						<small class="text-muted">Points : '.$oldVote.'&ensp;|&ensp;Wins : '.$oldWins.'</small>
					</div>
		
		';
	}
	return ($output);
}
function homepage_tagline($pdo) {
	$query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "";
	foreach($result as $row)
	{
		$output = strip_tags($row['homepage_tagline']) ;
	}
	return $output ;
}
function get_pic_thumbnail_image($pdo,$picId) {
	$query = "SELECT * FROM ot_admin_pics WHERE pic_id='".$picId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "";
	foreach($result as $row)
	{
		$picImage = _e($row['pic_image']) ;
		$picName = strip_tags($row['pic_caption']);
		$output .= '<a href="'.BASE_URL.'admin_images/'.$picImage.'" class="spotlight" ><img src="'.BASE_URL.'admin_images/'.$picImage.'" class="img-fluid img-thumbnail rounded-circle " style="max-height:100px; min-height:100px; min-width:100px; max-width:100px;" alt="'.$picName.'" /></a>' ;
	}
	return $output ;
}
?>