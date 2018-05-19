<?php

/**
 * Test: NFunctionReflection tests.
 *
 * @author     David Grudl
 * @package    Nette\Reflection
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



function bar() {}

$function = new NFunctionReflection('bar');
Assert::null( $function->getExtension() );


$function = new NFunctionReflection('sort');
Assert::equal( new NExtensionReflection('standard'), $function->getExtension() );
