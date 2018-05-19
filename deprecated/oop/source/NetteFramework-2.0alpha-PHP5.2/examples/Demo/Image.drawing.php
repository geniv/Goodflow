<?php

/**
 * NImage drawing example.
 * @author     David Grudl
 */


require dirname(__FILE__) . '/../../Nette/loader.php';



NDebug::enable();



$image = NImage::fromBlank(300, 300);

// white background
$image->filledRectangle(0, 0, 299, 299, NImage::rgb(255, 255, 255));

// black border
$image->rectangle(0, 0, 299, 299, NImage::rgb(0, 0, 0));

// three ellipses
$image->filledEllipse(100, 75, 150, 150, NImage::rgb(255, 255, 0, 75));
$image->filledEllipse(120, 168, 150, 150, NImage::rgb(255, 0, 0, 75));
$image->filledEllipse(187, 125, 150, 150, NImage::rgb(0, 0, 255, 75));

$image->send();