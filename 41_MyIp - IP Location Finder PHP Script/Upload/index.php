<?php 
error_reporting(0);
include("setup.php") ; 
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title><?php echo SITE_META_TITLE ; ?></title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="<?php echo SITE_META_DESCRIPTION ; ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="robots" content="all,follow">
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
      <link rel="icon" href="images/fav.ico" type="image/x-icon" />
      <link href="styles/bootstrap.css" rel='stylesheet' type='text/css'>
      <link href="styles/animate.css" rel='stylesheet' type='text/css'>
      <link href='styles/form.css' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="styles/font-awesome.min.css">
   </head>
   <style type="text/css">
      @font-face {
      font-family: BebasNeue;
      src: url(fonts/BebasNeueThin.otf);
      }
      #down {
      margin: 20px;
      }
   </style>
   <body style="overflow-x:hidden;" >
      <form method="POST" align="center">
         <div id="down" class="row justify-content-center text-center animated bounceInDown" id="formulario">
             
        <!-- Mobile AD 300 x 50 Pixel Start-->
        <div class="col-lg-12 d-md-none me-5">
              <?php include("ad_mobile.php") ; ?>
        </div>
        <!-- Mobile AD 300 x 50 Pixel Start-->
             
        <!-- Desktop AD 300 x 600 Pixel ==> Left Side AD Start-->
             
        <div class="col-lg-3 mt-5 d-none d-sm-none d-md-block d-lg-block">
              <?php include("ad_desktop_leftside.php") ; ?>
        </div>  
             
        <!-- Desktop AD 300 x 600 Pixel End-->
             
        <div class="col-lg-6">
         <table class="display" id="example">
            <i style="font-size:180px;" class="fa fa-map-marker" aria-hidden="true"></i><br>
            <h1 class="text-white"><?php echo HEADING ; ?></h1>
            <div class="form-inline">
               <textarea name="ccs" id="down"  class="btn btn-success" placeholder="<?php echo PLACEHOLDER_TEXT ; ?>" rows="1" class="form-control" style="cursor: auto; width: auto; height: 40px;text-align: center;" placeholder="" required></textarea>
               <div class="form-inline">
                  <button type="submit" onclick="start()" class="btn btn-warning bg-warning text-dark"><?php echo BUTTON_TEXT ; ?></button>
                </div>
             </div>
         </table>
        
<?php
    if ($_POST['ccs']) {
        $Ipfind = filter_var($_POST['ccs'], FILTER_VALIDATE_IP) ;
        $Search_Ip = substr($Ipfind, 0, 17);

        $api_jsonn = file_get_contents("http://Ip-api.com/json/" . $Search_Ip);

        $Ip1 = explode('"query":"', $api_jsonn);
        $Ip2 = explode('",', $Ip1[1]);
        $Ip = $Ip2[0];

        $Region1 = explode('"regionName":"', $api_jsonn);
        $Region2 = explode('",', $Region1[1]);
        $Region = $Region2[0];

        $Country1 = explode('"country":"', $api_jsonn);
        $Country2 = explode('",', $Country1[1]);
        $Country = $Country2[0];

        $City1 = explode('"city":"', $api_jsonn);
        $City2 = explode('",', $City1[1]);
        $City = $City2[0];

        $Net1 = explode('"isp":"', $api_jsonn);
        $Net2 = explode('",', $Net1[1]);
        $Net = $Net2[0];

        $result = " <div class=\"row p-2 text-start mt-2\"><div class=\"col-lg-3\"></div><div class=\"col-lg-6 border border-info newShadow p-4 rounded\">
         <b class=\"text-warning\">IP</b> : " . trim($Ip, '"}') . "<br>
         <b class=\"text-warning\">City</b> : " . $City . "<br>
         <b class=\"text-warning\">Region</b> : " . $Region . "<br>
         <b class=\"text-warning\">Country</b> : " . $Country . "<br>
         <b class=\"text-warning\">Provider</b> : " . $Net . "<br>
          </div><div class=\"col-lg-3\"></div></div>";
        echo $result;
    }
?>
      <!-- Copyright -->
      <div id="down" class="footer-copyright text-center "><?php echo COPYRIGHT_LINE ; ?></div>
      <!-- Copyright -->
            
    </div>
        <!-- Desktop AD 300 x 600 Pixel ==> Right Side AD Start-->
             
        <div class="col-lg-3 mt-5 d-none d-sm-none d-md-block d-lg-block">
              <?php include("ad_desktop_rightside.php") ; ?>
        </div>  
             
        <!-- Desktop AD 300 x 600 Pixel End-->
         </div>
      </form>
   </body>
</html>


