<?php
ob_start();
session_start();
header("Content-Type: application/xml; charset=utf-8");
include("_adminarea_/db/config.php");
include("_adminarea_/db/post_functions.php");
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

$statement = $pdo->prepare("select * from anony_post where post_status = '1' order by id asc") ;
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'post/'.$row["id"].'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}
echo '</urlset>' . PHP_EOL;
?>