<?php include("header.php") ; ?>

<div class="col-lg-12 mt-1">
    <div class="card shadow-lg">
        <div class="card-header">
            <h1 class="text-muted text-start"> <i class="bi bi-badge-ad-fill text-danger "></i> Google Ads </h1>
        </div>
    </div>
</div>


<div class="col-lg-6 mt-2">
    <form method="post" class="header970">
        <div class="card newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Desktop Ad - 468 x 60 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad 468 x 60 Pixel Javascript Code*</label>
                    <textarea name="header970code" class="form-control" rows="8"><?php echo ad_header468_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="header970status" class="form-control"> 
                        <option value="2" <?php if(ad_header468_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(ad_header468_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="header970message"></div>
                    <input type="hidden" name="btn_action" value="header970">
                    <button type="submit"  class="btn btn-sm btn-danger buttonheader970"><i class="bi bi-gear text-white"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Header Mobile Ad - 320 x 100 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="header320">
        <div class="card newShadow">
            <div class="card-header">
                <h6><i class="bi bi-phone text-warning"></i> Mobile Header Ad - 320 x 100 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad 320 x 100 Pixel Javascript Code*</label>
                    <textarea name="header320code" class="form-control" rows="8"><?php echo ad_header320_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="header320status" class="form-control"> 
                        <option value="2" <?php if(ad_header320_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(ad_header320_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="header320message"></div>
                    <input type="hidden" name="btn_action" value="header320">
                    <button type="submit"  class="btn btn-sm btn-danger buttonheader320"><i class="bi bi-gear text-white"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Right Sidebar Desktop Ad - 300 x 600 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="sidebar600left">
        <div class="card newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Left Sidebar Desktop Ad - 300 x 600 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad 300 x 600 Pixel Javascript Code*</label>
                    <textarea name="sidebar600leftcode" class="form-control" rows="8"><?php echo ad_sidebar600left_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="sidebar600leftstatus" class="form-control"> 
                        <option value="2" <?php if(ad_sidebar600left_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(ad_sidebar600left_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="sidebar600leftmessage"></div>
                    <input type="hidden" name="btn_action" value="sidebarleft600">
                    <button type="submit"  class="btn btn-sm btn-danger buttonsidebar600left"><i class="bi bi-gear text-white"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Right Sidebar Desktop Ad - 300 x 600 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="sidebar600">
        <div class="card newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Right Sidebar Desktop Ad - 300 x 600 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad 300 x 600 Pixel Javascript Code*</label>
                    <textarea name="sidebar600code" class="form-control" rows="8"><?php echo ad_sidebar600_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="sidebar600status" class="form-control"> 
                        <option value="2" <?php if(ad_sidebar600_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(ad_sidebar600_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="sidebar600message"></div>
                    <input type="hidden" name="btn_action" value="sidebar600">
                    <button type="submit"  class="btn btn-sm btn-danger buttonsidebar600"><i class="bi bi-gear text-white"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include("footer.php") ; ?>
