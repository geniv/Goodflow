<?php

/**
 * Test: NPermission Ensures that removing non-existent default deny rule does nothing.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
$acl->allow();
$acl->removeDeny();
Assert::true( $acl->isAllowed() );
