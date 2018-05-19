<?php

/**
 * Test: NDebug::barDump()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$consoleMode = FALSE;
NDebug::$productionMode = FALSE;
header('Content-Type: text/html');

NDebug::enable();

function shutdown() {
	$m = NString::match(ob_get_clean(), '#debug.innerHTML = (".*");#');
	Assert::match(file_get_contents(dirname(__FILE__) . '/Debug.barDump().001.expect'), json_decode($m[1]));
}
Assert::handler('shutdown');



$arr = array(10, 20.2, TRUE, FALSE, NULL, 'hello', array('key1' => 'val1', 'key2' => TRUE), (object) array('key1' => 'val1', 'key2' => TRUE));

NDebug::barDump($arr);

end($arr)->key1 = 'changed'; // make post-change

NDebug::barDump('<a href="#">test</a>', 'String');
