<?php

/**
 * Test: NTools critical sections.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



// entering
NTools::enterCriticalSection();

// leaving
NTools::leaveCriticalSection();

try {
	// leaving not entered
	NTools::leaveCriticalSection();
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', 'Critical section has not been initialized.', $e );
}

try {
	// doubled entering
	NTools::enterCriticalSection();
	NTools::enterCriticalSection();
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', 'Critical section has already been entered.', $e );
}
