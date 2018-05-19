<?php

/**
 * Test: NString::indent()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( "",  NString::indent("") );
Assert::same( "\n",  NString::indent("\n") );
Assert::same( "\tword",  NString::indent("word") );
Assert::same( "\n\tword",  NString::indent("\nword") );
Assert::same( "\n\tword",  NString::indent("\nword") );
Assert::same( "\n\tword\n",  NString::indent("\nword\n") );
Assert::same( "\r\n\tword\r\n",  NString::indent("\r\nword\r\n") );
Assert::same( "\r\n\t\tword\r\n",  NString::indent("\r\nword\r\n", 2) );
Assert::same( "\r\n      word\r\n",  NString::indent("\r\nword\r\n", 2, '   ') );
