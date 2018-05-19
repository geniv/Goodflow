<?php

/**
 * Test: NLatteFilter and invalid UTF-8.
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Template.inc';



$template = new MockTemplate;
$template->registerFilter(new NLatteFilter);


try {
	$template->render("\xAA");
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NLatteException', '%a% UTF-8 %a%', $e );
}
