<?php

/**
 * Test: NPermission Ensures that ACL-wide rules (all Roles, Resources, and privileges) work properly.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
$acl->allow();
Assert::true( $acl->isAllowed() );
Assert::true( $acl->isAllowed(NULL, NULL, 'somePrivilege') );

$acl->deny();
Assert::false( $acl->isAllowed() );
Assert::false( $acl->isAllowed(NULL, NULL, 'somePrivilege') );
