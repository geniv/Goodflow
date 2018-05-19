<?php

/**
 * Test: NString::checkEncoding()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::true( NString::checkEncoding("\xc5\xbelu\xc5\xa5ou\xc4\x8dk\xc3\xbd"), 'UTF-8' ); // žluťoučký
Assert::true( NString::checkEncoding("\x01"), 'C0' );
Assert::false( NString::checkEncoding("\xed\xa0\x80"), 'surrogate pairs' ); // xD800
Assert::false( NString::checkEncoding("\xef\xbb\xbf"), 'noncharacter' ); // xFEFF
Assert::false( NString::checkEncoding("\xf4\x90\x80\x80"), 'out of range' ); // x110000
