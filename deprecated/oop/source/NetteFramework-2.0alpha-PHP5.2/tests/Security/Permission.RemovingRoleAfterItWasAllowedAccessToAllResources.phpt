<?php

/**
 * Test: NPermission Confirm that deleting a role after allowing access to all roles
 * raise undefined index error.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
$acl->addRole('test0');
$acl->addRole('test1');
$acl->addRole('test2');
$acl->addResource('Test');

$acl->allow(NULL,'Test','xxx');

// error test
$acl->removeRole('test0');

// Check after fix
Assert::false( $acl->hasRole('test0') );