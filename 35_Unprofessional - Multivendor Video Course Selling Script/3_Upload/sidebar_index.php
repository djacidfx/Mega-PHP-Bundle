<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand text-left">
            <a href="<?php echo BASE_URL ; ?>"><img src="<?php echo BASE_URL ; ?>/img/siteLogoS.png" alt="logo"  class=" img-fluid"></a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo BASE_URL ; ?>"><img src="<?php echo BASE_URL ; ?>/img/siteLogoVS.png" alt="logo"  class=" img-fluid"></a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item dropdown <?php echo $dashboard ; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-laptop"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $home ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>">Home</a></li>
                  <li class="<?php echo $upload ; ?>"><?php if(!empty($_SESSION['unprofessional'])){ ?><a class="nav-link" href="<?php echo BASE_URL."upload" ?>">Upload Video</a><?php } else { ?><a class="nav-link" href="<?php echo BASE_URL."login" ?>">Upload Video</a> <?php } ?></li>
                  <li class="<?php echo $badges ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>badgesinfo">Badges</a></li>
                  <?php if(!empty($_SESSION['unprofessional'])){ ?>
                  <li class="<?php echo $activeItem ; ?>"><a class="nav-link" href="<?php echo BASE_URL."activeitems" ; ?>">Active Items </a></li>
                  <li class="<?php echo $pausedItem ; ?>"><a class="nav-link" href="<?php echo BASE_URL."pauseditems" ; ?>">Paused Items <?php echo count_paused_item($pdo) ; ?></a></li>
                  <li class="<?php echo $deletedItem ; ?>"><a class="nav-link" href="<?php echo BASE_URL."deleteditems" ; ?>">Deleted Items </a></li>
                    <li class="<?php echo $updateStatus ; ?>"><a class="nav-link" href="<?php echo BASE_URL."itemupdatestaus" ; ?>">Pending Updates <?php echo count_pending_updates($pdo) ; ?></a></li>
                  <li class="<?php echo $review ; ?>"><a class="nav-link" href="<?php echo BASE_URL."inreview" ; ?>">Review <?php echo count_review($pdo) ; ?></a></li>
                 <li class="<?php echo $softReject ; ?>"><a class="nav-link" href="<?php echo BASE_URL."softrejects" ; ?>">Soft Rejects <?php echo count_soft_reject_item($pdo) ; ?></a></li>
                  <li class="<?php echo $hardReject ; ?>"><a class="nav-link" href="<?php echo BASE_URL."hardrejects" ; ?>">Hard Rejects</a></li>
                 <li class="<?php echo $pending ; ?>"><a class="nav-link" href="<?php echo BASE_URL."pending" ; ?>">Pending Items<?php echo count_pending_item($pdo) ; ?></a></li>
                    <li class="<?php echo $refundRequest ; ?>"><a class="nav-link" href="<?php echo BASE_URL."refunds" ; ?>">Pending Refunds<?php echo count_pending_refunds($pdo) ; ?></a></li>
                  <?php } ?>
                </ul>
              </li>
              <li class="menu-header">Recommendation</li>
              <li class="<?php echo $new ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>new"><i class="fa fa-video"></i> <span>New </span></a></li>
              <li class="<?php echo $featured ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>featured"><i class="fa fa-star"></i> <span>Featured</span></a></li>
              <li class="<?php echo $trending ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>trending"><i class="fa fa-chart-line"></i> <span>Trending</span></a></li>
              <li class="<?php echo $bestseller ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>bestsellers"><i class="fa fa-dollar-sign "></i> <span>Best Sellers</span></a></li>
              <li class="menu-header">Sort By</li>
              <li class="nav-item dropdown <?php echo $sortby ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-chart-bar"></i> <span>Price</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $lowtohigh ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>lowtohigh">Low to High</a></li>
                  <li class="<?php echo $hightolow ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>hightolow">High to Low</a></li>
                </ul>
              </li>
              
              <li class="nav-item dropdown <?php echo $ratingby ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-star-half-alt"></i> <span>Ratings</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $abovefourfive ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>toprated">Above 4.5 Star</a></li>
                  <li class="<?php echo $abovefourstar ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>abovefourstar">Above 4 Star</a></li>
                  <li class="<?php echo $abovethreestar ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>abovethreestar">Above 3 Star</a></li>
                  <li class="<?php echo $abovetwostar ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>abovetwostar">Above 2 Star</a></li>
                  <li class="<?php echo $aboveonestar ; ?>"><a class="nav-link" href="<?php echo BASE_URL ; ?>aboveonestar">Above 1 Star</a></li>
                </ul>
              </li>
              
              <li class="nav-item dropdown <?php echo $categoryby ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Category</span></a>
                <ul class="dropdown-menu">
                    <?php echo active_category_list_for_sidebar($pdo) ; ?>
                </ul>
              </li>
              
              
              
            </ul>
            <div class="mt-2 mb-4 p-3 hide-sidebar-mini">
              <a href="<?php echo BASE_URL ; ?>forum" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-users"></i> Forum
              </a>
            </div>
        </aside>
      </div>