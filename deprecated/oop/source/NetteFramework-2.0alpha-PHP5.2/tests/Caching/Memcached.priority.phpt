<?php

/**
 * Test: NMemcachedStorage priority test.
 *
 * @author     David Grudl
 * @package    Nette\Caching
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';


if (!NMemcachedStorage::isAvailable()) {
	TestHelpers::skip('Requires PHP extension Memcache.');
}


// temporary directory
define('TEMP_DIR', dirname(__FILE__) . '/tmp');
TestHelpers::purge(TEMP_DIR);


$context = new NContext;
$context->addService('Nette\\Caching\\ICacheJournal', new NFileJournal(TEMP_DIR));
$storage = new NMemcachedStorage('localhost', 11211, '', $context);
$cache = new NCache($storage);


// Writing cache...
$cache->save('key1', 'value1', array(
	NCache::PRIORITY => 100,
));

$cache->save('key2', 'value2', array(
	NCache::PRIORITY => 200,
));

$cache->save('key3', 'value3', array(
	NCache::PRIORITY => 300,
));

$cache['key4'] = 'value4';


// Cleaning by priority...
$cache->clean(array(
	NCache::PRIORITY => '200',
));

Assert::false( isset($cache['key1']), 'Is cached key1?' );
Assert::false( isset($cache['key2']), 'Is cached key2?' );
Assert::true( isset($cache['key3']), 'Is cached key3?' );
Assert::true( isset($cache['key4']), 'Is cached key4?' );
