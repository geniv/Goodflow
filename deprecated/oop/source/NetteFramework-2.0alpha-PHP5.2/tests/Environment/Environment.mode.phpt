<?php

/**
 * Test: NEnvironment modes.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::false( NEnvironment::isConsole(), 'Is console?' );


Assert::true( NEnvironment::isProduction(), 'Is production mode?' );


// Setting my mode...
NEnvironment::setMode('myMode', 123);

Assert::true( NEnvironment::getMode('myMode'), 'Is enabled?' );
