<?php
include("database.php") ;
if($_POST['btn_action']){
    
    if($_POST['btn_action'] == 'deleteQuestion') {
        if(!empty($_POST['id'])) {
            $id = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $updcomment = $pdo->prepare("DELETE FROM `ot_questions` where quest_id = '".$id."'" ) ; 
            $updcomment->execute() ;
            echo "Question is deleted successfully." ;
        } else {
            echo "Question Id is missing. Try Again" ;
        }
    }
    
    if($_POST['btn_action'] == 'AddQuest') {
        if(!empty($_POST['question'])) {
            $question = filter_var($_POST['question'] , FILTER_SANITIZE_STRING) ;
            $ins = $pdo->prepare("insert into ot_questions (question) values ('".$question."') ") ;
            $ins->execute() ;
            if($ins){
                echo "Slambook Question created successfully." ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'EditQuest') {
        if(!empty($_POST['question']) && !empty($_POST['pId']) ) {
            $question = filter_var($_POST['question'] , FILTER_SANITIZE_STRING) ;
            $questionId = filter_var($_POST['pId'], FILTER_SANITIZE_NUMBER_INT);
            $ins = $pdo->prepare("update ot_questions set question = '".$question."' where quest_id = '".$questionId."'") ;
            $ins->execute() ;
            if($ins){
                echo "Slambook Question updated successfully." ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'fetch_quest') {
        
        if(!empty($_POST['pId'])){
			$questionId = filter_var($_POST['pId'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from ot_questions where quest_id = ?");
			$announce->execute(array($questionId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['pId'] = _e($row['quest_id']);
				$output['question'] = strip_tags($row['question']);
			}
			echo json_encode($output) ;
		} else {
			echo "Error : Question Id is mandatory." ;
		}
        
    }
    
    if($_POST['btn_action'] == 'deleteSlambook') {
        if(!empty($_POST['id'])) {
            $id = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("DELETE FROM `ot_slambook` where slambook_id = '".$id."'" ) ; 
            $upd->execute() ;
            $updel = $pdo->prepare("DELETE FROM `ot_slambook_answers` where ans_slambook_id = '".$id."'" ) ; 
            $updel->execute() ;
            $upddel = $pdo->prepare("DELETE FROM `ot_slambook_quest` where sb_slambook_id = '".$id."'" ) ; 
            $upddel->execute() ;
            $updans = $pdo->prepare("DELETE FROM `ot_all_answers` where all_slambook_id = '".$id."'" ) ; 
            $updans->execute() ;
            echo "User Slambook is deleted successfully." ;
        } else {
            echo "Slambook Id is missing. Try Again" ;
        }
    }
    
    if($_POST['btn_action'] == 'blockUserIp') {
        if(!empty($_POST['id'])) {
            $blockIp = base64_decode($_POST['id']) ;
            $blockIp = filter_var($blockIp , FILTER_VALIDATE_IP) ;
            if(find_blocked_ip($pdo , $blockIp) == 0){
                $del = $pdo->prepare("insert into ot_ip_blocked (blocked_ip) values('".$blockIp."') ") ; 
                $del->execute() ; 
                echo "User IP is blocked." ;
            } else {
                echo "User IP is already blocked." ;
            }
                         
        } else {
            echo "IP Address is empty. Try again." ;
        }
    }
    
    if($_POST['btn_action'] == 'blockUserManualIPAddress') {
        if(!empty($_POST['userip'])) {
            $blockIp = filter_var($_POST['userip'] , FILTER_VALIDATE_IP) ;
            if(!empty($blockIp)){
                if(find_blocked_ip($pdo , $blockIp) == 0){
                    $del = $pdo->prepare("insert into ot_ip_blocked (blocked_ip) values('".$blockIp."') ") ; 
                    $del->execute() ; 
                    echo "0" ;
                } else {
                    echo "2" ;
                }
            } else {
                echo "1" ;
            }
                         
        } else {
            echo "1" ;
        }
    }
    
    if($_POST['btn_action'] == 'deleteBlacklist') {
        if(!empty($_POST['status'])) {
            $blockIp = base64_decode($_POST['status']) ;
            $blockIp = filter_var($blockIp , FILTER_VALIDATE_IP) ;
            if(!empty($blockIp)){
                    $del = $pdo->prepare("delete from ot_ip_blocked where blocked_ip = '".$blockIp."'" ) ; 
                    $del->execute() ; 
                echo "User IP is unblocked & deleted from blacklist table" ;
            }
                         
        }
    }
    
    if($_POST['btn_action'] == 'saveGaCode') {
        if(!empty($_POST['ga_code']) ) {
            $code = base64_encode($_POST['ga_code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $userstatus = filter_var($_POST['user_status'] , FILTER_SANITIZE_NUMBER_INT) ;
            $adminstatus = filter_var($_POST['admin_status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($userstatus == '1'){
                $userstatus = '1' ;
            } else {
                $userstatus = '0' ;
            }
            
            if($adminstatus == '1'){
                $adminstatus = '1' ;
            } else {
                $adminstatus = '0' ;
            }
            
            $upd = $pdo->prepare("update ot_admin set ga_code = '".$code."' , user_on = '".$userstatus."' , admin_on = '".$adminstatus."' where id = '1'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'saveaboutus') {
        if( !empty($_POST['copyright']) ) {
            $copyright = filter_var($_POST['copyright'] , FILTER_SANITIZE_STRING) ;
            $upd = $pdo->prepare("update ot_admin set adm_name = '".$copyright."' where id = '1'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'saveextra') {
        if(!empty($_POST['blk'])  ) {
            $code = filter_var($_POST['blk'], FILTER_SANITIZE_STRING) ;
            $upd = $pdo->prepare("update ot_admin set block_msg = '".$code."'  where id = '1'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'saveemail') {
        if(!empty($_POST['email'])  && !empty($_POST['password']) ) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ;
            $password = filter_var($_POST['password'] , FILTER_SANITIZE_STRING) ;
            $statement = $pdo->prepare("select * from ot_admin where id = '1'");
            $statement->execute() ;
            $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $user_ok = $statement->rowCount();
            if($user_ok > 0) {
                foreach($result as $row){
                    $auth_pass = _e($row['adm_password']) ;
                }
            }
            //validate password
			if(password_verify($password, $auth_pass)) {            
                $upd = $pdo->prepare("update ot_admin set adm_email = '".$email."' where id = '1'") ;
                $upd->execute() ;
                if($upd){
                    echo "1" ;
                } else {
                    echo "0" ;
                }
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'savepassword') {
        if(!empty($_POST['oldpass'])  && !empty($_POST['newpass']) && !empty($_POST['repass'])  ) {
            $oldpass = filter_var($_POST['oldpass'], FILTER_SANITIZE_STRING) ;
            $newpass = filter_var($_POST['newpass'], FILTER_SANITIZE_STRING) ;
            $repass = filter_var($_POST['repass'], FILTER_SANITIZE_STRING) ;
            
            $uppercase = preg_match('@[A-Z]@', $newpass);
            $lowercase = preg_match('@[a-z]@', $newpass);
            $number    = preg_match('@[0-9]@', $newpass);
            $statement = $pdo->prepare("select * from ot_admin where id = '1'");
            $statement->execute() ;
            $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $user_ok = $statement->rowCount();
            if($user_ok > 0) {
                foreach($result as $row){
                    $auth_pass = _e($row['adm_password']) ;
                }
                if(password_verify($oldpass, $auth_pass)) {
                    if($newpass == $repass) {
                        //validate password
                        if(!$uppercase || !$lowercase || !$number || strlen($newpass) < 8) {
                            echo "3" ;
                        } else {
                            $update_password = $pdo->prepare("update ot_admin set adm_password = ? where id = '1'");
                            $update_password->execute(array(password_hash($newpass, PASSWORD_DEFAULT)));
                            
                            echo "1" ;
                        }
                    } else {
                        echo "2" ;
                    }
                } else {
                    echo "0" ;
                }
            }
        }
    }
    
    if($_POST['btn_action'] == 'header970') {
        if(!empty($_POST['header970code']) && !empty($_POST['header970status']) ) {
            $code = base64_encode($_POST['header970code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['header970status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '1'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'header320') {
        if(!empty($_POST['header320code']) && !empty($_POST['header320status']) ) {
            $code = base64_encode($_POST['header320code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['header320status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '2'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'sidebar600') {
        if(!empty($_POST['sidebar600code']) && !empty($_POST['sidebar600status']) ) {
            $code = base64_encode($_POST['sidebar600code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['sidebar600status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '3'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'sidebarleft600') {
        if(!empty($_POST['sidebar600leftcode']) && !empty($_POST['sidebar600leftstatus']) ) {
            $code = base64_encode($_POST['sidebar600leftcode']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['sidebar600leftstatus'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '4'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
}

?>