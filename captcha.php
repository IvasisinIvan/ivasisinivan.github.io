<?php
session_start();
$captchastring = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
$captchastring = substr(str_shuffle($captchastring), 0, 6);
$_SESSION["code"] = $captchastring;
$image = imagecreatefrompng(dirname(__FILE__).'/background.png');
$colour = imagecolorallocate($image, 200, 240, 240);
$font = dirname(__FILE__).'/oswald.ttf';
$rotate = rand(-10, 10);
imagettftext($image, 18, $rotate, 28, 32, $colour, $font, $captchastring);
header('Content-type: image/png');
imagepng($image);
?>