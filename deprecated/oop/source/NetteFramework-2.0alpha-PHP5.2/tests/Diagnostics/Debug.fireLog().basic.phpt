<?php

/**
 * Test: NDebug::fireLog()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



// Setup environment
$_SERVER['HTTP_X_FIRELOGGER'] = TRUE;

NDebug::$consoleMode = FALSE;
NDebug::$productionMode = FALSE;



$arr = array(10, 20.2, TRUE, FALSE, NULL, 'hello', array('key1' => 'val1', 'key2' => TRUE), (object) array('key1' => 'val1', 'key2' => TRUE));

// will show in Firebug "Console" tab
NDebug::fireLog('Hello World'); // NDebug::DEBUG
NDebug::fireLog('Info message', NDebug::INFO);
NDebug::fireLog('Warn message', NDebug::WARNING);
NDebug::fireLog('Error message', NDebug::ERROR);
NDebug::fireLog($arr);

Assert::match('%A%
FireLogger-de11e-0:%a%
', implode("\r\n", headers_list()));
