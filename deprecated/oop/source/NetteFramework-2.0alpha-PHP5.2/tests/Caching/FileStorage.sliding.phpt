<?php

/**
 * Test: NFileStorage sliding expiration test.
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
	NCache::EXPIRATION => time() + 2,
	NCache::SLIDING => TRUE,
));


for($i = 0; $i < 3; $i++) {
	// Sleeping 1 second
	sleep(1);
	clearstatcache();
	$cache->release();
	Assert::true( isset($cache[$key]), 'Is cached?' );

}

// Sleeping few seconds...
sleep(3);
clearstatcache();
$cache->release();

Assert::false( isset($cache[$key]), 'Is cached?' );
