<div class="row pt-4  <?php echo colormode('border_top') ; ?> mt-3">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row p-3">
            <div class="col-lg-4 ">
                <h3 class="text-muted border border-top-0 border-start-0 border-end-0 pb-3"><?php echo userlang('about_us') ; ?></h3>
                <p class="<?php echo colormode('default_text') ; ?> mt-3"><?php echo nl2br(find_aboutus($pdo)) ; ?></p>
            </div>
            <div class="col-lg-4">
                <h3 class="text-muted border border-top-0 border-start-0 border-end-0 pb-3"><?php echo userlang('quick_link') ; ?></h3>
                <p class="<?php echo colormode('default_text') ; ?> mt-3"><?php echo fetch_active_pages_foruser($pdo) ; ?></p>
            </div>
            <div class="col-lg-4">
                <h3 class="text-muted border border-top-0 border-start-0 border-end-0 pb-3"><?php echo userlang('copyright_heading') ; ?></h3>
                <p class="<?php echo colormode('default_text') ; ?> mt-3"><?php echo userlang('copyright_heading') ; ?> &copy; <?php echo date("Y"); ?> <b class="<?php echo colormode('default_text') ; ?>"><?php echo COPYRIGHT_NAME ; ?></b> . <?php echo userlang('all_right_reserved') ; ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>