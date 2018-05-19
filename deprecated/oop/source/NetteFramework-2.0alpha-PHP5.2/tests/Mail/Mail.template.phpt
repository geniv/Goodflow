<?php

/**
 * Test: NMail with template.
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Mail.inc';



// temporary directory
define('TEMP_DIR', dirname(__FILE__) . '/tmp');
TestHelpers::purge(TEMP_DIR);



$mail = new NMail();
$mail->addTo('Lady Jane <jane@example.com>');

$mail->htmlBody = new NFileTemplate;
$mail->htmlBody->setFile('files/template.phtml');
$mail->htmlBody->registerFilter(new NLatteFilter);

$mail->send();

Assert::match(file_get_contents(dirname(__FILE__) . '/Mail.template.expect'), TestMailer::$output);
