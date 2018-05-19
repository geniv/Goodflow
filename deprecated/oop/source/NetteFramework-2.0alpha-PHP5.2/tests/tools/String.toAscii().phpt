<?php

/**
 * Test: NString::toAscii()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( 'ZLUTOUCKY KUN oooo', NString::toAscii("\xc5\xbdLU\xc5\xa4OU\xc4\x8cK\xc3\x9d K\xc5\xae\xc5\x87 \xc3\xb6\xc5\x91\xc3\xb4o") ); // ŽLUŤOUČKÝ KŮŇ öőôo
Assert::same( 'Z `\'"^~', NString::toAscii("\xc5\xbd `'\"^~") );
