<?php

/**
 * Test: NLatteFilter and macros test.
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 * @keepTrailingSpaces
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Template.inc';



// temporary directory
define('TEMP_DIR', dirname(__FILE__) . '/tmp');
TestHelpers::purge(TEMP_DIR);



$template = new NFileTemplate;
$template->setCacheStorage(new MockCacheStorage(TEMP_DIR));
$template->setFile(dirname(__FILE__) . '/templates/inheritance.child1.latte');
$template->registerFilter(new NLatteFilter);

$template->people = array('John', 'Mary', 'Paul');

Assert::match(file_get_contents(dirname(__FILE__) . '/LatteFilter.macros.ext.001.expect'), $template->__toString(TRUE));
