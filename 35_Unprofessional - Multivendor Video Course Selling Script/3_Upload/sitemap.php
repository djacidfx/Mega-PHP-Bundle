<?php
ob_start();
session_start();
header("Content-Type: application/xml; charset=utf-8");
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

$users = $pdo->prepare("select * from ot_users where user_status = '1' and user_blocked = '0' order by id asc") ;
$users->execute();
$userresult = $users->fetchAll();
foreach($userresult as $userrow)
{
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'user/'.$userrow["user_name"].'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

$items = $pdo->prepare("select * from ot_users_video where item_status = '1' and item_pause = '1' and item_delete = '1' order by item_id asc") ;
$items->execute();
$itemsresult = $items->fetchAll();
foreach($itemsresult as $itemsrow)
{
    $shortUrlTitle = item_urltitle_by_id($pdo,$itemsrow["item_id"]) ;
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'video/'.$itemsrow["item_id"].'/'.$shortUrlTitle.'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

$forums = $pdo->prepare("select * from ot_forum_topic where topic_status = '1' order by topic_id asc") ;
$forums->execute();
$forumsresult = $forums->fetchAll();
foreach($forumsresult as $forumsrow)
{
    $topicTitle = forum_urltitle_by_id($pdo,$forumsrow["topic_id"]) ;
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'topic/'.$forumsrow["topic_id"].'/'.$topicTitle.'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

$category = $pdo->prepare("select * from ot_category where category_status = '1' order by id asc") ;
$category->execute();
$categoryresult = $category->fetchAll();
foreach($categoryresult as $categoryrow)
{
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'category/'.$categoryrow["id"].'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

$pages = $pdo->prepare("select * from ot_admin_pages where page_status = '1' order by page_id asc") ;
$pages->execute();
$pagesresult = $pages->fetchAll();
foreach($pagesresult as $pagesrow)
{
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'page/'.$pagesrow["page_slug"].'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'featured</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'new</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'trending</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'bestsellers</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'login</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'signup</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'recoverpassword</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;


echo '</urlset>' . PHP_EOL;
?>