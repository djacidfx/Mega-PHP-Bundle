<!DOCTYPE html>
<?php if($_SESSION['lang'] === "arabic" || $_SESSION['lang'] === "urdu") { ?>
<html lang="ar" dir="rtl">
<?php } else { ?> 
<html>  
<?php } ?>
    <head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"> 
    <title>Admin Panel</title>
    <meta property="og:title" content="Admin Panel" />
    <?php if($_SESSION['lang'] === "arabic" || $_SESSION['lang'] === "urdu") { ?>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <?php } else { ?> 
        <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" >
    <?php } ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/r-2.2.9/datatables.min.css"/>        
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/custom.css">    
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
    <?php if($_SESSION['lang'] === "english" || $_SESSION['lang'] === "kazakh") { ?>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "arabic") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=ar' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "afrikaans") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=af' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "chinesesimplified") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=zh-CN' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "chinesetraditional") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=zh-TW' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "croatian") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=hr' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "czech") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=cs' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "dutch") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=nl' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "french") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=fr' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "german") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=de' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "hindi" || $_SESSION['lang'] === "nepali") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=hi' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "italian") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=it' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "japanese") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=ja' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "korean") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=ko' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "polish") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=pl' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "portuguese") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=pt' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "russian") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=ru' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "spanish") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=es' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "swedish") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=sv' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "thai") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=th' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "turkish") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=tr' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "ukrainian") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=uk' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "urdu") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=ur' async defer></script>
    <?php } ?>
    <?php if($_SESSION['lang'] === "vietnamese") { ?>
    <script src='https://www.google.com/recaptcha/api.js?explicit&hl=vi' async defer></script>
    <?php } ?>
    
</head>