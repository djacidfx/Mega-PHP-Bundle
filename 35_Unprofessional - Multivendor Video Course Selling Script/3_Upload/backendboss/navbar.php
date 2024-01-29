<nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo BASE_URL ; ?>img/profile.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, Admin</div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title text-center text-lowercase"><?php echo admin_login_email($pdo) ;  ?></div> 
                <hr>
             <a href="<?php echo BASE_URL ; ?>sitemap.xml" class="dropdown-item has-icon" target="_blank">
                <i class="fas fa-sitemap"></i> Sitemap
              </a>
              <a href="<?php echo ADMIN_URL ; ?>email" class="dropdown-item has-icon">
                <i class="far fa-envelope"></i> Change Email
              </a>
              <a href="<?php echo ADMIN_URL ; ?>password" class="dropdown-item has-icon">
                <i class="fas fa-key"></i> Change Password
              </a>
              <a href="<?php echo ADMIN_URL ; ?>mainsetting" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Main Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo ADMIN_URL ; ?>signout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
    </ul>
</nav>