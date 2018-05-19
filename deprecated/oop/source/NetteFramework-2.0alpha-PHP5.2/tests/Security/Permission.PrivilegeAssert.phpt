<?php

/**
 * Test: NPermission Ensures that assertions on privileges work properly.
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
$acl->allow(NULL, NULL, 'somePrivilege', 'trueAssertion');
Assert::true( $acl->isAllowed(NULL, NULL, 'somePrivilege') );

$acl->allow(NULL, NULL, 'somePrivilege', 'falseAssertion');
Assert::false( $acl->isAllowed(NULL, NULL, 'somePrivilege') );
