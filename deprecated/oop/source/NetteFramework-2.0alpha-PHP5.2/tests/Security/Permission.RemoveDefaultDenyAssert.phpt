<?php

/**
 * Test: NPermission Ensures that removing the default deny rule results in assertion method being removed.
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
Assert::true( $acl->isAllowed() );
$acl->removeDeny();
Assert::false( $acl->isAllowed() );
