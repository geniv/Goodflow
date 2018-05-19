<?php

/**
 * Test: NDebug and NEnvironment.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = FALSE;



Assert::null( NDebug::$productionMode );

// setting production environment...

NEnvironment::setMode('production', TRUE);
NDebug::enable();

Assert::true( NDebug::$productionMode );
