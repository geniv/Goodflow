<?php

/**
 * Test: NPermission Ensures that basic addition and retrieval of a single Role works.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
Assert::false( $acl->hasRole('guest') );

$acl->addRole('guest');
Assert::true( $acl->hasRole('guest') );

$acl->removeRole('guest');
Assert::false( $acl->hasRole('guest') );
