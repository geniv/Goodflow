<?php

/**
 * Test: NImage factories.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$image = NImage::fromFile('files/images/logo.gif');
// logo.gif
Assert::same( 176, $image->width, 'width' );

Assert::same( 104, $image->height, 'height' );


$image = NImage::fromBlank(200, 300, NImage::rgb(255, 128, 0));
// blank
Assert::same( 200, $image->width, 'width' );

Assert::same( 300, $image->height, 'height' );
