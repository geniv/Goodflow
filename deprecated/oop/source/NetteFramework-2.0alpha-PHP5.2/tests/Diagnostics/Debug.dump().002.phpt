<?php

/**
 * Test: NDebug::dump() with $showLocation.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = FALSE;
NDebug::$productionMode = FALSE;



NDebug::$showLocation = TRUE;

ob_start();
NDebug::dump('xxx');
Assert::match( '<pre class="nette-dump">"xxx" (3) <small>in file %a% on line %d%</small>
</pre>', ob_get_clean() );
