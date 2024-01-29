<nav class="navbar navbar-expand-lg <?php echo colormode('class_navbar') ; ?> <?php echo colormode('navbarbg_color') ; ?> <?php echo colormode('border_bottom') ; ?> fixed-top">
  <div class="container">
    <a class="navbar-brand" href="<?php echo BASE_URL ; ?>"><img src="<?php echo BASE_URL ; ?>img/logo.png" class="img-fluid logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="row p-0 w-100">
            <div class="col-lg-4 mt-1">
                <form class="d-flex ms-auto w-100 justify-content-end mt-1" method="post" action="<?php echo BASE_URL ; ?>find" enctype="multipart/form-data">
                    <input class="form-control me-1 ms-3 <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?>" name="search_keyword" type="text" autocomplete="off" placeholder="<?php echo userlang('search') ; ?>" <?php if(isset($search)) { ?> value="<?php echo $search ; ?>" <?php } ?>>
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="col-lg-8 mt-2">
                <ul class="navbar-nav ms-md-auto gap-2 justify-content-end">
                    
                    <li class="nav-item rounded">
                        <select class=" custom-select form-select <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?>" onchange="location = this.value;">
                          <?php if(isset($catId)) { ?> 
                            <?php echo show_selectedcategory_options_withlink($pdo,$catId) ; ?>
                            <?php echo show_nonselectedcategory_options_withlink($pdo,$catId) ; ?>
                          <?php } else { ?>
                            <option value="" selected><?php echo userlang('choose_category') ; ?></option>
                            <?php echo show_category_options_withlink($pdo) ; ?>
                          <?php } ?>
                        </select>
                    </li>
                    <li class="nav-item rounded">
                      <a class="nav-link mt-n2 " href="<?php echo BASE_URL ; ?>redirect.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&mode=<?php echo colormode('xmode') ; ?>"><i class="bi bi-lightbulb-fill bigFont <?php echo colormode('default_text') ; ?>"></i></a>
                    </li>
                    <li class="nav-item dropdown rounded">
                      <a class="nav-link dropdown-toggle mt-n2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-translate bigFont <?php echo colormode('default_text') ; ?>"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end <?php echo colormode('dropdown-menu-dark') ; ?> pb-2 scrollable-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'english') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=english">English</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'arabic') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=arabic">Arabic (عربي)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'afrikaans') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=afrikaans">Afrikaans</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'chinesesimplified') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=chinesesimplified">Chinese Simplified (中国人)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'chinesetraditional') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=chinesetraditional">Chinese Traditional (中國人)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'croatian') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=croatian">Croatian (Hrvatski)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'czech') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=czech">Czech (čeština)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'dutch') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=dutch">Dutch</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'french') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=french">French (Français)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'german') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=german">German (Deutsch)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'hindi') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=hindi">Hindi (हिन्दी)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'italian') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=italian">Italian (Italiano)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'japanese') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=japanese">Japanese (日本)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'korean') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=korean">Korean (한국인)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'kazakh') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=kazakh">Kazakh (қазақ)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'nepali') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=nepali">Nepali (नेपाली)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'polish') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=polish">Polish (Polski)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'portuguese') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=portuguese">Portuguese (Português)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'russian') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=russian">Russian (Русский)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'spanish') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=spanish">Spanish (Español)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'swedish') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=swedish">Swedish (svenska)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'thai') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=thai">Thai (สงวนลิขสิทธิ์.)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'turkish') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=turkish">Turkish (Türkçe)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'ukrainian') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=ukrainian">Ukrainian (український)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'urdu') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=urdu">Urdu (اردو)</a></li>
            <li><a class="dropdown-item <?php if($_SESSION['lang'] === 'vietnamese') { ?> active <?php } ?>" href="<?php echo BASE_URL ; ?>changelang.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&lang=vietnamese">Vietnamese (Tiếng Việt)</a></li>
                      </ul>
                    </li>
                    <li class="nav-item rounded">
                        <a class="nav-link text-white btn btn-primary btn-sm" href="<?php echo BASE_URL ; ?>upload" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('upload_zip') ; ?>"><i class="bi bi-cloud-upload text-white me-2"></i><?php echo userlang('upload_zip') ; ?></a>
                    </li>
                    <li class="nav-item rounded">
                      <a class="nav-link text-muted" href="<?php echo BASE_URL ; ?>featured" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('featured') ; ?> <?php echo userlang('zip_files') ; ?>"><i class="bi bi-bookmark-star-fill text-warning me-2"></i><?php echo userlang('featured') ; ?></a>
                    </li>
                    <li class="nav-item rounded">
                      <a class="nav-link text-muted" href="<?php echo BASE_URL ; ?>popular" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('popular') ; ?> <?php echo userlang('zip_files') ; ?>"><i class="bi bi-file-earmark-bar-graph text-danger me-2"></i><?php echo userlang('popular') ; ?></a>
                    </li>
                    <li class="nav-item rounded">
                      <a class="nav-link text-muted" href="<?php echo BASE_URL ; ?>rss" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('blogs') ; ?>"><i class="bi bi-rss text-success me-2"></i><?php echo userlang('blogs') ; ?></a>
                    </li>
                  </ul>
            </div>
        </div>
      
        
    </div>
  </div>
</nav>
<body class="<?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?>">
<div class="container">
<div class="row">
<div class="col-lg-12">