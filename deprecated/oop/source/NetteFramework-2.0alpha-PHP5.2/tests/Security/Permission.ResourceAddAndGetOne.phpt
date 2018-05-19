<?php

/**
 * Test: NPermission Ensures that basic addition and retrieval of a single Resource works.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
Assert::false( $acl->hasResource('area') );

$acl->addResource('area');
Assert::true( $acl->hasResource('area') );

$acl->removeResource('area');
Assert::false( $acl->hasResource('area') );
