<?php

/**
 * Test: NString and NRegexpException run-time error.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



ini_set('pcre.backtrack_limit', 3); // forces PREG_BACKTRACK_LIMIT_ERROR

try {
	NString::split('0123456789', '#.*\d#');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'NRegexpException', 'Backtrack limit was exhausted (pattern: #.*\d#)', $e );
}

try {
	NString::match('0123456789', '#.*\d#');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'NRegexpException', 'Backtrack limit was exhausted (pattern: #.*\d#)', $e );
}

try {
	NString::matchAll('0123456789', '#.*\d#');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'NRegexpException', 'Backtrack limit was exhausted (pattern: #.*\d#)', $e );
}

try {
	NString::replace('0123456789', '#.*\d#', 'x');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'NRegexpException', 'Backtrack limit was exhausted (pattern: #.*\d#)', $e );
}

function cb() { return 'x'; }

try {
	NString::replace('0123456789', '#.*\d#', callback('cb'));
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception( 'NRegexpException', 'Backtrack limit was exhausted (pattern: #.*\d#)', $e );
}
