<?php

/**
 * Test: NNetteLoader basic usage.
 *
 * @author     David Grudl
 * @package    Nette\Loaders
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$loader = NNetteLoader::getInstance();
$loader->register();

Assert::true( class_exists('NDebug'), 'Class NDebug loaded?' );
