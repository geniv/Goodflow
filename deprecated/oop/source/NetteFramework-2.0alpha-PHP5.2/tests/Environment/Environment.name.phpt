<?php

/**
 * Test: NEnvironment name.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



//define('ENVIRONMENT', 'lab');

Assert::same( 'production', NEnvironment::getName(), 'Name:' );



try {
	// Setting name:
	NEnvironment::setName('lab2');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', 'Environment name has already been set.', $e );
}
