<?php

/**
 * Test: Memcached expiration test.
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
	NCache::EXPIRATION => time() + 3,
));


// Sleeping 1 second
sleep(1);
$cache->release();
Assert::true( isset($cache[$key]), 'Is cached?' );



// Sleeping 3 seconds
sleep(3);
$cache->release();
Assert::false( isset($cache[$key]), 'Is cached?' );
