<form class="form-inline mr-auto" action="<?php echo BASE_URL.'searched_item' ; ?>" method="post">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" name="search_keyword" type="search" placeholder="Search Course or User" aria-label="Search" data-width="250" maxlength="50" <?php if(!empty($_GET['search_keyword'])){ ?> value="<?php echo $search ; ?>" <?php } ?> required >
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
                <?php echo featured_item_on_searchpage($pdo) ; ?>
                <?php echo trending_item_on_searchpage($pdo) ; ?>
            </div>
          </div>
        </form>