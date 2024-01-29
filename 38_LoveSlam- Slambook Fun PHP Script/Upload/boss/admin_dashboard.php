<?php 
include("header.php") ;
?>
<div class="col-lg-12 mt-1">
    <div class="card shadow-lg">
        <div class="card-header">
            <h1 class="text-muted text-start"> <i class="bi bi-bar-chart-fill text-danger "></i> Analysis </h1>
        </div>
    </div>
</div>
<div class="col-lg-4 mt-3 ">
    <div class="card bg-danger text-white newShadow">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-5 alignCenter">
                    <i class="bi bi-suit-heart-fill text-warning veryBigFont"></i>
                </div>
                <div class="col-lg-7 alignCenter">
                    <h1 class="text-white "><?php echo total_slams($pdo) ; ?></h1>
                </div>
                <div class="col-lg-12 alignCenter customTopBorder text-warning p-2 pe-0 ps-0">
                    Lifetime Slams
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 mt-3 ">
    <div class="card bg-danger text-white newShadow">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-5 alignCenter">
                    <i class="bi bi-suit-heart-fill text-warning veryBigFont"></i>
                </div>
                <div class="col-lg-7 alignCenter">
                    <h1 class="text-white "><?php echo count_total_slams_today($pdo) ; ?></h1>
                </div>
                <div class="col-lg-12 alignCenter customTopBorder text-warning p-2 pe-0 ps-0">
                    Today Slams
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 mt-3 ">
    <div class="card bg-danger text-white newShadow">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-5 alignCenter">
                    <i class="bi bi-suit-heart-fill text-warning veryBigFont"></i>
                </div>
                <div class="col-lg-7 alignCenter">
                    <h1 class="text-white "><?php echo count_total_slams_thismonth($pdo) ; ?></h1>
                </div>
                <div class="col-lg-12 alignCenter customTopBorder text-warning p-2 pe-0 ps-0">
                    This Month Slams
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 mt-3 ">
    <div class="card bg-danger text-white newShadow">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-5 alignCenter">
                    <i class="bi bi-chat-text-fill text-warning veryBigFont"></i>
                </div>
                <div class="col-lg-7 alignCenter">
                    <h1 class="text-white "><?php echo total_slams_answers($pdo) ; ?></h1>
                </div>
                <div class="col-lg-12 alignCenter customTopBorder text-warning p-2 pe-0 ps-0">
                    Lifetime Slams Answers
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 mt-3 ">
    <div class="card bg-danger text-white newShadow">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-5 alignCenter">
                    <i class="bi bi-chat-text-fill text-warning veryBigFont"></i>
                </div>
                <div class="col-lg-7 alignCenter">
                    <h1 class="text-white "><?php echo count_total_slamsanswers_today($pdo) ; ?></h1>
                </div>
                <div class="col-lg-12 alignCenter customTopBorder text-warning p-2 pe-0 ps-0">
                    Today Slams Answers
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 mt-3 ">
    <div class="card bg-danger text-white newShadow">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-5 alignCenter">
                    <i class="bi bi-chat-text-fill text-warning veryBigFont"></i>
                </div>
                <div class="col-lg-7 alignCenter">
                    <h1 class="text-white "><?php echo count_total_slamsanswers_thismonth($pdo) ; ?></h1>
                </div>
                <div class="col-lg-12 alignCenter customTopBorder text-warning p-2 pe-0 ps-0">
                    This Month Slams Answers
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include("footer.php") ;
?>