<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
         $url = "https://";   
   } else  {
         $url = "http://";  
	} 
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];
	$serverUrl = $url ; 
	$title = "Encode & Decode Link / Text Online.";
?>
<a href="https://twitter.com/share?url=<?php echo $serverUrl ; ?>&text=<?php echo $title ; ?>" target="_blank" class="float-right p-1">
<i class="fab fa-twitter-square text-info fa-2x"></i>
</a>
<a href="http://www.facebook.com/share.php?u=<?php echo $serverUrl ; ?>" target="_blank" class="float-right p-1">
<i class="fab fa-facebook-square text-primary fa-2x"></i></a>
<a href="https://wa.me/?text=<?php echo $serverUrl ; ?>" target="_blank" class="float-right p-1">
<i class="fab fa-whatsapp text-whatsapp fa-2x"></i>
</a>
