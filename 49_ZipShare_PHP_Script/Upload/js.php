
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL ; ?>js/jquery.form.js"></script>
<script src="<?php echo BASE_URL ; ?>js/bodytooltip.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/custom.js"></script>
</div>
</div>
</div>
<?php include("footer.php") ; ?>
<?php if(find_analyticcode_on($pdo) > '0') { 
    echo find_analyticcode($pdo) ;
} ?>
</body>
</html>
