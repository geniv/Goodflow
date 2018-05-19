<?php

/**
 * Test: NRobotLoader basic usage.
 *
 * @author     David Grudl
 * @package    Nette\Loaders
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$loader = new NRobotLoader;
$loader->setCacheStorage(new NDummyStorage);
$loader->addDirectory(dirname(__FILE__) . '/files');
$loader->addDirectory(dirname(__FILE__) . '/files/'); // purposely doubled
$loader->addDirectory(dirname(__FILE__) . '/file/interface.php'); // as file
$loader->addDirectory(dirname(__FILE__) . '/files.robots');
$loader->register();

Assert::false( class_exists('ConditionalClass') );   // files/conditional.class.php
Assert::true( class_exists('TestClass') );           // files/namespaces1.php
Assert::true( interface_exists('TestInterface') );   // file/interface.php
if (PHP_VERSION_ID >= 50300) {
	Assert::true( class_exists('MySpace1\TestClass1') ); // files/namespaces1.php
	Assert::true( class_exists('MySpace2\TestClass2') ); // files/namespaces2.php
	Assert::true( class_exists('MySpace3\TestClass3') ); // files/namespaces2.php
}

Assert::false( class_exists('Disallowed1') );   // files.disallowed1\class.php
Assert::false( class_exists('Disallowed2') );   // files.disallowed2\class.php
Assert::false( class_exists('Disallowed3') );   // files.class.php
Assert::true( class_exists('Allowed1') );       // files.allowed.php
Assert::false( class_exists('Disallowed4') );   // files.disallowed4\class.php
Assert::false( class_exists('Disallowed5') );   // files.subdir2\disallowed5\class.php
Assert::false( class_exists('Disallowed6') );   // files.subdir2\class.php
Assert::true( class_exists('Allowed2') );       // files.subdir2\allowed.php
