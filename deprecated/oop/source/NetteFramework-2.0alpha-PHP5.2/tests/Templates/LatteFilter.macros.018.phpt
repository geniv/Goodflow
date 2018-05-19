<?php

/**
 * Test: NLatteFilter and NHtml::$xhtml.
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


NHtml::$xhtml = FALSE;
$template = new NFileTemplate;
$template->setCacheStorage(new MockCacheStorage(TEMP_DIR));
$template->setFile(dirname(__FILE__) . '/templates/common.latte');
$template->registerFilter(new NLatteFilter);
$template->registerHelper('translate', 'strrev');
$template->registerHelper('join', 'implode');
$template->registerHelperLoader('NTemplateHelpers::loader');

$template->hello = '<i>Hello</i>';
$template->id = ':/item';
$template->people = array('John', 'Mary', 'Paul', ']]>');
$template->menu = array('about', array('product1', 'product2'), 'contact');
$template->comment = 'test -- comment';
$template->el = NHtml::el('div')->title('1/2"');

Assert::match(file_get_contents(dirname(__FILE__) . '/LatteFilter.macros.018.expect'), $template->__toString(TRUE));
