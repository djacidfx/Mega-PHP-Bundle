<?php

// Error Reporting Turn On
//===============Do Not Change Me Start=======================//
ini_set('error_reporting', 1);
//===============Do Not Change Me End========================//


//=============== CHANGE Me Carefully Start =======================//


//=============== DATABASE CREDENTIALS CHANGE START =======================//

// Host Name 99% Web Hosting Hostname is localhost
$dbhost = 'CHANGE_ME_I_AM_YOUR_DATABASE_HOSTNAME' ;

// Database Name
$dbname = 'CHANGE_ME_I_AM_YOUR_DATABASE_NAME' ;

// Database Username
$dbuser = 'CHANGE_ME_I_AM_YOUR_DATABASE_USERNAME' ;

// Database Password
$dbpass = 'CHANGE_ME_I_AM_YOUR_DATABASE_PASSWORD' ;

//=============== DATABASE CREDENTIALS CHANGE END =======================//

//=============== Google ReCaptcha Verification Start=======================//

// Login to your Google Account, Go to https://www.google.com/recaptcha/admin/create , Read Documentation and Update this File

// Google ReCaptcha V2 Site Key
define("SITE_KEY", "CHANGE_ME_I_AM_YOUR_GOOGLE_RECAPTCH_V2_SITE_KEY");

// Google ReCaptcha V2 Secret Key
define("SECRET_KEY", "CHANGE_ME_I_AM_YOUR_GOOGLE_RECAPTCH_V2_SECRET_KEY");

//=============== Google ReCaptcha Verification End=======================//

// 1) Defining base url , replace https://www.yourwebsite.com/ with your website name
// 2) Whatever your folder name just replace payment/ with yourfoldername/ , 
// 3) Note : put forward slash / at the end of your folder name otherwise script won't work. 
// 4) https website is mandatory for Stripe Payment Gateway
// 5) If you want to Put this script in your Root Folder without any folder then your BASE_URL line is below
// 6) define("BASE_URL", "https://www.yourwebsite.com/");

//=============== CHANGE Me Carefully Start =======================//

//Define Website Address where you installed this script
define("BASE_URL", "https://www.yourwebsite.com/");

// Defining Password Note : This Password will use to delete website
define("DELETE_PASSWORD", "123456");

// How many number of website do you want to load when user visited your website
define("DEFAULT_SITE_LOAD" , "6") ;

// How many number of website do you want to load when user press load more button
define("MORE_SITE_LOAD" , "6") ;

// Define Load More Button Name
define("LOAD_MORE_BTN_NAME" , "Load More") ;

// Copyright Name
define("COPYRIGHT_NAME", "CodeDaddy") ;

// Define Website Meta Title
define("META_TITLE" , "Anonymous - Website Promotion") ;

// Define Website Meta Description
define("META_DESCRIPTION" , "Enjoy & Promote your website anonymously & Get High Traffic.") ;

// Define Share on facebook name
define("FB_NAME", "Share on Facebook") ;

// Define Share on twitter name
define("TWITTER_NAME", "Share on Twitter") ;

// Define Share on whatsapp name
define("WP_NAME", "Share on Whatsapp") ;

// Define Share on Linkedin name
define("LD_NAME", "Share on Linkedin") ;

// Add Website Button Name
define("ADD_WEBSITE_BTN", "Promote Website") ;

// Search Button Name
define("SEARCH_BTN", "Search Website") ;

// Form Title Name for User Website Form
define("FORM_TITLE", "Promote Website") ;

// Website Title Name for User Website Form
define("WEBSITE_TITLE", "Website Title") ;

// Site URL Title Name for User Website Form
define("SITE_URL_NAME", "Website URL") ;

// User Website Form Button Name
define("FORM_BTN_NAME", "Add Website") ;

// ReCaptcha Verification Failed Message
define("SPAM_MSG", "Captcha Verification Failed ! Spam is not allowed.") ;

// Duplicate Site URL Error Message
define("DUPLICATE_URL", "Duplicate URL. Try again.") ;

// Site Title & URL Empty Error Message
define("EMPTY_TITLE_URL", "Site Title / URL cannot be empty. Try again.") ;

// Website Link Name on Website Page
define("WEBSITE_LINK_NAME", "Open Website") ;

// Website Unlock Link Name on Website Page
define("UNLOCK_WEBSITE_LINK_NAME", "Unlock Website") ;

// Delete Button POP Up Name
define("DELETE_BTN_POP_UP", "Delete Site & Block IP") ;

// Blocked User Message
define("BLOCKED_MESSAGE", "You have blocked. This Website is not for you.") ;

// How many chance do you want to delete site, after that User IP blocked and they cannot access website
define("BLOCKED_CHANCE", "2") ;

// Delete Website Form Title
define("DELETEFORM_TITLE", "Delete Website") ;

// Delete Website Form Title
define("PASSWORD_NAME", "Delete Password") ;

// Delete Website Form Title
define("DELETEFORM_BTN_NAME", "Delete Website & Block IP") ;

// Delete Website Empty Password Error
define("EMPTY_PASSWORD_ERROR", "Delete Password cannot be empty.") ;

// Search Website Form Title
define("SEARCH_TITLE", "Search") ;

// Search Website Form Placeholder
define("SEARCH_PLACEHOLDER", "Search Anonymous Website") ;

// Search Website Form Button
define("SEARCH_BTN", "Search Website") ;

// ****************** AD Setup ******************* 

// 3 Types of Ads are available - 2 Desktop Ad & 1 Mobile Ad

// Desktop Ad Size : 300 x 600 Pixel  ||   Mobile Ad Size : 300 x 50 Pixel

// AD - 1 => Desktop Left Side Ad : Open ad_desktop_leftside.php ==> Paste Google Ad Javascript Code in that file 
// AD - 2 => Desktop Right Side Ad : Open ad_desktop_rightside.php ==> Paste Google Ad Javascript Code in that file 
// Note : AD - 1 & AD - 2 should be two different ads (means not with same Ad ID). Otherwise Ads will create problem
// AD - 3 => Mobile Ad : Open ad_mobile.php ==> Paste Google Ad Javascript Code in that file 
// Done


//=============== CHANGE Me Carefully End  =======================//






//===============  Do not change below anything  =======================//

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}

function _e($string) {
	return htmlentities(strip_tags($string), ENT_QUOTES, 'UTF-8');
}

function urltitle_by_id($pdo,$siteId) {
    $query = "SELECT * FROM ot_sites WHERE site_id='".$siteId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $siteTitle = trim($row['site_title']) ;
        $UrlTitle = preg_replace("/[^\w]+/", "-", $siteTitle);
        $UrlTitle = strtolower($UrlTitle)  ;
        $output .= strtolower($UrlTitle) ;
    }
    return $output ;
}

function check_site_id($pdo , $siteId) {
    $query = "SELECT * FROM ot_sites WHERE site_id = '".$siteId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return ($total) ;
}

function site_title_by_id($pdo,$siteId) {
    $query = "SELECT * FROM ot_sites WHERE site_id='".$siteId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $siteTitle = strip_tags($row['site_title']) ;
        $output .= $siteTitle ;
    }
    return $output ;
}

function site_views_by_id($pdo,$siteId) {
    $query = "SELECT * FROM ot_sites WHERE site_id='".$siteId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $siteviews = strip_tags($row['views']) ;
        $output .= $siteviews ;
    }
    return $output ;
}

function increase_views($pdo, $siteId){
    $oldView = site_views_by_id($pdo,$siteId) ;
    $newView = (int)$oldView + 1 ;
    $upd = $pdo->prepare("update ot_sites set views = '".$newView."' where site_id='".$siteId."'") ;
    $upd->execute();
    return true ;
}

function original_url($pdo,$siteId) {
    $query = "SELECT * FROM ot_sites WHERE site_id='".$siteId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $siteOriginalUrl = $row['site_url'] ;
        $output .= $siteOriginalUrl ;
    }
    return $output ;
}

function userip_by_siteid($pdo,$siteId) {
    $query = "SELECT * FROM ot_sites WHERE site_id='".$siteId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $userIp = $row['user_ip'] ;
        $output .= $userIp ;
    }
    return $output ;
}

function site_date($pdo,$siteId) {
    $query = "SELECT * FROM ot_sites WHERE site_id='".$siteId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $date = $row['site_date'] ;
        $date = date('d F, Y',strtotime($date));
        $output .= $date ;
    }
    return $output ;
}

function find_blocked_ip($pdo , $userIp) {
    $query = "SELECT * FROM ot_blocked_ip WHERE ip_address = '".$userIp."' and blocked = '1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return ($total) ;
}

function find_userip($pdo , $userIp) {
    $query = "SELECT * FROM ot_blocked_ip WHERE ip_address = '".$userIp."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return ($total) ;
}

function update_block($pdo , $userIp){
    if(find_userip($pdo , $userIp) === 0){
        $query = "insert into ot_blocked_ip (ip_address , chance) values ('".$userIp."' , '".BLOCKED_CHANCE."')";
        $statement = $pdo->prepare($query);
        $statement->execute();
    }
    return true ;
}

function update_password($pdo){
    $password = DELETE_PASSWORD ;
    $password = password_hash($password, PASSWORD_DEFAULT) ;
    $query = "update ot_auth set auth = '".$password."' where auth_id = '1'";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return true ;
}

function get_password($pdo) {
    $query = "SELECT * FROM ot_auth WHERE auth_id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $password = $row['auth'] ;
        $output .= $password ;
    }
    return $output ;
}

function final_block($pdo, $blockIp , $siteId){
    $query = "update ot_blocked_ip set blocked = '1' , chance = '0' where ip_address = '".$blockIp."'";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $del = $pdo->prepare("delete from ot_sites where site_id = '".$siteId."'");
    $del->execute();
    return true ;
}

function load_default_site($pdo){
    $limit = DEFAULT_SITE_LOAD ;
    $sql = "SELECT count(*) as number_rows FROM ot_sites WHERE 1 order by site_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = ($row['number_rows']);
	}
    $query = "SELECT * FROM ot_sites WHERE 1 order by site_id desc LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $siteTitle = $row['site_title'] ;
            $siteId = $row['site_id'] ;
            $urlTitle = urltitle_by_id($pdo,$siteId) ;
            $output .= '<div class="row text-start p-0 mt-3">
                            <div class="col-lg-12">
                                <div class="card bg-dark text-white newShadow">
                                    <div class="card-header">
                                        <h3><i class="bi bi-display me-2"></i> '.$siteTitle.'</h3>
                                    </div>
                                    <div class="card-body fw-bold mediumFont">

                                        <a href="'.BASE_URL.'site/'.$siteId.'/'.$urlTitle.'" class="me-3 btn btn-primary btn-sm"><i class="bi bi-unlock"></i> '.UNLOCK_WEBSITE_LINK_NAME.'</a>

                                    </div>
                                    <div class="card-footer">
                                        <small class="text-white"><i class="bi bi-eye"></i> '.site_views_by_id($pdo,$siteId).'&ensp;&ensp;</small><i class="bi bi-trash text-danger mouseClick smallfont float-end mt-n-half align-bottom delWebIn" data-status="'.$siteId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="'.DELETE_BTN_POP_UP.'"></i><small class="text-muted float-end ms-2 me-2">'.site_date($pdo,$siteId).'</small>
                                    </div>
                                </div>
                            </div>
                        </div>
            
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_site" id="show_more_site'.$siteId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$siteId.'" class="show_more_allsite btn btn-grey btn-sm">'.LOAD_MORE_BTN_NAME.'</button>
							</div>
							
					</div>
					</div>
					';
        }
    }
    
	return ($output);
}

function load_more_site($pdo,$limit){
    $sql = "SELECT count(*) as number_rows FROM ot_sites WHERE site_id < '".$_GET['id']."' order by site_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = ($row['number_rows']);
	}
    $query = "SELECT * FROM ot_sites WHERE site_id < '".$_GET['id']."' order by site_id desc LIMIT ".$limit."";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	$total = $statement->rowCount();
	if($total > 0) {
        foreach($result as $row)
        {
            $siteTitle = $row['site_title'] ;
            $siteId = $row['site_id'] ;
            $urlTitle = urltitle_by_id($pdo,$siteId) ;
            $output .= '<div class="row text-start p-0 mt-3">
                            <div class="col-lg-12">
                                <div class="card bg-dark text-white newShadow">
                                    <div class="card-header">
                                        <h3><i class="bi bi-display me-2"></i> '.$siteTitle.'</h3>
                                    </div>
                                    <div class="card-body fw-bold mediumFont">

                                        <a href="'.BASE_URL.'site/'.$siteId.'/'.$urlTitle.'" class="me-3 btn btn-primary btn-sm"><i class="bi bi-unlock"></i> '.UNLOCK_WEBSITE_LINK_NAME.'</a>

                                    </div>
                                    <div class="card-footer">
                                        <small class="text-white"><i class="bi bi-eye"></i> '.site_views_by_id($pdo,$siteId).'&ensp;&ensp;</small><i class="bi bi-trash text-danger mouseClick smallfont float-end mt-n-half align-bottom delWebIn" data-status="'.$siteId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="'.DELETE_BTN_POP_UP.'"></i><small class="text-muted float-end ms-2 me-2">'.site_date($pdo,$siteId).'</small>
                                    </div>
                                </div>
                            </div>
                        </div>
            
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_site" id="show_more_site'.$siteId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$siteId.'" class="show_more_allsite btn btn-grey btn-sm">'.LOAD_MORE_BTN_NAME.'</button>
							</div>
							
					</div>
					</div>
					';
        }
    }
    
	return ($output);
}

function grab_search_default($pdo,$search){
    $limit = DEFAULT_SITE_LOAD ;
    $sql = "SELECT count(*) as number_rows FROM ot_sites WHERE (site_title LIKE '%$search%') order by site_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_sites WHERE (site_title LIKE '%$search%') order by site_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $siteTitle = $row['site_title'] ;
            $siteId = $row['site_id'] ;
            $urlTitle = urltitle_by_id($pdo,$siteId) ;
            $output .= '<div class="row text-start p-0 mt-3">
                            <div class="col-lg-12">
                                <div class="card bg-dark text-white newShadow">
                                    <div class="card-header">
                                        <h3><i class="bi bi-display me-2"></i> '.$siteTitle.'</h3>
                                    </div>
                                    <div class="card-body fw-bold mediumFont">

                                        <a href="'.BASE_URL.'site/'.$siteId.'/'.$urlTitle.'" class="me-3 btn btn-primary btn-sm"><i class="bi bi-unlock"></i> '.UNLOCK_WEBSITE_LINK_NAME.'</a>

                                    </div>
                                    <div class="card-footer">
                                        <small class="text-white"><i class="bi bi-eye"></i> '.site_views_by_id($pdo,$siteId).'&ensp;&ensp;</small><i class="bi bi-trash text-danger mouseClick smallfont float-end mt-n-half align-bottom delWebIn" data-status="'.$siteId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="'.DELETE_BTN_POP_UP.'"></i><small class="text-muted float-end ms-2 me-2">'.site_date($pdo,$siteId).'</small>
                                    </div>
                                </div>
                            </div>
                        </div>
            
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_search" id="show_more_search'.$siteId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$siteId.'" class="show_more_allsearch btn btn-grey btn-sm ann'.$search.'">'.LOAD_MORE_BTN_NAME.'</button>
							</div>
							
					</div>
					</div>
					';
        }
    } else {
        $output .= '<div class="card bg-dark newShadow cp-0 text-center mt-3">
                            <div class="card-header mySecret text-center text-muted">
                                <div class="col-lg-12">
                                    <i class="bi bi-exclamation-circle bigIcon text-danger"></i> Nothing Found ! Try again with another search term.
                                </div>
                            </div>
                    </div>';
    }
    return $output ;
}

function grab_search_onload($pdo,$search,$siteId) {
    $limit = MORE_SITE_LOAD ;
    $sql = "SELECT count(*) as number_rows FROM ot_sites WHERE (site_title LIKE '%$search%') and site_id < '".$siteId."' order by site_id desc " ;
	$newitem = $pdo->prepare($sql);
	$newitem->execute(); 
	$items = $newitem->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($items as $row) {
		$totalRows = _e($row['number_rows']);
	}
    
    $query = "SELECT * FROM ot_sites WHERE (site_title LIKE '%$search%')  and site_id < '".$siteId."' order by site_id desc limit ".$limit." ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $total = $statement->rowCount();
    if($total > 0) {
        foreach($result as $row)
        {
            $siteTitle = $row['site_title'] ;
            $siteId = $row['site_id'] ;
            $urlTitle = urltitle_by_id($pdo,$siteId) ;
            $output .= '<div class="row text-start p-0 mt-3">
                            <div class="col-lg-12">
                                <div class="card bg-dark text-white newShadow">
                                    <div class="card-header">
                                        <h3><i class="bi bi-display me-2"></i> '.$siteTitle.'</h3>
                                    </div>
                                    <div class="card-body fw-bold mediumFont">

                                        <a href="'.BASE_URL.'site/'.$siteId.'/'.$urlTitle.'" class="me-3 btn btn-primary btn-sm"><i class="bi bi-unlock"></i> '.UNLOCK_WEBSITE_LINK_NAME.'</a>

                                    </div>
                                    <div class="card-footer">
                                        <small class="text-white"><i class="bi bi-eye"></i> '.site_views_by_id($pdo,$siteId).'&ensp;&ensp;</small><i class="bi bi-trash text-danger mouseClick smallfont float-end mt-n-half align-bottom delWebIn" data-status="'.$siteId.'" data-bs-toggle="tooltip" data-bs-placement="top" title="'.DELETE_BTN_POP_UP.'"></i><small class="text-muted float-end ms-2 me-2">'.site_date($pdo,$siteId).'</small>
                                    </div>
                                </div>
                            </div>
                        </div>
            
            ';
        }
        if($totalRows > $limit){
		$output .= '<div class="col-lg-12 justify-content-center mt-3">
					<div class="show_more_search" id="show_more_search'.$siteId.'">
							
							<div class="text-center p-2">
							<div id="loader-icon"><img src="'.BASE_URL.'img/loader.gif" class="img-fluid loaderImg" /></div>
							<button id="'.$siteId.'" class="show_more_allsearch btn btn-grey btn-sm ann'.$search.'">'.LOAD_MORE_BTN_NAME.'</button>
							</div>
							
					</div>
					</div>
					';
        }
    } else {
        $output .= '<div class="card bg-dark newShadow cp-0 text-center mt-3">
                            <div class="card-header mySecret text-center text-muted">
                                <div class="col-lg-12">
                                    <i class="bi bi-exclamation-circle bigIcon text-danger"></i> Nothing Found ! Try again with another search term.
                                </div>
                            </div>
                    </div>';
    }
    return $output ;
}
?>