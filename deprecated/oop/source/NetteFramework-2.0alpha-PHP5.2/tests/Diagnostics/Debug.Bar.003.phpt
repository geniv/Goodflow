<?php

/**
 * Test: NDebug Bar in production mode.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = FALSE;
NDebug::$productionMode = TRUE;
header('Content-Type: text/html');

NDebug::enable();

function shutdown() {
	Assert::same('', ob_get_clean());
}
Assert::handler('shutdown');
