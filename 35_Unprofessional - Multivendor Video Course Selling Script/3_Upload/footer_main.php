<?php include("common_footer.php") ; ?>

  <!-- General JS Scripts -->
  <script src="<?php echo BASE_URL ; ?>js/jquery-3.6.0.min.js"></script>
 <!-- <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>-->
  <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/r-2.2.7/datatables.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/jquery.nicescroll.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/moment.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/stisla.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/scripts.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/carousal.js"></script>
  <script src="<?php echo BASE_URL ; ?>tinymce/tinymce.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/tinymce_editor.js"></script>
<?php if(isset($tempId)){ ?> 
  <script src="<?php echo BASE_URL ; ?>js/softuploads.js"></script>
<?php } else {?> 
    <?php if(isset($itemId)){ ?> 
        <script src="<?php echo BASE_URL ; ?>js/editupload.js"></script>
    <?php } else {?>
        <?php 
        $uploadUrl = BASE_URL."upload" ;
        $uploadUrl = remove_http($uploadUrl) ;
        $host = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];
        if($host == $uploadUrl){
        ?>
        <script src="<?php echo BASE_URL ; ?>js/uploads.js"></script>
        <?php } ?>
    <?php } ?>
<?php } ?>
<?php if($nt == '1'){ ?>
    <script src="<?php echo BASE_URL ; ?>js/notification_one.js"></script>
<?php } ?>
<?php if($nt == '2'){ ?>
    <script src="<?php echo BASE_URL ; ?>js/notification_two.js"></script>
<?php } ?>
<?php if($nt == '3'){ ?>
    <script src="<?php echo BASE_URL ; ?>js/notification_three.js"></script>
<?php } ?>
<script src="<?php echo BASE_URL ; ?>js/readnoti.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/tables.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/page.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/profile.js"></script>
<?php if(ga_on_user($pdo) == 1){ echo ga_code($pdo) ; } ?>
</body>
</html>