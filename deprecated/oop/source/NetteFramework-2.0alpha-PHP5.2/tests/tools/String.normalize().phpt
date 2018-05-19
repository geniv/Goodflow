<?php

/**
 * Test: NString::normalize()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( "Hello\n  World",  NString::normalize("\r\nHello  \r  World \n\n") );
