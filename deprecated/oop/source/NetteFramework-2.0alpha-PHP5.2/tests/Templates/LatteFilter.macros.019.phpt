<?php

/**
 * Test: NLatteFilter and first/sep/last test.
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
$template->setFile(dirname(__FILE__) . '/templates/first-sep-last.latte');
$template->registerFilter(new NLatteFilter);
$template->people = array('John', 'Mary', 'Paul');

Assert::match(file_get_contents(dirname(__FILE__) . '/LatteFilter.macros.019.expect'), $template->__toString(TRUE));
