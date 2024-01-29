<header class="header fixed-top">
        <nav class="navbar navbar-expand-lg " style="background:#343a40 !important">
            <div class="search-box">
                <button class="dismiss"><i class="icon-close"></i></button>
                <form id="searchForm" action="<?php echo BASE_URL.'usersearch.php' ; ?>" method="post" role="search" class="bg-dark">
                    <input type="search" placeholder="Search Anonymous Post" class="form-control bg-dark text-white" name="search_keyword">
                </form>
            </div>
            <div class="container-fluid ">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header">
                        <a href="<?php echo BASE_URL ; ?>" class="navbar-brand">
                            <div class="brand-text brand-big hidden-lg-down"><img src="<?php echo BASE_URL ; ?>img/logo.png" alt="Logo" class="img-fluid"></div>
                            <div class="brand-text brand-small ml-1"><img src="<?php echo BASE_URL ; ?>img/logo.png" alt="Logo" class="img-fluid"></div>
                        </a>
                    </div>
                </div>
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <!-- Search-->
                    <li class="nav-item d-flex align-items-center"><a id="search" class="nav-link" href="#"><i class="icon-search"></i></a></li>
                    <li class="nav-item d-flex align-items-center"><button class="nav-link btn btn-md btn-warning subscribe text-primary">Post <i class="fa fa-user-secret"></i></button></li>
                    <li class="nav-item d-flex align-items-center"><a id="menu-toggle-right" class="nav-link" href="#"><i class="fa fa-bars"></i></a></li>
                    <nav id="sidebar-wrapper" class="bg-dark post-shadow">
                      <div class="sidebar-nav bg-dark"> 
                        <div class="tab" role="tabpanel"> 
                            <ul class="nav nav-tabs bg-dark" role="tablist">
                              <li class="nav-item w-100 bg-dark">
                                <a class="nav-link active bg-dark border border-top-0 border-left-0 border-right-0 text-white text-left p-2" href="<?php echo BASE_URL ; ?>featured" ><i class="fa fa-bookmark-o"></i> &ensp;Featured Posts</a>
                              
                                <a class="nav-link active bg-dark border border-top-0 border-left-0 border-right-0 text-white text-left p-2" href="<?php echo BASE_URL ; ?>trending" ><i class="fa fa-line-chart"></i> Trending Posts</a>
                                  
                                <a class="nav-link active bg-dark border border-top-0 border-left-0 border-right-0 text-white text-left p-2" href="<?php echo BASE_URL ; ?>popular" ><i class="fa fa-fire"></i>&ensp; Popular Posts</a>
                              </li>
                            </ul> 
                            <!--<div class="tab-content tabs">
                              <div role="tabpanel" class="tab-pane fade show active" id="live">
                                <div class="content newsf-list">
                                    <ul class="list-unstyled">
                                        <?php echo get_trending_post($pdo) ; ?>
										
                                    </ul>
                                </div>
                              </div>
                              
                           </div>-->
                      </div>
                    </nav>
                </ul> 
            </div>
        </nav>
		
    </header>
