<?php

/**
 * Test: NConfigAdapterNeon section.
 *
 * @author     David Grudl
 * @package    Nette\Config
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



try {
	$config = NConfig::fromFile('config3.neon');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'InvalidStateException', "Missing parent section scalar in 'config3.neon'.", $e );
}
