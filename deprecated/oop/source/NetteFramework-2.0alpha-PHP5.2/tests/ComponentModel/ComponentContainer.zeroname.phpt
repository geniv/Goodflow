<?php

/**
 * Test: NComponentContainer and '0' name.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$container = new NComponentContainer;
$container->addComponent(new NComponentContainer, 0);
Assert::same( '0', $container->getComponent(0)->getName() );
