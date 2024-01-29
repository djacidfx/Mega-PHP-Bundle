<?php
error_reporting(0);
include("setup.php") ;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?php echo META_SITE_TITLE ; ?></title>
	<meta property="og:title" content="<?php echo META_SITE_TITLE ; ?>" />
	<meta property="og:description" content="<?php echo META_SITE_DESCRIPTION ; ?>" />
	<link href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="<?php echo BASE_URL ; ?>css/custom.css" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo BASE_URL ; ?>favicon.png">
</head>
<body class="bg-dark">
	<div class="container">
		<div class="row">


      <!-- Desktop AD 300 x 600 Pixel ==> Left Side AD Start-->

      <div class="col-lg-3 mt-5 d-none d-sm-none d-md-block d-lg-block">
            <?php include("ad_desktop_leftside.php") ; ?>
      </div>

      <!-- Desktop AD 300 x 600 Pixel End-->

      <div class="col-lg-6 text-white justify-content-center text-center mt-5">

        <div class="col-lg-12 object">
          <h1 class="text-warning"><?php echo INDEX_HEADING ; ?></h1>
        </div>
        <div class="col-lg-12  mt-n16">
          <i class="bi bi-link textShadow verybigFont text-primary"></i>
        </div>

        <!-- Mobile AD 300 x 50 Pixel Start-->
        <div class="col-lg-12 d-md-none me-5 mt-n8">
              <?php include("ad_mobile.php") ; ?>
        </div>
        <!-- Mobile AD 300 x 50 Pixel Start-->

        <div class="col-lg-12">
          <div class="card bg-dark newShadow">
            <div class="card-body bg-dark">
              <form method="post" class="shortMyLink">
                <div class="col-lg-12 p-2">
                  <input type="text" name="url" class="form-control bg-dark text-white customBorder" placeholder="<?php echo BOX_PLACEHOLDER ; ?>" autocomplete="off" required />
                </div>
                <div class="col-lg-12 p-2">
                  <input type="hidden" name="btn_action" value="fetch_url"  />
                  <button type="submit" class="btn btn-md btn-primary shortBtn"><?php echo BUTTON_NAME ; ?></button>
                </div>
              </form>
              <div class="col-lg-12 shortLink p-2"></div>
            </div>
          </div>
        </div>

      </div>

      <!-- Desktop AD 300 x 600 Pixel ==> Right Side AD Start-->

      <div class="col-lg-3 mt-5 d-none d-sm-none d-md-block d-lg-block">
            <?php include("ad_desktop_rightside.php") ; ?>
      </div>

      <!-- Desktop AD 300 x 600 Pixel End-->
      <div class="bg-dark customTopBorder text-muted text-center fixed-bottom p-2"><span>Copyright &copy; <?php echo date("Y"); ?> <b class="text-white"><?php echo COPYRIGHT_NAME ; ?></b> . All Rights Reserved.</span></div>
    </div>
	</div>

  <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
  <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
  <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/clipboard.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ; ?>js/custom.js" ></script>
  <script>
      var clipboard = new ClipboardJS('.btn');

      clipboard.on('success', function (e) {
        console.log(e);
      });

      clipboard.on('error', function (e) {
        console.log(e);
      });
    </script>
</body>
</html>
