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
{* comment
*}
qwerty

EOD
));



Assert::match(<<<EOD
qwerty

EOD

, $template->render(<<<EOD
{* comment
*}

qwerty

EOD
));



Assert::match(<<<EOD

qwerty

EOD

, $template->render(<<<EOD
{* comment
*}


qwerty

EOD
));



Assert::match(<<<EOD
qwerty

EOD

, $template->render(<<<EOD
{* comment
*}

{contentType text}
qwerty

EOD
));


/* TODO
Assert::match(<<<EOD
qwerty

EOD

, $template->render(<<<EOD
{* comment
*}
{contentType text}
qwerty

EOD
));



Assert::match(<<<EOD
qwerty

EOD

, $template->render(<<<EOD
{* comment
*}
{contentType text/plain}
qwerty

EOD
));
*/