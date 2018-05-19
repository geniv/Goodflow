<?php

/**
 * Test: NDebug E_ERROR in HTML.
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
	Assert::match(file_get_contents(dirname(__FILE__) . '/Debug.E_ERROR.html.expect'), ob_get_clean());
	die(0);
}
Assert::handler('shutdown');



function first($arg1, $arg2)
{
	second(TRUE, FALSE);
}


function second($arg1, $arg2)
{
	third(array(1, 2, 3));
}


function third($arg1)
{
	missing_funcion();
}


first(10, 'any string');
