<?php

/**
 * Test: NPermission Ensures that removal of all Roles works.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
$acl->addRole('guest');
$acl->removeAllRoles();
Assert::false( $acl->hasRole('guest') );
