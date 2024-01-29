<?php include("header_session.php") ; ?>
<?php
$pageSlug = filter_var($_GET['page_slug'], FILTER_SANITIZE_STRING);
$checkPageStatus = check_activepage_for_user($pdo,$pageSlug) ; 
if($checkPageStatus == 0) {
	header("location: ".BASE_URL."") ;
	exit ;
}
?>
<?php $webtitle = get_page_title($pdo,$pageSlug) ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$nt = '2' ;
?>
<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-file fa-lg"></i> <?php echo get_page_title($pdo,$pageSlug); ?></h1>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                    <?php echo  get_page_content($pdo,$pageSlug) ; ?>
                </div>
              </div>
            </div>
        </div>
        

    </section>
</div>
<?php include("footer_main.php") ; ?>
