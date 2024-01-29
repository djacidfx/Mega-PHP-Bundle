<?php include("header.php") ; ?>
<div class="col-lg-12 mt-2">
    <?php echo  get_unseencomments_default($pdo) ; ?>
    <div class="jQueryNewUnseenComment"></div>
</div>
<?php include("footer.php") ; ?>