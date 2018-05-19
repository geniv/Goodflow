<?php

/**
 * Test: NImage rotating.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



if (GD_BUNDLED === 0) {
	TestHelpers::skip('Requires PHP extension GD in bundled version.');
}



$image = NImage::fromFile('files/images/logo.gif');
$image->rotate(30, NImage::rgb(0, 0, 0));

Assert::same(file_get_contents(dirname(__FILE__) . '/Image.rotate.expect'), $image->toString(NImage::GIF));