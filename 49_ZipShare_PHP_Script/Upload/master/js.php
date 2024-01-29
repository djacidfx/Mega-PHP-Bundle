<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/r-2.2.9/datatables.min.js"></script>
<script src="<?php echo BASE_URL ; ?>js/jquery.form.js"></script>
<script src="<?php echo BASE_URL ; ?>js/bodytooltip.js"></script>
<script src="<?php echo BASE_URL ; ?>js/spotlight.bundle.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/admin.js"></script>
<script src="<?php echo BASE_URL ; ?>tinymce/tinymce.min.js"></script>
<?php if(($_SESSION['mode']) == "dark") { ?> 
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/tinymce_darkeditor.js"></script>
<?php } if(($_SESSION['mode']) === "light") { ?>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/tinymce_editor.js"></script>
<?php } ?>
</div>
</div>
</div>
</body>
</html>