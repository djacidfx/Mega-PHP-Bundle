<?php
function extractVideoID($url) {
  preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
  return $match[1];
}

    $youtubelink = !empty($_POST['youtubelink']) ? trim($_POST['youtubelink']) : "";
    $youtubeID = extractVideoID($youtubelink);
    $thumblink = 'https://img.youtube.com/vi/'.$youtubeID;
?>

