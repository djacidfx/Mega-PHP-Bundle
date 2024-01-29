<header class="header fixed-top">
        <nav class="navbar navbar-expand-lg " style="background:#343a40 !important">
            
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
                    
                    <li class="nav-item d-flex align-items-center"><a id="menu-toggle-right" class="nav-link" href="#"><i class="fa fa-bars"></i></a></li>
                    <nav id="sidebar-wrapper" class="bg-dark post-shadow">
                      <div class="sidebar-nav bg-dark"> 
                        <div class="tab" role="tabpanel"> 
                            <ul class="nav nav-tabs bg-dark" role="tablist">
                              <li class="nav-item bg-dark">
                                <a class="nav-link active bg-dark border border-top-0 border-left-0 border-right-0 text-white" href="#live" role="tab" data-toggle="tab"><i class="fa fa-line-chart"></i> Top Points</a>
                              </li>
							  <li class="nav-item bg-dark">
                                <a class="nav-link bg-dark border border-top-0 border-left-0 border-right-0 text-white" href="#trend" role="tab" data-toggle="tab"><i class="fa fa-rocket"></i> Top Winning</a> 
							  </li> 
                            </ul> 
                            <div class="tab-content tabs">
                              <div role="tabpanel" class="tab-pane fade show active" id="live">
                                <div class="content newsf-list">
                                    <ul class="list-unstyled">
                                        <?php echo get_top_points($pdo) ; ?>
										
                                    </ul>
                                </div>
                              </div>
							  
							  <div role="tabpanel" class="tab-pane fade" id="trend">
							  	<div class="content newsf-list">
                                    <ul class="list-unstyled">
										<?php echo get_top_winner($pdo) ; ?>
									</ul>
							  </div>
                              
                           </div>
                      </div>
                    </nav>
                </ul> 
            </div>
        </nav>
		
    </header>
