<?php

/**
 * Test: NDebug::dump() in production mode.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = FALSE;
NDebug::$productionMode = TRUE;


ob_start();
NDebug::dump('sensitive data');
Assert::same( '', ob_get_clean() );

Assert::match( '<pre class="nette-dump">"forced" (6)
</pre>', NDebug::dump('forced', TRUE) );
