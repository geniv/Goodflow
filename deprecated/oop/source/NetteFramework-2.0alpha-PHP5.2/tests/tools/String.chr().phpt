<?php

/**
 * Test: NString::chr()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( "\x00",  NString::chr(0), '#0' );
Assert::same( "\xc3\xbf",  NString::chr(255), '#255 in UTF-8' );
Assert::same( "\xFF",  NString::chr(255, 'ISO-8859-1'), '#255 in ISO-8859-1' );
