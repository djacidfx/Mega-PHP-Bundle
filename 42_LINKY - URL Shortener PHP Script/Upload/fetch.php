<?php
error_reporting(0);
include("setup.php") ;

function remove_http($url) {
   $disallowed = array('http://', 'https://');
   foreach($disallowed as $d) {
      if(strpos($url, $d) === 0) {
         return str_replace($d, '', $url);
      }
   }
   return $url;
}

if(isset($_POST['btn_action'])){
  if($_POST['btn_action'] == 'fetch_url'){
    if (isset($_POST['url'])) {
    	if(preg_match("/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/",  $_POST['url'])){
    		$urls = file_get_contents("urls.json");
    		$urls = json_decode($urls, true);

    		$random = substr(sha1(microtime()), 0, URL_LENGTH);

    		if (!isset($urls[$random])) {
    			$urls[$random] = remove_http($_POST['url']);
    		}
    		file_put_contents('urls.json', json_encode($urls));
        $newlink = BASE_URL."link/".$random ;
        $buttonName = BUTTON_NAME ;
        $output = array(
          'err' => '0',
          'newlink' => $newlink,
          'buttonName' => $buttonName
          ) ;
        echo json_encode($output);
    	}
    	else {
        $wrong = WRONG_MESSAGE ;
        $buttonName = BUTTON_NAME ;
        $output = array(
          'err' => '1',
          'wrong' => $wrong,
          'buttonName' => $buttonName
          ) ;
        echo json_encode($output);
    	}
    }
  }
}
