<?php

/**
 * Test: NPermission Ensures that the default rule obeys its assertion.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



function falseAssertion()
{
	return FALSE;
}



$acl = new NPermission;
$acl->deny(NULL, NULL, NULL, 'falseAssertion');
Assert::true( $acl->isAllowed(NULL, NULL, 'somePrivilege') );
