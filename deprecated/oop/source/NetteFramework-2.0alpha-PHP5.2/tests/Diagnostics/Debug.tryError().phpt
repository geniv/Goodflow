<?php

/**
 * Test: NDebug::tryError() & catchError.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::tryError(); {
	$a++;
} $res = NDebug::catchError($e);

Assert::true( $res );
Assert::same( "Undefined variable: a", $e->getMessage() );



NDebug::tryError(); {

} $res = NDebug::catchError($e);

Assert::false( $res );
Assert::null( $e );
