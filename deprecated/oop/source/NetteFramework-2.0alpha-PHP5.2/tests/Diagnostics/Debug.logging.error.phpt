<?php

/**
 * Test: NDebug error logging.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



// Setup environment
$_SERVER['HTTP_HOST'] = 'nette.org';

NDebug::$logDirectory = dirname(__FILE__) . '/log';
TestHelpers::purge(NDebug::$logDirectory);

NDebug::$consoleMode = FALSE;
NDebug::$mailer = 'testMailer';

NDebug::enable(NDebug::PRODUCTION, NULL, 'admin@example.com');

function testMailer() {}

function shutdown() {
	Assert::match('%a%PHP Fatal error: Call to undefined function missing_funcion() in %a%', file_get_contents(NDebug::$logDirectory . '/error.log'));
	Assert::true(is_file(NDebug::$logDirectory . '/email-sent'));
	die(0);
}
Assert::handler('shutdown');



missing_funcion();
