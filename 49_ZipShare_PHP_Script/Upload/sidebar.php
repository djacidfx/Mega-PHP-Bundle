<div class="newShadow <?php echo colormode('border') ; ?> mt-3 mb-3">
    <div class="col-lg-12 <?php echo colormode('bg_color') ; ?> text-muted  p-3 <?php echo colormode('border_bottom') ; ?>">
        <i class="bi bi-bookmark-star-fill text-warning me-1"></i><?php echo userlang('featured') ; ?> <a href="<?php echo BASE_URL ; ?>featured" class="btn btn-success btn-sm float-end"><?php echo userlang('view_all') ; ?></a>
    </div>
    <div class="col-lg-12 <?php echo colormode('bg_color') ; ?> text-muted  p-3 ">
        <?php echo sidebar_featured($pdo) ; ?>
    </div>
    <?php if(find_adcode_on($pdo) > '0') { ?> 
    <div class="col-lg-12 <?php echo colormode('bg_color') ; ?> text-muted  p-3 justify-content-center">
        <?php echo find_adcode($pdo) ; ?>
    </div>
    <?php } ?>
    <div class="col-lg-12 <?php echo colormode('bg_color') ; ?> text-muted  p-3  <?php echo colormode('border_bottom') ; ?>">
        <i class="bi bi-file-earmark-bar-graph me-1 text-danger"></i><?php echo userlang('popular') ; ?> <a href="<?php echo BASE_URL ; ?>popular" class="btn btn-success btn-sm float-end"><?php echo userlang('view_all') ; ?></a>
    </div>
    <div class="col-lg-12 <?php echo colormode('bg_color') ; ?> text-muted  p-3 <?php echo colormode('border_bottom') ; ?>">
        <?php echo sidebar_popular($pdo) ; ?>
    </div>
</div>