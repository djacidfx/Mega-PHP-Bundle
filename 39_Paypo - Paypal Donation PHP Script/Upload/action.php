<?php
ob_start();
session_start();
include("setup.php") ;

function file_get_contents_ssl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3000); // 3 sec.
    curl_setopt($ch, CURLOPT_TIMEOUT, 10000); // 10 sec.
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

if(isset($_POST['btn_action']))
{
    if($_POST['btn_action'] == 'SubmitDonationForm')
	{
        if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['amount']) ) {
            
            $name = filter_var($_POST['name'] , FILTER_SANITIZE_STRING) ;
            $email = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL) ;
            $amount = filter_var($_POST['amount'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($amount >= MIN_DONATION_AMOUNT && $amount <= MAX_DONATION_AMOUNT) {
                if(isset($_POST['g-recaptcha-response'])){
                    $captcha=$_POST['g-recaptcha-response'];
                }
                $secretKey = SECRET_KEY ;
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
                $response = file_get_contents_ssl($url);
                $responseKeys = json_decode($response,true);
                if($responseKeys["success"]) {
                    $_SESSION['uEmail'] = $email ;
                    $_SESSION['uName'] = $name ;
                    $_SESSION['uAmt'] = $amount ;  

                    $output = array( 
					'err' => '0'                      
					);
		           echo json_encode($output);
                } else {
                    $output = array( 
					'err' => '3',
					'form_msg' => RECAPTCHA_ERROR
					);
		          echo json_encode($output);
                }
            } else {
                $output = array( 
					'err' => '2',
					'form_msg' => AMOUNT_ERROR
					);
		      echo json_encode($output);
            }
        } else {
            $output = array( 
					'err' => '1',
					'form_msg' => MANDATORY_ERROR
					);
		      echo json_encode($output);
        }
    }
}
?>