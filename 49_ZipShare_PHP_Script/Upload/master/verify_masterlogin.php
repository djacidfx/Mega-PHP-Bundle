<?php
include("db.php") ; 
$err = 0;
if( !empty($_POST['password']) && !empty($_POST['username']) ) {
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    }
    $output = "" ;
    $secretKey = SECRET_KEY ;
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents_ssl($url);
    $responseKeys = json_decode($response,true);
    if($responseKeys["success"]) {
        $checkUser =  $pdo->prepare("SELECT * FROM ot_admin WHERE username = '".$username."'");
         $checkUser->execute();
         $user_ok = $checkUser->rowCount();
         $user_data = $checkUser->fetchAll(PDO::FETCH_ASSOC);
         //checking user credential
         if($user_ok > 0){
            foreach($user_data as $row){
                $auth_pass = ($row['password']);
            }
            if(password_verify($password, $auth_pass)) {
                $_SESSION['master'] = $row;
                $output = array( 
                        'err' => '0'
                        );
                echo json_encode($output);
            } else {
                $form_msg =  userlang('admin_incorrectlogin_msg') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '3'
                        );
                echo json_encode($output); 
            }
        } else {
            $form_msg =  userlang('admin_incorrectlogin_msg') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '3'
                    );
            echo json_encode($output);
        }
    } else {
        $form_msg =  userlang('spam_msg') ;
        $output = array( 
                'form_msg' => $form_msg,
                'err' => '2'
                );
        echo json_encode($output);
    }
} else {
    $form_msg =  userlang('empty_admin_error') ;
    $output = array( 
            'form_msg' => $form_msg,
            'err' => '1'
            );
    echo json_encode($output);
}
?>
    
    