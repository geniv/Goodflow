<?php

/**
 * Test: NString::padLeft() & padRight()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( "ŤOUŤOUŤŽLU", NString::padLeft("\xc5\xbdLU", 10, "\xc5\xa4OU") );
Assert::same( "ŤOUŤOUŽLU", NString::padLeft("\xc5\xbdLU", 9, "\xc5\xa4OU") );
Assert::same( "ŽLU", NString::padLeft("\xc5\xbdLU", 3, "\xc5\xa4OU") );
Assert::same( "ŽLU", NString::padLeft("\xc5\xbdLU", 0, "\xc5\xa4OU") );
Assert::same( "ŽLU", NString::padLeft("\xc5\xbdLU", -1, "\xc5\xa4OU") );
Assert::same( "ŤŤŤŤŤŤŤŽLU", NString::padLeft("\xc5\xbdLU", 10, "\xc5\xa4") );
Assert::same( "ŽLU", NString::padLeft("\xc5\xbdLU", 3, "\xc5\xa4") );
Assert::same( "       ŽLU", NString::padLeft("\xc5\xbdLU", 10) );



Assert::same( "ŽLUŤOUŤOUŤ", NString::padRight("\xc5\xbdLU", 10, "\xc5\xa4OU") );
Assert::same( "ŽLUŤOUŤOU", NString::padRight("\xc5\xbdLU", 9, "\xc5\xa4OU") );
Assert::same( "ŽLU", NString::padRight("\xc5\xbdLU", 3, "\xc5\xa4OU") );
Assert::same( "ŽLU", NString::padRight("\xc5\xbdLU", 0, "\xc5\xa4OU") );
Assert::same( "ŽLU", NString::padRight("\xc5\xbdLU", -1, "\xc5\xa4OU") );
Assert::same( "ŽLUŤŤŤŤŤŤŤ", NString::padRight("\xc5\xbdLU", 10, "\xc5\xa4") );
Assert::same( "ŽLU", NString::padRight("\xc5\xbdLU", 3, "\xc5\xa4") );
Assert::same( "ŽLU       ", NString::padRight("\xc5\xbdLU", 10) );
