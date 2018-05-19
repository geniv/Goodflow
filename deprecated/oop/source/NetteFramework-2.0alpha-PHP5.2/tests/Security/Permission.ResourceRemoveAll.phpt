<?php

/**
 * Test: NPermission Ensures that removal of all Resources works.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
$acl->addResource('area');
$acl->removeAllResources();
Assert::false( $acl->hasResource('area') );
