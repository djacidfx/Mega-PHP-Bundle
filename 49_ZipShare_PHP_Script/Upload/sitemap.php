<?php
header("Content-Type: application/xml; charset=utf-8");
include("config/database.php") ; 
include("functions.php") ; 
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'popular</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'featured</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'upload</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.BASE_URL.'rss</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

$zip = $pdo->prepare("select * from ot_zip where zip_status = '1' order by zip_id asc") ;
$zip->execute();
$resultzip = $zip->fetchAll();
foreach($resultzip as $rowzip)
{
    $zipSlug = _e($rowpage['zip_slug']) ;
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'zip/'.$zipSlug.'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

$category = $pdo->prepare("select * from ot_category where category_status = '1' order by cat_id asc") ;
$category->execute();
$resultcat = $category->fetchAll();
foreach($resultcat as $rowcat)
{
    $catSlug = _e($rowcat['category_slug']) ;
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'category/'.$catSlug.'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

$statement = $pdo->prepare("select * from ot_blogs where blog_status = '1' order by blog_id asc") ;
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
    $blogSlug = _e($row['blog_slug']) ;
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'blog/'.$blogSlug.'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

$page = $pdo->prepare("select * from ot_pages where page_status = '1' order by page_id asc") ;
$page->execute();
$resultpage = $page->fetchAll();
foreach($resultpage as $rowpage)
{
    $pageSlug = _e($rowpage['page_slug']) ;
    echo '<url>' . PHP_EOL;
    echo '<loc>'.BASE_URL.'page/'.$pageSlug.'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}
echo '</urlset>' . PHP_EOL;
?>