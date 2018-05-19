<?php

/**
 * Test: NJson::decode()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( "ok", NJson::decode('"ok"') );
Assert::null( NJson::decode('') );
Assert::null( NJson::decode('null') );
Assert::null( NJson::decode('NULL') );


Assert::equal( (object) array('a' => 1), NJson::decode('{"a":1}') );
Assert::same( array('a' => 1), NJson::decode('{"a":1}', NJson::FORCE_ARRAY) );



try {
	NJson::decode('{');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NJsonException', 'Syntax error, malformed JSON', $e );
}



try {
	NJson::decode('{}}');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NJsonException', 'Syntax error, malformed JSON', $e );
}



try {
	NJson::decode("\x00");
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NJsonException', 'Unexpected control character found', $e );
}
