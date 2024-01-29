<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand text-left">
            <a href="<?php echo ADMIN_URL ; ?>dashboard"><img src="<?php echo BASE_URL ; ?>/img/siteLogoS.png" alt="logo"  class=" img-fluid"></a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo ADMIN_URL ; ?>dashboard"><img src="<?php echo BASE_URL ; ?>/img/siteLogoVS.png" alt="logo"  class=" img-fluid"></a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item dropdown <?php echo $dashboard ; ?>">
                <a href="<?php echo ADMIN_URL ; ?>dashboard" class="nav-link has-dropdown"><i class="fa fa-laptop"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $home ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL ; ?>dashboard">Home</a></li>
                  <li class="<?php echo $createcategory ; ?>"><a class="nav-link " href="<?php echo ADMIN_URL ; ?>category">Create Category</a></li>
                  <li class="<?php echo $viewcategory ; ?>"><a class="nav-link " href="<?php echo ADMIN_URL ; ?>viewcategory">View Category</a></li>
                    <li class="<?php echo $inreview ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."inreview" ; ?>">In Review &ensp;<span class="badge badge-primary w-25 mt-n1"><?php echo count_review_for_admin($pdo) ; ?></span></a></li>
                    <li class="<?php echo $softReject ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."softrejectreview" ; ?>">SR Review &ensp;<span class="badge badge-primary w-25 mt-n1"><?php echo count_soft_reject_review_for_admin($pdo) ; ?></span></a></li>
                    <li class="<?php echo $statusUpdate ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."itemupdates" ; ?>">Item Updates &ensp;<span class="badge badge-primary w-25 mt-n1"><?php echo count_item_updates_for_admin($pdo) ; ?></span></a></li>
                    <li class="<?php echo $pending ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."pendingreview" ; ?>">Pending &ensp;<span class="badge badge-primary w-25 mt-n1"><?php echo count_pending_item_for_admin($pdo) ; ?></span></a></li>
                    <li class="<?php echo $disputes ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."pendingdisputes" ; ?>">Refund Disputes &ensp;<span class="badge badge-primary w-25 mt-n1"><?php echo count_disputes($pdo) ; ?></span></a></li>
                    <li class="<?php echo $solvedDisputes ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."solveddisputes" ; ?>">Solved Disputes </a></li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php echo $settings ; ?>">
                  <a href="<?php echo ADMIN_URL ; ?>settings" class="nav-link has-dropdown"><i class="fa fa-cog"></i><span> Settings</span> </a>
                  <ul class="dropdown-menu">
                    <li class="<?php echo $mainSettings ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL ; ?>mainsetting">Main Setting</a></li>
                    <li class="<?php echo $socialSettings ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL ; ?>socialsetting">Social Setting</a></li>
                    <li class="<?php echo $analyticSettings ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL ; ?>googleanalytics">Google Analytics Setting</a></li>
                  </ul>
              </li>
              <li class="nav-item dropdown <?php echo $hardreject ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-window-close"></i> <span>Hard Reject Settings</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $title_hard_reject ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."titlehardrejects" ; ?>">Title</a></li>
                  <li class="<?php echo $hardrejectsubject  ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."subjecthardrejects" ; ?>">Reasons</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php echo $badges ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-trophy"></i> <span>Badges Settings</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $authorBadges ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."authorbadges" ; ?>">Author Badges</a></li>
                  <li class="<?php echo $followerBadges  ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."followerbadges" ; ?>">Follower Badges</a></li>
                  <li class="<?php echo $communityBadges  ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."communitybadges" ; ?>">Community Badges</a></li>
                  <li class="<?php echo $buyerBadges  ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."buyerbadges" ; ?>">Buyer Badges</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php echo $items ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-video"></i> <span>Items</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $featured ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."makefeatured" ; ?>">Featured</a></li>
                  <li class="<?php echo $activeItems ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."activeitems" ; ?>">Active Items</a></li>
                  <li class="<?php echo $disabledItems ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."disableditems" ; ?>">Disabled Items</a></li>
                  <li class="<?php echo $pausedItems ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."pauseditems" ; ?>">Paused Items</a></li>
                  
                </ul>
              </li>
              <li class="nav-item dropdown <?php echo $forum ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-bullhorn"></i> <span>Forum</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $forumCategory ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."forumcategory" ; ?>">Category</a></li>
                    <li class="<?php echo $topicseen ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."unreadtopic" ; ?>">Unread Topic &ensp;<span class="badge badge-primary w-25 mt-n1"><?php echo count_forumtopic_unseen($pdo) ; ?></span></a></li>
                  <li class="<?php echo $topicread ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."seentopic" ; ?>">Seen Topic</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php echo $reports ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-flag"></i> <span>Reports</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $commentReport ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."commentreport" ; ?>">Comment Report &ensp;<span class="badge badge-primary w-25 mt-n1"><?php echo count_reportedcomment_unseen($pdo); ?></span></a></li>
                    <li class="<?php echo $replyReport ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."replyreport" ; ?>">Reply Report &ensp;<span class="badge badge-primary w-25 mt-n1"><?php echo count_reportedcommentreply_unseen($pdo) ; ?></span></a></li>
                    <li class="<?php echo $ratingReport ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."ratingreport" ; ?>">Rating Report &ensp;<span class="badge badge-primary w-25 mt-n1"><?php echo count_reportedratings_unseen($pdo) ; ?></span></a></li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php echo $users ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-users"></i> <span>Users</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $activeUsers ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."actusers" ; ?>">Active Users</a></li>
                  <li class="<?php echo $blockedUsers ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."blkusers" ; ?>">Blocked Users</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php echo $payments ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-dollar-sign"></i> <span>Payments</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $itemPay ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."itempayments" ; ?>">Item Payments</a></li>
                  <li class="<?php echo $walletPay ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."walletpayments" ; ?>">Wallet Payments</a></li>
                </ul>
              </li>
               <li class="nav-item dropdown <?php echo $payouts ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-dollar-sign"></i> <span>Payouts</span></a>
                <ul class="dropdown-menu">
                  <li class="<?php echo $sendPayout ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."sendpayout" ; ?>">Send Payouts</a></li>
                  <li class="<?php echo $paidPayout ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."paidpayout" ; ?>">Paid Payouts</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown <?php echo $pages ; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-file"></i> <span>Pages</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $createPage ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."createpage" ; ?>">Create Pages</a></li>
                    <li class="<?php echo $managePage ; ?>"><a class="nav-link" href="<?php echo ADMIN_URL."managepage" ; ?>">Manage Pages</a></li>
                </ul>
              </li>
              
              
              
            </ul>

        </aside>
      </div>