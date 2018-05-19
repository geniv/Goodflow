<?php

/**
 * Test: NRoute UTF-8 parameter.
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Route.inc';



$route = new NRoute('<param č>', array(
	'presenter' => 'Default',
));

testRouteIn($route, '/č', 'Default', array(
	'param' => 'č',
	'test' => 'testvalue',
), '/%C4%8D?test=testvalue');

testRouteIn($route, '/%C4%8D');

testRouteIn($route, '/');
