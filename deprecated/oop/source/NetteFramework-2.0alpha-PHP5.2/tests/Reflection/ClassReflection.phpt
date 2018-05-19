<?php

/**
 * Test: NClassReflection tests.
 *
 * @author     David Grudl
 * @package    Nette\Reflection
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



class Foo
{
	public function f() {}
}

class Bar extends Foo implements Countable
{
	public $var;

	function count() {}
}


Assert::equal( new NClassReflection('Bar'), NClassReflection::from('Bar') );
Assert::equal( new NClassReflection('Bar'), NClassReflection::from(new Bar) );



$rc = NClassReflection::from('Bar');

Assert::null( $rc->getExtension() );


Assert::equal( array(
	'Countable' => new NClassReflection('Countable'),
), $rc->getInterfaces() );


Assert::equal( new NClassReflection('Foo'), $rc->getParentClass() );


Assert::null( $rc->getConstructor() );


Assert::equal( new NMethodReflection('Foo', 'f'), $rc->getMethod('f') );


try {
	$rc->getMethod('doesntExist');
} catch (Exception $e) {
	Assert::same( 'Method Bar::doesntExist() does not exist', $e->getMessage() );

}

Assert::equal( array(
	new NMethodReflection('Bar', 'count'),
	new NMethodReflection('Foo', 'f'),
), $rc->getMethods() );



Assert::equal( new NPropertyReflection('Bar', 'var'), $rc->getProperty('var') );


try {
	$rc->getProperty('doesntExist');
} catch (exception $e) {
	Assert::same( 'Property Bar::$doesntExist does not exist', $e->getMessage() );

}

Assert::equal( array(
	new NPropertyReflection('Bar', 'var'),
), $rc->getProperties() );
