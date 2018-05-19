<?php

/**
 * Test: NString and error in callback.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same('HELLO', NString::replace('hello', '#.#', callback(create_function('$m', '
	$a++; // E_NOTICE
	return strtoupper($m[0]);
'))));
