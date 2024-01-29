<?php
ob_start();
session_start();
header("Content-Type: application/xml; charset=utf-8");
include("config/db.php") ; 
include("controller/functions.php") ;
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

$statement = $pdo->prepare("select * from ot_secrets where '1' order by id asc") ;
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
    $postId = _e($row['id']) ;
    $postshortTitle = post_short_title_by_id($pdo,$postId) ;
    $postTitle = post_title_by_id($pdo,$postId) ;
    $postUrlTitle = post_urltitle_by_id($pdo,$postId) ;
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'secret/'.$row["id"].'/'.$postUrlTitle.'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'sharesecret</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'new</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'featured</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'trending</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '</urlset>' . PHP_EOL;
?>