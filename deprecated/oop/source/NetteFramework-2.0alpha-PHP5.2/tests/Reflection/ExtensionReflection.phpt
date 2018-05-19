<?php

/**
 * Test: NExtensionReflection tests.
 *
 * @author     David Grudl
 * @package    Nette\Reflection
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$ext = new NExtensionReflection('standard');
$funcs = $ext->getFunctions();
Assert::equal( new NFunctionReflection('sleep'), $funcs['sleep'] );



$ext = new NExtensionReflection('reflection');
Assert::equal( array(
	'ReflectionException' => new NClassReflection('ReflectionException'),
	'Reflection' => new NClassReflection('Reflection'),
	'Reflector' => new NClassReflection('Reflector'),
	'ReflectionFunctionAbstract' => new NClassReflection('ReflectionFunctionAbstract'),
	'ReflectionFunction' => new NClassReflection('ReflectionFunction'),
	'ReflectionParameter' => new NClassReflection('ReflectionParameter'),
	'ReflectionMethod' => new NClassReflection('ReflectionMethod'),
	'ReflectionClass' => new NClassReflection('ReflectionClass'),
	'ReflectionObject' => new NClassReflection('ReflectionObject'),
	'ReflectionProperty' => new NClassReflection('ReflectionProperty'),
	'ReflectionExtension' => new NClassReflection('ReflectionExtension'),
), $ext->getClasses() );
