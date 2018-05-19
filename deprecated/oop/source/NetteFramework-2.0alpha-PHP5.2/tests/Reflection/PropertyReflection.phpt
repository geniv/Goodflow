<?php

/**
 * Test: NPropertyReflection tests.
 *
 * @author     David Grudl
 * @package    Nette\Reflection
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



class A
{
	public $prop;
}

class B extends A
{
}

$propInfo = new NPropertyReflection('B', 'prop');
Assert::equal( new NClassReflection('A'), $propInfo->getDeclaringClass() );
