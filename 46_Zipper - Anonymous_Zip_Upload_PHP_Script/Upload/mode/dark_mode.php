<?php
function colormode($txt){
    static $colormode = array(
        'xmode' => 'light',
        'bg_color' => 'bg-dark',
        'border' => 'darkmode_border',
        'border_bottom' => 'darkmode_border_bottom',
        'border_top' => 'darkmode_border_top' ,
        'border_right' => 'darkmode_border_right',
        'default_text' => 'text-white',
        'dark_btn' => 'btn-dark',
        'dropdown-menu-dark' => 'dropdown-menu-dark',
        'textarea-bgcolor' => 'bg-dark',
        'google_captcha_theme' => 'dark',
        'tbl_dark' => 'table-dark'
    );
    return $colormode[$txt];
}

?>