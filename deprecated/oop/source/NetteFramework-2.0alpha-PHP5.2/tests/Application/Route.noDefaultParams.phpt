<?php

/**
 * Test: NRoute with NoDefaultParams
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Route.inc';



$route = new NRoute('<presenter>/<action>/<extra>', array(
));

testRouteIn($route, '/presenter/action/12', 'Presenter', array(
	'action' => 'action',
	'extra' => '12',
	'test' => 'testvalue',
), NULL);
