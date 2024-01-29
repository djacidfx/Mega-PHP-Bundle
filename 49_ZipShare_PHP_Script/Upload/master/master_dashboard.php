<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
check_admin_logged_in($pdo);
?>
<div class="row p-0">
    <div class="col-lg-12">
        <div class="col-lg-12 ">
            <h1 class="text-muted text-center"> <i class="bi bi-bell-fill text-warning"></i> <?php echo userlang('notifications') ; ?></h1>
        </div>
        <div class="row p-0 text-center justify-content-center">
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>allzip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_zip_files') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-file-earmark-zip text-primary veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_zipfile($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_zip_files') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>active_zip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_active_zip_files') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-cloud-check text-success veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_activezipfile($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_active_zip_files') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>pending_zip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_pending_zip_files') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-cloud-slash text-danger veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_pendingzipfile($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_pending_zip_files') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
        <div class="row p-0 text-center justify-content-center">
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>featured" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('featured') ; ?> <?php echo userlang('zip_files') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-bookmark-star text-warning veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_featuredzipfile($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('featured') ; ?> <?php echo userlang('zip_files') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>popular" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('popular') ; ?> <?php echo userlang('zip_files') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-file-earmark-bar-graph text-info veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_popularzipfile($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('popular') ; ?> <?php echo userlang('zip_files') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>blocked" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_banned_ip') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-slash-circle text-danger veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_blockedip($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_banned_ip') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row p-0 text-center justify-content-center">
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>category" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_category') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-diagram-3-fill text-primary veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_category($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_category') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>category_active" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_active_category') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-check2-circle text-success veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_activecategory($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_active_category') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>category_deactive" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_disable_category') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-x-circle text-danger veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_disabledcategory($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_disable_category') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row p-0 text-center justify-content-center">
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>createblog" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('create_blog') ; ?> ">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-12 alignCenter">
                                    <i class="bi bi-rss text-primary veryBigFont"></i>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('create_blog') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>active_blog" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_active_blog') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-clipboard-check text-success veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_activeblogs($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_active_blog') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>deactive_blog" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_disable_blog') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-clipboard-x text-danger veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_deactiveblogs($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_disable_blog') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row p-0 text-center justify-content-center">
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>page_create" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('create_page') ; ?> ">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-12 alignCenter">
                                    <i class="bi bi-journal-bookmark text-primary veryBigFont"></i>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('create_page') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>active_blog" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_active_page') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-journal-check text-success veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_activepages($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_active_page') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>deactive_blog" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_disable_page') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-journal-x text-danger veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_deactivepages($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_disable_page') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
            
    </div>
</div>
<?php
include("js.php") ;
?>