<?php

/**
 * Test: NDebug exception in production & console mode.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = TRUE;
NDebug::$productionMode = TRUE;

NDebug::enable();

function shutdown() {
	Assert::match('ERROR:%A%', ob_get_clean());
}
Assert::handler('shutdown');



throw new Exception('The my exception', 123);
