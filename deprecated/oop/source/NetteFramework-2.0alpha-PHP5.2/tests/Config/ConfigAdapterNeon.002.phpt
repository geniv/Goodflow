<?php

/**
 * Test: NConfigAdapterNeon section.
 *
 * @author     David Grudl
 * @package    Nette\Config
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$config = NConfig::fromFile('config1.neon', 'development');
Assert::equal( new NConfig(array(
	'database' => new NConfig(array(
		'params' => new NConfig(array(
			'host' => 'dev.example.com',
			'username' => 'devuser',
			'password' => 'devsecret',
			'dbname' => 'dbname',
		)),
		'adapter' => 'pdo_mysql',
	)),
	'timeout' => '10',
	'display_errors' => '1',
	'html_errors' => '',
	'items' => new NConfig(array(
		'0' => '10',
		'1' => '20',
	)),
	'webname' => 'the example',
)), $config );
