<header class="header fixed-top">
        <nav class="navbar navbar-expand-lg " style="background:<?php echo $headerColor ; ?> ;">
            <div class="search-box">
                <button class="dismiss"><i class="icon-close"></i></button>
                <form id="searchForm" action="<?php echo BASE_URL.'usersearch.php' ; ?>" method="post" role="search">
                    <input type="search" placeholder="e.g. Pitbull, Hip Hop Music ..." class="form-control" name="search_keyword">
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
                    
                    <li class="nav-item d-flex align-items-center"><a id="menu-toggle-right" class="nav-link" href="#"><i class="fa fa-bars"></i></a></li>
                    <nav id="sidebar-wrapper">
                      <div class="sidebar-nav"> 
                        <div class="tab" role="tabpanel"> 
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="nav-item w-100">
                                <a class="nav-link active" href="#live" role="tab" data-toggle="tab"><i class="fa fa-music"></i> Artist / Category</a>
                              </li>
                            </ul> 
                            <div class="tab-content tabs">
                              <div role="tabpanel" class="tab-pane fade show active" id="live">
                                <div class="content newsf-list">
                                    <ul class="list-unstyled">
                                        <?php echo get_category_name_and_link($pdo) ; ?>
                                    </ul>
                                </div>
                              </div>
                              
                           </div>
                      </div>
                    </nav>
                </ul> 
            </div>
        </nav>
		<div class="row fixed-top mt-class text-center">
	
		<div class="col-lg-3"></div>
		<div class="col-lg-6 bg-white rounded">
			<div id="infos-song">
			<p id="song-title"></p>
			<span id="song-artist"></span>
			
			<span id="song-album"></span>
		  </div>
		  <div class="audio-duration">
			<div id="time-start" class="time time-start">0:00</div>
			<div id="time-end" class="time time-end">0:00</div>
			<div style="clear: both;"></div>
			<div class="audio-player-progress"><span class="audio-player-progress-bar"></span></div>
		  </div>
	
		  <div style="clear: both;"></div>
		  <div id="audio-control" class="audio-control" style="display:block;">
			<i id="backward" class="gy fa fa-backward fa-fw" aria-hidden="true"></i>
			<i id="playpause" class="gy fa fa-pause fa-fw" aria-hidden="true"></i>
			<i id="forward" class="gy fa fa-forward fa-fw" aria-hidden="true"></i>
			<i id="show-playlist" class="gy fa fa-list fa-fw" aria-hidden="true"></i>
		  </div>
		</div>
		<div class="col-lg-3"></div>
	</div>
    </header>
