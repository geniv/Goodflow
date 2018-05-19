<?php

/**
 * Test: NDebug E_ERROR in production mode.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 * @assertCode 500
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = FALSE;
NDebug::$productionMode = TRUE;
header('Content-Type: text/html');

NDebug::enable();

function shutdown() {
	Assert::match('%A%<h1>Server Error</h1>%A%', ob_get_clean());
	die(0);
}
Assert::handler('shutdown');



missing_funcion();
