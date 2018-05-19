<?php

/**
 * Test: NCliRouter invalid argument
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$_SERVER['argv'] = 1;
$httpRequest = new NHttpRequest(new NUriScript());

$router = new NCliRouter;
Assert::null( $router->match($httpRequest) );
