</div>
        
    
        
    </div>
    <?php if(analytics_user_status($pdo) == '1') { echo analytics_code($pdo) ; } ?>
    <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>	 
    <script type="text/javascript" src="<?php echo BASE_URL ; ?>js/custom.js" ></script>
</body>
</html>