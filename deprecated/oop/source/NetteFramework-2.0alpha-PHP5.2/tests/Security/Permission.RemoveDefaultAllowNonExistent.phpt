<?php

/**
 * Test: NPermission Ensures that removing non-existent default allow rule does nothing.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
$acl->removeAllow();
Assert::false( $acl->isAllowed() );
