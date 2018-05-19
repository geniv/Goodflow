<?php

/**
 * Test: NPermission Ensures that removal of all Resources results in Resource-specific rules being removed.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
$acl->addResource('area');
$acl->allow(NULL, 'area');
Assert::true( $acl->isAllowed(NULL, 'area') );
$acl->removeAllResources();
try {
	$acl->isAllowed(NULL, 'area');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', "Resource 'area' does not exist.", $e );
}

$acl->addResource('area');
Assert::false( $acl->isAllowed(NULL, 'area') );
