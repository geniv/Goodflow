<?php

/**
 * Test: NString::trim()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( 'x',  NString::trim(" \t\n\r\x00\x0B\xC2\xA0x") );
Assert::same( 'a b',  NString::trim(' a b ') );
Assert::same( ' a b ',  NString::trim(' a b ', '') );
Assert::same( 'e',  NString::trim("\xc5\x98e-", "\xc5\x98-") ); // Ře-

try {
	NString::trim("\xC2x\xA0");
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', NULL, $e );
}
