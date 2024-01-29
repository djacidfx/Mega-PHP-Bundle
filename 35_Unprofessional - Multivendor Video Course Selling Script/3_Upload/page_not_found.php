<?php include("header_session.php") ; ?>
<?php $webtitle = "Page Not Found" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h2 class="text-danger mt-5">404 - Page Not Found</h2>
            <div class="page-description">
              The page you are looking for might have been removed, had its name changed, doesn't exist, or is temporarily unavailable.
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
<?php include("footer_main.php") ; ?>