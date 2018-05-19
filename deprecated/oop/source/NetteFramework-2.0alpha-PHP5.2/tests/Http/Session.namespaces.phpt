<?php

/**
 * Test: NSession namespaces.
 *
 * @author     David Grudl
 * @package    Nette\Web
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



ob_start();

$session = new NSession;
Assert::false( $session->hasNamespace('trees'), 'hasNamespace() should have returned FALSE for a namespace with no keys set' );

$namespace = $session->getNamespace('trees');
Assert::false( $session->hasNamespace('trees'), 'hasNamespace() should have returned FALSE for a namespace with no keys set' );

$namespace->hello = 'world';
Assert::true( $session->hasNamespace('trees'), 'hasNamespace() should have returned TRUE for a namespace with keys set' );

$namespace = $session->getNamespace('default');
Assert::true( $namespace instanceof NSessionNamespace );

try {
	$namespace = $session->getNamespace('');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidArgumentException', 'Session namespace must be a non-empty string.', $e );
}
