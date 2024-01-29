<?php
ob_start();
session_start();
// Box
$image_width = 160;
$image_height = 50;
$characters_lenght = 6;
$font_size = 24;
$rotate = rand(-3, 3);

// Colors
$background_color = "#800080";
$text_color = "#ffffff";
$distortion_color = "#FFFF00";

// Distortion
$distortion_dots = 50;
$distortion_lines = 5;

$code = "";

$permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789';

function generate_string($input, $strength = 10) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
  
    return $random_string;
}

$code .= generate_string($permitted_chars, 5);


$_SESSION["captcha"] = $code;

$image =  imagecreatetruecolor($image_width, $image_height);
$font = ["./Merriweather.ttf"] ;

// HEX TO RGB
list($background_r, $background_g, $background_b) = sscanf($background_color, "#%02x%02x%02x");
list($text_r, $text_g, $text_b) = sscanf($text_color, "#%02x%02x%02x");
list($distortion_r, $distortion_g, $distortion_b) = sscanf($distortion_color, "#%02x%02x%02x");

$background = imagecolorallocate($image, $background_r, $background_g, $background_b);
$text = imagecolorallocate($image, $text_r, $text_g, $text_b);
$distortion = imagecolorallocate($image, $distortion_r, $distortion_g, $distortion_b);

imagefilledrectangle($image, 0, 0, $image_width, $image_height, $background);

for ($i = 0; $i < $distortion_lines; $i++) {
    imageline($image, 0, rand() % $image_height, $image_width, rand() % $image_height, $distortion);
}

for ($i = 1; $i < $distortion_dots; $i++) {
    imagesetpixel($image, rand() % $image_width, rand() % $image_height, $distortion);
}


imagettftext($image, $font_size, $rotate, 12, $image_height - 12, $text, $font[array_rand($font)], $code);

header("Content-type:image/jpeg");
imagepng($image);
imagedestroy($image);
?>