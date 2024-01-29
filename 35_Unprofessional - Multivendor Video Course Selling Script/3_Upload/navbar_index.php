<?php
checking_user_is_blocked($pdo) ;
$curMonth = date("m") ;
$curYear = date("Y") ;
if(!empty($_SESSION['unprofessional'])){
    $badgeUsername = username_by_id($pdo,$_SESSION['unprofessional']['id']) ;
    $soldCount = user_solditems_by_username($pdo,$badgeUsername) ;
    $startBadge = "";
    $percentage = "";
    $authorSoldAmt = count_author_sold_amount($pdo,$_SESSION['unprofessional']['id']) ;
    $isAuthor = check_user_is_author($pdo,$_SESSION['unprofessional']['id']) ;
    
    $level_one = get_author_level_requirement($pdo,1) ;
    $level_two = get_author_level_requirement($pdo,2) ;
    $level_three = get_author_level_requirement($pdo,3) ;
    $level_four = get_author_level_requirement($pdo,4) ;
    $level_five = get_author_level_requirement($pdo,5) ;
    $level_six = get_author_level_requirement($pdo,6) ;
    $level_seven = get_author_level_requirement($pdo,7) ;
    $level_eight = get_author_level_requirement($pdo,8) ;
    $level_nine = get_author_level_requirement($pdo,9) ;
    $level_ten = get_author_level_requirement($pdo,10) ;
    $level_eleven = get_author_level_requirement($pdo,11) ;
    $level_twelve = get_author_level_requirement($pdo,12) ;
    $level_thirteen = get_author_level_requirement($pdo,13) ;
    $level_fourteen = get_author_level_requirement($pdo,14) ;
    $level_fifteen = get_author_level_requirement($pdo,15) ;
    $level_sixteen = get_author_level_requirement($pdo,16) ;
}
if($soldCount != '0'){
    
    if($authorSoldAmt >= $level_one && $authorSoldAmt < $level_two){
        $percentage = (($authorSoldAmt * 100) / $level_two);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_two.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_1.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 1 : Sold More Than $'.$level_one.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_2.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 2 : Sell $'.$level_two.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_two && $authorSoldAmt < $level_three){
        $percentage = (($authorSoldAmt * 100) / $level_three);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_three.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_2.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 2 : Sold More Than $'.$level_two.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_3.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 3 : Sell $'.$level_three.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_three && $authorSoldAmt < $level_four){
        $percentage = (($authorSoldAmt * 100) / $level_four);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_four.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_3.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 3 : Sold More Than $'.$level_three.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_4.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 4 : Sell $'.$level_four.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_four && $authorSoldAmt < $level_five){
        $percentage = (($authorSoldAmt * 100) / $level_five);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_five.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_4.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 4 : Sold More Than $'.$level_four.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_5.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 5 : Sell $'.$level_five.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_five && $authorSoldAmt < $level_six){
        $percentage = (($authorSoldAmt * 100) / $level_six);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_six.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_5.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 5 : Sold More Than $'.$level_five.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_6.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 6 : Sell $'.$level_six.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_six && $authorSoldAmt < $level_seven){
        $percentage = (($authorSoldAmt * 100) / $level_seven);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_seven.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_6.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 6 : Sold More Than $'.$level_six.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_7.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 7 : Sell $'.$level_seven.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_seven && $authorSoldAmt < $level_eight){
        $percentage = (($authorSoldAmt * 100) / $level_eight);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_eight.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_7.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 7 : Sold More Than $'.$level_seven.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_8.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 8 : Sell $'.$level_eight.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_eight && $authorSoldAmt < $level_nine){
        $percentage = (($authorSoldAmt * 100) / $level_nine);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_sixteen.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_8.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 8 : Sold More Than $'.$level_eight.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_9.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 9 : Sell $'.$level_nine.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_nine && $authorSoldAmt < $level_ten){
        $percentage = (($authorSoldAmt * 100) / $level_ten);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_ten.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_9.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 9 : Sold More Than $'.$level_nine.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_10.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 10 : Sell $'.$level_ten.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_ten && $authorSoldAmt < $level_eleven){
        $percentage = (($authorSoldAmt * 100) / $level_eleven);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_sixteen.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_10.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 10 : Sold More Than $'.$level_ten.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_11.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 11 : Sell $'.$level_eleven.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_eleven && $authorSoldAmt < $level_twelve){
        $percentage = (($authorSoldAmt * 100) / $level_twelve);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_twelve.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_11.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 11 : Sold More Than $'.$level_eleven.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_12.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 12 : Sell $'.$level_twelve.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_twelve && $authorSoldAmt < $level_thirteen){
        $percentage = (($authorSoldAmt * 100) / $level_thirteen);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_thirteen.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_12.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 12 : Sold More Than $'.$level_twelve.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_13.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 13 : Sell $'.$level_thirteen.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_thirteen && $authorSoldAmt < $level_fourteen){
        $percentage = (($authorSoldAmt * 100) / $level_fourteen);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_fourteen.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_13.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 13 : Sold More Than $'.$level_thirteen.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_14.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 14 : Sell $'.$level_fourteen.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_fourteen && $authorSoldAmt < $level_fifteen){
        $percentage = (($authorSoldAmt * 100) / $level_fifteen);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_fifteen.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_14.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 14 : Sold More Than $'.$level_fourteen.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_15.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 15 : Sell $'.$level_fifteen.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_fifteen && $authorSoldAmt < $level_sixteen){
        $percentage = (($authorSoldAmt * 100) / $level_sixteen);
        $percentage = round($percentage,2) ;
        $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_sixteen.'</p>
                       <div class="progress">
                        <div class="progress-bar" style="width:'.$percentage.'%"></div>
                       </div>
                        <img src="'.BASE_URL.'/badges/author_level_15.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Author Level 15 : Sold More Than $'.$level_fifteen.' worth of Items">
                        <img src="'.BASE_URL.'/badges/author_level_16.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 16 : Sell $'.$level_sixteen.' worth of Items">
                      ';
    }
    if($authorSoldAmt >= $level_sixteen){
        $startBadge = '<p class="text-center mb-1">You Nailed It.</p>
                        <div class="text-center">
                        <img src="'.BASE_URL.'/badges/power_elite_badge.png" class="img-fluid badgeImgUsername " data-toggle="tooltip" data-placement="top" title="Power Elite Author">&ensp;
                        <img src="'.BASE_URL.'/badges/elite_badge.png" class="img-fluid badgeImgUsername " data-toggle="tooltip" data-placement="top" title="Power Elite Author">&ensp;
                        <img src="'.BASE_URL.'/badges/author_level_16.png" class="img-fluid badgeImgUsername " data-toggle="tooltip" data-placement="top" title="Author Level 16 : Sold More Than $'.$level_sixteen.' worth of Items">
                        </div>
                      ';
    }
    
} else {
    if($authorSoldAmt == '0'){
        if($isAuthor == '0'){
            $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_one.'</p>
                           <div class="progress">
                            <div class="progress-bar" style="width:0%"></div>
                           </div>
                            <img src="'.BASE_URL.'/badges/author_badge.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Become Author : Approve at least 1 Video">
                            <img src="'.BASE_URL.'/badges/author_level_1.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 1 : Sell $'.$level_one.' worth of Items">
                          ';
        } else {
            $startBadge = '<p class="text-center mb-0">$'.$authorSoldAmt.' / $'.$level_one.'</p>
                           <div class="progress">
                            <div class="progress-bar" style="width:0%"></div>
                           </div>
                            <img src="'.BASE_URL.'/badges/author_badge.png" class="img-fluid badgeImgUsername" data-toggle="tooltip" data-placement="top" title="Verified Author">
                            <img src="'.BASE_URL.'/badges/author_level_1.png" class="img-fluid badgeImgUsername float-right" data-toggle="tooltip" data-placement="top" title="Achieve Author Level 1 : Sell $'.$level_one.' worth of Items">
                          ';
        }
    }
}
?>
<nav class="navbar navbar-expand-lg main-navbar">
        <?php include("search_design.php") ; ?>
        <ul class="navbar-nav navbar-right">
          <?php if(!empty($_SESSION['unprofessional'])){ ?>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="getMyNotifications nav-link notification-toggle nav-link-lg <?php if(count_unseen_notifications($pdo) > 0) { ?>beep<?php } ?>"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#" class="readAll">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons showNotifications">
                <div id="loader-icon" class="text-center"><img src="<?php echo BASE_URL.'img/loader.gif' ; ?>" class="img-fluid img-loader" /></div>
              </div>
              <div class="dropdown-footer text-center">
                <a href="<?php echo BASE_URL ; ?>notifications">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
        <?php } ?>
            <?php if(!empty($_SESSION['unprofessional'])){ ?>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo BASE_URL.get_user_profilepic_name_url($pdo) ; ?>" class="rounded-circle mr-1 img-fluid pH"></a>
            <div class="dropdown-menu dropdown-menu-right">
            
              <div class="dropdown-title text-center"><?php echo user_fullname($pdo) ;  ?></div> 
                <hr>
                
                    <div class="dropdown-title p-2 mt-n2"><?php echo $startBadge ; ?></div>
                <div class="row mt-n2">
                    <div class="col-lg-12">
                        <div class="dropdown-title mb-0 text-center">
                            <div class="text-muted"><small>Earning</small></div>
                            <div><b class="bigFont">$<?php echo  grab_author_unpaid_earning($pdo,$_SESSION['unprofessional']['id'])  ; ?></b></div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-n3">
                        <div class="dropdown-title mb-0 text-center">
                            <div class="text-muted"><small>Wallet</small></div>
                            <div><b class="bigFont">$<?php echo  find_userwallet_amt($pdo,$_SESSION['unprofessional']['id'])  ; ?></b></div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <a href="<?php echo BASE_URL ; ?>wallet" class="btn btn-sm btn-success ">+ Add Credit</a>
                    </div>
                </div>
                    
                    <hr>
                
              
              <a href="<?php echo BASE_URL ; ?>user/<?php echo username_by_id($pdo,$_SESSION['unprofessional']['id']); ?>" class="dropdown-item has-icon">
                <i class="fas fa-user"></i> Profile
              </a>
              <a href="<?php echo BASE_URL ; ?>editprofile" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Edit Profile
              </a>
              <a href="<?php echo BASE_URL ; ?>downloads" class="dropdown-item has-icon">
                <i class="fas fa-download"></i> Downloads
              </a>
            <a href="<?php echo BASE_URL ; ?>purchases" class="dropdown-item has-icon">
                <i class="fas fa-cart-arrow-down"></i> Purchases
              </a>
            <a href="<?php echo BASE_URL ; ?>payouts" class="dropdown-item has-icon">
                <i class="fas fa-credit-card mr-2"></i> Earning & Payouts
              </a>
             <a href="<?php echo BASE_URL ; ?>statement/<?php echo $curMonth ; ?>/<?php echo $curYear ; ?>" class="dropdown-item has-icon">
                <i class="fas fa-chart-area"></i> Statement
              </a>
              <a href="<?php echo BASE_URL ; ?>settings" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Email & Settings
              </a>
            
              <div class="dropdown-divider"></div>
              <a href="<?php echo BASE_URL."logout" ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            
            </div>
          </li>
            <?php } else { ?>
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo BASE_URL ; ?>img/profile.png" class="rounded-circle mr-1"></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?php echo BASE_URL ; ?>login" class="dropdown-item has-icon">
                <i class="fas fa-sign-in-alt"></i> Login
              </a>
              <a href="<?php echo BASE_URL ; ?>signup" class="dropdown-item has-icon">
                <i class="fas fa-users"></i> SignUp
              </a>
              <a href="<?php echo BASE_URL ; ?>recoverpassword" class="dropdown-item has-icon">
                <i class="fas fa-key"></i> Recover Password
              </a>
                </div>
            </li>
                <?php } ?>
        </ul>
      </nav>