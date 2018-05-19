<?php

/**
 * Test: NDebug notices and warnings with $strictMode in console.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = TRUE;
NDebug::$productionMode = FALSE;

NDebug::$strictMode = TRUE;
NDebug::enable();

function shutdown() {
	Assert::match("exception 'FatalErrorException' with message 'Undefined variable: x' in %a%
Stack trace:
#0 %a%: %ns%Debug::_errorHandler(8, '%a%', '%a%', %a%, Array)
#1 %a%: third(Array)
#2 %a%: second(true, false)
#3 %a%: first(10, 'any string')
#4 {main}
", ob_get_clean());
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
	$x++;
}


first(10, 'any string');
