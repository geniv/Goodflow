<?php

/**
 * Test: NString and NRegexpException run-time error.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



try {
	NString::split("0123456789\xFF", '#\d#u');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'Malformed UTF-8 data (pattern: #\d#u)', $e );
}

try {
	NString::match("0123456789\xFF", '#\d#u');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'Malformed UTF-8 data (pattern: #\d#u)', $e );
}

try {
	NString::matchAll("0123456789\xFF", '#\d#u');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'Malformed UTF-8 data (pattern: #\d#u)', $e );
}

try {
	NString::replace("0123456789\xFF", '#\d#u', 'x');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'Malformed UTF-8 data (pattern: #\d#u)', $e );
}

function cb() { return 'x'; }

try {
	NString::replace("0123456789\xFF", '#\d#u', callback('cb'));
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'Malformed UTF-8 data (pattern: #\d#u)', $e );
}
