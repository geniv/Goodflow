<?php

/**
 * Test: NFileStorage call().
 *
 * @author     David Grudl
 * @package    Nette\Caching
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



// temporary directory
define('TEMP_DIR', dirname(__FILE__) . '/tmp');
TestHelpers::purge(TEMP_DIR);



function mockFunction($x, $y)
{
	$GLOBALS['called'] = TRUE;
	return $x + $y;
}


$cache = new NCache(new NFileStorage(TEMP_DIR));

$called = FALSE;
Assert::same( 55, $cache->call('mockFunction', 5, 50) );
Assert::true( $called );

$called = FALSE;
Assert::same( 55, $cache->call('mockFunction', 5, 50) );
Assert::false( $called );
