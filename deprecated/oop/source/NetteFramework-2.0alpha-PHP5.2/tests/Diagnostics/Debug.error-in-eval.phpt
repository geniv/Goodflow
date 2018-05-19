<?php

/**
 * Test: NDebug eval error in HTML.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 * @assertCode 500
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = FALSE;
NDebug::$productionMode = FALSE;
header('Content-Type: text/html');

NDebug::enable();

function shutdown() {
	Assert::match(file_get_contents(dirname(__FILE__) . '/Debug.error-in-eval.expect'), ob_get_clean());
}
Assert::handler('shutdown');



function first($user, $pass)
{
	eval('trigger_error("The my error", E_USER_ERROR);');
}


first('root', 'xxx');
