<?php

// File and new size
$filename = 'P3220334.JPG';
$percent = 0.5;

// Content type
header('Content-type: image/jpeg');

ini_set('memory_limit', '100M');

// Get new sizes
list($width, $height) = getimagesize($filename);

$newwidth = 640; //$width * $percent;
$newheight = 480; //$height * $percent;

// Load
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);

//imagefilter($source, IMG_FILTER_SMOOTH, 1); //nej 1!

// Resize
imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Output
imagejpeg($thumb);
//imagejpeg($thumb, "obr.jpg", 100);

//ini_set('memory_limit', '100M');
/*
header('Content-type: image/png;');

$obr = imagecreate(900, 600);
$barva = imagecolorallocate($obr, 204, 204, 204); //barva pozadí
$text = imagecolorallocate($obr, 0, 0, 0);
$red = imagecolorallocate($obr, 204, 0, 0);
imageline($obr, 10, 10, 400, 400, $text);
imagerectangle($obr, 100, 50, 400,200, $text);
imageellipse($obr, 50, 200, 50, 40, $text);
imagefill($obr, 50, 200, $red);
imagearc($obr, 100, 100, 150, 150, 25, 155, $red);
$font = imageloadfont("font.gdf");
imagestring($obr, $font, 30, 50, "Di do prdele", $text);
imagestringup($obr, $font, 700, 550, "Di do prdele", $text);
imagepng($obr);*/
?>