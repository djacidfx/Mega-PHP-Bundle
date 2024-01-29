<?php include_once("setup.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
    <title><?php echo META_SITE_TITLE ; ?></title>
    <meta property="og:title" content="<?php echo META_SITE_TITLE ; ?>" />
	<meta property="og:description" content="<?php echo META_SITE_DESCRIPTION ; ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>/custom.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>/favicon.png">
    <meta name="robots" content="index,follow">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 justify-content-center text-center mt-3 d-none d-sm-none d-md-block d-lg-block">
                <?php include("ad_desktop_banner.php"); ?>
            </div>
            <div class="col-lg-12 justify-content-center text-center mt-3 d-md-none">
                <?php include("ad_mobile.php"); ?>
            </div>
            <div class="col-lg-3 justify-content-center text-center mt-3 d-none d-sm-none d-md-block d-lg-block">
                <?php include("ad_desktop_leftside.php"); ?>
            </div>
            <div class="col-lg-6 mtop">
                <div class="card shadow-lg mt-3">
                    <div class="card-header text-center"><a href="<?php echo BASE_URL ; ?>"><img src="<?php echo BASE_URL ; ?>/logo.png" class="img-fluid"></a></div>
                    <div class="card-body ">
                        <form class="row gy-2 gx-3 align-items-center mt-3 text-center justify-content-center genpass">
                            <div class="col-auto">
                                <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                                <select name="len" class="form-select" id="autoSizingSelect" required>
                                  <option >Choose Password Length</option>
                                    <?php 
                                        for($i=MINIMUM_PASSWORD_LENGTH; $i <= MAXIMUM_PASSWORD_LENGTH ; $i++){
                                            echo "<option value=".$i.">".$i."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <input type="hidden" name="btn_action" value="btn_action">
                                <button type="submit" class="btn btn-primary action_logpass"><?php echo BUTTON_TEXT ; ?></button>
                            </div>
                        </form>
                        <div class="row gy-2 gx-3 align-items-center mt-3 text-center justify-content-center">
                            <div class="col-auto">
                               <div class="p-messages"></div> 
                            </div>
                        </div>
                        <div class="row gy-2 gx-3  spass">
                            <div class="d-flex align-items-center mt-3 text-center justify-content-center">
                                <div class="col-auto me-3">
                                <input type="text" class="form-control bg-light passtext" id="txt"  readonly>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success copytext" data-clipboard-target="#txt"><i class="bi bi-shield-check me-1"></i><?php echo COPY_PASSWORD_TEXT ; ?></button>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-lg mt-5 ">
                    <div class="card-body">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-12">
                                <a href="<?php echo BASE_URL ; ?>/about.php" class="me-2"><?php echo ABOUT_US_PAGE_LINK_TITLE ; ?>&ensp;||</a>
                                <a href="<?php echo BASE_URL ; ?>/terms.php" class="me-2"><?php echo TERMS_CONDITIONS_PAGE_LINK_TITLE ; ?>&ensp;||</a>
                                <a href="<?php echo BASE_URL ; ?>/privacy.php" class="me-2"><?php echo PRIVACY_POLICY_PAGE_LINK_TITLE ; ?></a>
                            </div>
                            <div class="col-lg-12 text-muted mt-3">
                                <?php echo COPYRIGHT_LINE; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 justify-content-center text-center mt-3 d-none d-sm-none d-md-block d-lg-block">
                <?php include("ad_desktop_leftside.php"); ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="<?php echo BASE_URL ; ?>/clipboard.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            "use strict";

            var base_url = location.protocol + '//' + location.host + location.pathname ;
            base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
            
             $(document).on('submit','.genpass', function(event){
                event.preventDefault();
                $('.action_logpass').attr('disabled','disabled');
                var form_data = $(this).serialize();
                $.ajax({
                    url: base_url+"generator.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                        data = JSON.parse(data);
                        
                        if(data.err == 0) {
                            $('.action_logpass').attr('disabled',false);
                            $('.spass').fadeIn();
                            $('.passtext').val(data.passtext) ;
                            $('.p-messages').fadeIn().html('<p class="text-success">'+data.form_msg+'</p>');
                        } 
                        if(data.err == 1) {
                            $('.action_logpass').attr('disabled',false);
                            $('.spass').fadeOut();
                            $('.p-messages').fadeIn().html('<p class="text-danger">'+data.form_msg+'</p>');
                        } 
                        if(data.err == 2) {
                            $('.action_logpass').attr('disabled',false);
                            $('.spass').fadeOut();
                            $('.p-messages').fadeIn().html('<p class="text-danger">'+data.form_msg+'</p>');
                        }
                    }
                });
            });
            
        });
    </script>
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