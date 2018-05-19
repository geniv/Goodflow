<?php

/**
 * Test: NJson::encode()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( '"ok"', NJson::encode('ok') );



try {
	NJson::encode(array("bad utf\xFF"));
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NJsonException', 'json_encode(): Invalid UTF-8 sequence in argument', $e );
}



try {
	$arr = array('recursive');
	$arr[] = & $arr;
	NJson::encode($arr);
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NJsonException', 'json_encode(): recursion detected', $e );
}
