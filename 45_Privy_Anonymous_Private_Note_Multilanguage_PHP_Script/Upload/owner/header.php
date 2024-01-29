<!-- Header -->
<div class="col-lg-12 <?php echo colormode('border_bottom') ; ?> ">
    <div class="row text-center">
        <div class="col-lg-12 p-2"><a href="<?php echo ADMIN_URL ; ?>"><img src="<?php echo BASE_URL ; ?>img/logo.png" class="img-fluid"></a> <a href="<?php echo BASE_URL ; ?>redirect.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>&mode=<?php echo colormode('xmode') ; ?>" class="ms-2" ><i class="bi bi-lightbulb-fill bigFont <?php echo colormode('default_text') ; ?> ms-2"></i></a>
        <div class="dropdown div-inline">
          <button class="btn <?php echo colormode('dark_btn') ; ?> dropdown-toggle mt-n2" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-translate bigFont <?php echo colormode('default_text') ; ?>"></i>
          </button>
          <ul class="dropdown-menu <?php echo colormode('dropdown-menu-dark') ; ?> dropdown-menu-md-start pb-5" aria-labelledby="dropdownMenuButton2">
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
        </div>
        <?php if(isset($_SESSION['owner'])){ ?> 
            <a href="<?php echo ADMIN_URL ; ?>logout" class="mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('logout') ; ?> "><i class="bi bi-power bigFont text-danger"></i></a>
        <?php } ?>
        </div>
    </div>
</div>
