<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ; 

if($_POST['verify_otp']){
	if($_POST['verify_otp'] == 'Submit') {
        $fullname = username_by_id($pdo,$_SESSION['unprofessional']['id']) ;
        $email = useremail_by_id($pdo,$_SESSION['unprofessional']['id']) ;
        $otp = filter_var($_POST['otp'], FILTER_SANITIZE_NUMBER_INT) ;
		$statement = $pdo->prepare("select * from ot_users where id = '".$_SESSION['unprofessional']['id']."'");
		$statement->execute() ;
		$chance_ok = $statement->rowCount();
		$userData = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($userData as $data) {
			$chance = _e($data['u_chance']) ;
		}
        if($chance > '0') {
            $statementNew = $pdo->prepare("select * from ot_users where user_otp = '".$otp."' and id = '".$_SESSION['unprofessional']['id']."'");
			$statementNew->execute() ;
			$verify_ok = $statementNew->rowCount();
			if($verify_ok > 0) {
				$updUserStatus = $pdo->prepare("update ot_users set user_status='1' where id = '".$_SESSION['unprofessional']['id']."'");
				$updUserStatus->execute();
				$output = array( 
								'err' => '0'
							) ;
				echo json_encode($output);
			} else {
				$chance = $chance - 1 ;
				if($chance == '0') {
					$block = $pdo->prepare("update ot_users set u_chance = '".$chance."' , user_blocked ='1' where  id = '".$_SESSION['unprofessional']['id']."'");
					$block->execute() ;
					$output = array( 
									'err' => '1'
								) ;
					echo json_encode($output);
				} else {
					$upd = $pdo->prepare("update ot_users set u_chance = '".$chance."' where id = '".$_SESSION['unprofessional']['id']."'");
					$upd->execute();
					$form_message = "You have only ".$chance." chance left. After that you'll be Permanently Blocked.";
					$output = array( 
									'form_message' => $form_message,
									'err' => '2',
									'chance' => $chance
								) ;
					echo json_encode($output);
				}
			}
        } else {
			$block = $pdo->prepare("update ot_users set user_blocked ='1' where id = '".$_SESSION['unprofessional']['id']."'");
			$block->execute() ;
			$output = array( 
							'err' => '1'
						) ;
			echo json_encode($output);
		}
          
    }
}
?>