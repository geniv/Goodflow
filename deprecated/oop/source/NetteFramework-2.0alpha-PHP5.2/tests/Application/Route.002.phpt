<?php

/**
 * Test: NRoute default usage.
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Route.inc';



$route = new NRoute('index.php', array(
	'action' => 'default',
));

testRouteIn($route, '/index.php', 'querypresenter', array(
	'action' => 'default',
	'test' => 'testvalue',
), '/index.php?test=testvalue&presenter=querypresenter');

testRouteIn($route, '/');
