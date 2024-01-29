<footer class="main-footer bg-white">
    <div class="row">
    <div class="col-lg-4 ">
      <h2><?php echo aboutus_name($pdo) ; ?></h2>
      <hr>
      <p><?php echo nl2br(get_aboutus_info($pdo)) ; ?></p> 
    </div>
    <div class="col-lg-4 ">
      <h2><?php echo quicklink_name($pdo) ; ?></h2>
      <hr>
     <?php 
		$checkSlug = check_slug_for_user($pdo) ;
        if($checkSlug > '0') {
    ?>
        <p><?php echo fetch_active_pages_foruser($pdo) ; ?></p>
	<?php
		}
	?>
    </div>
    <div class="col-lg-4 ">
        <h2>Follow Us</h2>
            <hr>
        <div class="row">
            
            <?php if(check_show_community_earning($pdo) > 0){ ?> 
            <div class="col-lg-6">
                <label>Sold Items</label>
                <h5><b class="text-dark"><?php echo count_communityitem_sold($pdo) ; ?></b></h5>
            </div>
            <div class="col-lg-6">
                <label>Community Earnings</label>
                <h5><b class="text-dark">$<?php echo grab_community_earning($pdo); ?></b></h5>
            </div>
            <?php } ?>
             <div class="col-lg-12 mt-3">
                <?php echo get_insta_url($pdo).get_fb_url($pdo).get_twitter_url($pdo).get_linkedin_url($pdo).get_behance_url($pdo).get_dribble_url($pdo).get_vk_url($pdo) ; ?>
            </div>
        </div>
        
    </div>
    <div class="col-lg-12 text-center">
        <p>Copyright &copy; <?php echo date("Y"); ?>&ensp;<?php echo admin_copyright_name($pdo) ; ?>. All Rights Reserved.</p>    
    </div>
    </div>
</footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo BASE_URL ; ?>js/jquery-3.6.0.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
  <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/r-2.2.7/datatables.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/jquery.nicescroll.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/moment.min.js"></script>
  
  <script src="<?php echo BASE_URL ; ?>js/stisla.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/scripts.js"></script>
  <script src="<?php echo ADMIN_URL ; ?>js/actions.js"></script>
  <script src="<?php echo ADMIN_URL ; ?>js/datatables.js"></script>
  <script src="<?php echo ADMIN_URL ; ?>js/review.js"></script>
  <script src="<?php echo ADMIN_URL ; ?>js/modal.js"></script>
<script src="<?php echo BASE_URL ; ?>tinymce/tinymce.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/tinymce_editor.js"></script>
<?php if(ga_on_admin($pdo) == 1){ echo ga_code($pdo) ; } ?>
</body>
</html>