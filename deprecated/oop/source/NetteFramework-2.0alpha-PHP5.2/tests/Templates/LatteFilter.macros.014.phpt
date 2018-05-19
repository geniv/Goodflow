<?php

/**
 * Test: NLatteFilter and macros test.
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Template.inc';



$template = new MockTemplate;
$template->registerFilter(new NLatteFilter);

Assert::match(<<<EOD
Block

EOD

, $template->render(<<<EOD
{block}
Block

EOD
));