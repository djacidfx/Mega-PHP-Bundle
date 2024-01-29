<?php
		$apiDetail = $pdo->prepare("SELECT * FROM ot_admin WHERE id=?");
		$apiDetail->execute(array(filter_var("1", FILTER_SANITIZE_NUMBER_INT))); 
		$api_textlocal = $apiDetail->fetchAll(PDO::FETCH_ASSOC);
		foreach($api_textlocal as $textlocal)
		{
			$textlocal_apikey = _e($textlocal['sms_apikey']) ;
			$textlocal_senderid = _e($textlocal['sms_senderid']) ;
		}
		$apiKey = urlencode($textlocal_apikey);
		$numbers = array($countryCode.$mobile);
		$numbers = implode(',', $numbers);
		$m = rawurlencode($msg);
		$data = array("apikey" => $apiKey, "numbers" => _e($numbers) , "sender" => $textlocal_senderid, "message" => _e($m));
		$ch = curl_init("https://api.textlocal.in/send/");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
?>