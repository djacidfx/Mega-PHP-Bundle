<?php include("header_session.php") ; ?>
<?php 
$nt = '2' ;
$categoryby = "active" ;
$catId = $_GET['cat_id'] ;
checking_active_category($pdo,$catId) ;
if(checking_active_category($pdo,$catId) > 0) {
    increase_category_view($pdo,$catId) ;
}
$webtitle = "Category - ".category_name($pdo,$catId) ;
?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section"> 
      <?php if(isset($_GET['seller']) || isset($_GET['price']) || isset($_GET['highprice']) || isset($_GET['rating'])){ ?>
            <?php if(!empty($_GET['seller'])=='bestseller') { ?> 
                <?php echo fetch_category_item_bestseller_default($pdo,$catId) ; ?>
                <div class="jQueryNewCategoryBestSellerItem"></div>
            <?php } elseif(!empty($_GET['price'])=='lowest') { ?> 
                <?php echo fetch_category_item_lowprice_default($pdo,$catId) ; ?>
                <div class="jQueryCategoryLowestPriceItem"></div>
            <?php } elseif(!empty($_GET['highprice'])=='highest') { ?> 
                <?php echo fetch_category_item_highprice_default($pdo,$catId) ; ?>
                <div class="jQueryCategoryHighestPriceItem"></div>
            <?php } elseif(!empty($_GET['rating'])=='top') { ?> 
                <?php echo fetch_category_item_highrating_default($pdo,$catId) ; ?>
                <div class="jQueryCategoryHighestRatingItem"></div>
            <?php } else { ?> 
                <?php echo fetch_category_item_default($pdo,$catId) ; ?>
                <div class="jQueryNewCategoryItem"></div>
            <?php } ?>
        <?php } else { ?>
            <?php echo fetch_category_item_default($pdo,$catId) ; ?>
            <div class="jQueryNewCategoryItem"></div>
        <?php } ?>
      
    </section>
</div>
<?php include("footer_main.php") ; ?>
