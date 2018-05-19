<?php

/**
 * Test: NString::startsWith()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::true( NString::startsWith('123', NULL), "startsWith('123', NULL)" );
Assert::true( NString::startsWith('123', ''), "startsWith('123', '')" );
Assert::true( NString::startsWith('123', '1'), "startsWith('123', '1')" );
Assert::false( NString::startsWith('123', '2'), "startsWith('123', '2')" );
Assert::true( NString::startsWith('123', '123'), "startsWith('123', '123')" );
Assert::false( NString::startsWith('123', '1234'), "startsWith('123', '1234')" );
