<?php

/**
 * Test: NRoute with WithAbsolutePath
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Route.inc';



$route = new NRoute('/<abspath>/', array(
	'presenter' => 'Default',
	'action' => 'default',
));

testRouteIn($route, '/abc', 'Default', array(
	'abspath' => 'abc',
	'action' => 'default',
	'test' => 'testvalue',
), '/abc/?test=testvalue');
