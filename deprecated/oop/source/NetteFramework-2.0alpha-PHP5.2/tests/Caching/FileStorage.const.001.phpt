<?php

/**
 * Test: NFileStorage constant dependency test.
 *
 * @author     David Grudl
 * @package    Nette\Caching
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$key = 'nette';
$value = 'rulez';

// temporary directory
define('TEMP_DIR', dirname(__FILE__) . '/tmp');
TestHelpers::purge(TEMP_DIR);


$cache = new NCache(new NFileStorage(TEMP_DIR));


define('ANY_CONST', 10);


// Writing cache...
$cache->save($key, $value, array(
	NCache::CONSTS => 'ANY_CONST',
));
$cache->release();

Assert::true( isset($cache[$key]), 'Is cached?' );
