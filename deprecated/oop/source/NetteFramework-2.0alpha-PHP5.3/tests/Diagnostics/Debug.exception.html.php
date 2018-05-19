<?php

/**
 * Test: Nette\Debug exception in HTML.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 * @assertCode 500
 */

use Nette\Debug;



require __DIR__ . '/../bootstrap.php';



Debug::$consoleMode = FALSE;
Debug::$productionMode = FALSE;
header('Content-Type: text/html');

Debug::enable();

echo '<!doctype html>';


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
	throw new Exception('The my exception', 123);
}


define('MY_CONST', 123);

first(10, 'any string');
