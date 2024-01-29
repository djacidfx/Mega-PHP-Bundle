<?php include("header.php") ; ?>

<div class="col-lg-12 mt-3 customBottomBorder">
    <h1 class="text-white text-start"> <i class="bi bi-bell-fill text-warning "></i> Notifications & Shortcuts</h1>
</div>
<div class="col-lg-3 mt-3 ">
    <a href="<?php echo ADMIN_URL ; ?>totalpost" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Total Secret / Confessions">
        <div class="card bg-dark text-white newShadow btn-grey">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-signpost-2-fill text-primary veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_posts($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Total Secret / Confession
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="col-lg-3 mt-3 ">
    <a href="<?php echo ADMIN_URL ; ?>postunseen" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Unseen Secret / Confessions">
        <div class="card bg-dark text-white newShadow btn-grey">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-eye-slash text-danger veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_unseenposts($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Total Unseen Secret / Confession
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-lg-3 mt-3 ">
    <a href="<?php echo ADMIN_URL ; ?>postseen" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Seen Secret / Confessions">
        <div class="card bg-dark text-white newShadow btn-grey">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-eye text-info veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_seenposts($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Total Seen Secret / Confession
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-lg-3 mt-3 ">
    <a href="<?php echo ADMIN_URL ; ?>featuredposts" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Featured Secret / Confessions">
        <div class="card bg-dark text-white newShadow btn-grey">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-bookmark-star text-warning veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_featuredposts($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Total Featured Secret / Confession
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-lg-3 mt-3 ">
    <a href="<?php echo ADMIN_URL ; ?>trendingposts" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Trending Secret / Confessions">
        <div class="card bg-dark text-white newShadow btn-grey">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-graph-up text-success veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_trendingposts($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Total Trending Secret / Confession
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-lg-3 mt-3 ">
    <a href="<?php echo ADMIN_URL ; ?>unseencomments" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Unseen Comments">
        <div class="card bg-dark text-white newShadow btn-grey">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-chat-dots text-danger veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_unseencomments($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Total Unseen Comments
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-lg-3 mt-3 ">
    <a href="<?php echo ADMIN_URL ; ?>unseencomments" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Seen Comments">
        <div class="card bg-dark text-white newShadow btn-grey">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-chat-dots text-primary veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_seencomments($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Total Seen Comments
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-lg-3 mt-3 ">
    <a href="<?php echo ADMIN_URL ; ?>blockedusers" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Blocked User IP">
        <div class="card bg-dark text-white newShadow btn-grey">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-slash-circle-fill text-danger veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_blockedip($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Total Blocked User IP
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-lg-12 mt-3 customBottomBorder">
    <h1 class="text-white text-start"> <i class="bi bi-bar-chart-fill text-warning "></i> Analysis </h1>
</div>
<div class="col-lg-4 mt-3 ">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-signpost-2-fill text-success veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_posts($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Lifetime Secrets
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="col-lg-4 mt-3 ">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-calendar-plus text-primary veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_posts_today($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Today Secrets
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="col-lg-4 mt-3 ">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-calendar3 text-warning veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_posts_thismonth($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        This Month Secrets
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="col-lg-4 mt-3 ">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-chat-dots text-success veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_comments($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Lifetime Comments
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="col-lg-4 mt-3 ">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-calendar-plus text-primary veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_comments_today($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Today Comments
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="col-lg-4 mt-3 ">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-calendar3 text-warning veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_comments_thismonth($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        This Month Comments
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="col-lg-4 mt-3 ">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-slash-circle-fill text-danger veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_blockedip($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Lifetime Blocked IP
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="col-lg-4 mt-3 ">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-calendar-plus text-primary veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_blockedip_today($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        Today Blocked IP
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="col-lg-4 mt-3 ">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-5 alignCenter">
                        <i class="bi bi-calendar3 text-warning veryBigFont"></i>
                    </div>
                    <div class="col-lg-7 alignCenter">
                        <h1 class="text-white "><?php echo count_total_blockedip_thismonth($pdo) ; ?></h1>
                    </div>
                    <div class="col-lg-12 alignCenter customTopBorder text-muted p-2 pe-0 ps-0">
                        This Month Blocked IP
                    </div>
                </div>
            </div>
        </div>
</div>
<?php include("footer.php") ; ?>
                    
                