<?php include("header.php") ; ?>
<div class="col-lg-12 mt-2">
    <?php echo  get_seencomments_default($pdo) ; ?>
    <div class="jQueryNewSeenComment"></div>
</div>
<?php include("footer.php") ; ?>