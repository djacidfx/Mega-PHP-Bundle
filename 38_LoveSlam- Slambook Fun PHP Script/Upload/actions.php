<?php
include("database.php") ;

if(isset($_POST['btn_action']))
{
    if($_POST['btn_action'] == 'saveSlambook')
	{
        if(!empty($_POST['name'])){
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            $secretKey = SECRET_KEY ;
            $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ;
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents_ssl($url);
            $responseKeys = json_decode($response,true);
            if($responseKeys["success"]) {
                $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING) ;
                $ins = $pdo->prepare("insert into ot_slambook (username, user_ip) values ('".$name."', '".$ip."')") ;
                $ins->execute() ;
                $statement = $pdo->query("SELECT LAST_INSERT_ID()");
                $slambookLastId = $statement->fetchColumn();
                $username = urltitle_by_id($pdo,$slambookLastId) ;
                
                $sel = $pdo->prepare("select * from ot_questions where 1 order by quest_id asc") ;
                $sel->execute() ;
                $result = $sel->fetchAll();
                foreach($result as $row)
                {
                    $question = strip_tags($row['question']) ;
                    $replaceQuestion = str_replace("username", $name, $question);
                    
                    $insagain = $pdo->prepare("insert into ot_slambook_quest (sb_slambook_id, sb_questions) values ('".$slambookLastId."' , '".$replaceQuestion."') ") ;
                    $insagain->execute() ;
                    
                        
                    
                }
                
                $output = array(
                                'id' => $slambookLastId,
                                'username' => $username,
                                'err' => '0'
                                );
                        echo json_encode($output);
                
            } else {
                $form_msg =  "Spam is not allowed.";
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '2'
                        );
                echo json_encode($output);
            }
        } else {
            $form_msg =  "Name is missing. Try again.";
			$output = array( 
					'form_msg' => $form_msg,
					'err' => '1'
					);
			echo json_encode($output);
        }
    }
    
    
    if($_POST['btn_action'] == 'saveQuestAnswer')
	{
        if(!empty($_POST['sbid']) && !empty($_POST['name'])){
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            $secretKey = SECRET_KEY ;
            $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ;
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents_ssl($url);
            $responseKeys = json_decode($response,true);
            if($responseKeys["success"]) {
                $slambookId = filter_var($_POST['sbid'], FILTER_SANITIZE_NUMBER_INT);
                $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
                $checkEmptyField = check_question_form($pdo,$slambookId) ;
                if($checkEmptyField) {
                    $ins = $pdo->prepare("insert into ot_slambook_answers (ans_user_ip, ans_slambook_id, ans_username) values ('".$ip."' , '".$slambookId."' , '".$name."') ") ;
                    $ins->execute() ;
                    $statement = $pdo->query("SELECT LAST_INSERT_ID()");
                    $answerId = $statement->fetchColumn();
                    $username = urlanswername_by_id($pdo,$answerId) ; 
                    $query = "SELECT * FROM ot_slambook_quest WHERE sb_slambook_id='".$slambookId."' order by sb_quest_id asc";
                    $statement = $pdo->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                        $questId = _e($row['sb_quest_id']) ;
                        $rId = "quest".$questId ;
                        $newquestId = filter_var($_POST[$rId] , FILTER_SANITIZE_STRING) ;
                        
                        $insanswer = $pdo->prepare("insert into ot_all_answers (all_answer_id, all_slambook_id, all_quest_id, all_answer) values ('".$answerId."' , '".$slambookId."' , '".$questId."' , '".$newquestId."') ") ;
                        $insanswer->execute() ;
                    }
                    $output = array(
                                'id' => $answerId,
                                'username' => $username,
                                'err' => '0'
                                );
                        echo json_encode($output);
                } else {
                    $form_msg =  "Every Field is Mandatory to Submit.";
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '1'
                            );
                    echo json_encode($output); 
                    
                }
            } else {
                $form_msg =  "Spam is not allowed.";
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '2'
                        );
                echo json_encode($output);
            }
        }  else {
            $form_msg =  "Every Field is Mandatory to Submit.";
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '1'
                    );
            echo json_encode($output); 
        } 
    }
}
?>