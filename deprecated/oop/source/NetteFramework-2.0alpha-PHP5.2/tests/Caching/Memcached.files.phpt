<?php

/**
 * Test: Memcached files dependency test.
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


$dependentFile = dirname(__FILE__) . '/tmp/spec.file';
@unlink($dependentFile);

// Writing cache...
$cache->save($key, $value, array(
	NCache::FILES => array(
		__FILE__,
		$dependentFile,
	),
));
$cache->release();

Assert::true( isset($cache[$key]), 'Is cached?' );


// Modifing dependent file
file_put_contents($dependentFile, 'a');
$cache->release();

Assert::false( isset($cache[$key]), 'Is cached?' );


// Writing cache...
$cache->save($key, $value, array(
	NCache::FILES => $dependentFile,
));
$cache->release();

Assert::true( isset($cache[$key]), 'Is cached?' );


// Modifing dependent file
sleep(2);
file_put_contents($dependentFile, 'b');
clearstatcache();
$cache->release();

Assert::false( isset($cache[$key]), 'Is cached?' );
