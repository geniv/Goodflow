<?php

/**
 * Test: NDebug notices and warnings logging.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



// Setup environment
$_SERVER['HTTP_HOST'] = 'nette.org';

$logDirectory = dirname(__FILE__) . '/log';
TestHelpers::purge($logDirectory);

NDebug::$consoleMode = FALSE;
NDebug::$mailer = 'testMailer';

NDebug::enable(NDebug::PRODUCTION, $logDirectory, 'admin@example.com');

function testMailer() {}


// throw error
$a++;

Assert::match('%a%PHP Notice: Undefined variable: a in %a%', file_get_contents($logDirectory . '/error.log'));
Assert::true(is_file($logDirectory . '/email-sent'));
