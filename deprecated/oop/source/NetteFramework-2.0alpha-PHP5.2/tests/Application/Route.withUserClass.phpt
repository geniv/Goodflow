<?php

/**
 * Test: NRoute with WithUserClass
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Route.inc';



NRoute::addStyle('#numeric');
NRoute::setStyleProperty('#numeric', NRoute::PATTERN, '\d{1,3}');

$route = new NRoute('<presenter>/<id #numeric>', array());

testRouteIn($route, '/presenter/12/', 'Presenter', array(
	'id' => '12',
	'test' => 'testvalue',
), '/presenter/12?test=testvalue');

testRouteIn($route, '/presenter/1234');

testRouteIn($route, '/presenter/');
