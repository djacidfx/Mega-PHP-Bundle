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
function count_item_view($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_Id = '".$itemId."' and item_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['item_viewed']);
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
function user_wallet_amount($pdo){
	$query = "SELECT * FROM ot_user WHERE user_id = '".$_SESSION['user']['user_id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['user_wallet']);
	}
	return ($output);
}
function user_wallet_amount_by_id($pdo,$uid){
	$query = "SELECT * FROM ot_user WHERE user_id = '".$uid."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['user_wallet']);
	}
	return ($output);
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
function count_total_user($pdo){
	$query = "SELECT * FROM ot_user WHERE 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_total_active_user($pdo){
	$query = "SELECT * FROM ot_user WHERE user_status='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_total_deactive_user($pdo){
	$query = "SELECT * FROM ot_user WHERE user_blocked='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function count_today_sale($pdo){
	$todayDate = date("Y-m-d") ;
	$query = "SELECT count(payment_id) as total_sale FROM ot_payments WHERE complete_status = '1' and payment_status = 'Completed' and payment_date='".$todayDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	return _e($output) ;
}
function count_today_earning($pdo){
	$todayDate = date("Y-m-d") ;
	$query = "SELECT sum(p_total_amt) as total_sale FROM ot_payments WHERE complete_status = '1' and payment_status = 'Completed' and payment_date='".$todayDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	if(empty($output)){
		$output = '0.00';
	}
	return _e($output) ;
}
function count_today_biggest_sold_item($pdo){
	$todayDate = date("Y-m-d") ;
	$query = "SELECT count(p_item_id) as c, p_item_id FROM `ot_payments` WHERE complete_status = '1' and payment_status = 'Completed' and payment_date = '".$todayDate."' GROUP BY p_item_id order by c desc limit 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$itemId = _e($row['p_item_id']) ;
		$output .= $itemId ;
	}
	
	return _e($output) ;
}
//**********
function count_today_wallet_sale($pdo){
	$todayDate = date("Y-m-d") ;
	$query = "SELECT count(wallet_id) as total_sale FROM ot_user_wallet WHERE wallet_complete_status = '1' and wallet_date='".$todayDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	return _e($output) ;
}
function count_today_wallet_earning($pdo){
	$todayDate = date("Y-m-d") ;
	$query = "SELECT sum(planAmt) as total_sale FROM ot_user_wallet WHERE wallet_complete_status = '1' and wallet_date='".$todayDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	if(empty($output)){
		$output = '0.00';
	}
	return _e($output) ;
}
function count_today_biggest_sold_wallet_item($pdo){
	$todayDate = date("Y-m-d") ;
	$query = "SELECT count(planId) as c, planId FROM `ot_user_wallet` WHERE wallet_complete_status = '1' and wallet_date = '".$todayDate."' GROUP BY planId order by c desc limit 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$itemId = _e($row['planId']) ;
		$output .= $itemId ;
	}
	
	return _e($output) ;
}
function count_thismonth_wallet_sale($pdo){
	$firstDate = date("Y-m-01") ;
	$lastDate = date("Y-m-t") ;
	$query = "SELECT count(wallet_id) as total_sale FROM ot_user_wallet WHERE wallet_complete_status = '1' and wallet_date between '".$firstDate."' and '".$lastDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	return _e($output) ;
}
function count_thismonth_wallet_earning($pdo){
	$firstDate = date("Y-m-01") ;
	$lastDate = date("Y-m-t") ;
	$query = "SELECT sum(planAmt) as total_sale FROM ot_user_wallet WHERE wallet_complete_status = '1' and wallet_date between '".$firstDate."' and '".$lastDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	if(empty($output)){
		$output = '0.00';
	}
	return _e($output) ;
}
function count_thismonth_biggest_sold_wallet_item($pdo){
	$firstDate = date("Y-m-01") ;
	$lastDate = date("Y-m-t") ;
	$query = "SELECT count(planId) as c, planId FROM `ot_user_wallet` WHERE wallet_complete_status = '1' and wallet_date between '".$firstDate."' and '".$lastDate."' GROUP BY planId order by c desc limit 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$itemId = _e($row['planId']) ;
		$output .= $itemId ;
	}
	
	return _e($output) ;
}
function count_total_wallet_sale($pdo){
	$query = "SELECT count(wallet_id) as total_sale FROM ot_user_wallet WHERE wallet_complete_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	return _e($output) ;
}
function count_total_wallet_earning($pdo){
	$query = "SELECT sum(planAmt) as total_sale FROM ot_user_wallet WHERE wallet_complete_status = '1' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	if(empty($output)){
		$output = '0.00';
	}
	return _e($output) ;
}
function count_total_biggest_sold_wallet_item($pdo){
	$query = "SELECT count(planId) as c, planId FROM `ot_user_wallet` WHERE wallet_complete_status = '1' GROUP BY planId order by c desc limit 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$itemId = _e($row['planId']) ;
		$output .= $itemId ;
	}
	
	return _e($output) ;
}
//**********
function count_thismonth_sale($pdo){
	$firstDate = date("Y-m-01") ;
	$lastDate = date("Y-m-t") ;
	$query = "SELECT count(payment_id) as total_sale FROM ot_payments WHERE complete_status = '1' and payment_status = 'Completed' and payment_date between '".$firstDate."' and '".$lastDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	return _e($output) ;
}
function count_thismonth_earning($pdo){
	$firstDate = date("Y-m-01") ;
	$lastDate = date("Y-m-t") ;
	$query = "SELECT sum(p_total_amt) as total_sale FROM ot_payments WHERE complete_status = '1' and payment_status = 'Completed' and payment_date between '".$firstDate."' and '".$lastDate."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	if(empty($output)){
		$output = '0.00';
	}
	return _e($output) ;
}
function count_thismonth_biggest_sold_item($pdo){
	$firstDate = date("Y-m-01") ;
	$lastDate = date("Y-m-t") ;
	$query = "SELECT count(p_item_id) as c, p_item_id FROM `ot_payments` WHERE complete_status = '1' and payment_status = 'Completed' and payment_date between '".$firstDate."' and '".$lastDate."' GROUP BY p_item_id order by c desc limit 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$itemId = _e($row['p_item_id']) ;
		$output .= $itemId ;
	}
	
	return _e($output) ;
}
function count_total_sale($pdo){
	$query = "SELECT count(payment_id) as total_sale FROM ot_payments WHERE complete_status = '1' and payment_status = 'Completed'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	return _e($output) ;
}
function count_total_earning($pdo){
	$query = "SELECT sum(p_total_amt) as total_sale FROM ot_payments WHERE complete_status = '1' and payment_status = 'Completed'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['total_sale']) ;
	}
	if(empty($output)){
		$output = '0.00';
	}
	return _e($output) ;
}
function count_total_biggest_sold_item($pdo){
	$query = "SELECT count(p_item_id) as c, p_item_id FROM `ot_payments` WHERE complete_status = '1' and payment_status = 'Completed' GROUP BY p_item_id order by c desc limit 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$itemId = _e($row['p_item_id']) ;
		$output .= $itemId ;
	}
	
	return _e($output) ;
}
function get_item_small_thumbnail($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<a href="'.ADMIN_URL.'_item_secure_/'.$itemId.'/'._e($row['item_thumbnail']).'" class="spotlight"><img src='.ADMIN_URL.'_item_secure_/'.$itemId.'/'._e($row['item_thumbnail']).' class="img-fluid myThumbnailImage border border-light rounded shadow-lg" /></a>';
	}
	return ($output);
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
			$output = '<a href="'.strip_tags($row['fb_url']).'" target="_blank"><i class="fa fa-facebook-square text-white fa-2x"></i></a>&ensp;' ;
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
			$output = '<a href="'.strip_tags($row['twitter_url']).'" target="_blank"><i class="fa fa-twitter-square text-white fa-2x"></i></a>&ensp;' ; 
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
			$output = '<a href="'.strip_tags($row['linkedin_url']).'" target="_blank"><i class="fa fa-linkedin-square text-white fa-2x"></i></a>&ensp;' ; 
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
			$output = '<a href="'.strip_tags($row['behance_url']).'" target="_blank"><i class="fa fa-behance-square text-white fa-2x"></i></a>&ensp;' ;
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
				$output = '<a href="'.strip_tags($row['dribble_url']).'" target="_blank"><i class="fa fa-dribbble text-white fa-2x"></i></a>&ensp;' ;
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
			$output = '<a href="'.strip_tags($row['vk_url']).'" target="_blank"><i class="fa fa-vk text-white fa-2x"></i></a>&ensp;' ; 
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
		$output .= '<a class="text-white" href="'.BASE_URL.'page/'._e($row["page_slug"]).'"><i class="icon fa fa-caret-right"></i> &ensp;'._e($row["page_name"]).'</a><br>';
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
function get_userfullname_byid($pdo,$uid){
	$query = "SELECT * FROM ot_user WHERE user_id='".$uid."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output = _e($row['user_name']) ; 
		}
	}
	return _e($output) ;
}
function getuser_purchases_by_id($pdo,$uid){
	$query = "SELECT sum(p_total_amt) as toal_amt FROM ot_payments WHERE p_user_id='".$uid."' and payment_status = 'Completed' group by p_user_id";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '0';
	if($total > 0) {
	foreach($result as $row)
		{
			$output = _e($row['toal_amt']) ; 
		}
	}
	return _e($output) ;
}
function get_useremail_byid($pdo,$uid){
	$query = "SELECT * FROM ot_user WHERE user_id='".$uid."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output = _e($row['user_email']) ; 
		}
	}
	return _e($output) ;
}
function get_item_sale($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['item_sale']);
	}
	return ($output);
}
function STRIPE_PUBLISHABLE_KEY($pdo) {
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['STRIPE_PUBLISHABLE_KEY']) ;	
	}
	return ($output);
}
function payment_method($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$payPal = _e($row['paypal_on']) ;
		$stripe = _e($row['stripe_on']) ;
		$txnFee = _e($row['txn_fee']) ;
		if($txnFee > 0) {
			$txnFee = '+ $'.(int)_e($row['txn_fee']).' Transaction Fee';
		} else {
			$txnFee = "";
		}
		if($payPal == '1') {
			$output .= '<option value="1">Paypal&ensp;'.$txnFee.' </option>';
		}
		if($stripe == '1') {
			$output .= '<option value="2">Stripe&ensp;'.$txnFee.' </option>';
		}
		$output .= '<option value="3">Wallet + $0 Transaction Fee </option>';
	}
	return ($output);
}
function payment_method_for_wallet($pdo){
	$query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$payPal = _e($row['paypal_on']) ;
		$stripe = _e($row['stripe_on']) ;
		if($payPal == '1') {
			$output .= '<option value="1">Paypal</option>';
		}
		if($stripe == '1') {
			$output .= '<option value="2">Stripe</option>';
		}
	}
	return ($output);
}
function get_wallet_plan($pdo){
	$query = "SELECT * FROM ot_wallet_plan WHERE plan_status = '1' order by plan_id desc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$planAmt = (int)_e($row['plan_amt']) ;
		$planName = _e($row['plan_name']);
		$bonusAmt = (int)_e($row['bonus_amt']) ; 
		$planId = _e($row['plan_id']) ;
		$output .= '<option value="'.$planId.'">'.$planName.'</option>';
		
	}
	return ($output);
}
function get_wallet_plan_name($pdo,$planId){
	$query = "SELECT * FROM ot_wallet_plan WHERE plan_status = '1' and plan_id = '".$planId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$planName = _e($row['plan_name']);
		$output .= $planName ;
		
	}
	return ($output);
}
function get_item_price($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['regular_price']);
	}
	return ($output);
}
function get_transaction_fee($pdo){
	$query = "SELECT txn_fee FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= (int)_e($row['txn_fee']);
	}
	return ($output);
}
function count_loved_items($pdo){
	$query = "SELECT count(*) as total_love FROM item_loved WHERE  love_uid='".$_SESSION['user']['user_id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	if($total > 0) {
		foreach($result as $row){
			$output .= _e($row['total_love']) ;
		}
	}
	return _e($output) ;
}
function count_purchased_items($pdo){
	$query = "SELECT count(*) as total_purchases FROM ot_payments WHERE  p_user_id='".$_SESSION['user']['user_id']."' and payment_status='Completed'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	if($total > 0) {
		foreach($result as $row){
			$output .= _e($row['total_purchases']) ;
		}
	}
	return _e($output) ;
}
function show_loved_items_notifications($pdo){
	
	$countLovedItem = count_loved_items($pdo) ;
	$query = "SELECT love_item_id FROM item_loved WHERE  love_uid='".$_SESSION['user']['user_id']."' order by love_id desc limit 4";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	if($total > 0) {
		foreach($result as $row){
			$itemId = _e($row['love_item_id']) ;
			$sql = $pdo->prepare("select item_thumbnail, item_name from item_db where item_Id = '".$itemId."'") ;
			$sql->execute();
			$newresult = $sql->fetchAll();
			foreach($newresult as $itemrow){
				$strLength = strip_tags($itemrow['item_name']);
				if(strlen($strLength) > 20) {
					$dot = "...";
				} else {
					$dot = "";
				}
				$output .= '<li>
                                <a rel="nofollow" href="'.BASE_URL.'item/'.$itemId.'" class="dropdown-item nav-link">
                                    <div class="notification">
                                        <div class="notification-content"><img src="'.ADMIN_URL.'_item_secure_/'.$itemId.'/'._e($itemrow['item_thumbnail']).'" alt="Image" class="img-fluid rounded-circle" style="height: 40px; width:40px;"> &ensp;'.strip_tags(substr_replace($itemrow['item_name'], $dot, 20)).'</div>
                                    </div>
                                </a>
                            </li>				
				' ;	
			}			
		}
		if($countLovedItem > 4) {
			$output .= '<li><a href="'.BASE_URL.'loved/" class="dropdown-item all-notifications bg-light text-center btn btn-sm btn-light"> <strong>View All</strong></a></li>';
		}
	} else {
		$output .= '<li>
                       <a rel="nofollow" href="#" class="dropdown-item nav-link">
                         <div class="notification ">
                            <div class="notification-content text-danger"><i class="fa fa-exclamation-circle text-warning "></i> No Loved Items.</div>
                           </div>
                        </a>
                   </li>
		';
	}
	return ($output) ;
}
function get_userfullname($pdo){
	$query = "SELECT * FROM ot_user WHERE user_id='".$_SESSION['user']['user_id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output = _e($row['user_name']) ; 
		}
	}
	return _e($output) ;
}
function get_useremail($pdo){
	$query = "SELECT * FROM ot_user WHERE user_id='".$_SESSION['user']['user_id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	if($total > 0) {
	$output = '';
	foreach($result as $row)
		{
			$output = _e($row['user_email']) ; 
		}
	}
	return _e($output) ;
}
function check_user_chance($pdo){
	$query = "SELECT * FROM ot_user WHERE user_blocked = '0' and user_status ='0' and user_id='".$_SESSION['user']['user_id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	if($total > 0) {
		foreach($result as $row){
			$output .= _e($row['u_chance']) ;
		}
	}
	return _e($output) ;
}
function check_user_registration_status($pdo){
	$query = "SELECT * FROM ot_user WHERE user_status = '1' and user_id='".$_SESSION['user']['user_id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
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
function check_item_selling_or_not($pdo){
	$query = "SELECT * FROM item_db WHERE  item_sale > '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function check_user_status($pdo){
	$query = "SELECT * FROM ot_user WHERE user_blocked = '0' and user_id='".$_SESSION['user']['user_id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	return _e($total) ;
}
function check_user_verify_status($pdo){
	if(isset($_SESSION['user']['user_id'])){
	$query = "SELECT * FROM ot_user WHERE user_status = '1' and user_id='".$_SESSION['user']['user_id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	return _e($total) ;
	} else {
	return 1 ;
	}
}
function item_demo_link($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_demo_link != '' and item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['item_demo_link']);
	}
	return ($output);
}
function get_item_loved_by($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_status = '1' and  item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['item_loved_by']);
	}
	return ($output);
}
function check_item_love($pdo,$itemId) {
	$query = "SELECT * FROM item_loved WHERE love_item_id = '".$itemId."' and love_uid='".$_SESSION['user']['user_id']."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	if($total > 0) {
		$output .= '<small class="text-muted">Loved</small><br><a href="#!" class="itemUnLove" id="'.$itemId.'"><i class="fa fa-heart text-danger fa-2x"></i></a>';
	} else {
		$output .= '<small class="text-muted">Love</small><br><a href="#!" class="itemLove" id="'.$itemId.'"><i class="fa fa-heart-o text-danger fa-2x"></i></a>';
	}
	return ($output);
}

function item_preview($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_demo_link != '' and item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<div class="col-lg-4"><small class="text-muted">Preview</small><br><a href="'.BASE_URL.'itempreview/'.$itemId.'" class="btn btn-primary buttonCircle btn-sm"><i class="fa fa-bug"></i> </a></div>';
	}
	return ($output);
}
function get_item_youtube_video($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_youtube_id != '' and item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$yid = _e($row['item_youtube_id']) ;
		$output .= '<div class="col-lg-6"><small class="text-muted">Video</small><br><button type="button" name="viewVideo" id="'.$yid.'" class="btn btn-danger buttonCircle btn-sm viewVideo "><i class="fa fa-youtube-play "></i></button></div>';
	}
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
function get_item_previewImage_formetatags($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= ADMIN_URL.'_item_secure_/'.$itemId.'/'._e($row['item_preview']) ;
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
                       <a href="'.BASE_URL.'category/'._e($row["c_id"]).'" class="d-flex border-bottom">
                       	  <div class="msg-body">
                             <h6 class="h5 msg-nav-h6"> <i class="fa fa-bookmark-o"></i> '._e($row['c_name']).'</h6>
                          </div>
                        </a>
                     </li>
		
		';
	}
	return ($output);
}
function get_recommend_category($pdo){
	$query = "SELECT c_name, c_id FROM item_category WHERE c_status = '1' order by rand() limit 2";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<i class="fa fa-folder-open mt-1"></i> <a href="'.BASE_URL.'category/'._e($row["c_id"]).'" class=" text-white">&ensp;'._e($row['c_name']).'</a>&ensp; ';
	}
	return ($output);
}
function get_recommend_category_byid($pdo,$catId){
	$query = "SELECT c_name, c_id FROM item_category WHERE c_status = '1' and c_id!= '".$catId."' order by rand() limit 2";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<i class="fa fa-folder-open mt-1"></i> <a href="'.BASE_URL.'category/'._e($row["c_id"]).'" class=" text-white">&ensp;'._e($row['c_name']).'</a>&ensp; ';
	}
	return ($output);
}
function get_item_regular_price_design($pdo,$item_id){
	$query = "SELECT regular_price, item_Id FROM item_db WHERE item_Id = '".$item_id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="btn btn-light btn-sm text-muted"> <b>$'._e($row['regular_price']).'</b></a>';
			
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
function get_item_updated_date($pdo,$itemId) {
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id = '".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	foreach($result as $row)
	{
		$output .= date('d F, Y',strtotime(_e($row['updated_date'])));;
	}
	return ($output);
}
function preview_image_for_product_page($pdo,$itemId) {
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id = '".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	$output .= '<div class="row" id="report2">';
	foreach($result as $row)
	{
		$output .= '
		<div class="col-lg-12" id="card-1">
        	<div class="card card-inverse card-info rounded"><a href="'.ADMIN_URL.'_item_secure_/'.$itemId.'/'._e($row['item_preview']).'" class="spotlight"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="'.get_item_title($pdo,$itemId).'" class="card-img-top img-fluid" style="max-height:600px;"></a></div>
        </div>';
	}
	$output .= '</div>';
	return ($output);
}
function item_description_for_product_page($pdo,$itemId) {
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id = '".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	$output .= '<div class="row" id="report2">';
	foreach($result as $row)
	{
		$output .= '
		<div class="col-lg-12" id="card-1">
        	<div class="card card-inverse card-info p-3 rounded">'.base64_decode($row['item_description']).'</div>
        </div>';
	}
	$output .= '</div>';
	return ($output);
}
function check_screenshot_foruser($pdo,$itemId){
	$query = "SELECT * FROM item_db WHERE item_docufile != '' and item_status = '1' and item_Id='".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function item_other_details($pdo,$itemId) {
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id = '".$itemId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	$output .= '';
	foreach($result as $row)
	{
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '<div class="col-lg-12 text-success p-1">-&ensp;<i class="fa fa-heart text-danger"></i> '._e($row['item_loved_by']).'</div>';
		} else {
			$itemLove = "";
		}
		$categoryName = fetchcategory_name($pdo,_e($row['main_category'])) ;
		$sale = _e($row['item_sale']);
		if($sale > 0) {
			$download = '<div class="col-lg-12 text-success p-1">
							-&ensp;<i class="fa fa-download text-success"></i> '.$sale.'&ensp;Download
						</div>';
		} else {
			$download = "";
		}
		$itemPreviewAudio = '<div class="col-lg-12 text-success p-1 text-center mt-2">
							<h4><i class="fa fa-headphones"></i> Audio Preview</h4>
							<audio controls>
							  <source src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_docufile']).'">
							</audio></div>';
		$output .= '
		
				<div class="col-lg-12 p-1">
				<a href="'.BASE_URL.'category/'._e($row["main_category"]).'" class=" text-primary">-&ensp;<i class="fa fa-folder-open"></i> '.$categoryName.'</a>
				</div>
				<div class="col-lg-12 text-muted p-1">
					-&ensp;<i class="fa fa-file-text-o text-muted"></i> '._e($row['item_filesize']).'&ensp;KB
				</div>
				
				'.$download.' '.$itemLove.'
				<div class="border mt-3"></div>
				'.$itemPreviewAudio.'
				';
	}
	$output .= '';
	return ($output);
}
function index_page_item($pdo) {
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
	$output .= '<div class="row" id="report2">';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                               '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_item" id="show_more_new_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	$output .= '</div>';
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> No Item Found. </h3>';
	}
	return ($output);

}

function fetch_newallproduct_load_foruser($pdo){
	$limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM item_db WHERE item_status='1' and item_Id < ".$_GET['id']." order by item_Id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	$output .= '<div class="row" id="report2">';
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_Id < ".$_GET['id']." order by item_Id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$output .='<div class="row  mt-2">';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                              '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_item" id="show_more_new_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	$output .='</div>';
	return ($output);
}
function fetch_product_by_category_foruser($pdo,$catId) {

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
	$output .= '<div class="row" id="report2">';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                               '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
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
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> No Item Found. </h3>';
	}
	return ($output);


}
function fetch_categoryproduct_load_foruser($pdo,$itemId,$catId){
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
	$output .='<div class="row  mt-2">';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                               '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_cat_item" id="show_more_cat_item'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_category_item btn btn-primary btn-sm ann'.$catId.'" >Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	$output .='</div>';
	return ($output);
}
function fetch_searchallproduct_foruser($pdo,$search) {
	
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
	$output .='<div class="row">';
	
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                               '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_search" id="show_more_new_search'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_search btn btn-primary btn-sm ann'.$search.'" >Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
		$output .='</div>';
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> Sorry, Nothing Found. Try with other Search Term.</h3>';
	}
	return ($output);

}
function fetch_searchallproduct_foruser_onload($pdo,$search,$itemId){
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
	$output .='<div class="row">';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                               '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	if(empty($itemId)){
			$itemId = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_new_search" id="show_more_new_search'.$itemId.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$itemId.'" class="show_more_newest_search btn btn-primary btn-sm ann'.$search.'" >Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
		$output .='</div>';
	return ($output);
}
function fetch_maxsaleproduct_foruser($pdo){
	$limit = "5";
	$query = "SELECT count(item_Id) as c, item_Id, item_name, item_preview,item_thumbnail, regular_price, item_loved_by, item_sale FROM item_db WHERE item_status = '1' and item_sale > 0 group by item_Id order by item_sale DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']) ;
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "..";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$sale = '&ensp;<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
		$output .= '<a href="'.BASE_URL.'item/'._e($row['item_Id']).'">
					<div class="row p-2  border border-muted border-top-0 border-right-0 border-left-0">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xl-3 mt-1">
							<img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_thumbnail']).'"  alt="'.get_item_title($pdo,$itemId).'" class="rounded img-fluid" style=" height:50px; width:50px;max-height:50px;">
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xl-9 mt-1 p-0">
							<div class="col-lg-12 p-0">
								<h6 class="text-primary">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h6>
							</div>
							<div class="col-lg-12 p-0 newFont">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6">
									<i class="fa fa-bookmark-o"></i> '.$CatName.'
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 text-right">
									 '.$itemLove.' '.$sale.'
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
		';
	}
	return ($output);
}
function related_items($pdo,$categoryId,$itemId) {
	$limit = "3";
	
	$query = "SELECT * FROM item_db WHERE item_status = '1' and main_category = '".$categoryId."' and item_Id!='".$itemId."' order by rand() LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	$output .= '<div class="row mt-4" id="report2">';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                               '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	$output .= '</div>';
	} else {
		$output .= '<div class="col-lg-12 mt-4 bg-white p-3 rounded" id="report2"><h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> No Related Product Found. </h3></div>';
	}
	return ($output);

}
function fetch_user_downloads($pdo) {
	$limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM ot_payments WHERE payment_status = 'Completed' and complete_status = '1' and p_user_id = '".$_SESSION['user']['user_id']."' order by payment_id DESC " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT payment_id, item_Id, item_name, item_loved_by, item_mainfile, item_preview, item_sale, payment_date FROM ot_payments left join item_db on (item_db.item_Id = ot_payments.p_item_id) WHERE payment_status = 'Completed' and complete_status = '1' and p_user_id = '".$_SESSION['user']['user_id']."' order by ot_payments.payment_id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	$output .= '<div class="row" id="report2">';
	foreach($result as $row)
	{
		$id = _e($row['payment_id']) ;
		$itemId = _e($row['item_Id']);
		$date = _e($row['payment_date']);
		$date =  date('d F, Y',strtotime($date));
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		$itemStatus = check_item_foruser($pdo,$itemId) ;
		if($itemStatus == '0') {
			$downloadButton = '<button class="btn btn-sm btn-danger text-warning" disabled="disabled"><i class="fa fa-exclamation-circle"></i> Item Removed</button>';
		} else {
			$downloadButton = '<form method="POST" action="'.BASE_URL.'downloadItem.php" enctype="multipart/form-data">
							<input type="hidden" name="item_id" value="'.$itemId.'" >
							<input type="hidden" name="main_file" value="'._e($row['item_mainfile']).'" >
							<input type="submit" name="SaveMainfile" value="Download" class="btn btn-sm btn-success" ></form>
			' ; 
		}
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                              Purchased On<br>'.$date.' &ensp; '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$downloadButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_user_download" id="show_more_user_download'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_user_downloaded_item btn btn-info btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	$output .= '</div>';
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> No Item Found in Your Downloads. </h3>';
	}
	return ($output);

}

function fetch_user_downloads_onload($pdo){
	$limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM ot_payments WHERE payment_status = 'Completed' and complete_status = '1' and p_user_id = '".$_SESSION['user']['user_id']."' and payment_id < ".$_GET['id']." order by payment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	$output .= '<div class="row" id="report2">';
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT payment_id, item_Id, item_name, item_loved_by, item_mainfile, item_preview, item_sale, payment_date FROM ot_payments left join item_db on (item_db.item_Id = ot_payments.p_item_id) WHERE payment_status = 'Completed' and complete_status = '1' and p_user_id = '".$_SESSION['user']['user_id']."' and payment_id < ".$_GET['id']." order by ot_payments.payment_id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$output .='<div class="row  mt-2">';
	foreach($result as $row)
	{
		$id = _e($row['payment_id']) ;
		$itemId = _e($row['item_Id']);
		$date = _e($row['payment_date']);
		$date =  date('d F, Y',strtotime($date));
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		$itemStatus = check_item_foruser($pdo,$itemId) ;
		if($itemStatus == '0') {
			$downloadButton = '<button class="btn btn-sm btn-danger text-warning" disabled="disabled"><i class="fa fa-exclamation-circle"></i> Item Removed</button>';
		} else {
			$downloadButton = '<form method="POST" action="'.BASE_URL.'downloadItem.php" enctype="multipart/form-data">
							<input type="hidden" name="item_id" value="'.$itemId.'" >
							<input type="hidden" name="main_file" value="'._e($row['item_mainfile']).'" >
							<input type="submit" name="SaveMainfile" value="Download" class="btn btn-sm btn-success" ></form>
			' ; 
		}
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                              Purchased On<br>'.$date.' &ensp; '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$downloadButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	if(empty($id)){
			$id = "";
		}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_user_download" id="show_more_user_download'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_user_downloaded_item btn btn-info btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	$output .='</div>';
	return ($output);
}
function fetch_loved_items($pdo){
	$limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM item_loved WHERE love_uid = '".$_SESSION['user']['user_id']."'  order by love_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$newquery = "select * from item_loved where love_uid = '".$_SESSION['user']['user_id']."' order by love_id desc limit ".$limit."";
	$newstatement = $pdo->prepare($newquery) ;
	$newstatement->execute();
	$newresult = $newstatement->fetchAll();
	$output = '';
	$total = $newstatement->rowCount();
	if($total > 0) {
	foreach($newresult as $newrow) {
		$id = _e($newrow['love_id']);
		$itemId = _e($newrow['love_item_id']);
		$query = "select * from item_db where item_Id = '".$itemId."' and item_status = '1'";
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output .= '<div class="row removeLoveSta'.$id.' p-2 mt-1  border border-muted border-top-0 border-right-0 border-left-0 bg-white rounded">';
		foreach($result as $row)
		{
			$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
			$strLength = strip_tags($row['item_name']);
			if(strlen($strLength) > 24) {
				$dot = "..";
			} else {
				$dot = "";
			}
			$itemLove = _e($row['item_loved_by']) ;
			if($itemLove > 0) {
				$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
			} else {
				$itemLove = "";
			}
			if(_e($row['item_sale']) > 0) {
				$sale = '&ensp;<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
			$output .= '
						
							<div class="col-lg-3 col-md-3  text-left">
								<img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_thumbnail']).'"  alt="'.get_item_title($pdo,$itemId).'" class="rounded img-fluid" style=" height:50px; width:50px;max-height:50px;">
							</div>
							<div class="col-lg-6 col-md-6 mt-1 p-0 text-left">
								<div class="col-lg-12 p-0">
									<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><h6 class="text-primary">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h6></a>
								</div>
								<div class="col-lg-12 p-0 newFont">
										<i class="fa fa-bookmark-o"></i> '.$CatName.'&ensp; '.$itemLove.'&ensp; '.$sale.'
										
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xl-3 mt-1 text-left">
								<button type="button" id="'.$id.'" data-status = "'.$itemId.'" class="removeLove btn btn-light"><i class="fa fa-trash-o"></i></button>
							</div>
			';
		}
		$output .= '</div>';
	}
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> No Items Loved by You. </h3>';
	}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_loved_item" id="show_more_loved_item'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_all_loved_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	return ($output);
}
function fetch_loved_items_onload($pdo){
	$limit = get_limit_onload($pdo);
	$sql = "SELECT count(*) as number_rows FROM item_loved WHERE love_uid = '".$_SESSION['user']['user_id']."' and love_id < ".$_GET['id']."   order by love_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$newquery = "select * from item_loved where love_uid = '".$_SESSION['user']['user_id']."' and love_id < ".$_GET['id']." order by love_id desc limit ".$limit."";
	$newstatement = $pdo->prepare($newquery) ;
	$newstatement->execute();
	$newresult = $newstatement->fetchAll();
	$output = '';
	foreach($newresult as $newrow) {
		$id = _e($newrow['love_id']);
		$itemId = _e($newrow['love_item_id']);
		$query = "select * from item_db where item_Id = '".$itemId."' and item_status = '1'";
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output .= '<div class="row removeLoveSta'.$id.' p-2 mt-1  border border-muted border-top-0 border-right-0 border-left-0 bg-white rounded">';
		foreach($result as $row)
		{
			$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
			$strLength = strip_tags($row['item_name']);
			if(strlen($strLength) > 24) {
				$dot = "..";
			} else {
				$dot = "";
			}
			$itemLove = _e($row['item_loved_by']) ;
			if($itemLove > 0) {
				$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
			} else {
				$itemLove = "";
			}
			if(_e($row['item_sale']) > 0) {
				$sale = '&ensp;<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
			$output .= '
						
							<div class="col-lg-3 col-md-3 col-sm-3 col-xl-3 mt-1 text-left">
								<img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_thumbnail']).'"  alt="'.get_item_title($pdo,$itemId).'" class="rounded img-fluid" style=" height:50px; width:50px;max-height:50px;">
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 mt-1 p-0 text-left">
								<div class="col-lg-12 p-0">
									<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><h6 class="text-primary">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h6></a>
								</div>
								<div class="col-lg-12 p-0 newFont">
										<i class="fa fa-bookmark-o"></i> '.$CatName.'&ensp; '.$itemLove.'&ensp; '.$sale.'
										
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xl-3 mt-1 text-left">
								<button type="button" id="'.$id.'" data-status = "'.$itemId.'" class="removeLove btn btn-light"><i class="fa fa-trash-o"></i></button>
							</div>
			';
		}
		$output .= '</div>';
	}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_loved_item" id="show_more_loved_item'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_all_loved_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	return ($output);
}
function fetch_purchased_items($pdo){
	$limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM ot_payments WHERE p_user_id = '".$_SESSION['user']['user_id']."'  and payment_status = 'Completed' order by payment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$newquery = "select * from ot_payments where p_user_id = '".$_SESSION['user']['user_id']."' and payment_status = 'Completed' order by payment_id desc limit ".$limit."";
	$newstatement = $pdo->prepare($newquery) ;
	$newstatement->execute();
	$newresult = $newstatement->fetchAll();
	$output = '';
	$total = $newstatement->rowCount();
	if($total > 0) {
	foreach($newresult as $newrow) {
		$id = _e($newrow['payment_id']);
		$itemId = _e($newrow['p_item_id']);
		$date = _e($newrow['payment_date']);
		$date =  date('d F, Y',strtotime($date));
		$transactionId = _e($newrow['txn_id']);
		$payMethod = _e($newrow['payment_method']);
		$paidAmount = (int)(_e($newrow['p_total_amt'])) ;
		$query = "select * from item_db where item_Id = '".$itemId."'";
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output .= '<div class="row  p-2 mt-1  border border-muted border-top-0 border-right-0 border-left-0 bg-white rounded">';
		foreach($result as $row)
		{
			$strLength = strip_tags($row['item_name']);
			if(strlen($strLength) > 24) {
				$dot = "..";
			} else {
				$dot = "";
			}
			
			$output .= '
						
							<div class="col-lg-2 col-md-2  text-left">
								<img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_thumbnail']).'"  alt="'.get_item_title($pdo,$itemId).'" class="rounded img-fluid" style=" height:50px; width:50px;max-height:50px;">
							</div>
							<div class="col-lg-6 col-md-6 mt-1  text-left">
								<div class="col-lg-12 p-0">
									<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><h6 class="text-primary">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h6></a>
								</div>
								<div class="col-lg-12 p-0 newFont">
									Purchased On : '.$date.'&ensp;|&ensp;Method : '.$payMethod.'&ensp;|&ensp;Paid : $'.$paidAmount.'
								</div>
							</div>
							<div class="col-lg-4 col-md-4  mt-1 text-left">
								<label>Transaction ID</label><br>
								<b>'.$transactionId.'</b>
							</div>
			';
		}
		$output .= '</div>';
	}
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> No Items Purchased by You. </h3>';
	}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_purchased_item" id="show_more_purchased_item'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_all_purchased_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	return ($output);
}
function fetch_purchased_items_onload($pdo){
	$limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM ot_payments WHERE p_user_id = '".$_SESSION['user']['user_id']."'   and payment_status = 'Completed' and payment_id < '".$_GET['id']."'  order by payment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$newquery = "select * from ot_payments where p_user_id = '".$_SESSION['user']['user_id']."'   and payment_status = 'Completed' and payment_id < '".$_GET['id']."' order by payment_id desc limit ".$limit."";
	$newstatement = $pdo->prepare($newquery) ;
	$newstatement->execute();
	$newresult = $newstatement->fetchAll();
	$output = '';
	foreach($newresult as $newrow) {
		$id = _e($newrow['payment_id']);
		$itemId = _e($newrow['p_item_id']);
		$date = _e($newrow['payment_date']);
		$date =  date('d F, Y',strtotime($date));
		$transactionId = _e($newrow['txn_id']);
		$payMethod = _e($newrow['payment_method']);
		$paidAmount = (int)(_e($newrow['p_total_amt'])) ;
		$query = "select * from item_db where item_Id = '".$itemId."'";
		$statement = $pdo->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output .= '<div class="row  p-2 mt-1  border border-muted border-top-0 border-right-0 border-left-0 bg-white rounded">';
		foreach($result as $row)
		{
			$strLength = strip_tags($row['item_name']);
			if(strlen($strLength) > 24) {
				$dot = "..";
			} else {
				$dot = "";
			}
			
			$output .= '
						
							<div class="col-lg-2 col-md-2  text-left">
								<img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_thumbnail']).'"  alt="'.get_item_title($pdo,$itemId).'" class="rounded img-fluid" style=" height:50px; width:50px;max-height:50px;">
							</div>
							<div class="col-lg-6 col-md-6 mt-1  text-left">
								<div class="col-lg-12 p-0">
									<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><h6 class="text-primary">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h6></a>
								</div>
								<div class="col-lg-12 p-0 newFont">
									Purchased On : '.$date.'&ensp;|&ensp;Method : '.$payMethod.'&ensp;|&ensp;Paid : $'.$paidAmount.'
								</div>
							</div>
							<div class="col-lg-4 col-md-4  mt-1 text-left">
								<label>Transaction ID</label>
								<b>'.$transactionId.'</b>
							</div>
			';
		}
		$output .= '</div>';
	}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_purchased_item" id="show_more_purchased_item'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_all_purchased_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	return ($output);
}


function fetch_wallet_history($pdo){
	$limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM ot_user_wallet WHERE wallet_user_id = '".$_SESSION['user']['user_id']."'  and wallet_complete_status = '1' order by wallet_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$newquery = "select * from ot_user_wallet WHERE wallet_user_id = '".$_SESSION['user']['user_id']."'  and wallet_complete_status = '1' order by wallet_id desc limit ".$limit."";
	$newstatement = $pdo->prepare($newquery) ;
	$newstatement->execute();
	$newresult = $newstatement->fetchAll();
	$output = '';
	$total = $newstatement->rowCount();
	if($total > 0) {
	foreach($newresult as $newrow) {
		$id = _e($newrow['wallet_id']);
		$planId = _e($newrow['planId']) ; 
		$planName = get_wallet_plan_name($pdo,$planId) ;
		$date = _e($newrow['wallet_date']);
		$date =  date('d F, Y',strtotime($date));
		$transactionId = _e($newrow['wallet_txn_id']);
		$payMethod = _e($newrow['wallet_method']);
		$planAmt = (int)(_e($newrow['planAmt'])) ;
		$bonusAmt = (int)(_e($newrow['bonusAmt'])) ;
		$wallet_amt = (int)(_e($newrow['wallet_amt'])) ;
		$output .= '<div class="row  p-2 mt-1  border border-muted border-top-0 border-right-0 border-left-0 bg-white rounded">';
		
			$strLength = strip_tags($planName);
			if(strlen($strLength) > 30) {
				$dot = "..";
			} else {
				$dot = "";
			}
			
			$output .= '
							<div class="col-lg-8 col-md-8 mt-1  text-left">
								<div class="col-lg-12 p-0">
									<h6 class="text-primary">'.strip_tags(substr_replace($planName, $dot, 30)).'</h6>
								</div>
								<div class="col-lg-12 p-0 newFont">
									Purchased On : '.$date.'&ensp;|&ensp;Method : '.$payMethod.'&ensp;|&ensp;Paid : $'.$planAmt.'&ensp;|&ensp;Bonus : $'.$bonusAmt.'&ensp;|&ensp;Credited Amount : $'.$wallet_amt.'
								</div>
							</div>
							<div class="col-lg-4 col-md-4  mt-1 text-left">
								<label>Transaction ID</label><br>
								<b>'.$transactionId.'</b>
							</div>
			';
		$output .= '</div>';
	}
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> Oops, You have not added any Money in your Wallet. </h3>';
	}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_wallet_item" id="show_more_wallet_item'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_all_wallet_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	return ($output);
}
function fetch_wallet_history_onload($pdo){
	$limit = get_limit_default($pdo);
	$sql = "SELECT count(*) as number_rows FROM ot_user_wallet WHERE wallet_user_id = '".$_SESSION['user']['user_id']."'  and wallet_complete_status = '1' and wallet_id < '".$_GET['id']."'  order by wallet_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$newquery = "select * from ot_user_wallet WHERE wallet_user_id = '".$_SESSION['user']['user_id']."'  and wallet_complete_status = '1' and wallet_id < '".$_GET['id']."' order by wallet_id desc limit ".$limit."";
	$newstatement = $pdo->prepare($newquery) ;
	$newstatement->execute();
	$newresult = $newstatement->fetchAll();
	$output = '';
	foreach($newresult as $newrow) {
		$id = _e($newrow['wallet_id']);
		$planId = _e($newrow['planId']) ; 
		$planName = get_wallet_plan_name($pdo,$planId) ;
		$date = _e($newrow['wallet_date']);
		$date =  date('d F, Y',strtotime($date));
		$transactionId = _e($newrow['wallet_txn_id']);
		$payMethod = _e($newrow['wallet_method']);
		$planAmt = (int)(_e($newrow['planAmt'])) ;
		$bonusAmt = (int)(_e($newrow['bonusAmt'])) ;
		$wallet_amt = (int)(_e($newrow['wallet_amt'])) ;
		$output .= '<div class="row  p-2 mt-1  border border-muted border-top-0 border-right-0 border-left-0 bg-white rounded">';
		
			$strLength = strip_tags($planName);
			if(strlen($strLength) > 30) {
				$dot = "..";
			} else {
				$dot = "";
			}
			
			$output .= '
							<div class="col-lg-8 col-md-8 mt-1  text-left">
								<div class="col-lg-12 p-0">
									<h6 class="text-primary">'.strip_tags(substr_replace($planName, $dot, 30)).'</h6>
								</div>
								<div class="col-lg-12 p-0 newFont">
									Purchased On : '.$date.'&ensp;|&ensp;Method : '.$payMethod.'&ensp;|&ensp;Paid : $'.$planAmt.'&ensp;|&ensp;Bonus : $'.$bonusAmt.'&ensp;|&ensp;Credited Amount : $'.$wallet_amt.'
								</div>
							</div>
							<div class="col-lg-4 col-md-4  mt-1 text-left">
								<label>Transaction ID</label><br>
								<b>'.$transactionId.'</b>
							</div>
			';
		$output .= '</div>';
	}
	if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center">
					<div class="show_more_wallet_item" id="show_more_wallet_item'.$id.'">
							
							<div class="col text-center p-2">
							<div id="loader-icon"><img src="'.ADMIN_URL.'images/loader.gif" class="img-fluid img-loader" /></div>
							<button id="'.$id.'" class="show_more_all_wallet_item btn btn-primary btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	return ($output);
}
function new_item_on_index_page($pdo) {
	$limit = "3";
	$query = "SELECT * FROM item_db WHERE item_status = '1' order by item_Id DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	$output .= '<h2 class="text-muted"><i class="fa fa-diamond text-muted"></i> New Items
				<a class="btn btn-success btn-sm float-right" href="'.BASE_URL.'new/"> Browse All</a>
				</h2>
				<hr>
				<div class="row" id="report2">';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                               '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	
	$output .= '</div>';
	} else {
		$output .= '<h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> No Item Found. </h3>';
	}
	return ($output);

}
function top_viewed_item($pdo) {
	$limit = "3";
	$query = "SELECT * FROM item_db WHERE item_status = '1' order by item_viewed DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	$output .= '<h2 class="text-muted"><i class="fa fa-signal text-muted"></i> Top Viewed Items</h2>
				<hr>
				<div class="row" id="report2">';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                               '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	
	$output .= '</div>';
	} 
	return ($output);

}
function top_loved_item_on_index_page($pdo) {
	$limit = "3";
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_loved_by > 0 order by item_loved_by DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	$output .= '<h2 class="text-muted"><i class="fa fa-heart text-danger"></i> Top Loved Items</h2><hr>
				<div class="row" id="report2">';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                               '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	
	$output .= '</div>';
	}
	return ($output);

}
function top_downloaded_item_on_index_page($pdo) {
	$limit = "3";
	$query = "SELECT * FROM item_db WHERE item_status = '1' and item_sale > 0 order by item_sale DESC LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
	$output .= '<h2 class="text-muted"><i class="fa fa-download text-success"></i> Top Downloaded Items</h2><hr>
				<div class="row" id="report2">';
	foreach($result as $row)
	{
		$itemId = _e($row['item_Id']);
		$strLength = strip_tags($row['item_name']);
		if(strlen($strLength) > 24) {
			$dot = "...";
		} else {
			$dot = "";
		}
		$itemLove = _e($row['item_loved_by']) ;
		if($itemLove > 0) {
			$itemLove = '&ensp;<i class="fa fa-heart text-danger"></i> <b>'._e($row['item_loved_by']).' </b>';
		} else {
			$itemLove = "";
		}
		$CatName = get_category_name_foritem($pdo,_e($row['item_Id'])) ;
		
			if($row['item_sale'] > 0) {
				$sale = '<i class="fa fa-download text-success"></i> <b>'._e($row['item_sale']).'</b>';
			} else {
				$sale = "";
			}
		
		$buyNowButton = get_item_regular_price_design($pdo,_e($row['item_Id'])) ; 
		$output .= '
		<div class="col-md-4" id="card-1">
                    <div class="card card-inverse card-info">
							<span class="notify-badge bg-primary text-white newFontTag"><i class="fa fa-bookmark-o newFontTag"></i>  '.$CatName.'</span>
							<a href="'.BASE_URL.'item/'._e($row['item_Id']).'"><img src="'.ADMIN_URL.'_item_secure_/'._e($row['item_Id']).'/'._e($row['item_preview']).'"  alt="Preview Image" class="card-img-top img-fluid" style="max-height:170px;"></a>
						
                        <div class="card-block">
                            <a href="'.BASE_URL.'item/'._e($row['item_Id']).'" class="text-info"><h4 class="card-title">'.strip_tags(substr_replace($row['item_name'], $dot, 24)).'</h4></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats newFont">
                               '.$itemLove.'  &ensp; '.$sale.' 
							   
							   <span class="float-right">'.$buyNowButton.'</span>
                            </div>
							
                        </div>
                    </div>
                </div>
		';
	}
	
	$output .= '</div>';
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