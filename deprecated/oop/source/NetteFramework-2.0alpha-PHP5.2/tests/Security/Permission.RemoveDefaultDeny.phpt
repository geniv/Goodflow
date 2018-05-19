<?php

/**
 * Test: NPermission Ensures that removing the default deny rule results in default deny rule.
 *
 * @author     David Grudl
 * @package    Nette\Security
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$acl = new NPermission;
Assert::false( $acl->isAllowed() );
$acl->removeDeny();
Assert::false( $acl->isAllowed() );
