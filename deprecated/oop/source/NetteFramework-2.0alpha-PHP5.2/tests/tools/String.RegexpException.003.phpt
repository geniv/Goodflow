<?php

/**
 * Test: NString and NRegexpException compile error.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



try {
	NString::split('0123456789', '#*#');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'preg_split(): Compilation failed: nothing to repeat at offset 0 in pattern: #*#', $e );
}

try {
	NString::match('0123456789', '#*#');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'preg_match(): Compilation failed: nothing to repeat at offset 0 in pattern: #*#', $e );
}

try {
	NString::matchAll('0123456789', '#*#');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'preg_match_all(): Compilation failed: nothing to repeat at offset 0 in pattern: #*#', $e );
}

try {
	NString::replace('0123456789', '#*#', 'x');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'preg_replace(): Compilation failed: nothing to repeat at offset 0 in pattern: #*#', $e );
}

function cb() { return 'x'; }

try {
	NString::replace('0123456789', '#*#', callback('cb'));
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'preg_replace_callback(): Compilation failed: nothing to repeat at offset 0 in pattern: #*#', $e );
}
