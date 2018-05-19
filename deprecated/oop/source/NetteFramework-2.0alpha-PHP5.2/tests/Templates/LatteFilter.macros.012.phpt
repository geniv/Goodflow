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
qwerty

EOD

, $template->render(<<<EOD
{contentType text}
qwerty

EOD
));



Assert::match(<<<EOD

asdfgh
EOD

, $template->render(<<<EOD

{contentType text}
asdfgh
EOD
));
