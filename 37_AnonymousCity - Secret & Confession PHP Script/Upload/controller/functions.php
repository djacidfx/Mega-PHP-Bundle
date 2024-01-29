<?php 
$whitelist = array(
    '127.0.0.1',
    '::1'
);

function _e($string) {
	return htmlentities(strip_tags($string), ENT_QUOTES, 'UTF-8');
}

function find_blocked_ip($pdo , $userNewIp) {
    $query = "SELECT * FROM ot_ip_blocked WHERE blocked_ip = '".$userNewIp."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function file_get_contents_ssl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3000); // 3 sec.
    curl_setopt($ch, CURLOPT_TIMEOUT, 10000); // 10 sec.
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function check_admin_logged_in($pdo){
    if(!isset($_SESSION['boss'])) 
    {
        header("location: ".ADMIN_URL."signout");
        exit;
    } 
}

function count_total_posts($pdo){
	$query = "SELECT * FROM ot_secrets WHERE 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_posts_today($pdo){
    $start = date("Y-m-d") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-d") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_secrets WHERE secret_date >= '".$start."' and secret_date <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_posts_thismonth($pdo){
    $start = date("Y-m-01") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-t") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_secrets WHERE secret_date >= '".$start."' and secret_date <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_unseenposts($pdo){
	$query = "SELECT * FROM ot_secrets WHERE admin_seen = '0' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_seenposts($pdo){
	$query = "SELECT * FROM ot_secrets WHERE admin_seen = '1' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_featuredposts($pdo){
	$query = "SELECT * FROM ot_secrets WHERE featured = '1' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_trendingposts($pdo){
	$query = "SELECT * FROM ot_secrets WHERE trending = '1' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_comments($pdo){
	$query = "SELECT * FROM ot_comments WHERE 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_comments_today($pdo){
    $start = date("Y-m-d") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-d") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_comments WHERE comment_time >= '".$start."' and comment_time <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_comments_thismonth($pdo){
    $start = date("Y-m-01") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-t") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_comments WHERE comment_time >= '".$start."' and comment_time <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_seencomments($pdo){
	$query = "SELECT * FROM ot_comments WHERE comment_seen= '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_unseencomments($pdo){
	$query = "SELECT * FROM ot_comments WHERE comment_seen= '0'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_blockedip($pdo){
	$query = "SELECT * FROM ot_ip_blocked WHERE 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_blockedip_today($pdo){
    $start = date("Y-m-d") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-d") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_ip_blocked WHERE block_time >= '".$start."' and block_time <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_blockedip_thismonth($pdo){
    $start = date("Y-m-01") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-t") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_ip_blocked WHERE block_time >= '".$start."' and block_time <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_post_id($pdo , $postId) {
    $query = "SELECT * FROM ot_secrets WHERE id = '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function featuredload_index($pdo) {
    $query = "SELECT * FROM ot_loader WHERE loader_id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['loading']) ;
    }
    return $output ;
}

function trendingload_index($pdo) {
    $query = "SELECT * FROM ot_loader WHERE loader_id='2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['loading']) ;
    }
    return $output ;
}

function newload_index($pdo) {
    $query = "SELECT * FROM ot_loader WHERE loader_id='3'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['loading']) ;
    }
    return $output ;
}

function featuredload_index_side($pdo) {
    $query = "SELECT * FROM ot_loader WHERE loader_id='4'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['loading']) ;
    }
    return $output ;
}

function trendingload_index_side($pdo) {
    $query = "SELECT * FROM ot_loader WHERE loader_id='5'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['loading']) ;
    }
    return $output ;
}

function featuredload_featuredpage($pdo) {
    $query = "SELECT * FROM ot_loader WHERE loader_id='6'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['loading']) ;
    }
    return $output ;
}

function trendingload_trendingpage($pdo) {
    $query = "SELECT * FROM ot_loader WHERE loader_id='7'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['loading']) ;
    }
    return $output ;
}

function newload_newpage($pdo) {
    $query = "SELECT * FROM ot_loader WHERE loader_id='8'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['loading']) ;
    }
    return $output ;
}

function searchload_searchpage($pdo) {
    $query = "SELECT * FROM ot_loader WHERE loader_id='9'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['loading']) ;
    }
    return $output ;
}

function about_us($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['about_us']) ;
    }
    return $output ;
}

function copyright_name($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= strip_tags($row['adm_name']) ;
    }
    return $output ;
}

function admin_email($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= strip_tags($row['adm_email']) ;
    }
    return $output ;
}

function analytics_code($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ga_code']) ;
    }
    return $output ;
}

function analytics_user_status($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_on']) ;
    }
    return $output ;
}

function analytics_admin_status($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['admin_on']) ;
    }
    return $output ;
}

function ad_header970_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}


function ad_header970_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function ad_header320_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_header320_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function ad_featuredone300_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='3'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function ad_featuredtwo300_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='4'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function desktopfeatured300_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='3'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_featuredmobileone300_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='7'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}


function mobilefeatured300_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='7'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_trendingone300_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='5'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function ad_trendingtwo300_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='6'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function desktoptrending300_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='5'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_trendingmobileone300_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='8'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}


function mobiletrending300_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='8'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_sidebar600_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='9'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_sidebar600_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='9'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function ad_sidebar300_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='10'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_sidebar300_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='10'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function ad_commonfeatured300_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='11'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_commonfeatured300_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='11'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function ad_commontrending300_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='12'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_commontrending300_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='12'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function post_seen($pdo,$postId) {
    $query = "update ot_secrets set admin_seen = '1' WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    return true ;
}

function post_short_title_by_id($pdo,$postId) {
    $query = "SELECT * FROM ot_secrets WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $strLength = strip_tags($row['title']);
		if(strlen($strLength) > 25) {
			$dot = "...";
		} else {
			$dot = "";
		}
        $output .= strip_tags(substr_replace($row['title'], $dot, 25)) ;
    }
    return $output ;
}

function post_urltitle_by_id($pdo,$postId) {
    $query = "SELECT * FROM ot_secrets WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postTitle = _e($row['title']) ;
        $postUrlTitle = preg_replace("/[^\w]+/", "-", $postTitle);
        $postUrlTitle = strtolower($postUrlTitle)  ;
        $output .= strtolower($postUrlTitle) ;
    }
    return $output ;
}

function post_title_by_id($pdo,$postId) {
    $query = "SELECT * FROM ot_secrets WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postTitle = strip_tags($row['title']) ;
        $output .= $postTitle ;
    }
    return $output ;
}

function check_post_duplicate($pdo,$postTitle){
	$query = "SELECT * FROM ot_secrets WHERE title = '".trim($postTitle)."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_duplicate_title_byId($pdo,$postTitle,$postId){
	$query = "SELECT * FROM ot_secrets WHERE title = '".trim($postTitle)."' and id != '".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function post_description_by_id($pdo,$postId) {
    $query = "SELECT * FROM ot_secrets WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postDescription = base64_decode(_e($row['description'])) ;
        $output .= $postDescription ;
    }
    return $output ;
}

function post_loves_by_id($pdo,$postId) {
    $query = "SELECT * FROM ot_secrets WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postloves = strip_tags($row['loves']) ;
        $output .= $postloves ;
    }
    return $output ;
}

function post_views_by_id($pdo,$postId) {
    $query = "SELECT * FROM ot_secrets WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postviews = strip_tags($row['views']) ;
        $output .= $postviews ;
    }
    return $output ;
}

function increase_views($pdo, $postId){
    $oldView = post_views_by_id($pdo,$postId) ;
    $newView = $oldView + 1 ;
    $upd = $pdo->prepare("update ot_secrets set views = '".$newView."' where id='".$postId."'") ;
    $upd->execute();
    return true ;
}

function post_date_by_id($pdo,$postId) {
    $query = "SELECT * FROM ot_secrets WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postdate = strip_tags($row['secret_date']) ;
        $postdate = date('d F, Y',strtotime($postdate));
        $output .= $postdate ;
    }
    return $output ;
}

function count_comment($pdo,$postId){
    $query = "SELECT count(comment_id) as totalComments FROM ot_comments WHERE post_id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $totalComments = _e($row['totalComments']) ;
        $output .= $totalComments ;
    }
    return $output ;
}

function already_loved_message($pdo){
  $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $lovemsg = strip_tags($row['love_msg']) ;
        $output .= $lovemsg ;
    }
    return $output ;  
}

function block_message($pdo){
  $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $lovemsg = strip_tags($row['block_msg']) ;
        $output .= $lovemsg ;
    }
    return $output ;  
}

function check_userlove_post($pdo,$postId,$userIp){
	$query = "SELECT * FROM ot_secret_love WHERE love_post_id = '".$postId."' and love_user_ip = '".$userIp."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function grab_featured_post_for_index($pdo,$limit){
    $query = "SELECT * FROM ot_secrets WHERE featured='1' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postId = _e($row['id']) ;
        $postshortTitle = post_short_title_by_id($pdo,$postId) ;
        $postTitle = post_title_by_id($pdo,$postId) ;
        $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
        $postCommentCount = count_comment($pdo,$postId) ;
        $postLoves = post_loves_by_id($pdo,$postId) ;
        $postViews = post_views_by_id($pdo,$postId) ;
        $postDate = post_date_by_id($pdo,$postId) ;
        $output .= '<div class="col-lg-6 p-md-1 mt-2">
                            <div class="card bg-dark shadow-lg text-start">
                                <div class="card-header text-white fixH ">
                                    <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                </div>
                                <div class="card-body text-white ps-2"> 
                                    <span class="p-1"><i class="bi bi-bookmark-star text-warning pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Featured"></i></span>
                                    <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                    <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                    <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                    <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                </div>
                            </div>
                        </div>
        
        
        ' ;
    }
    return $output ;
}

function grab_featured_post_for_sidebar($pdo,$limit){
    $query = "SELECT * FROM ot_secrets WHERE featured='1' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postId = _e($row['id']) ;
        $postshortTitle = post_short_title_by_id($pdo,$postId) ;
        $postTitle = post_title_by_id($pdo,$postId) ;
        $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
        $postCommentCount = count_comment($pdo,$postId) ;
        $postLoves = post_loves_by_id($pdo,$postId) ;
        $postViews = post_views_by_id($pdo,$postId) ;
        $postDate = post_date_by_id($pdo,$postId) ;
        $output .= '
                    <div class="body">
                        <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'">
                            <div class="col-lg-12 customBottomBorder p-2 text-start ps-3 btn-grey text-muted">
                                <i class="bi bi-link-45deg text-primary"></i> '.$postshortTitle.'
                            </div>
                        </a>
                    </div>
        ';
    }
    return $output ;
}

function grab_trending_post_for_index($pdo,$limit){
    $query = "SELECT * FROM ot_secrets WHERE trending='1' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postId = _e($row['id']) ;
        $postshortTitle = post_short_title_by_id($pdo,$postId) ;
        $postTitle = post_title_by_id($pdo,$postId) ;
        $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
        $postCommentCount = count_comment($pdo,$postId) ;
        $postLoves = post_loves_by_id($pdo,$postId) ;
        $postViews = post_views_by_id($pdo,$postId) ;
        $postDate = post_date_by_id($pdo,$postId) ;
        $output .= '<div class="col-lg-6 p-md-1 mt-2">
                            <div class="card bg-dark shadow-lg text-start">
                                <div class="card-header text-white fixH ">
                                    <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                </div>
                                <div class="card-body text-white ps-2"> 
                                    <span class="p-1"><i class="bi bi-graph-up text-success pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Trending"></i></span>
                                    <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                    <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                    <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                    <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                </div>
                            </div>
                        </div>
        
        
        ' ;
    }
    return $output ;
}

function grab_trending_post_for_sidebar($pdo,$limit){
    $query = "SELECT * FROM ot_secrets WHERE trending='1' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postId = _e($row['id']) ;
        $postshortTitle = post_short_title_by_id($pdo,$postId) ;
        $postTitle = post_title_by_id($pdo,$postId) ;
        $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
        $postCommentCount = count_comment($pdo,$postId) ;
        $postLoves = post_loves_by_id($pdo,$postId) ;
        $postViews = post_views_by_id($pdo,$postId) ;
        $postDate = post_date_by_id($pdo,$postId) ;
        $output .= '
                    <div class="body">
                        <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'">
                            <div class="col-lg-12 customBottomBorder p-2 text-start ps-3 btn-grey text-muted">
                                <i class="bi bi-link-45deg text-primary"></i> '.$postshortTitle.'
                            </div>
                        </a>
                    </div>
        ';
    }
    return $output ;
}

function grab_new_post_for_index($pdo,$limit){
    $query = "SELECT * FROM ot_secrets WHERE trending='0' and featured='0' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postId = _e($row['id']) ;
        $postshortTitle = post_short_title_by_id($pdo,$postId) ;
        $postTitle = post_title_by_id($pdo,$postId) ;
        $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
        $postCommentCount = count_comment($pdo,$postId) ;
        $postLoves = post_loves_by_id($pdo,$postId) ;
        $postViews = post_views_by_id($pdo,$postId) ;
        $postDate = post_date_by_id($pdo,$postId) ;
        $output .= '<div class="col-lg-6 p-md-1 mt-2">
                            <div class="card bg-dark shadow-lg text-start">
                                <div class="card-header text-white fixH ">
                                    <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                </div>
                                <div class="card-body text-white ps-2"> 
                                    <span class="p-1"><i class="bi bi-broadcast text-info pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="New"></i></span>
                                    <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                    <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                    <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                    <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                </div>
                            </div>
                        </div>
        
        
        ' ;
    }
    return $output ;
}

function grab_post_footer($pdo,$postId){
    $query = "SELECT * FROM ot_secrets WHERE id='".$postId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $postId = _e($row['id']) ;
        $postshortTitle = post_short_title_by_id($pdo,$postId) ;
        $postTitle = post_title_by_id($pdo,$postId) ;
        $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
        $postCommentCount = count_comment($pdo,$postId) ;
        $postLoves = post_loves_by_id($pdo,$postId) ;
        $postViews = post_views_by_id($pdo,$postId) ;
        $postDate = post_date_by_id($pdo,$postId) ;
        $postViews = post_views_by_id($pdo,$postId) ;
        $output .= '
                    <span class="p-1"><i class="bi bi-bookmark-star text-warning pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Featured"></i></span>
                    <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userPostLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                    <span class="p-1"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i> '.$postCommentCount.'</span>
                    <span class="p-1"><i class="bi bi-emoji-heart-eyes text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Views"></i> '.$postViews.'</span>
                    <span class="p-1"><a href="#!" class="sharePostSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                  ' ;
    }
    return $output ;
}

function get_comments_default($pdo,$postId) {
    $limit = "1";
	$sql = "SELECT count(*) as number_rows FROM ot_comments WHERE post_id = '".$postId."' order by comment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM ot_comments WHERE post_id = '".$postId."' order by comment_id desc LIMIT ".$limit."";
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
            $comment = base64_decode($row['comment']) ;
            $comment = nl2br(strip_tags($comment)) ;
            $adminReply = base64_decode($row['admin_reply']) ;
            if(!empty($adminReply)){
                $adminReply = '<div class="card-footer mySecret text-start">
                                <i class="bi bi-patch-check-fill text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Verified Admin Reply"></i> Admin <br> '.base64_decode($row['admin_reply']).'
                                </div>
                
                ';
            } else {
                $adminReply = "" ;
            }
            $output .= '<div class="card bg-dark newShadow cp-0">
                            <div class="card-header mySecret text-start text-muted">
                                <i class="bi bi-emoji-sunglasses bigIcon text-primary"  data-bs-toggle="tooltip" data-bs-placement="top" title="Anonymous User"></i> <small class="text-muted">&ensp;'.$commentDate.'</small>
                            </div>
                            <div class="card-body mySecret text-start">
                                '.$comment.'
                            </div>
                            '.$adminReply.'
                        </div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_comment" id="show_more_comment'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$postId.'" class="show_more_allcomment btn btn-grey btn-sm ann'.$commentId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    }
    
	return ($output);
}

function get_comments_onload($pdo,$postId) {
    $limit = "1";
	$sql = "SELECT count(*) as number_rows FROM ot_comments WHERE post_id = '".$postId."' and comment_id < '".$_GET['id']."' order by comment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM ot_comments WHERE post_id = '".$postId."' and comment_id < '".$_GET['id']."' order by comment_id desc LIMIT ".$limit."";
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
            $comment = base64_decode($row['comment']) ;
            $comment = nl2br(strip_tags($comment)) ;
            $adminReply = base64_decode($row['admin_reply']) ;
            if(!empty($adminReply)){
                $adminReply = '<div class="card-footer mySecret text-start">
                                <i class="bi bi-patch-check-fill text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Verified Admin Reply"></i> Admin <br> '.base64_decode($row['admin_reply']).'
                                </div>
                
                ';
            } else {
                $adminReply = "" ;
            }
            $output .= '<div class="card bg-dark newShadow cp-0">
                            <div class="card-header mySecret text-start text-muted">
                                <i class="bi bi-emoji-sunglasses bigIcon text-primary"  data-bs-toggle="tooltip" data-bs-placement="top" title="Anonymous User"></i> <small class="text-muted">&ensp;'.$commentDate.'</small>
                            </div>
                            <div class="card-body mySecret text-start">
                                '.$comment.'
                            </div>
                            '.$adminReply.'
                        </div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_comment" id="show_more_comment'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$postId.'" class="show_more_allcomment btn btn-grey btn-sm ann'.$commentId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    }
    
	return ($output);
}

function get_unseencomments_default($pdo) {
    $limit = "10";
	$sql = "SELECT count(*) as number_rows FROM ot_comments WHERE comment_seen = '0' order by comment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM ot_comments WHERE comment_seen = '0' order by comment_id desc LIMIT ".$limit."";
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
            $usercomment = nl2br(base64_decode($row['comment'])) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $adminReply = base64_decode($row['admin_reply']) ;
            $uip = _e($row['c_user_ip']);
            $blockIp = base64_encode($uip) ;
            if(!empty($adminReply)){
                $adminReply = '<div class="col-lg-12 mySecret text-start">
                                <i class="bi bi-patch-check-fill text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Verified Admin Reply"></i> Admin <br> '.base64_decode($row['admin_reply']).'
                                </div>
                
                ';
            } else {
                $adminReply = "" ;
            }
            $output .= '<div class="card bg-dark newShadow cp-0 showform'.$commentId.'">
                            <div class="card-header mySecret text-start text-muted">
                            <div class="row">
                                <div class="col-lg-12 text-white bigFont customBottomBorder">
                                    <i class="bi bi-signpost-2-fill text-danger "></i> '.$postTitle.' <a href="'.ADMIN_URL.'edit?id='.$postId.'" target="_blank" class="text-end btn btn-grey btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View / Edit Post"><i class="bi bi-pencil-square text-danger"></i></a>
                                </div>
                                <div class="col-lg-6 mt-2">
                                <div class="col-lg-12">
                                    <i class="bi bi-emoji-sunglasses bigIcon text-primary"  data-bs-toggle="tooltip" data-bs-placement="top" title="User Comment"></i> <small class="text-muted">&ensp;'.$commentDate.'</small>
                                </div>
                                <div class="col-lg-12">
                                    '.$usercomment.'
                                </div>
                                </div>
                                <div class="col-lg-6 mt-2">
                                '.$adminReply.'
                                </div>
                            </div>
                            </div>
                            
                            <div class="card-body mySecret text-start">
                                <form method="post" class="commentReply" id="'.$commentId.'">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-muted">Edit User Comment*</label>
                                            <textarea name="userComment" class="form-control new_txtarea" autofocus required>'.$usercomment.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-muted">Edit / Post Admin Reply</label>
                                            <textarea name="adminReply" class="form-control new_txtarea" autofocus >'.base64_decode($row['admin_reply']).'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mt-3 text-center">
                                            <div class="remove-messages"></div>
                                            <input type="hidden" name="cid" value="'.$commentId.'">
                                            <input type="hidden" name="btn_action" value="postCommentReply">
                                            <button type="submit" class="btn btn-md btn-grey action_sb">Mark Seen & Post Reply</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            
                            <div class="card-footer text-center ">
                                <div class="form-group">
                                    <label class="text-muted">User IP : '.$uip.'</label>
                                </div>
                                <button class="btn btn-sm btn-danger markOnlySeen " id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark Only Seen"><i class="bi bi-eye text-white"></i></button>
                                &ensp;
                                <button class="btn btn-sm btn-danger deleteComment " id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Comment"><i class="bi bi-trash-fill text-white"></i></button>
                                &ensp;
                                <button class="btn btn-sm btn-danger deleteCommentBlock " id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Comment & Block User IP" data-status = '.$blockIp.'><i class="bi bi-person-x-fill text-white"></i></button>
                            </div>
                        </div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_unseencomment" id="show_more_unseencomment'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$commentId.'" class="show_more_allunseencomment btn btn-grey btn-sm ann'.$commentId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    } else {
        $output .= '<div class="card bg-dark newShadow cp-0 text-center">
                            <div class="card-header mySecret text-center text-muted">
                                <div class="col-lg-12">
                                    <i class="bi bi-exclamation-circle bigIcon text-danger"></i> No Unseen Comment right now.
                                </div>
                            </div>
                    </div>';
    }
    
	return ($output);
}

function get_unseencomments_onload($pdo,$oldcommentId) {
    $limit = "10";
	$sql = "SELECT count(*) as number_rows FROM ot_comments WHERE comment_seen = '0' and comment_id < '".$oldcommentId."' order by comment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM ot_comments WHERE comment_seen = '0' and comment_id < '".$oldcommentId."' order by comment_id desc LIMIT ".$limit."";
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
            $usercomment = nl2br(base64_decode($row['comment'])) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $adminReply = base64_decode($row['admin_reply']) ;
            $uip = _e($row['c_user_ip']);
            $blockIp = base64_encode($uip) ;
            if(!empty($adminReply)){
                $adminReply = '<div class="col-lg-12 mySecret text-start">
                                <i class="bi bi-patch-check-fill text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Verified Admin Reply"></i> Admin <br> '.base64_decode($row['admin_reply']).'
                                </div>
                
                ';
            } else {
                $adminReply = "" ;
            }
            $output .= '<div class="card bg-dark newShadow cp-0 showform'.$commentId.'">
                            <div class="card-header mySecret text-start text-muted">
                            <div class="row">
                                <div class="col-lg-12 text-white bigFont customBottomBorder">
                                    <i class="bi bi-signpost-2-fill text-danger "></i> '.$postTitle.' <a href="'.ADMIN_URL.'edit?id='.$postId.'" target="_blank" class="text-end btn btn-grey btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View / Edit Post"><i class="bi bi-pencil-square text-danger"></i></a>
                                </div>
                                <div class="col-lg-6 mt-2">
                                <div class="col-lg-12">
                                    <i class="bi bi-emoji-sunglasses bigIcon text-primary"  data-bs-toggle="tooltip" data-bs-placement="top" title="User Comment"></i> <small class="text-muted">&ensp;'.$commentDate.'</small>
                                </div>
                                <div class="col-lg-12">
                                    '.$usercomment.'
                                </div>
                                </div>
                                <div class="col-lg-6 mt-2">
                                '.$adminReply.'
                                </div>
                            </div>
                            </div>
                            
                            <div class="card-body mySecret text-start">
                                <form method="post" class="commentReply" id="'.$commentId.'">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-muted">Edit User Comment*</label>
                                            <textarea name="userComment" class="form-control new_txtarea" id="usereditable'.$commentId.'" autofocus required>'.$usercomment.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-muted">Edit / Post Admin Reply*</label>
                                            <textarea name="adminReply" class="form-control new_txtarea" id="admineditable'.$commentId.'" autofocus >'.base64_decode($row['admin_reply']).'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mt-3 text-center">
                                            <div class="remove-messages"></div>
                                            <input type="hidden" name="cid" value="'.$commentId.'">
                                            <input type="hidden" name="btn_action" value="postCommentReply">
                                            <button type="submit" class="btn btn-md btn-grey action_sb">Mark Seen & Post Reply</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            
                            <div class="card-footer text-center ">
                                <div class="form-group">
                                    <label class="text-muted">User IP : '.$uip.'</label>
                                </div>
                                <button class="btn btn-sm btn-danger markOnlySeen" id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark Only Seen"><i class="bi bi-eye text-white"></i></button>
                                &ensp;
                                <button class="btn btn-sm btn-danger deleteComment" id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Comment"><i class="bi bi-trash-fill text-white"></i></button>
                                &ensp;
                                <button class="btn btn-sm btn-danger deleteCommentBlock" id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Comment & Block User IP" data-status = '.$blockIp.'><i class="bi bi-person-x-fill text-white"></i></button>
                            </div>
                        </div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_unseencomment" id="show_more_unseencomment'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$commentId.'" class="show_more_allunseencomment btn btn-grey btn-sm ann'.$commentId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    } 
    
	return ($output);
}


function get_seencomments_default($pdo) {
    $limit = "1";
	$sql = "SELECT count(*) as number_rows FROM ot_comments WHERE comment_seen = '1' order by comment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM ot_comments WHERE comment_seen = '1' order by comment_id desc LIMIT ".$limit."";
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
            $usercomment = nl2br(base64_decode($row['comment'])) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $adminReply = base64_decode($row['admin_reply']) ;
            $uip = _e($row['c_user_ip']);
            $blockIp = base64_encode($uip) ;
            if(!empty($adminReply)){
                $adminReply = '<div class="col-lg-12 mySecret text-start">
                                <i class="bi bi-patch-check-fill text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Verified Admin Reply"></i> Admin <br> '.base64_decode($row['admin_reply']).'
                                </div>
                
                ';
            } else {
                $adminReply = "" ;
            }
            $output .= '<div class="card bg-dark newShadow cp-0 showform'.$commentId.'">
                            <div class="card-header mySecret text-start text-muted">
                            <div class="row">
                                <div class="col-lg-12 text-white bigFont customBottomBorder">
                                    <i class="bi bi-signpost-2-fill text-danger "></i> '.$postTitle.' <a href="'.ADMIN_URL.'edit?id='.$postId.'" target="_blank" class="text-end btn btn-grey btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View / Edit Post"><i class="bi bi-pencil-square text-danger"></i></a>
                                </div>
                                <div class="col-lg-6 mt-2">
                                <div class="col-lg-12">
                                    <i class="bi bi-emoji-sunglasses bigIcon text-primary"  data-bs-toggle="tooltip" data-bs-placement="top" title="User Comment"></i> <small class="text-muted">&ensp;'.$commentDate.'</small>
                                </div>
                                <div class="col-lg-12">
                                    '.$usercomment.'
                                </div>
                                </div>
                                <div class="col-lg-6 mt-2">
                                '.$adminReply.'
                                </div>
                            </div>
                            </div>
                            
                            <div class="card-body mySecret text-start">
                                <form method="post" class="commentReply" id="'.$commentId.'">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-muted">Edit User Comment*</label>
                                            <textarea name="userComment" class="form-control new_txtarea" autofocus required>'.$usercomment.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-muted">Edit / Post Admin Reply</label>
                                            <textarea name="adminReply" class="form-control new_txtarea" autofocus >'.base64_decode($row['admin_reply']).'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mt-3 text-center">
                                            <div class="remove-messages"></div>
                                            <input type="hidden" name="cid" value="'.$commentId.'">
                                            <input type="hidden" name="btn_action" value="postCommentReply">
                                            <button type="submit" class="btn btn-md btn-grey action_sb">Mark Seen & Post Reply</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            
                            <div class="card-footer text-center ">
                                <div class="form-group">
                                    <label class="text-muted">User IP : '.$uip.'</label>
                                </div>
                                <button class="btn btn-sm btn-danger markOnlyUnSeen " id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark Only UnSeen"><i class="bi bi-eye-slash text-white"></i></button>
                                &ensp;
                                <button class="btn btn-sm btn-danger deleteComment " id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Comment"><i class="bi bi-trash-fill text-white"></i></button>
                                &ensp;
                                <button class="btn btn-sm btn-danger deleteCommentBlock " id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Comment & Block User IP" data-status = '.$blockIp.'><i class="bi bi-person-x-fill text-white"></i></button>
                            </div>
                        </div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_seencomment" id="show_more_seencomment'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$commentId.'" class="show_more_allseencomment btn btn-grey btn-sm ann'.$commentId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    } else {
        $output .= '<div class="card bg-dark newShadow cp-0 text-center">
                            <div class="card-header mySecret text-center text-muted">
                                <div class="col-lg-12">
                                    <i class="bi bi-exclamation-circle bigIcon text-danger"></i> No Seen Comment right now.
                                </div>
                            </div>
                    </div>';
    }
    
	return ($output);
}

function get_seencomments_onload($pdo,$oldcommentId) {
    $limit = "1";
	$sql = "SELECT count(*) as number_rows FROM ot_comments WHERE comment_seen = '1' and comment_id < '".$oldcommentId."' order by comment_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
	$query = "SELECT * FROM ot_comments WHERE comment_seen = '1' and comment_id < '".$oldcommentId."' order by comment_id desc LIMIT ".$limit."";
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
            $usercomment = nl2br(base64_decode($row['comment'])) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $adminReply = base64_decode($row['admin_reply']) ;
            $uip = _e($row['c_user_ip']);
            $blockIp = base64_encode($uip) ;
            if(!empty($adminReply)){
                $adminReply = '<div class="col-lg-12 mySecret text-start">
                                <i class="bi bi-patch-check-fill text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Verified Admin Reply"></i> Admin <br> '.base64_decode($row['admin_reply']).'
                                </div>
                
                ';
            } else {
                $adminReply = "" ;
            }
            $output .= '<div class="card bg-dark newShadow cp-0 showform'.$commentId.'">
                            <div class="card-header mySecret text-start text-muted">
                            <div class="row">
                                <div class="col-lg-12 text-white bigFont customBottomBorder">
                                    <i class="bi bi-signpost-2-fill text-danger "></i> '.$postTitle.' <a href="'.ADMIN_URL.'edit?id='.$postId.'" target="_blank" class="text-end btn btn-grey btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View / Edit Post"><i class="bi bi-pencil-square text-danger"></i></a>
                                </div>
                                <div class="col-lg-6 mt-2">
                                <div class="col-lg-12">
                                    <i class="bi bi-emoji-sunglasses bigIcon text-primary"  data-bs-toggle="tooltip" data-bs-placement="top" title="User Comment"></i> <small class="text-muted">&ensp;'.$commentDate.'</small>
                                </div>
                                <div class="col-lg-12">
                                    '.$usercomment.'
                                </div>
                                </div>
                                <div class="col-lg-6 mt-2">
                                '.$adminReply.'
                                </div>
                            </div>
                            </div>
                            
                            <div class="card-body mySecret text-start">
                                <form method="post" class="commentReply" id="'.$commentId.'">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="text-muted">Edit User Comment*</label>
                                            <textarea name="userComment" class="form-control new_txtarea" id="usereditable'.$commentId.'" autofocus required>'.$usercomment.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label class="text-muted">Edit / Post Admin Reply*</label>
                                            <textarea name="adminReply" class="form-control new_txtarea" id="admineditable'.$commentId.'" autofocus >'.base64_decode($row['admin_reply']).'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mt-3 text-center">
                                            <div class="remove-messages"></div>
                                            <input type="hidden" name="cid" value="'.$commentId.'">
                                            <input type="hidden" name="btn_action" value="postCommentReply">
                                            <button type="submit" class="btn btn-md btn-grey action_sb">Mark Seen & Post Reply</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            
                            <div class="card-footer text-center ">
                                <div class="form-group">
                                    <label class="text-muted">User IP : '.$uip.'</label>
                                </div>
                                <button class="btn btn-sm btn-danger markOnlyUnSeen" id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark Only UnSeen"><i class="bi bi-eye-slash text-white"></i></button>
                                &ensp;
                                <button class="btn btn-sm btn-danger deleteComment" id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Comment"><i class="bi bi-trash-fill text-white"></i></button>
                                &ensp;
                                <button class="btn btn-sm btn-danger deleteCommentBlock" id="'.$commentId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Comment & Block User IP" data-status = '.$blockIp.'><i class="bi bi-person-x-fill text-white"></i></button>
                            </div>
                        </div>
            ';

        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_seencomment" id="show_more_seencomment'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$commentId.'" class="show_more_allseencomment btn btn-grey btn-sm ann'.$commentId.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
	
	
    } 
    
	return ($output);
}

function grab_featured_allpost_default($pdo,$limit){
    $sql = "SELECT count(*) as number_rows FROM ot_secrets WHERE featured='1' order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_secrets WHERE featured='1' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $postId = _e($row['id']) ;
            $postshortTitle = post_short_title_by_id($pdo,$postId) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
            $postCommentCount = count_comment($pdo,$postId) ;
            $postLoves = post_loves_by_id($pdo,$postId) ;
            $postViews = post_views_by_id($pdo,$postId) ;
            $postDate = post_date_by_id($pdo,$postId) ;
            $output .= '<div class="col-lg-6 p-md-1 mt-2">
                                <div class="card bg-dark shadow-lg text-start">
                                    <div class="card-header text-white fixH ">
                                        <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                    </div>
                                    <div class="card-body text-white ps-2"> 
                                        <span class="p-1"><i class="bi bi-bookmark-star text-warning pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Featured"></i></span>
                                        <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                        <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                    </div>
                                </div>
                            </div>


            ' ;
        }
        
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_featured" id="show_more_featured'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$postId.'" class="show_more_allfeatured btn btn-grey btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        
    } else {
        $output .= '<div class="card bg-dark newShadow cp-0 text-center">
                            <div class="card-header mySecret text-center text-muted">
                                <div class="col-lg-12">
                                    <i class="bi bi-exclamation-circle bigIcon text-danger"></i> No Featured Secrets & Confessions right now.
                                </div>
                            </div>
                    </div>';
    }
    return $output ;
}

function grab_featured_allpost_onload($pdo,$limit){
    $sql = "SELECT count(*) as number_rows FROM ot_secrets WHERE featured='1' and id < '".$_GET['id']."'  order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_secrets WHERE featured='1' and id < '".$_GET['id']."' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $postId = _e($row['id']) ;
            $postshortTitle = post_short_title_by_id($pdo,$postId) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
            $postCommentCount = count_comment($pdo,$postId) ;
            $postLoves = post_loves_by_id($pdo,$postId) ;
            $postViews = post_views_by_id($pdo,$postId) ;
            $postDate = post_date_by_id($pdo,$postId) ;
            $output .= '<div class="col-lg-6 p-md-1 mt-2">
                                <div class="card bg-dark shadow-lg text-start">
                                    <div class="card-header text-white fixH ">
                                        <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                    </div>
                                    <div class="card-body text-white ps-2"> 
                                        <span class="p-1"><i class="bi bi-bookmark-star text-warning pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Featured"></i></span>
                                        <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                        <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                    </div>
                                </div>
                            </div>


            ' ;
        }
        
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_featured" id="show_more_featured'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$postId.'" class="show_more_allfeatured btn btn-grey btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        
    } 
    return $output ;
}

function grab_trending_allpost_default($pdo,$limit){
    $sql = "SELECT count(*) as number_rows FROM ot_secrets WHERE trending='1' order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_secrets WHERE trending='1' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $postId = _e($row['id']) ;
            $postshortTitle = post_short_title_by_id($pdo,$postId) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
            $postCommentCount = count_comment($pdo,$postId) ;
            $postLoves = post_loves_by_id($pdo,$postId) ;
            $postViews = post_views_by_id($pdo,$postId) ;
            $postDate = post_date_by_id($pdo,$postId) ;
            $output .= '<div class="col-lg-6 p-md-1 mt-2">
                                <div class="card bg-dark shadow-lg text-start">
                                    <div class="card-header text-white fixH ">
                                        <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                    </div>
                                    <div class="card-body text-white ps-2"> 
                                        <span class="p-1"><i class="bi bi-graph-up text-success pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Trending"></i></span>
                                        <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                        <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                    </div>
                                </div>
                            </div>


            ' ;
        }
        
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_trending" id="show_more_trending'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$postId.'" class="show_more_alltrending btn btn-grey btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        
    } else {
        $output .= '<div class="card bg-dark newShadow cp-0 text-center">
                            <div class="card-header mySecret text-center text-muted">
                                <div class="col-lg-12">
                                    <i class="bi bi-exclamation-circle bigIcon text-danger"></i> No Trending Secrets & Confessions right now.
                                </div>
                            </div>
                    </div>';
    }
    return $output ;
}

function grab_trending_allpost_onload($pdo,$limit){
    $sql = "SELECT count(*) as number_rows FROM ot_secrets WHERE trending='1' and id < '".$_GET['id']."'  order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_secrets WHERE trending='1' and id < '".$_GET['id']."' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $postId = _e($row['id']) ;
            $postshortTitle = post_short_title_by_id($pdo,$postId) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
            $postCommentCount = count_comment($pdo,$postId) ;
            $postLoves = post_loves_by_id($pdo,$postId) ;
            $postViews = post_views_by_id($pdo,$postId) ;
            $postDate = post_date_by_id($pdo,$postId) ;
            $output .= '<div class="col-lg-6 p-md-1 mt-2">
                                <div class="card bg-dark shadow-lg text-start">
                                    <div class="card-header text-white fixH ">
                                        <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                    </div>
                                    <div class="card-body text-white ps-2"> 
                                        <span class="p-1"><i class="bi bi-graph-up text-success pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Trending"></i></span>
                                        <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                        <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                    </div>
                                </div>
                            </div>


            ' ;
        }
        
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_trending" id="show_more_trending'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$postId.'" class="show_more_alltrending btn btn-grey btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        
    } 
    return $output ;
}

function grab_new_allpost_default($pdo,$limit){
    $sql = "SELECT count(*) as number_rows FROM ot_secrets WHERE trending !='1' and featured != '1' order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_secrets WHERE trending !='1' and featured != '1' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $postId = _e($row['id']) ;
            $postshortTitle = post_short_title_by_id($pdo,$postId) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
            $postCommentCount = count_comment($pdo,$postId) ;
            $postLoves = post_loves_by_id($pdo,$postId) ;
            $postViews = post_views_by_id($pdo,$postId) ;
            $postDate = post_date_by_id($pdo,$postId) ;
            $output .= '<div class="col-lg-6 p-md-1 mt-2">
                                <div class="card bg-dark shadow-lg text-start">
                                    <div class="card-header text-white fixH ">
                                        <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                    </div>
                                    <div class="card-body text-white ps-2"> 
                                        <span class="p-1"><i class="bi bi-broadcast text-info pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="New"></i></span>
                                        <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                        <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                    </div>
                                </div>
                            </div>


            ' ;
        }
        
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_new" id="show_more_new'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$postId.'" class="show_more_allnew btn btn-grey btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        
    } else {
        $output .= '<div class="card bg-dark newShadow cp-0 text-center">
                            <div class="card-header mySecret text-center text-muted">
                                <div class="col-lg-12">
                                    <i class="bi bi-exclamation-circle bigIcon text-danger"></i> No New Secrets & Confessions right now.
                                </div>
                            </div>
                    </div>';
    }
    return $output ;
}

function grab_new_allpost_onload($pdo,$limit){
    $sql = "SELECT count(*) as number_rows FROM ot_secrets WHERE trending != '1' and featured != '1' and id < '".$_GET['id']."'  order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_secrets WHERE trending != '1' and featured != '1' and id < '".$_GET['id']."' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $postId = _e($row['id']) ;
            $postshortTitle = post_short_title_by_id($pdo,$postId) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
            $postCommentCount = count_comment($pdo,$postId) ;
            $postLoves = post_loves_by_id($pdo,$postId) ;
            $postViews = post_views_by_id($pdo,$postId) ;
            $postDate = post_date_by_id($pdo,$postId) ;
            $output .= '<div class="col-lg-6 p-md-1 mt-2">
                                <div class="card bg-dark shadow-lg text-start">
                                    <div class="card-header text-white fixH ">
                                        <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                    </div>
                                    <div class="card-body text-white ps-2"> 
                                        <span class="p-1"><i class="bi bi-broadcast text-info pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="New"></i></span>
                                        <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                        <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                    </div>
                                </div>
                            </div>


            ' ;
        }
        
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_new" id="show_more_new'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$postId.'" class="show_more_allnew btn btn-grey btn-sm">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        
    } 
    return $output ;
}

function grab_search_default($pdo,$search){
    $limit = searchload_searchpage($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_secrets WHERE (title LIKE '%$search%') order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_secrets WHERE (title LIKE '%$search%') order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $postId = _e($row['id']) ;
            $postshortTitle = post_short_title_by_id($pdo,$postId) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
            $postCommentCount = count_comment($pdo,$postId) ;
            $postLoves = post_loves_by_id($pdo,$postId) ;
            $postViews = post_views_by_id($pdo,$postId) ;
            $postDate = post_date_by_id($pdo,$postId) ;
            $featured = _e($row['featured']) ;
            $trending = _e($row['trending']) ;
            $badge = '' ;
            if($featured == '1'){
                $badge = '<span class="p-1"><i class="bi bi-bookmark-star text-warning pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="New"></i></span>' ;
            }
            if($trending == '1'){
                $badge = '<span class="p-1"><i class="bi bi-graph-up text-success pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="New"></i></span>' ;
            }
            if( ($trending == '0') && ($featured == '0') ){
                $badge = '<span class="p-1"><i class="bi bi-broadcast text-info pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="New"></i></span>' ;
            }
            $output .= '<div class="col-lg-6 p-md-1 mt-2">
                                <div class="card bg-dark shadow-lg text-start">
                                    <div class="card-header text-white fixH ">
                                        <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                    </div>
                                    <div class="card-body text-white ps-2"> 
                                        '.$badge.'
                                        <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                        <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                    </div>
                                </div>
                            </div>


            ' ;
        }
        
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_search" id="show_more_search'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$postId.'" class="show_more_allsearch btn btn-grey btn-sm ann'.$search.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        
    } else {
        $output .= '<div class="card bg-dark newShadow cp-0 text-center">
                            <div class="card-header mySecret text-center text-muted">
                                <div class="col-lg-12">
                                    <i class="bi bi-exclamation-circle bigIcon text-danger"></i> Nothing Found ! Try again with another search term.
                                </div>
                            </div>
                    </div>';
    }
    return $output ;
}


function grab_search_onload($pdo,$search,$postId){
    $limit = searchload_searchpage($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_secrets WHERE (title LIKE '%$search%') and id < '".$postId."' order by id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_secrets WHERE (title LIKE '%$search%') and id < '".$postId."' order by id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $postId = _e($row['id']) ;
            $postshortTitle = post_short_title_by_id($pdo,$postId) ;
            $postTitle = post_title_by_id($pdo,$postId) ;
            $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
            $postCommentCount = count_comment($pdo,$postId) ;
            $postLoves = post_loves_by_id($pdo,$postId) ;
            $postViews = post_views_by_id($pdo,$postId) ;
            $postDate = post_date_by_id($pdo,$postId) ;
            $featured = _e($row['featured']) ;
            $trending = _e($row['trending']) ;
            $badge = '' ;
            if($featured == '1'){
                $badge = '<span class="p-1"><i class="bi bi-bookmark-star text-warning pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="New"></i></span>' ;
            }
            if($trending == '1'){
                $badge = '<span class="p-1"><i class="bi bi-graph-up text-success pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="New"></i></span>' ;
            }
            if( ($trending == '0') && ($featured == '0') ){
                $badge = '<span class="p-1"><i class="bi bi-broadcast text-info pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="New"></i></span>' ;
            }
            $output .= '<div class="col-lg-6 p-md-1 mt-2">
                                <div class="card bg-dark shadow-lg text-start">
                                    <div class="card-header text-white fixH ">
                                        <a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$postTitle.'"><h5>'.$postshortTitle.'</h5></a>
                                    </div>
                                    <div class="card-body text-white ps-2"> 
                                        '.$badge.'
                                        <span class="p-1"><i class="bi bi-suit-heart text-white pointer bigIcon userLove" id="'.$postId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Love" data-status = '.$_SERVER['REMOTE_ADDR'].'></i> <span class="userLov'.$postId.'">'.$postLoves.'</span></span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-chat-dots text-white pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Comments"></i></a> '.$postCommentCount.'</span>
                                        <span class="p-1"><a href="'.BASE_URL.'secret/'.$postId.'/'.$postUrlTitle.'"><i class="bi bi-link-45deg text-primary pointer bigIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a></span>
                                        <span class="p-1"><a href="#!" class="shareSocial" id="'.$postId.'"><i class="bi bi-share-fill pointer bigIcon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Social Networks"></i></a></span>
                                    </div>
                                </div>
                            </div>


            ' ;
        }
        
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_search" id="show_more_search'.$postId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$postId.'" class="show_more_allsearch btn btn-grey btn-sm ann'.$search.'">Load More</button>
							</div>
							
					</div>
					</div>
					';
		}
        
    } 
    return $output ;
}
?>