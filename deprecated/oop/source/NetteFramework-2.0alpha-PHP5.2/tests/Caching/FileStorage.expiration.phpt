<?php

/**
 * Test: NFileStorage expiration test.
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


// Writing cache...
$cache->save($key, $value, array(
	NCache::EXPIRATION => time() + 3,
));


// Sleeping 1 second
sleep(1);
clearstatcache();
$cache->release();
Assert::true( isset($cache[$key]), 'Is cached?' );



// Sleeping 3 seconds
sleep(3);
clearstatcache();
$cache->release();
Assert::false( isset($cache[$key]), 'Is cached?' );
