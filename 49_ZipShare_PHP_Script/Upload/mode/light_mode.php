<?php
function colormode($txt){
    static $colormode = array(
        'xmode' => 'dark',
        'bg_color' => 'bg-light',
        'border' => 'lightmode_border',
        'border_bottom' => 'lightmode_border_bottom' ,
        'border_top' => 'lightmode_border_top' ,
        'border_right' => 'lightmode_border_right',
        'default_text' => 'text-dark',
        'dark_btn' => '',
        'dropdown-menu-dark' => '',
        'textarea-bgcolor' => 'bg-white',
        'google_captcha_theme' => '',
        'tbl_dark' => 'table-light',
        'class_navbar' => 'navbar-light',
        'navbarbg_color' => 'bg-white'
    );
    return $colormode[$txt];
}

?>