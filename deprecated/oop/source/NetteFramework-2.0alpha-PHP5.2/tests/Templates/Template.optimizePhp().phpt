<?php

/**
 * Test: NTemplate::optimizePhp()
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$input = file_get_contents(dirname(__FILE__) . '/templates/optimize.latte');
$expected = file_get_contents(dirname(__FILE__) . '/Template.optimizePhp().expect');
Assert::match($expected, NTemplate::optimizePhp($input));
