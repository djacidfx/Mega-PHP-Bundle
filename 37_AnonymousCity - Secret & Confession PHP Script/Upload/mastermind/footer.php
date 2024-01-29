            </div>
        </div>
    </div>
<?php if(analytics_admin_status($pdo) == '1') { echo analytics_code($pdo) ; } ?>
    <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>	 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/r-2.2.9/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_URL ; ?>js/admin.js" ></script>
<script src="<?php echo BASE_URL ; ?>tinymce/tinymce.min.js"></script>
    <script src="<?php echo ADMIN_URL ; ?>js/tinymce_editor.js"></script>
</body>
</html>
