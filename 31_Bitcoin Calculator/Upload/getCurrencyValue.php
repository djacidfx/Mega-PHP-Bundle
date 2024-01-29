<?php
function getResource($url){
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
function coinbase(){
#appears to update once per minute.
	$data = json_decode(getResource('https://api.coinbase.com/v2/exchange-rates?currency=BTC'),'TRUE');
	return $data['data'];
}
if(isset($_POST['submitValue'])){
	if($_POST['submitValue'] == 'submitValue'){
		$amt = filter_var($_POST['amt'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$currencyName = filter_var($_POST['currencyName'], FILTER_SANITIZE_STRING);
		$data = array();
		$results = coinbase() ;
		foreach($results as $row) {
			$data[1] = $row ;	
		}
		$output = '';
		$output .= ''.$amt.' BTC = '.number_format(json_encode($data[1][$currencyName] * $amt),2).' '.$currencyName.'';
		echo $output;
	}
}
?>