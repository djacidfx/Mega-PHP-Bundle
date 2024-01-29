<?php
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


$userIp = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ;
$err = 0 ;
if(isset($_POST['btn_action'])) {
    
    if($_POST['btn_action'] == 'btnAddSite') {
        if(!empty($_POST['url']) && !empty($_POST['title'])){
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            $output = "" ;
            $secretKey = SECRET_KEY ;
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents_ssl($url);
            $responseKeys = json_decode($response,true);
            if($responseKeys["success"]) {
                $url = filter_var($_POST['url'], FILTER_SANITIZE_URL) ;
                $siteTitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING) ; 
                $statement =  $pdo->prepare("SELECT * FROM ot_sites WHERE site_url = '".$url."'");
                $statement->execute();
                $total = $statement->rowCount();
                if($total === 0) {
                    $ins = $pdo->prepare("insert into ot_sites (user_ip, site_url, site_title) values ('".$userIp."' , '".$url."' , '".$siteTitle."')");
                    $ins->execute() ;
                    $newstatement = $pdo->query("SELECT LAST_INSERT_ID()");
                    $siteId = $newstatement->fetchColumn();
                    $siteURLtitle = urltitle_by_id($pdo,$siteId) ;
                    $form_msg = BASE_URL."site/".$siteId."/".$siteURLtitle ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '0'
                            );
                    echo json_encode($output);
                } else {
                    $form_msg =  DUPLICATE_URL ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '2'
                            );
                    echo json_encode($output);
                }
            } else {
                $form_msg =  SPAM_MSG ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '3'
                        );
                echo json_encode($output);
            }
            
        } else {
            $form_msg =  EMPTY_TITLE_URL ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '1'
                        );
                echo json_encode($output);
        }
    }
    
    if($_POST['btn_action'] == 'btnDeleteSite') {
        if(!empty($_POST['password']) && !empty($_POST['sid'])){
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            $secretKey = SECRET_KEY ;
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents_ssl($url);
            $responseKeys = json_decode($response,true);
            if($responseKeys["success"]) {
                $password = filter_var($_POST['password'] , FILTER_SANITIZE_STRING) ;
                $siteId = filter_var($_POST['sid'] , FILTER_SANITIZE_NUMBER_INT) ;
                $originalPassword = get_password($pdo) ;
                if(password_verify($password, $originalPassword)){
                    $statement = $pdo->prepare("select user_ip from ot_sites where site_id = '".$siteId."'");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result as $row){
                        $blockIp = $row['user_ip'] ;
                    }
                    final_block($pdo, $blockIp , $siteId) ;
                    $output = array( 
                            'err' => '0'
                            );
                    echo json_encode($output);
                } else {
                    $sel = $pdo->prepare("select chance from ot_blocked_ip where ip_address = '".$userIp."'") ;
                    $sel->execute();
                    $newresult = $sel->fetchAll(PDO::FETCH_ASSOC);
                    foreach($newresult as $newrow){
                        $chance = $newrow['chance'] ;
                        $chance = (int)$chance - 1 ;
                        if($chance === 0){
                            $upd = $pdo->prepare("update ot_blocked_ip set blocked = '1' , chance = '0' where ip_address = '".$userIp."'") ;
                            $upd->execute();
                            $output = array( 
                                    'err' => '4'
                                    );
                            echo json_encode($output);
                        } else {
                            $upd = $pdo->prepare("update ot_blocked_ip set chance = '".$chance."' where ip_address = '".$userIp."'") ;
                            $upd->execute();
                            $form_msg =  "Wrong Password. Try again." ;
                            $output = array( 
                                    'form_msg' => $form_msg,
                                    'err' => '2'
                                    );
                            echo json_encode($output);
                        }
                    }
                }
                
            } else {
                $form_msg =  SPAM_MSG ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '3'
                        );
                echo json_encode($output);
            }
            
        } else {
            $form_msg =  EMPTY_PASSWORD_ERROR ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '1'
                        );
                echo json_encode($output);
        }
    }
    
    if($_POST['btn_action'] == 'manualUserSearch')
	{
        if(!empty($_POST['search_keyword'])){
            $search = filter_var($_POST['search_keyword'], FILTER_SANITIZE_STRING) ;            
            $query = "SELECT * FROM `ot_sites` WHERE (site_title LIKE '%$search%') order by site_id DESC ";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $total = $statement->rowCount();
            if($total > 0){
                $url = BASE_URL."search?term=".$search ;
                echo $url ;
            } else {
                echo "2" ;
            }
        } else {
            echo "1" ;
        }
    }
}
?>