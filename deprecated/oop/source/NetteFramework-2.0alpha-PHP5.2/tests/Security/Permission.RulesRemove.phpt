<?php

/**
 * Test: NPermission Ensure that basic rule removal works.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
$acl->allow(NULL, NULL, array('privilege1', 'privilege2'));
Assert::false( $acl->isAllowed() );
Assert::true( $acl->isAllowed(NULL, NULL, 'privilege1') );
Assert::true( $acl->isAllowed(NULL, NULL, 'privilege2') );
$acl->removeAllow(NULL, NULL, 'privilege1');
Assert::false( $acl->isAllowed(NULL, NULL, 'privilege1') );
Assert::true( $acl->isAllowed(NULL, NULL, 'privilege2') );
