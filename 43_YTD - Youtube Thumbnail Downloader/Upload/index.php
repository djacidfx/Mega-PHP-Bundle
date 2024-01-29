<?php 
ob_start();
include "setup.php" ;
include "thumbnail.php" ;
if(isset($_POST['download_thumbnail'])){
    if(!empty($_POST['thumburl'])){
        $thumburl = filter_var($_POST['thumburl'], FILTER_SANITIZE_URL) ;
        $filename = time().'_thumbnail.jpg';
        $file_contents = file_get_contents_curl($thumburl);
        file_put_contents($filename, $file_contents);
        if (headers_sent()) {
			echo 'HTTP header already sent';
		} else {
			if (!is_file($filename)) {
				header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
				echo 'File not found';
			} else if (!is_readable($filename)) {
				header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
				echo 'File not readable';
			} else {
				header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
				header("Content-Type: application/octet-stream");
				header("Content-Transfer-Encoding: Binary");
				header("Content-Length: ".filesize($filename));
				header("Content-Disposition: attachment; filename=\"".basename($filename)."\"");
                ob_clean();
                flush();
				readfile($filename);
                ignore_user_abort(true);
                unlink($filename);
				exit;
			}
		}
    }
}
function file_get_contents_curl($url) {
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);  
    $data = curl_exec($ch);
    curl_close($ch);  
    return $data;
}
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"> 
    <title><?php echo META_SITE_TITLE ; ?></title>
    <meta property="og:title" content="<?php echo META_SITE_TITLE ; ?>" />
	<meta property="og:description" content="<?php echo META_SITE_DESCRIPTION ; ?>" />
	<link href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="<?php echo BASE_URL ; ?>css/custom.css" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
    <script src="<?php echo BASE_URL ; ?>js/spotlight.bundle.js"></script>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-3 justify-content-center text-center object">
                <img src="<?php echo BASE_URL ; ?>img/logo.png" class="img-fluid img-responsive">
            </div>
            
             <!-- Mobile AD 300 x 50 Pixel Start-->
            <div class="col-lg-12 d-md-none me-5 mt-2">
                  <?php include("ad_mobile.php") ; ?>
            </div>
            <!-- Mobile AD 300 x 50 Pixel Start-->
            
            <!-- Desktop AD 300 x 600 Pixel ==> Left Side AD Start-->

            <div class="col-lg-3 mt-3 d-none d-sm-none d-md-block d-lg-block">
                <?php include("ad_desktop_leftside.php") ; ?>
            </div>

            <!-- Desktop AD 300 x 600 Pixel End-->
            
            <div class="col-lg-6 text-white justify-content-center text-center mt-3">
                
        
            <div class="col-lg-12">
                <div class="card darkShadow">
                    <div class="card-body">
                        <form action="" method="POST">
                        <div class="row g-3">
                            
                              <div class="col-lg-8">
                                <input type='text' name='youtubelink' placeholder='' id="typer" class='form-control '/>
                              </div>
                              <div class="col-lg-4">
                                <button type="submit" class="btn btn-md btn-danger"><i class="bi bi-youtube"></i>&ensp;<span class="align-top"><?php echo BUTTON_NAME; ?></span></button>
                              </div>
                            
                        </div>
                        </form>
                    </div>
                </div>                
            </div>
            
        <?php if(!empty($youtubeID)){ ?>
            <div class="embed-responsive embed-responsive-16by9 p-2">
                <img src="<?php echo $thumblink.'/maxresdefault.jpg'; ?>" class="img-fluid img-responsive"><br/>
            </div>
                
            <div class="row customBottomBorder mt-2">
                <div class="col-lg-6 p-1">
                <b class="text-muted bigIconS"><?php echo low_resolution ; ?></b><span class="text-dark"> - <?php list($imgWidth, $imgHeight) = getimagesize($thumblink.'/mqdefault.jpg'); echo $imgWidth.' x '.$imgHeight; ?> Pixel</span>
                </div>
                <div class="col-lg-6 justify-content-center text-center p-1 mt-n2">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 text-md-end p-1">
                            <a href="<?php echo $thumblink.'/mqdefault.jpg'; ?>" class='spotlight' data-title="<?php echo low_resolution ; ?> - <?php list($imgWidth, $imgHeight) = getimagesize($thumblink.'/mqdefault.jpg'); echo $imgWidth.' x '.$imgHeight; ?>" data-toggle="tooltip" title="View" ><i class="bi bi-eye-fill btn btn-sm btn-primary"></i></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-md-start p-1">
                            <form method="post" action="">
                                <input type="hidden" name="thumburl" value="<?php echo $thumblink.'/mqdefault.jpg'; ?>" >
                                <button type="submit" name="download_thumbnail" class="btn btn-sm btn-success" data-toggle="tooltip" title="Download"><i class="bi bi-download"></i></button>
                            </form> 
                        </div>
                    </div>
                    
                                       
                </div>
            </div>
                
            <div class="row customBottomBorder mt-2">
                <div class="col-lg-6 p-1">
                <b class="text-muted bigIconS"><?php echo med_resolution ; ?></b><span class="text-dark"> - <?php list($imgWidth, $imgHeight) = getimagesize($thumblink.'/hqdefault.jpg'); echo $imgWidth.' x '.$imgHeight; ?> Pixel</span>
                </div>
                <div class="col-lg-6 justify-content-center text-center p-1 mt-n2">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 text-md-end p-1">
                            <a href="<?php echo $thumblink.'/hqdefault.jpg'; ?>" class='spotlight' data-title="<?php echo med_resolution ; ?> - <?php list($imgWidth, $imgHeight) = getimagesize($thumblink.'/hqdefault.jpg'); echo $imgWidth.' x '.$imgHeight; ?>" data-toggle="tooltip" title="View" ><i class="bi bi-eye-fill btn btn-sm btn-primary"></i></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-md-start p-1">
                            <form method="post" action="">
                                <input type="hidden" name="thumburl" value="<?php echo $thumblink.'/hqdefault.jpg'; ?>" >
                                <button type="submit" name="download_thumbnail" class="btn btn-sm btn-success" data-toggle="tooltip" title="Download"><i class="bi bi-download"></i></button>
                            </form> 
                        </div>
                    </div>
                    
                                       
                </div>
            </div> 
                
            <div class="row customBottomBorder mt-2">
                <div class="col-lg-6 p-1">
                <b class="text-muted bigIconS"><?php echo high_resolution ; ?></b><span class="text-dark"> - <?php list($imgWidth, $imgHeight) = getimagesize($thumblink.'/sddefault.jpg'); echo $imgWidth.' x '.$imgHeight; ?> Pixel</span>
                </div>
                <div class="col-lg-6 justify-content-center text-center p-1 mt-n2">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 text-md-end p-1">
                            <a href="<?php echo $thumblink.'/sddefault.jpg'; ?>" class='spotlight' data-title="<?php echo high_resolution ; ?> - <?php list($imgWidth, $imgHeight) = getimagesize($thumblink.'/sddefault.jpg'); echo $imgWidth.' x '.$imgHeight; ?>" data-toggle="tooltip" title="View" ><i class="bi bi-eye-fill btn btn-sm btn-primary"></i></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-md-start p-1">
                            <form method="post" action="">
                                <input type="hidden" name="thumburl" value="<?php echo $thumblink.'/sddefault.jpg'; ?>" >
                                <button type="submit" name="download_thumbnail" class="btn btn-sm btn-success" data-toggle="tooltip" title="Download"><i class="bi bi-download"></i></button>
                            </form> 
                        </div>
                    </div>
                    
                                       
                </div>
            </div>
                
            <div class="row customBottomBorder mt-2 pb-5">
                <div class="col-lg-6 p-1">
                <b class="text-muted bigIconS"><?php echo max_resolution ; ?></b><span class="text-dark"> - <?php list($imgWidth, $imgHeight) = getimagesize($thumblink.'/maxresdefault.jpg'); echo $imgWidth.' x '.$imgHeight; ?> Pixel</span>
                </div>
                <div class="col-lg-6 justify-content-center text-center p-1 mt-n2">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 text-md-end p-1">
                            <a href="<?php echo $thumblink.'/maxresdefault.jpg'; ?>" class='spotlight' data-title="<?php echo max_resolution ; ?> - <?php list($imgWidth, $imgHeight) = getimagesize($thumblink.'/maxresdefault.jpg'); echo $imgWidth.' x '.$imgHeight; ?>" data-toggle="tooltip" title="View" ><i class="bi bi-eye-fill btn btn-sm btn-primary"></i></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-md-start p-1">
                            <form method="post" action="">
                                <input type="hidden" name="thumburl" value="<?php echo $thumblink.'/maxresdefault.jpg'; ?>" >
                                <button type="submit" name="download_thumbnail" class="btn btn-sm btn-success" data-toggle="tooltip" title="Download"><i class="bi bi-download"></i></button>
                            </form> 
                        </div>
                    </div>
                    
                                       
                </div>
            </div>
                
                
            
        <?php } ?>
            </div>
            
            <!-- Desktop AD 300 x 600 Pixel ==> Right Side AD Start-->

          <div class="col-lg-3 mt-3 d-none d-sm-none d-md-block d-lg-block">
                <?php include("ad_desktop_rightside.php") ; ?>
          </div>

          <!-- Desktop AD 300 x 600 Pixel End-->
          <div class="bg-white customTopBorder text-muted text-center fixed-bottom p-2"><span>Copyright &copy; <?php echo date("Y"); ?> <b class="text-dark"><?php echo COPYRIGHT_NAME ; ?></b> . All Rights Reserved.</span></div>
            
        </div>
    </div>
    
    <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL ; ?>js/custom.js"></script>
    
    
</body>
</html>

