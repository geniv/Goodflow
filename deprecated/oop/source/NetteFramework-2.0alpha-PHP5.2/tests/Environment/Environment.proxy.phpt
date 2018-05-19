<?php

/**
 * Test: NEnvironment proxy.
 *
 * @author     Jakub Vrana
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';
$configurator = new NConfigurator;



$_SERVER["SERVER_ADDR"] = "192.0.32.10";
Assert::true( $configurator->detect('production'), 'Is production mode?' );



$_SERVER["SERVER_ADDR"] = "127.0.0.1";
Assert::false( $configurator->detect('production'), 'Is production mode without proxy?' );



$_SERVER["HTTP_X_FORWARDED_FOR"] = "192.0.32.10";
Assert::true( $configurator->detect('production'), 'Is production mode with proxy?' );



$_SERVER["HTTP_X_FORWARDED_FOR"] = "127.0.0.1";
Assert::false( $configurator->detect('production'), 'Is production mode with local proxy?' );
