<?php

/**
 * Test: NPermission Ensures that ACL-wide rules apply to privileges for a particular Role.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
$acl->addRole('guest');
$acl->allow('guest');
Assert::true( $acl->isAllowed('guest', NULL, 'somePrivilege') );
$acl->deny('guest');
Assert::false( $acl->isAllowed('guest', NULL, 'somePrivilege') );
