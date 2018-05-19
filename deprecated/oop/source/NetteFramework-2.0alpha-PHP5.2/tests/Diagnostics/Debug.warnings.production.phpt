<?php

/**
 * Test: NDebug notices and warnings in production mode.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = FALSE;
NDebug::$productionMode = TRUE;

NDebug::enable();

function shutdown() {
	Assert::same('', ob_get_clean());
}
Assert::handler('shutdown');



mktime(); // E_STRICT
mktime(0, 0, 0, 1, 23, 1978, 1); // E_DEPRECATED
$x++; // E_NOTICE
rename('..', '..'); // E_WARNING
require 'E_COMPILE_WARNING.inc'; // E_COMPILE_WARNING