<?php

/**
 * Test: NEnvironment configuration.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



class Factory
{
	static function createService($options)
	{
		TestHelpers::note( 'Factory::createService', __METHOD__ );
		Assert::same( array('anyValue' => 'hello world'), $options );
		return (object) NULL;
	}
}

NEnvironment::setName(NEnvironment::PRODUCTION);
NEnvironment::loadConfig('config.ini');
Assert::same(array('Factory::createService'), TestHelpers::fetchNotes());

Assert::same( 'hello world', NEnvironment::getVariable('foo') );

Assert::same( 'hello world', constant('HELLO_WORLD') );

Assert::same( array(
	'mbstring-internal_encoding' => 'UTF-8',
	'date.timezone' => 'Europe/Prague',
	'iconv.internal_encoding' => 'UTF-8',
), NEnvironment::getConfig('php')->toArray() );

Assert::same( array(
	'adapter' => 'pdo_mysql',
	'params' => array(
		'host' => 'db.example.com',
		'username' => 'dbuser',
		'password' => 'secret',
		'dbname' => 'dbname',
	),
), NEnvironment::getConfig('database')->toArray() );

Assert::true( NEnvironment::isProduction() );
