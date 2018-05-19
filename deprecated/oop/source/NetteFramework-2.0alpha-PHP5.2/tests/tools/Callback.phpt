<?php

/**
 * Test: NCallback tests.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



class Test
{
	static function add($a, $b)
	{
		return $a + $b;
	}
}


Assert::same( 'Test::add', (string) new NCallback(new Test, 'add') );
Assert::same( 'Test::add', (string) new NCallback('Test', 'add') );
Assert::same( 'Test::add', (string) new NCallback('Test::add') );
Assert::same( 'undefined', (string) new NCallback('undefined') );



$cb = new NCallback(new Test, 'add');

Assert::same( 8, $cb->invoke(3, 5) );
Assert::same( 8, $cb->invokeArgs(array(3, 5)) );
Assert::equal( array(new Test, 'add'), $cb->getNative() );
Assert::true( $cb->isCallable() );


try {
	callback('undefined')->invoke();
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', "Callback 'undefined' is not callable.", $e );
}

try {
	callback(NULL)->invoke();
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidArgumentException', 'Invalid callback.', $e );
}
