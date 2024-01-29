<?php include("config.php") ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title><?php echo $siteTitle; ?></title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <meta property="og:site_name" content="<?php echo $siteUrl ; ?>" />
	  <meta property="og:title" content="<?php echo $siteTitle; ?>" />
      <meta property="og:description" content="<?php echo $metaSiteDescription ; ?>" />
	  <meta property="og:url" content="<?php echo $siteUrl ; ?>" />
	  <meta property="og:type" content="calculator" />
	  <meta property="article:publisher" content="<?php echo $siteUrl ; ?>" />
	  <meta property="article:section" content="Calculator" />
	  <meta property="article:tag" content="<?php echo $metaTags; ?>" />
	  <meta property="og:image" content="<?php echo $siteUrl ; ?>/img/<?php echo $socialShareImage ; ?>" />
	  <meta property="og:image:secure_url" content="<?php echo $siteUrl ; ?>/img/<?php echo $socialShareImage ; ?>" />
	  <meta property="og:image:width" content="1280" />
	  <meta property="og:image:height" content="640" />
	  <meta property="twitter:card" content="summary_large_image" />
	  <meta property="twitter:image" content="<?php echo $siteUrl ; ?>/img/<?php echo $socialShareImage ; ?>" />
	  <meta name="robots" content="all,follow">
	  
      <link rel="icon" href="<?php echo $siteUrl ; ?>/img/<?php echo $faviconImage ; ?>">
      <link rel="stylesheet" href="<?php echo $siteUrl ; ?>/css/bootstrap.min.css">
	  <link rel="stylesheet" href="<?php echo $siteUrl ; ?>/css/RobotCondesedFont.css">
      <link rel="stylesheet" href="<?php echo $siteUrl ; ?>/font-awesome-4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo $siteUrl ; ?>/css/font-icon-style.css">
</head>
<body style="background:<?php echo $bodyBgColor ; ?>">
      <nav class="navbar  navbar-expand-md  navbar-static-top navbar-color" style="background-color: <?php echo $headerBgColor ; ?>">
            <div class="container justify-content-center">
                        <a href="" class="p-2"><img src="<?php echo $siteUrl ; ?>/img/<?php echo $logoImage ; ?>" alt="logo" class="img-fluid"></a>
						<!--<div class="col-lg-12 text-center">-->
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
						   <i class="fa fa-share-alt-square navbar-toggler-icon fa-2x text-center" style="color:<?php echo $shareIconButtonColor ; ?>"></i>
						</button>
						<!--</div>-->
                  <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
					<ul class="navbar-nav ml-auto text-center">
					  <li class="nav-item">
						<a  href="http://www.facebook.com/share.php?u=<?php echo $siteUrl ; ?>" target="_blank"><i class="fa fa-facebook-square fa-2x" style="color:<?php echo $fbShareColor ; ?>"></i></a>
						&ensp;
						<a href="https://twitter.com/share?url=<?php echo $siteUrl ; ?>&text=<?php echo $twitterShareText ; ?>" target="_blank"><i class="fa fa-twitter-square fa-2x" style="color:<?php echo $twitterShareColor ; ?>"></i></a>
						&ensp;
						<a  href="https://wa.me/?text=<?php echo $whatsappShareText ; ?>"><i class="fa fa-whatsapp fa-2x" style="color:<?php echo $whatsappShareColor ; ?>"></i></a>
						&ensp;
					  </li>    
					</ul>
				  </div>
				  
            </div>
			
      </nav>