<?php

/**
 * Test: NEnvironment services.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( 'NHttpResponse', NEnvironment::getHttpResponse()->reflection->name );


Assert::same( 'NApplication', NEnvironment::getApplication()->reflection->name );


NEnvironment::setVariable('tempDir', dirname(__FILE__) . '/tmp');
Assert::same( 'NCache', NEnvironment::getCache('my')->reflection->name );


/* in PHP 5.3
NEnvironment::setServiceAlias('IUser', 'xyz');
Assert::same('xyz', NEnvironment::getXyz()->reflection->name );
*/
