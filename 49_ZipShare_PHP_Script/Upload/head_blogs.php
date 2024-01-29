<!DOCTYPE html>
<?php if($_SESSION['lang'] === "arabic" || $_SESSION['lang'] === "urdu") { ?>
<html lang="ar" dir="rtl">
<?php } else { ?> 
<html>  
<?php } ?>
    <head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"> 
    <title><?php echo $blogTitle ; ?></title>
    <meta property="og:title" content="<?php echo $blogTitle ; ?>" />
	<meta property="og:description" content="<?php echo $blogShortDescription ; ?>" />
    <meta property="og:site_name" content="<?php echo BASE_URL ; ?>" />
	<meta property="og:url" content="<?php echo BASE_URL."blog/".$blogSlug ; ?>" />
	<meta property="og:type" content="article" />
	<meta property="article:publisher" content="<?php echo BASE_URL ; ?>" />
	<meta property="article:section" content="Articles" />
	<meta property="article:tag" content="Anonymous Website, Anonymous Promotion , Anonymous Group, Anonymous Post" />
	<meta property="og:image" content="<?php echo BASE_URL ; ?>blogimages/<?php echo $blogImage ; ?>" />
	<meta property="og:image:secure_url" content="<?php echo BASE_URL ; ?>blogimages/<?php echo $blogImage ; ?>" />
	<meta property="og:image:width" content="1600" />
	<meta property="og:image:height" content="800" />
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:image" content="<?php echo BASE_URL ; ?>blogimages/<?php echo $blogImage ; ?>" />
	<meta name="robots" content="all,follow">
        
    <?php if($_SESSION['lang'] === "arabic" || $_SESSION['lang'] === "urdu") { ?>
         <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.rtl.min.css" >
         <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/label.rtl.css" >
    <?php } else { ?> 
        <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" >
        <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/label.css" >
    <?php } ?>
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/custom.css">    
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
    
    
</head>