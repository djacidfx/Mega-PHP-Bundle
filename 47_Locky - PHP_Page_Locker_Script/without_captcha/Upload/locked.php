<?php
session_start();
error_reporting(0);

// *********** Change Only me Start 

// Page Heading Name : change only inside double inverted comma i.e. "  " means change only Page Locked text
$openPageName = "Page Locked" ;

// Placeholder Text Name : change only inside double inverted comma i.e. "  " means change only Enter Password text
$enterPasswordName = "Enter Password" ;

// Button Name : change only inside double inverted comma i.e. "  " means change only Unlock Page text
$unlockName = "Unlock Page" ;

// Wrong Password Error Text : change only inside double inverted comma i.e. "  " means change only Wrong password entered. text
$errorMessage = "Wrong password entered." ;

// Password for page unlock : change only inside double inverted comma i.e. "  " means change only 123 text
$password = "123" ;

// Page lock after inactivity in seconds :  means change only 3 text
// 1 hour = 60*60 = 3600 seconds = use only = 3600
// Half hour = 30*60 = 1800 seconds = use only = 1800
// 5 Minutes = 5*60 = 300 seconds = use only = 300
$inactive = 3;

// *********** Change Only me End

// *********** Do not change anything below ***************************

if(!isset($_SESSION['timeout'])) {
    $_SESSION['timeout'] = time() + $inactive; 
    
}
if(!isset($_SESSION['u']) ) {
   $_SESSION['u'] = "1";
}
if(!isset($_SESSION['error']) ) {
   $_SESSION['error'] = "";
}

$session_life = time() - $_SESSION['timeout'];

if($session_life > $inactive)
{  
    session_unset();
    session_destroy(); 
    $_SESSION['u'] = "1";
}

$_SESSION['timeout']=time();


if(isset($_POST['submit'])){
    $typedPassword = filter_var($_POST['password'], FILTER_SANITIZE_STRING) ;
    if($password === $typedPassword){
        $_SESSION['u'] = "0";
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
        header('Location: '.$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        exit;
    } else {
        $_SESSION['u'] = "1";
        $_SESSION['error'] = '<i class="bi bi-exclamation-triangle me-1"></i>'.$errorMessage;
    }
}

if($_SESSION['u'] === '1'){
    $body = '
                <!DOCTYPE html>
                <html>
                <head>
                <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
                <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
                <title>'.$openPageName.'</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" >
                <style>
                body{
                    height: 100vh;
                } 
                .container{
                    height: 100%;
                }
                .maxw {
                    max-width : 394.3px !important ;
                }
                </style>
                </head>
                <body class="bg-dark text-white">
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="row maxw">
                        <form method="post" action="">
                        <div class="card shadow-lg bg-dark text-white">
                            <div class="card-header text-center">
                                <h2 class="text-warning"><i class="bi bi-lock me-1"></i>'.$openPageName.'</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="password" name="password" class="form-control bg-dark text-white" placeholder="'.$enterPasswordName.'" autocomplete="off" autofocus required>
                                    </div>
                                    <div class="col-lg-12 mt-2 mb-3 text-center">
                                        <p class="text-danger">'.$_SESSION['error'].'</p>
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="bi bi-shield-lock me-1"></i>'.$unlockName.'</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
                </body>
    ';
    echo $body ;
    exit();
} 

?>