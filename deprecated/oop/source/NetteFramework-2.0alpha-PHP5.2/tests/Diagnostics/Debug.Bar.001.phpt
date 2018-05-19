<?php

/**
 * Test: NDebug Bar in HTML.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = FALSE;
NDebug::$productionMode = FALSE;
header('Content-Type: text/html');

NDebug::enable();

function shutdown() {
	Assert::match('%A%<!-- Nette Debug Bar -->%A%', ob_get_clean());
}
Assert::handler('shutdown');
