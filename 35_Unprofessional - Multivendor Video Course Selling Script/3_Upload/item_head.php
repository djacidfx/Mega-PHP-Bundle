<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $itemTitle ; ?></title>
    <meta property="og:site_name" content="<?php echo BASE_URL ; ?>" />
    <meta property="og:title" content="<?php echo $itemTitle ; ?>" />
    <meta property="og:description" content="Buy <?php echo $itemTitle ; ?>" />
    <meta property="og:url" content="<?php echo BASE_URL."video/".$itemId."/".$shortUrlTitle ; ?>" />
    <meta property="product:price:amount" content="<?php echo find_activeitem_price($pdo,$itemId) ; ?>" />
    <meta property="product:price:currency" content="USD" />
    <meta property="og:image" content="<?php echo BASE_URL ; ?>mainImg/<?php echo find_live_image($pdo,$itemId) ; ?>" />
    <meta property="og:type" content="Video Products" />
	<meta property="og:image:secure_url" content="<?php echo BASE_URL ; ?>mainImg/<?php echo find_live_image($pdo,$itemId) ; ?>" />
	<meta property="og:image:width" content="600" />
	<meta property="og:image:height" content="300" />
	<meta property="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?php echo $itemTitle ; ?>" />
    <meta name="twitter:description" content="Buy <?php echo (get_username_by_itemid($pdo,$itemId)) ; ?> Video Course." />
	<meta property="twitter:image" content="<?php echo BASE_URL ; ?>mainImg/<?php echo find_live_image($pdo,$itemId) ; ?>" />	
    
	<meta name="robots" content="all,follow">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/r-2.2.7/datatables.min.css"/>
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/components.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/custom.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/siteLogoBig.png">
</head>