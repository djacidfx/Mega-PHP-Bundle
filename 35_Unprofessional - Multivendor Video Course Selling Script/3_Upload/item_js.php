<!-- General JS Scripts -->
  <script src="<?php echo BASE_URL ; ?>js/jquery-3.6.0.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
  <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/r-2.2.7/datatables.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/jquery.nicescroll.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/moment.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/stisla.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/scripts.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/tables.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ; ?>js/product.js" ></script>
  <script src="<?php echo BASE_URL ; ?>js/notification_three.js"></script>
<?php if(ga_on_user($pdo) == 1){ echo ga_code($pdo) ; } ?>