<?php

/**
 * Test: NPermission Ensures that assertions on privileges work properly for a particular Role.
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

function trueAssertion()
{
	return TRUE;
}


$acl = new NPermission;
$acl->addRole('guest');
$acl->allow('guest', NULL, 'somePrivilege', 'trueAssertion');
Assert::true( $acl->isAllowed('guest', NULL, 'somePrivilege') );
$acl->allow('guest', NULL, 'somePrivilege', 'falseAssertion');
Assert::false( $acl->isAllowed('guest', NULL, 'somePrivilege') );
