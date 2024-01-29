<?php 
include("header.php") ; 
?>
<!-- Header Desktop Ad - 970 x 90 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="header970">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Desktop Header Ad - 970 x 90 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/1_970_90.png" class="img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad 970 x 90 Pixel Javascript Code*</label>
                    <textarea name="header970code" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_header970_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="header970status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(ad_header970_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(ad_header970_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="header970message"></div>
                    <input type="hidden" name="btn_action" value="header970">
                    <button type="submit"  class="btn btn-sm btn-grey buttonheader970"><i class="bi bi-gear text-primary"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Header Mobile Ad - 320 x 100 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="header320">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-phone text-warning"></i> Mobile Header Ad - 320 x 100 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/2_320_100.png" class="img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad 320 x 100 Pixel Javascript Code*</label>
                    <textarea name="header320code" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_header320_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="header320status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(ad_header320_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(ad_header320_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="header320message"></div>
                    <input type="hidden" name="btn_action" value="header320">
                    <button type="submit"  class="btn btn-sm btn-grey buttonheader320"><i class="bi bi-gear text-primary"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Desktop Ad after Featured Item - 300 x 50 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="desktopfeatured300">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Desktop Ad after Featured Item - 300 x 50 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/3_300_50.png" class="img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad - 1, 300 x 50 Pixel Javascript Code*</label>
                    <textarea name="desktopfeatured300_one" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_featuredone300_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad - 2, 300 x 50 Pixel Javascript Code*</label>
                    <textarea name="desktopfeatured300_two" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_featuredtwo300_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="desktopfeatured300status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(desktopfeatured300_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(desktopfeatured300_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="desktopfeatured300message"></div>
                    <input type="hidden" name="btn_action" value="btndesktopfeatured300">
                    <button type="submit"  class="btn btn-sm btn-grey buttondesktopfeatured300"><i class="bi bi-gear text-primary"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Desktop Ad after Trending Item - 300 x 50 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="desktoptrending300">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Desktop Ad after Trending Item - 300 x 50 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/4_300_50.png" class="img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad - 1, 300 x 50 Pixel Javascript Code*</label>
                    <textarea name="desktoptrending300_one" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_trendingone300_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad - 2, 300 x 50 Pixel Javascript Code*</label>
                    <textarea name="desktoptrending300_two" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_trendingtwo300_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="desktoptrending300status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(desktoptrending300_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(desktoptrending300_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="desktoptrending300message"></div>
                    <input type="hidden" name="btn_action" value="btndesktoptrending300">
                    <button type="submit"  class="btn btn-sm btn-grey buttondesktoptrending300"><i class="bi bi-gear text-primary"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Mobile Ad after Featured Item - 300 x 50 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="mobilefeatured300">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-phone text-warning"></i> Mobile Ad after Featured Item - 300 x 50 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/5_300_50.png" class="img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad, 300 x 50 Pixel Javascript Code*</label>
                    <textarea name="mobilefeatured300_one" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_featuredmobileone300_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="mobilefeatured300status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(mobilefeatured300_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(mobilefeatured300_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="mobilefeatured300message"></div>
                    <input type="hidden" name="btn_action" value="btnmobilefeatured300">
                    <button type="submit"  class="btn btn-sm btn-grey buttonmobilefeatured300"><i class="bi bi-gear text-primary"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Mobile Ad after Trending Item - 300 x 50 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="mobiletrending300">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-phone text-warning"></i> Mobile Ad after Trending Item - 300 x 50 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/6_300_50.png" class="img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad, 300 x 50 Pixel Javascript Code*</label>
                    <textarea name="mobiletrending300_one" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_trendingmobileone300_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="mobiletrending300status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(mobiletrending300_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(mobiletrending300_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="mobiletrending300message"></div>
                    <input type="hidden" name="btn_action" value="btnmobiletrending300">
                    <button type="submit"  class="btn btn-sm btn-grey buttonmobiletrending300"><i class="bi bi-gear text-primary"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Right Sidebar Desktop Ad - 300 x 600 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="sidebar600">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Right Sidebar Desktop Ad - 300 x 600 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/7_300_600.png" class="img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad 300 x 600 Pixel Javascript Code*</label>
                    <textarea name="sidebar600code" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_sidebar600_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="sidebar600status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(ad_sidebar600_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(ad_sidebar600_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="sidebar600message"></div>
                    <input type="hidden" name="btn_action" value="sidebar600">
                    <button type="submit"  class="btn btn-sm btn-grey buttonsidebar600"><i class="bi bi-gear text-primary"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Replace Right Sidebar Mobile Ad - 320 x 100 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="sidebar300">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-phone text-warning"></i> Replace Right Sidebar Mobile Ad - 320 x 100 Pixel</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/8_320_100.png" class="img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad 320 x 100 Pixel Javascript Code*</label>
                    <textarea name="sidebar300code" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_sidebar300_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="sidebar300status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(ad_sidebar300_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(ad_sidebar300_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="sidebar300message"></div>
                    <input type="hidden" name="btn_action" value="sidebar300">
                    <button type="submit"  class="btn btn-sm btn-grey buttonsidebar300"><i class="bi bi-gear text-primary"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Common Right Sidebar Ad After Featured - 300 x 50 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="commonfeatured300">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-phone text-warning"></i> Common Desktop & Mobile Ad - 300 x 50 Pixel [After Featured]</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/9_300_50.png" class="img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad 300 x 50 Pixel Javascript Code*</label>
                    <textarea name="commonfeatured300code" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_commonfeatured300_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="commonfeatured300status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(ad_commonfeatured300_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(ad_commonfeatured300_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="commonfeatured300message"></div>
                    <input type="hidden" name="btn_action" value="commonfeatured300">
                    <button type="submit"  class="btn btn-sm btn-grey buttoncommonfeatured300"><i class="bi bi-gear text-primary"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Common Right Sidebar Ad After Trending - 300 x 50 Pixel -->
<div class="col-lg-6 mt-2">
    <form method="post" class="commontrending300">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-phone text-warning"></i> Common Desktop & Mobile Ad - 300 x 50 Pixel [After Trending]</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/10_300_50.png" class="img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">Paste Google Ad 300 x 50 Pixel Javascript Code*</label>
                    <textarea name="commontrending300code" class="form-control bg-dark text-white customBorder" rows="8"><?php echo ad_commontrending300_js_code($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2">
                    <select name="commontrending300status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(ad_commontrending300_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(ad_commontrending300_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="commontrending300message"></div>
                    <input type="hidden" name="btn_action" value="commontrending300">
                    <button type="submit"  class="btn btn-sm btn-grey buttoncommontrending300"><i class="bi bi-gear text-primary"></i> Save Ad Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include("footer.php") ; ?>