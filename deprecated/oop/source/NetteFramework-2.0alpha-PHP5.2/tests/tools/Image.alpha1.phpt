<?php

/**
 * Test: NImage alpha channel.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

ob_start();

$image = NImage::fromBlank(200, 100, NImage::rgb(255, 128, 0, 60));
$image->crop(0, 0, '60%', '60%');
$image->send(NImage::PNG, 100);

Assert::same(file_get_contents(dirname(__FILE__) . '/Image.alpha1.expect'), ob_get_clean());