<?php

/**
 * Test: NSession::regenerateId()
 *
 * @author     David Grudl
 * @package    Nette\Web
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$session = new NSession;
$session->start();
$oldId = $session->getId();
$session->regenerateId();
$newId = $session->getId();
Assert::true( $newId != $oldId );
