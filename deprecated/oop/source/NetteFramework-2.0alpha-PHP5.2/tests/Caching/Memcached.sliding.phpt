<?php

/**
 * Test: Memcached sliding expiration test.
 *
 * @author     David Grudl
 * @package    Nette\Caching
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



if (!NMemcachedStorage::isAvailable()) {
	TestHelpers::skip('Requires PHP extension Memcache.');
}



$key = 'nette';
$value = 'rulez';

$cache = new NCache(new NMemcachedStorage('localhost'));


// Writing cache...
$cache->save($key, $value, array(
	NCache::EXPIRATION => time() + 2,
	NCache::SLIDING => TRUE,
));


for($i = 0; $i < 3; $i++) {
	// Sleeping 1 second
	sleep(1);
	$cache->release();
	Assert::true( isset($cache[$key]), 'Is cached?' );

}

// Sleeping few seconds...
sleep(3);
$cache->release();

Assert::false( isset($cache[$key]), 'Is cached?' );
