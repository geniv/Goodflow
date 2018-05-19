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
$template->registerFilter(new NLatteFilter);

Assert::match(file_get_contents(dirname(__FILE__) . '/LatteFilter.macros.020.expect'), $template->compile(file_get_contents(dirname(__FILE__) . '/templates/isLinkCurrent.latte')));
