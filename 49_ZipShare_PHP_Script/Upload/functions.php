<?php

function _e($string) {
	return htmlentities(strip_tags($string), ENT_QUOTES, 'UTF-8');
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
    if(!isset($_SESSION['master'])) 
    {
        header("location: ".ADMIN_URL."logout");
        exit;
    } 
}

function check_blog_slug($pdo,$blogSlug){
	$query = "SELECT * FROM ot_blogs WHERE  blog_slug = '".$blogSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function blogid_by_blog_slug($pdo,$blogSlug){
	$query = "SELECT * FROM ot_blogs WHERE  blog_slug = '".$blogSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['blog_id']);
	}
	return ($output);
}

function blogslug_by_blogid($pdo,$blogId){
	$query = "SELECT * FROM ot_blogs WHERE  blog_id = '".$blogId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row['blog_slug']);
	}
	return ($output);
}

function blogimage_by_blog_slug($pdo,$blogSlug){
	$query = "SELECT * FROM ot_blogs WHERE  blog_slug = '".$blogSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['blog_image']);
	}
	return ($output);
}

function blogimage_by_blog_id($pdo,$blogId){
	$query = "SELECT * FROM ot_blogs WHERE  blog_id = '".$blogId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['blog_image']);
	}
	return ($output);
}

function blogtitle_by_blog_slug($pdo,$blogSlug){
	$query = "SELECT * FROM ot_blogs WHERE  blog_slug = '".$blogSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row['blog_title']);
	}
	return ($output);
}

function blog_short_title_byslug($pdo,$blogSlug) {
    $query = "SELECT * FROM ot_blogs WHERE blog_slug = '".$blogSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $strLength = strip_tags($row['blog_title']);
		if(strlen($strLength) > 38) {
			$dot = "..";
		} else {
			$dot = "";
		}
        $output .= strip_tags(substr_replace($row['blog_title'], $dot, 38)) ;
    }
    return $output ;
}

function blogshortdescription_by_blog_slug($pdo,$blogSlug){
	$query = "SELECT * FROM ot_blogs WHERE  blog_slug = '".$blogSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row['blog_short_description']);
	}
	return ($output);
}

function blogdescription_by_blog_slug($pdo,$blogSlug){
	$query = "SELECT * FROM ot_blogs WHERE  blog_slug = '".$blogSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= base64_decode(strip_tags($row['blog_description']));
	}
	return ($output);
}

function pageid_by_page_slug($pdo,$pageSlug){
	$query = "SELECT * FROM ot_pages WHERE  page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row['page_id']);
	}
	return ($output);
}

function pageslug_by_pageid($pdo,$pageId){
	$query = "SELECT * FROM ot_pages WHERE  page_id = '".$pageId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= strip_tags($row['page_slug']);
	}
	return ($output);
}

function pagedescription_by_page_slug($pdo,$pageSlug){
	$query = "SELECT * FROM ot_pages WHERE  page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= base64_decode(strip_tags($row['page_description']));
	}
	return ($output);
}

function check_blog_slug_byId($pdo,$blogSlug,$blogId){
	$query = "SELECT * FROM ot_blogs WHERE blog_slug = '".$blogSlug."' and blog_id != '".$blogId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_slug_for_user($pdo){
	$query = "SELECT * FROM ot_pages WHERE  page_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function fetch_active_pages_foruser($pdo){
	$query = "SELECT * FROM ot_pages WHERE page_status = '1' order by page_name ASC";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<a  href="'.BASE_URL.'page/'._e($row["page_slug"]).'"><i class="bi bi-dot me-2"></i>'._e($row["page_name"]).'</a><br>';
	}
	return ($output);
}
function get_page_title($pdo,$pageSlug){
	$query = "SELECT * FROM ot_pages WHERE page_slug = '".$pageSlug."'";
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
	$query = "SELECT * FROM ot_pages WHERE  page_status = '1' and page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function get_page_content($pdo,$pageSlug){
	$query = "SELECT * FROM ot_pages WHERE page_status = '1' and page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= base64_decode($row["page_description"]) ;
	}
	return ($output);
}

function check_category_slug($pdo,$catSlug){
	$query = "SELECT * FROM ot_category WHERE  category_slug = '".$catSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function check_category_slug_byId($pdo,$catSlug,$catId){
	$query = "SELECT * FROM ot_category WHERE category_slug = '".$catSlug."' and cat_id != '".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function check_page_slug($pdo,$pageSlug){
	$query = "SELECT * FROM ot_pages WHERE  page_slug = '".$pageSlug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}
function check_page_slug_byId($pdo,$pageSlug,$pageId){
	$query = "SELECT * FROM ot_pages WHERE  page_slug = '".$pageSlug."' and page_id != '".$pageId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_zipfile($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_zip WHERE 1");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_activezipfile($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_zip WHERE zip_status = '1'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_pendingzipfile($pdo){
    $statement =  $pdo->prepare("SELECT * FROM ot_zip WHERE zip_status = '0'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_featuredzipfile($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_zip WHERE zip_status = '1' and zip_featured = '1'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_popularzipfile($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_zip WHERE zip_status = '1' and zip_popular = '1'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_blogs($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_blogs WHERE 1");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_activeblogs($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_blogs WHERE blog_status = '1'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_deactiveblogs($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_blogs WHERE blog_status = '0'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_pages($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_pages WHERE 1");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_activepages($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_pages WHERE page_status = '1'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_deactivepages($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_pages WHERE page_status = '0'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_category($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_category WHERE 1");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_activecategory($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_category WHERE category_status = '1'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_disabledcategory($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_category WHERE category_status = '0'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_blockedip($pdo){
	$query = "SELECT * FROM ot_blocked_ip WHERE 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function find_blocked_ip($pdo , $userNewIp) {
    $query = "SELECT * FROM ot_blocked_ip WHERE ip_address = '".$userNewIp."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function find_adcode_on($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id = '1' and ad_code_on = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function find_copyrightname($pdo){
    $query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= strip_tags($row['copyright_name']) ;
    }
    return $output ;
}

function find_aboutus($pdo){
    $query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= strip_tags($row['about_us']) ;
    }
    return $output ;
}

function find_adcode($pdo){
    $query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode(strip_tags($row['ad_code'])) ;
    }
    return $output ;
}

function find_analyticcode_on($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id = '1' and analytic_code_on = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function find_analyticcode($pdo){
    $query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode(strip_tags($row['analytic_code'])) ;
    }
    return $output ;
}

function find_auto_approve($pdo){
    $query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['auto_approve']) ;
    }
    return $output ;
}

function find_default_limit($pdo){
    $query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['show_default']) ;
    }
    return $output ;
}

function find_loadmore_limit($pdo){
    $query = "SELECT * FROM ot_admin WHERE id = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['show_load_more']) ;
    }
    return $output ;
}

function get_categoryid_byslug($pdo,$slug){
    $statement =  $pdo->prepare("SELECT * FROM ot_category WHERE category_slug = '".$slug."' ");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['cat_id']) ;
    }
    return $output ;
}

function get_catname_byid($pdo,$catId){
    $statement =  $pdo->prepare("SELECT * FROM ot_category WHERE cat_id = '".$catId."' ");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['category_name']) ;
    }
    return $output ;
}

function show_category_options($pdo){
    $statement =  $pdo->prepare("SELECT * FROM ot_category WHERE category_status = '1' order by category_name asc");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'.$row['cat_id'].'">'.$row['category_name'].'</option>' ;
    }
    return $output ;
}

// Show Active Category Options Link to Users

function show_category_options_withlink($pdo){
    $statement =  $pdo->prepare("SELECT * FROM ot_category WHERE category_status = '1' order by category_name asc");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'.BASE_URL.'category/'.catshortname_by_id($pdo,$row['cat_id']).'">'.$row['category_name'].'</option>' ;
    }
    return $output ;
}

// Show Active Selected Category Options Link to Users

function show_selectedcategory_options_withlink($pdo,$catId){
    $statement =  $pdo->prepare("SELECT * FROM ot_category WHERE cat_id = '".$catId."' and category_status = '1' order by category_name asc");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'.BASE_URL.'category/'.catshortname_by_id($pdo,$row['cat_id']).'">'.$row['category_name'].'</option>' ;
    }
    return $output ;
}

// Show Active Non Selected Category Options Link to Users

function show_nonselectedcategory_options_withlink($pdo,$catId){
    $statement =  $pdo->prepare("SELECT * FROM ot_category WHERE cat_id != '".$catId."' and category_status = '1' order by category_name asc");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= '<option value="'.BASE_URL.'category/'.catshortname_by_id($pdo,$row['cat_id']).'">'.$row['category_name'].'</option>' ;
    }
    return $output ;
}

function catshortname_by_id($pdo,$catId) {
    $query = "SELECT * FROM ot_category WHERE cat_id='".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $catTitle = trim($row['category_name']) ;
        $UrlTitle = preg_replace("/[^\w]+/", "-", $catTitle);
        $UrlTitle = strtolower($UrlTitle)  ;
        $output .= strtolower($UrlTitle) ;
    }
    return $output ;
}

function check_cat_id($pdo,$catId) {
    $query = "SELECT * FROM ot_category WHERE cat_id = '".$catId."' and category_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_zip_title($pdo,$ziptitle) {
    $query = "SELECT * FROM ot_zip WHERE zip_name = '".$ziptitle."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_zip_id($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id = '".$zipId."' and zip_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_zip_description($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id = '".$zipId."' and zip_description != ''";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_zip_file($pdo,$zipFile) {
    $query = "SELECT * FROM ot_zip WHERE zip_file = '".$zipFile."' and zip_status = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_zip_featured($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id = '".$zipId."' and zip_status = '1' and zip_featured = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_zip_popular($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id = '".$zipId."' and zip_status = '1' and zip_popular = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function urltitle_by_id($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipTitle = trim($row['zip_name']) ;
        $UrlTitle = preg_replace("/[^\w]+/", "-", $zipTitle);
        $UrlTitle = strtolower($UrlTitle)  ;
        $output .= strtolower($UrlTitle) ;
    }
    return $output ;
}

function getziptitle_by_id($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipTitle = strip_tags($row['zip_name']) ;
        $output .= ($zipTitle) ;
    }
    return $output ;
}

function short_ziptitle_by_id($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $strLength = strip_tags($row['zip_name']);
		if(strlen($strLength) > 38) {
			$dot = "..";
		} else {
			$dot = "";
		}
        $output .= strip_tags(substr_replace($row['zip_name'], $dot, 38)) ;
    }
    return $output ;
}

function getzipdescription_by_id($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipDescription = nl2br(strip_tags($row['zip_description'])) ;
        $output .= ($zipDescription) ;
    }
    return $output ;
}

function getzipfile_by_id($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipFile = _e($row['zip_file']) ;
        $output .= ($zipFile) ;
    }
    return $output ;
}

function get_admin_username($pdo){
    $statement =  $pdo->prepare("SELECT * FROM ot_admin WHERE id = '1' ");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= ($row['username']) ;
    }
    return $output ;
}

function get_userip($pdo , $zipId) {
    $statement =  $pdo->prepare("SELECT * FROM ot_zip WHERE zip_id = '".$zipId."'");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_ip']) ;
    }
    return $output ;
}

function getzipid_by_zipfile($pdo,$zipFile) {
    $query = "SELECT * FROM ot_zip WHERE zip_file='".$zipFile."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipId = _e($row['zip_id']) ;
        $output .= ($zipId) ;
    }
    return $output ;
}

function getzipid_by_slug($pdo,$slug) {
    $query = "SELECT * FROM ot_zip WHERE zip_slug='".$slug."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipId = _e($row['zip_id']) ;
        $output .= ($zipId) ;
    }
    return $output ;
}

function getcategoryname_by_id($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $catId = _e($row['zip_category']) ;
        $categoryName = get_catname_byid($pdo,$catId) ;
        $output .= ($categoryName) ;
    }
    return $output ;
}

function getcategoryshortname_by_zipid($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $catId = _e($row['zip_category']) ;
        $categoryName = catshortname_by_id($pdo,$catId) ;
        $output .= ($categoryName) ;
    }
    return $output ;
}

function getcategoryid_by_zipid($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $catId = _e($row['zip_category']) ;
        $output .= ($catId) ;
    }
    return $output ;
}

function getzipdate_by_id($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipDate = _e($row['zip_date']) ;
        $zipDate =  date('d F, Y',strtotime($zipDate));
        $output .= ($zipDate) ;
    }
    return $output ;
}

function getviews_by_zipid($pdo,$zipId) {
    $query = "SELECT * FROM ot_zip WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $views = _e($row['zip_views']) ;
        $output .= ($views) ;
    }
    return $output ;
}

function increaseviews_by_zipid($pdo,$zipId) {
    $views = getviews_by_zipid($pdo,$zipId) ;
    $newViews = (int)$views + 1 ;
    $query = "update ot_zip set zip_views = '".$newViews."' WHERE zip_id='".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    return true ;
}

function check_download_ip($pdo,$userIp,$zipId) {
    $query = "SELECT * FROM ot_download WHERE download_user_ip = '".$userIp."' and download_zip_id = '".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function update_download($pdo,$zipId,$userIp) {
    if(check_download_ip($pdo,$userIp,$zipId) === '0') {
        $query = "insert into ot_download (download_zip_id, download_user_ip) values ('".$zipId."' , '".$userIp."')";
        $statement = $pdo->prepare($query);
        $statement->execute();
        return true ; 
    } else{
        return false ;
    } 
    
}

function count_downloads($pdo,$zipId) {
    $query = "SELECT * FROM ot_download WHERE download_zip_id = '".$zipId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function show_category_default($pdo,$catId){
    $limit = find_default_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_zip WHERE zip_status='1' and zip_category = '".$catId."'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and zip_category = '".$catId."' order by zip_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $zipId = _e($row['zip_id']) ;
            $urlTitle = strip_tags($row['zip_slug']) ;
            $zipTitle = strip_tags($row['zip_name']) ;
            $catName = get_catname_byid($pdo,$catId) ;
            $date = getzipdate_by_id($pdo,$zipId) ;
            $views = getviews_by_zipid($pdo,$zipId) ;
            $downloads = count_downloads($pdo,$zipId) ; 
            $featured = _e($row['zip_featured']) ;
            $popular = _e($row['zip_popular']) ;
            $badge = "";
            if($featured === '1') {
                $badge = '<div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i>'.userlang('featured').'</div>' ;
            }
            if($popular === '1'){
                $badge = '<div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i>'.userlang('popular').'</div>' ;
            }
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <div class="card-header"><a href="'.BASE_URL.'zip/'.$urlTitle.'" class="btn btn-md btn-primary float-end"><i class="bi bi-unlock-fill"></i> '.userlang('unlock_zip').'</a></div>
                            <div class="card-body">
                                <h4 >'.$zipTitle.'</h4>
                                <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i>'.$catName.'</small></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted float-end">'.$date.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-eye me-1"></i>'.$views.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2">'.$downloads.'</span></small>
                                '.$badge.'
                            </div>
                        </div>
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_cat_file" id="show_more_cat_file'.$zipId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$zipId.'" class="show_more_allcatfile btn btn-secondary btn-sm ann'.$catId.'">'.userlang('load_more').'</button>
							</div>
							
					</div>
					</div>
					';
        }
    }
    return $output ;
}

function show_category_loadmore($pdo,$catId,$zipId){
    $limit = find_loadmore_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_zip WHERE zip_status='1' and zip_category = '".$catId."' and zip_id < '".$zipId."'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and zip_category = '".$catId."' and zip_id < '".$zipId."' order by zip_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $zipId = _e($row['zip_id']) ;
            $urlTitle = strip_tags($row['zip_slug']) ;
            $zipTitle = strip_tags($row['zip_name']) ;
            $catName = get_catname_byid($pdo,$catId) ;
            $date = getzipdate_by_id($pdo,$zipId) ;
            $views = getviews_by_zipid($pdo,$zipId) ;
            $downloads = count_downloads($pdo,$zipId) ; 
            $featured = _e($row['zip_featured']) ;
            $popular = _e($row['zip_popular']) ;
            $badge = "";
            if($featured === '1') {
                $badge = '<div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i>'.userlang('featured').'</div>' ;
            }
            if($popular === '1'){
                $badge = '<div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i>'.userlang('popular').'</div>' ;
            }
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <div class="card-header"><a href="'.BASE_URL.'zip/'.$urlTitle.'" class="btn btn-md btn-primary float-end"><i class="bi bi-unlock-fill"></i> '.userlang('unlock_zip').'</a></div>
                            <div class="card-body">
                                <h4 >'.$zipTitle.'</h4>
                                <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i>'.$catName.'</small></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted float-end">'.$date.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-eye me-1"></i>'.$views.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2">'.$downloads.'</span></small>
                                '.$badge.'
                            </div>
                        </div>
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_cat_file" id="show_more_cat_file'.$zipId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$zipId.'" class="show_more_allcatfile btn btn-secondary btn-sm ann'.$catId.'">'.userlang('load_more').'</button>
							</div>
							
					</div>
					</div>
					';
        }
    }
    return $output ;
}


function show_index_default($pdo){
    $limit = find_default_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_zip WHERE zip_status='1'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' order by zip_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $zipId = _e($row['zip_id']) ;
            $catId = _e($row['zip_category']) ;
            $urlTitle = strip_tags($row['zip_slug']) ;
            $zipTitle = strip_tags($row['zip_name']) ;
            $catName = get_catname_byid($pdo,$catId) ;
            $catSlug = catshortname_by_id($pdo,$catId) ;
            $date = getzipdate_by_id($pdo,$zipId) ;
            $views = getviews_by_zipid($pdo,$zipId) ;
            $downloads = count_downloads($pdo,$zipId) ; 
            $featured = _e($row['zip_featured']) ;
            $popular = _e($row['zip_popular']) ;
            $badge = "";
            if($featured === '1') {
                $badge = '<div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i>'.userlang('featured').'</div>' ;
            }
            if($popular === '1'){
                $badge = '<div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i>'.userlang('popular').'</div>' ;
            }
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <div class="card-header"><a href="'.BASE_URL.'zip/'.$urlTitle.'" class="btn btn-md btn-primary float-end"><i class="bi bi-unlock-fill"></i> '.userlang('unlock_zip').'</a></div>
                            <div class="card-body">
                                <h4 >'.$zipTitle.'</h4>
                                <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i><a href="'.BASE_URL.'category/'.$catSlug.'">'.$catName.'</a></small></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted float-end">'.$date.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-eye me-1"></i>'.$views.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2">'.$downloads.'</span></small>
                                '.$badge.'
                            </div>
                        </div>
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_index_file" id="show_more_index_file'.$zipId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$zipId.'" class="show_more_allindexfile btn btn-secondary btn-sm ann'.$catId.'">'.userlang('load_more').'</button>
							</div>
							
					</div>
					</div>
					';
        }
    }
    return $output ;
}

function show_index_loadmore($pdo,$zipId){
    $limit = find_loadmore_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_zip WHERE zip_status='1' and zip_id < '".$zipId."'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and zip_id < '".$zipId."' order by zip_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $zipId = _e($row['zip_id']) ;
            $catId = _e($row['zip_category']) ;
            $urlTitle = strip_tags($row['zip_slug']) ;
            $zipTitle = strip_tags($row['zip_name']) ;
            $catName = get_catname_byid($pdo,$catId) ;
            $catSlug = catshortname_by_id($pdo,$catId) ;
            $date = getzipdate_by_id($pdo,$zipId) ;
            $views = getviews_by_zipid($pdo,$zipId) ;
            $downloads = count_downloads($pdo,$zipId) ; 
            $featured = _e($row['zip_featured']) ;
            $popular = _e($row['zip_popular']) ;
            $badge = "";
            if($featured === '1') {
                $badge = '<div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i>'.userlang('featured').'</div>' ;
            }
            if($popular === '1'){
                $badge = '<div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i>'.userlang('popular').'</div>' ;
            }
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <div class="card-header"><a href="'.BASE_URL.'zip/'.$urlTitle.'" class="btn btn-md btn-primary float-end"><i class="bi bi-unlock-fill"></i> '.userlang('unlock_zip').'</a></div>
                            <div class="card-body">
                                <h4 >'.$zipTitle.'</h4>
                                <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i><a href="'.BASE_URL.'category/'.$catSlug.'">'.$catName.'</a></small></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted float-end">'.$date.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-eye me-1"></i>'.$views.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2">'.$downloads.'</span></small>
                                '.$badge.'
                            </div>
                        </div>
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_index_file" id="show_more_index_file'.$zipId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$zipId.'" class="show_more_allindexfile btn btn-secondary btn-sm ann'.$catId.'">'.userlang('load_more').'</button>
							</div>
							
					</div>
					</div>
					';
        }
    }
    return $output ;
}

function show_featured_default($pdo) {
    $limit = find_default_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_zip WHERE zip_status='1' and zip_featured = '1'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and zip_featured = '1' order by zip_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $zipId = _e($row['zip_id']) ;
            $catId = _e($row['zip_category']) ;
            $urlTitle = strip_tags($row['zip_slug']) ;
            $zipTitle = strip_tags($row['zip_name']) ;
            $catName = get_catname_byid($pdo,$catId) ;
            $catSlug = catshortname_by_id($pdo,$catId) ;
            $date = getzipdate_by_id($pdo,$zipId) ;
            $views = getviews_by_zipid($pdo,$zipId) ;
            $downloads = count_downloads($pdo,$zipId) ; 
            $featured = _e($row['zip_featured']) ;
            $popular = _e($row['zip_popular']) ;
            $badge = "";
            if($featured === '1') {
                $badge = '<div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i>'.userlang('featured').'</div>' ;
            }
            if($popular === '1'){
                $badge = '<div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i>'.userlang('popular').'</div>' ;
            }
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <div class="card-header"><a href="'.BASE_URL.'zip/'.$urlTitle.'" class="btn btn-md btn-primary float-end"><i class="bi bi-unlock-fill"></i> '.userlang('unlock_zip').'</a></div>
                            <div class="card-body">
                                <h4 >'.$zipTitle.'</h4>
                                <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i><a href="'.BASE_URL.'category/'.$catSlug.'">'.$catName.'</a></small></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted float-end">'.$date.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-eye me-1"></i>'.$views.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2">'.$downloads.'</span></small>
                                '.$badge.'
                            </div>
                        </div>
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_featured_file" id="show_more_featured_file'.$zipId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$zipId.'" class="show_more_allfeaturedfile btn btn-secondary btn-sm ann'.$catId.'">'.userlang('load_more').'</button>
							</div>
							
					</div>
					</div>
					';
        }
    }
    return $output ;
}

function show_featured_loadmore($pdo,$zipId) {
    $limit = find_loadmore_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_zip WHERE zip_status='1' and zip_featured = '1' and zip_id < '".$zipId."'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and zip_featured = '1' and zip_id < '".$zipId."' order by zip_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $zipId = _e($row['zip_id']) ;
            $catId = _e($row['zip_category']) ;
            $urlTitle = strip_tags($row['zip_slug']) ;
            $zipTitle = strip_tags($row['zip_name']) ;
            $catName = get_catname_byid($pdo,$catId) ;
            $catSlug = catshortname_by_id($pdo,$catId) ;
            $date = getzipdate_by_id($pdo,$zipId) ;
            $views = getviews_by_zipid($pdo,$zipId) ;
            $downloads = count_downloads($pdo,$zipId) ; 
            $featured = _e($row['zip_featured']) ;
            $popular = _e($row['zip_popular']) ;
            $badge = "";
            if($featured === '1') {
                $badge = '<div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i>'.userlang('featured').'</div>' ;
            }
            if($popular === '1'){
                $badge = '<div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i>'.userlang('popular').'</div>' ;
            }
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <div class="card-header"><a href="'.BASE_URL.'zip/'.$urlTitle.'" class="btn btn-md btn-primary float-end"><i class="bi bi-unlock-fill"></i> '.userlang('unlock_zip').'</a></div>
                            <div class="card-body">
                                <h4 >'.$zipTitle.'</h4>
                                <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i><a href="'.BASE_URL.'category/'.$catSlug.'">'.$catName.'</a></small></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted float-end">'.$date.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-eye me-1"></i>'.$views.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2">'.$downloads.'</span></small>
                                '.$badge.'
                            </div>
                        </div>
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_featured_file" id="show_more_featured_file'.$zipId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$zipId.'" class="show_more_allfeaturedfile btn btn-secondary btn-sm ann'.$catId.'">'.userlang('load_more').'</button>
							</div>
							
					</div>
					</div>
					';
        }
    }
    return $output ;
}

function show_popular_default($pdo) {
    $limit = find_default_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_zip WHERE zip_status='1' and zip_popular = '1'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and zip_popular = '1' order by zip_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $zipId = _e($row['zip_id']) ;
            $catId = _e($row['zip_category']) ;
            $urlTitle = strip_tags($row['zip_slug']) ;
            $zipTitle = strip_tags($row['zip_name']) ;
            $catName = get_catname_byid($pdo,$catId) ;
            $catSlug = catshortname_by_id($pdo,$catId) ;
            $date = getzipdate_by_id($pdo,$zipId) ;
            $views = getviews_by_zipid($pdo,$zipId) ;
            $downloads = count_downloads($pdo,$zipId) ; 
            $featured = _e($row['zip_featured']) ;
            $popular = _e($row['zip_popular']) ;
            $badge = "";
            if($featured === '1') {
                $badge = '<div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i>'.userlang('featured').'</div>' ;
            }
            if($popular === '1'){
                $badge = '<div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i>'.userlang('popular').'</div>' ;
            }
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <div class="card-header"><a href="'.BASE_URL.'zip/'.$urlTitle.'" class="btn btn-md btn-primary float-end"><i class="bi bi-unlock-fill"></i> '.userlang('unlock_zip').'</a></div>
                            <div class="card-body">
                                <h4 >'.$zipTitle.'</h4>
                                <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i><a href="'.BASE_URL.'category/'.$catSlug.'">'.$catName.'</a></small></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted float-end">'.$date.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-eye me-1"></i>'.$views.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2">'.$downloads.'</span></small>
                                '.$badge.'
                            </div>
                        </div>
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_popular_file" id="show_more_popular_file'.$zipId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$zipId.'" class="show_more_allpopularfile btn btn-secondary btn-sm ann'.$catId.'">'.userlang('load_more').'</button>
							</div>
							
					</div>
					</div>
					';
        }
    }
    return $output ;
}

function show_popular_loadmore($pdo,$zipId) {
    $limit = find_loadmore_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_zip WHERE zip_status='1' and zip_popular = '1' and zip_id < '".$zipId."'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and zip_popular = '1' and zip_id < '".$zipId."' order by zip_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $zipId = _e($row['zip_id']) ;
            $catId = _e($row['zip_category']) ;
            $urlTitle = strip_tags($row['zip_slug']) ;
            $zipTitle = strip_tags($row['zip_name']) ;
            $catName = get_catname_byid($pdo,$catId) ;
            $catSlug = catshortname_by_id($pdo,$catId) ;
            $date = getzipdate_by_id($pdo,$zipId) ;
            $views = getviews_by_zipid($pdo,$zipId) ;
            $downloads = count_downloads($pdo,$zipId) ; 
            $featured = _e($row['zip_featured']) ;
            $popular = _e($row['zip_popular']) ;
            $badge = "";
            if($featured === '1') {
                $badge = '<div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i>'.userlang('featured').'</div>' ;
            }
            if($popular === '1'){
                $badge = '<div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i>'.userlang('popular').'</div>' ;
            }
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <div class="card-header"><a href="'.BASE_URL.'zip/'.$urlTitle.'" class="btn btn-md btn-primary float-end"><i class="bi bi-unlock-fill"></i> '.userlang('unlock_zip').'</a></div>
                            <div class="card-body">
                                <h4 >'.$zipTitle.'</h4>
                                <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i><a href="'.BASE_URL.'category/'.$catSlug.'">'.$catName.'</a></small></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted float-end">'.$date.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-eye me-1"></i>'.$views.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2">'.$downloads.'</span></small>
                                '.$badge.'
                            </div>
                        </div>
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_popular_file" id="show_more_popular_file'.$zipId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$zipId.'" class="show_more_allpopularfile btn btn-secondary btn-sm ann'.$catId.'">'.userlang('load_more').'</button>
							</div>
							
					</div>
					</div>
					';
        }
    }
    return $output ;
}

function show_search_default($pdo,$search) {
    $limit = find_default_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_zip WHERE zip_status='1' and (zip_name LIKE '%$search%')" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and (zip_name LIKE '%$search%') order by zip_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $zipId = _e($row['zip_id']) ;
            $catId = _e($row['zip_category']) ;
            $urlTitle = strip_tags($row['zip_slug']) ;
            $zipTitle = strip_tags($row['zip_name']) ;
            $catName = get_catname_byid($pdo,$catId) ;
            $catSlug = catshortname_by_id($pdo,$catId) ;
            $date = getzipdate_by_id($pdo,$zipId) ;
            $views = getviews_by_zipid($pdo,$zipId) ;
            $downloads = count_downloads($pdo,$zipId) ; 
            $featured = _e($row['zip_featured']) ;
            $popular = _e($row['zip_popular']) ;
            $badge = "";
            if($featured === '1') {
                $badge = '<div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i>'.userlang('featured').'</div>' ;
            }
            if($popular === '1'){
                $badge = '<div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i>'.userlang('popular').'</div>' ;
            }
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <div class="card-header"><a href="'.BASE_URL.'zip/'.$urlTitle.'" class="btn btn-md btn-primary float-end"><i class="bi bi-unlock-fill"></i> '.userlang('unlock_zip').'</a></div>
                            <div class="card-body">
                                <h4 >'.$zipTitle.'</h4>
                                <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i><a href="'.BASE_URL.'category/'.$catSlug.'">'.$catName.'</a></small></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted float-end">'.$date.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-eye me-1"></i>'.$views.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2">'.$downloads.'</span></small>
                                '.$badge.'
                            </div>
                        </div>
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_search_file" id="show_more_search_file'.$zipId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$zipId.'" class="show_more_allsearchfile btn btn-secondary btn-sm ann'.$search.'">'.userlang('load_more').'</button>
							</div>
							
					</div>
					</div>
					';
        }
    } else {
        $output .= '
                      <div class="card newShadow '.colormode('bg_color').' text-danger mt-3">
                            <div class="card-header"><h5><i class="bi bi-exclamation-triangle me-2"></i>'.userlang('no_search_found').'</h5></div>
                      </div>
        ' ;
    }
    return $output ;
}

function show_search_loadmore($pdo,$search,$zipId) {
    $limit = find_loadmore_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_zip WHERE zip_status='1' and (zip_name LIKE '%$search%') and zip_id < '".$zipId."'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and (zip_name LIKE '%$search%') and zip_id < '".$zipId."' order by zip_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $zipId = _e($row['zip_id']) ;
            $catId = _e($row['zip_category']) ;
            $urlTitle = strip_tags($row['zip_slug']) ;
            $zipTitle = strip_tags($row['zip_name']) ;
            $catName = get_catname_byid($pdo,$catId) ;
            $catSlug = catshortname_by_id($pdo,$catId) ;
            $date = getzipdate_by_id($pdo,$zipId) ;
            $views = getviews_by_zipid($pdo,$zipId) ;
            $downloads = count_downloads($pdo,$zipId) ; 
            $featured = _e($row['zip_featured']) ;
            $popular = _e($row['zip_popular']) ;
            $badge = "";
            if($featured === '1') {
                $badge = '<div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i>'.userlang('featured').'</div>' ;
            }
            if($popular === '1'){
                $badge = '<div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i>'.userlang('popular').'</div>' ;
            }
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <div class="card-header"><a href="'.BASE_URL.'zip/'.$urlTitle.'" class="btn btn-md btn-primary float-end"><i class="bi bi-unlock-fill"></i> '.userlang('unlock_zip').'</a></div>
                            <div class="card-body">
                                <h4 >'.$zipTitle.'</h4>
                                <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i><a href="'.BASE_URL.'category/'.$catSlug.'">'.$catName.'</a></small></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted float-end">'.$date.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-eye me-1"></i>'.$views.'</small>
                                <small class="'.colormode('default_text').'"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2">'.$downloads.'</span></small>
                                '.$badge.'
                            </div>
                        </div>
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_search_file" id="show_more_search_file'.$zipId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$zipId.'" class="show_more_allsearchfile btn btn-secondary btn-sm ann'.$search.'">'.userlang('load_more').'</button>
							</div>
							
					</div>
					</div>
					';
        }
    } 
    return $output ;
}

function sidebar_featured($pdo){
     
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and zip_featured = '1' order by zip_id desc limit 3";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipId = _e($row['zip_id']) ;
        $zipShortTitle = short_ziptitle_by_id($pdo,$zipId) ;
        $urlTitle = strip_tags($row['zip_slug']) ;
        $output .= '
                    <div class="col-lg-12 mb-2">
                        <i class="bi bi-file-earmark-zip me-1"></i><a href="'.BASE_URL.'zip/'.$urlTitle.'">'.$zipShortTitle.'</a>
                    </div>
        ' ;
    }
    return $output ;
}

function sidebar_popular($pdo){
     
    $query = "SELECT * FROM ot_zip WHERE zip_status='1' and zip_popular = '1' order by zip_id desc limit 3";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipId = _e($row['zip_id']) ;
        $zipShortTitle = short_ziptitle_by_id($pdo,$zipId) ;
        $urlTitle = strip_tags($row['zip_slug']) ;
        $output .= '
                    <div class="col-lg-12 mb-2">
                        <i class="bi bi-file-earmark-zip me-1"></i><a href="'.BASE_URL.'zip/'.$urlTitle.'">'.$zipShortTitle.'</a>
                    </div>
        ' ;
    }
    return $output ;
}

function index_page_blog($pdo){
    $limit = 3 ;
    $sql = "SELECT count(*) as number_rows FROM ot_blogs WHERE blog_status='1'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_blogs WHERE blog_status='1' order by blog_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        $output .= '<div class="row p-0 mt-3 mb-4">';
        $output .= '<h3 class="text-muted"><i class="bi bi-rss me-2"></i>'.userlang('latest_blog').'<a href="'.BASE_URL.'rss" class="btn btn-success btn-sm float-end">'.userlang('view_all').'</a></h3>';
        foreach($result as $row)
        {
            $blogSlug = _e($row['blog_slug']) ;
            $blogId = blogid_by_blog_slug($pdo,$blogSlug);
            $blogTitle = blogtitle_by_blog_slug($pdo,$blogSlug) ;
            $blogShortTitle = blog_short_title_byslug($pdo,$blogSlug) ;
            $blogImage = blogimage_by_blog_slug($pdo,$blogSlug) ;
            $output .= '
                        <div class="col-lg-4">
                        <a href="'.BASE_URL.'blog/'.$blogSlug.'">
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <img class="card-img-top" src="'.BASE_URL.'blogimages/'.$blogImage.'" alt="'.$blogTitle.'">
                            <div class="card-body">
                                <h5 class="'.colormode('default_text').'">'.$blogShortTitle.'</h5>
                                <span class=""><a href="https://www.facebook.com/sharer/sharer.php?u='.BASE_URL.'blog/'.$blogSlug.'" target="_blank"><i class="bi bi-facebook pointer shareIcon fbColor mt-1" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_fb').'"></i></a></span>
                        <span class="p-1"><a href="https://twitter.com/share?url='.BASE_URL.'blog/'.$blogSlug.'&text='.$blogTitle.'" target="_blank"><i class="bi bi-twitter twitterColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_tw').'"></i></a></span>
                        <span class="p-1"><a href="https://wa.me/?text='.BASE_URL.'blog/'.$blogSlug.'" target="_blank"><i class="bi bi-whatsapp wpColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_wp').'"></i></a></span>
                        <span class="p-1"><a href="https://www.linkedin.com/shareArticle?mini=true&url='.BASE_URL.'blog/'.$blogSlug.'&title='.$blogTitle.'&summary=&source=" target="_blank" ><i class="bi bi-linkedin ldColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_ld').'"></i></a></span>
                            </div>
                        </div>
                        </a>
                        </div>
                        
                        
            ';
        }
        $output .= '</div>' ;
    }
    
    return $output ;
}

function show_blog_default($pdo) {
    $limit = find_default_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_blogs WHERE blog_status='1'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_blogs WHERE blog_status='1' order by blog_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $blogSlug = _e($row['blog_slug']) ;
            $blogId = blogid_by_blog_slug($pdo,$blogSlug);
            $blogTitle = blogtitle_by_blog_slug($pdo,$blogSlug) ;
            $blogShortTitle = blog_short_title_byslug($pdo,$blogSlug) ;
            $blogImage = blogimage_by_blog_slug($pdo,$blogSlug) ;
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <a href="'.BASE_URL.'blog/'.$blogSlug.'"><img class="card-img-top" src="'.BASE_URL.'blogimages/'.$blogImage.'" alt="'.$blogTitle.'"></a>
                            <div class="card-body">
                                <a class="'.colormode('default_text').'" href="'.BASE_URL.'blog/'.$blogSlug.'"><h5 >'.$blogShortTitle.'</h5></a>
                                <span class=""><a href="https://www.facebook.com/sharer/sharer.php?u='.BASE_URL.'blog/'.$blogSlug.'" target="_blank"><i class="bi bi-facebook pointer shareIcon fbColor mt-1" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_fb').'"></i></a></span>
                        <span class="p-1"><a href="https://twitter.com/share?url='.BASE_URL.'blog/'.$blogSlug.'&text='.$blogTitle.'" target="_blank"><i class="bi bi-twitter twitterColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_tw').'"></i></a></span>
                        <span class="p-1"><a href="https://wa.me/?text='.BASE_URL.'blog/'.$blogSlug.'" target="_blank"><i class="bi bi-whatsapp wpColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_wp').'"></i></a></span>
                        <span class="p-1"><a href="https://www.linkedin.com/shareArticle?mini=true&url='.BASE_URL.'blog/'.$blogSlug.'&title='.$blogTitle.'&summary=&source=" target="_blank" ><i class="bi bi-linkedin ldColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_ld').'"></i></a></span>
                            </div>
                        </div>
                       
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_popular_file" id="show_more_rss_file'.$blogId.'">
						<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$blogId.'" class="show_more_allrssfile btn btn-secondary btn-sm">'.userlang('load_more').'</button>
				        </div>							
					</div>
					</div>
					';
        }
    }
    return $output ;
}

function show_blog_loadmore($pdo,$blogId){
    $limit = find_loadmore_limit($pdo) ;
    $sql = "SELECT count(*) as number_rows FROM ot_blogs WHERE blog_status='1' and blog_id < '".$blogId."'" ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_blogs WHERE blog_status='1' and blog_id < '".$blogId."' order by blog_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $blogSlug = _e($row['blog_slug']) ;
            $blogId = blogid_by_blog_slug($pdo,$blogSlug);
            $blogTitle = blogtitle_by_blog_slug($pdo,$blogSlug) ;
            $blogShortTitle = blog_short_title_byslug($pdo,$blogSlug) ;
            $blogImage = blogimage_by_blog_slug($pdo,$blogSlug) ;
            $output .= '
                        <div class="card newShadow '.colormode('bg_color').' '.colormode('default_text').' mt-3">
                            <a href="'.BASE_URL.'blog/'.$blogSlug.'"><img class="card-img-top" src="'.BASE_URL.'blogimages/'.$blogImage.'" alt="'.$blogTitle.'"></a>
                            <div class="card-body">
                                <a class="'.colormode('default_text').'" href="'.BASE_URL.'blog/'.$blogSlug.'"><h5 >'.$blogShortTitle.'</h5></a>
                                <span class=""><a href="https://www.facebook.com/sharer/sharer.php?u='.BASE_URL.'blog/'.$blogSlug.'" target="_blank"><i class="bi bi-facebook pointer shareIcon fbColor mt-1" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_fb').'"></i></a></span>
                        <span class="p-1"><a href="https://twitter.com/share?url='.BASE_URL.'blog/'.$blogSlug.'&text='.$blogTitle.'" target="_blank"><i class="bi bi-twitter twitterColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_tw').'"></i></a></span>
                        <span class="p-1"><a href="https://wa.me/?text='.BASE_URL.'blog/'.$blogSlug.'" target="_blank"><i class="bi bi-whatsapp wpColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_wp').'"></i></a></span>
                        <span class="p-1"><a href="https://www.linkedin.com/shareArticle?mini=true&url='.BASE_URL.'blog/'.$blogSlug.'&title='.$blogTitle.'&summary=&source=" target="_blank" ><i class="bi bi-linkedin ldColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="'.userlang('share_ld').'"></i></a></span>
                            </div>
                        </div>
                       
                        
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_popular_file" id="show_more_rss_file'.$blogId.'">
						<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$blogId.'" class="show_more_allrssfile btn btn-secondary btn-sm">'.userlang('load_more').'</button>
				        </div>							
					</div>
					</div>
					';
        }
    }
    return $output ;
}
?>