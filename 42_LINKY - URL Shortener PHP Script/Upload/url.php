<?php
error_reporting(0);
include("setup.php") ;

	if (isset($_GET['url'])) {
		$urls = file_get_contents("urls.json");
		$urls = json_decode($urls, true);

		if (isset($urls[$_GET['url']])) {
			$url = "http://{$urls[$_GET['url']]}";
			if(DELAY_SECONDS > 0){
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
			              <h3 class="text-muted"><?php echo DELAY_MESSAGE ; ?></h3>
										<br />
										<h2 class="text-white " id="delayDiv"></h2>
			            </div>
			          </div>
			        </div>

			      </div>

			      <!-- Desktop AD 300 x 600 Pixel ==> Right Side AD Start-->

			      <div class="col-lg-3 mt-5 d-none d-sm-none d-md-block d-lg-block">
			            <?php include("ad_desktop_rightside.php") ; ?>
			      </div>

			      <!-- Desktop AD 300 x 600 Pixel End-->

			    </div>
				</div>

			  <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
			  <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
			  <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>
			  <script>
				var link = '<?php echo $url ; ?>' ;
				var timeLeft = <?php echo DELAY_SECONDS ; ?> ;
				var elem = document.getElementById('delayDiv');
				//alert(link) ;
				var timerId = setInterval(countdown, 1000);

				function countdown() {
					if (timeLeft == -1) {
						clearTimeout(timerId);
						window.location.href = link ;
					} else {
						elem.innerHTML = timeLeft + ' seconds remaining';
						timeLeft--;
					}
				}
			    </script>
			</body>
			</html>
			<?php
			} else {
				header("Location: {$url}");
			}
		} else {
				header("Location: index.php");
		}
}

?>
