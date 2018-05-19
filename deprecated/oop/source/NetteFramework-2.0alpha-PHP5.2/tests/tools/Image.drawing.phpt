<?php

/**
 * Test: NImage drawing.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$size = 300;
$image = NImage::fromBlank($size, $size);

$image->filledRectangle(0, 0, $size - 1, $size - 1, NImage::rgb(255, 255, 255));
$image->rectangle(0, 0, $size - 1, $size - 1, NImage::rgb(0, 0, 0));

$radius = 150;

$image->filledEllipse(100, 75, $radius, $radius, NImage::rgb(255, 255, 0, 75));
$image->filledEllipse(120, 168, $radius, $radius, NImage::rgb(255, 0, 0, 75));
$image->filledEllipse(187, 125, $radius, $radius, NImage::rgb(0, 0, 255, 75));

$image->copyResampled($image, 200, 200, 0, 0, 80, 80, $size, $size);

Assert::same(file_get_contents(dirname(__FILE__) . '/Image.drawing.expect'), $image->toString(NImage::GIF));