<?php

/**
 * Test: NEnvironment variables.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::null( NEnvironment::getVariable('foo', NULL), "Getting variable 'foo':" );


try {
	NEnvironment::getVariable('foo');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', "Unknown environment variable 'foo'.", $e );
}


// Defining constant 'APP_DIR':
define('APP_DIR', '/myApp');

Assert::same( '/myApp', NEnvironment::getVariable('appDir') );


// Setting variable 'test'...
NEnvironment::setVariable('test', '%appDir%/test');

Assert::same( '/myApp/test', NEnvironment::getVariable('test') );


Assert::same( array(
	'appDir' => '/myApp',
	'test' => '/myApp/test',
), NEnvironment::getVariables());



try {
	// Setting circular variables...
	NEnvironment::setVariable('bar', '%foo%');
	NEnvironment::setVariable('foo', '%foobar%');
	NEnvironment::setVariable('foobar', '%bar%');
	NEnvironment::getVariable('bar');

	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', 'Circular reference detected for variables: foo, foobar, bar.', $e );
}
