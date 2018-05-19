<?php

/**
 * Test: NParameterReflection tests.
 *
 * @author     David Grudl
 * @package    Nette\Reflection
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



function myFunction($test, $test2 = null) {
	echo $test;
}

$reflect = new NFunctionReflection('myFunction');
$params = $reflect->getParameters();
Assert::same( 2, count($params) );
Assert::same( 'Function myFunction()', (string) $params[0]->declaringFunction );
Assert::null( $params[0]->class );
Assert::null( $params[0]->declaringClass );
Assert::same( 'Function myFunction()', (string) $params[1]->declaringFunction );
Assert::null( $params[1]->class );
Assert::null( $params[1]->declaringClass );



class Foo
{
	function myMethod($test, $test2 = null)
	{
		echo $test;
	}
}

$reflect = new NClassReflection('Foo');
$params = $reflect->getMethod('myMethod')->getParameters();
Assert::same( 2, count($params) );
Assert::same( 'Method Foo::myMethod()', (string) $params[0]->declaringFunction );
Assert::null( $params[0]->class );
Assert::same( 'Class Foo', (string) $params[0]->declaringClass );
Assert::same( 'Method Foo::myMethod()', (string) $params[1]->declaringFunction );
Assert::null( $params[1]->class );
Assert::same( 'Class Foo', (string) $params[1]->declaringClass );
