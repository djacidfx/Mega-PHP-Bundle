<?php 
include("database.php") ;
$postId = filter_var($_GET['id'] , FILTER_SANITIZE_NUMBER_INT) ;
if(check_post_id($pdo , $postId) == 0) {
    header("location: ".BASE_URL."");
}
$postTitle = post_title_by_id($pdo,$postId) ;
$postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
$postDescription = post_description_by_id($pdo,$postId) ; 
increase_views($pdo, $postId) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $postTitle ; ?></title>
    <meta property="og:title" content="<?php echo $postTitle ; ?>" />
    <meta property="og:description" content="<?php //echo $postDescription ; ?>" />
    <meta property="og:site_name" content="<?php echo BASE_URL ; ?>" />
	<meta property="og:url" content="<?php echo BASE_URL."secret/".$postId."/".$postUrlTitle ; ?>" />
	<meta property="og:type" content="article" />
	<meta property="article:publisher" content="<?php echo BASE_URL ; ?>" />
	<meta property="article:section" content="Articles" />
	<meta property="article:tag" content="Anonymous Secret, Anonymous Confession , Anonymous Group, Anonymous Post" />
	<meta property="og:image" content="" />
	<meta property="og:image:secure_url" content="" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="twitter:card" content="" />
	<meta property="twitter:image" content="" />
	
	<meta name="robots" content="all,follow">
    
    <link href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/r-2.2.7/datatables.min.css"/>
    <link href="<?php echo BASE_URL ; ?>css/custom.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<?php
include("body_start.php") ;
?>