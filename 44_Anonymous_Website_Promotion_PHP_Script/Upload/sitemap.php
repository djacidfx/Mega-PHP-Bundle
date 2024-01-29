<?php
header("Content-Type: application/xml; charset=utf-8");
include("setup.php") ; 
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

$statement = $pdo->prepare("select * from ot_sites where 1 order by site_id asc") ;
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
    $siteId = _e($row['site_id']) ;
    $UrlTitle = urltitle_by_id($pdo,$siteId) ;
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'site/'.$row["site_id"].'/'.$UrlTitle.'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}
echo '</urlset>' . PHP_EOL;
?>