<?php

/**
 * Test: NFileStorage @serializationVersion dependency test (continue...).
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


$cache = new NCache(new NFileStorage(TEMP_DIR));


/**
 * @serializationVersion 123
 */
class Foo
{
}


// Changed @serializationVersion

Assert::false( isset($cache[$key]), 'Is cached?' );
