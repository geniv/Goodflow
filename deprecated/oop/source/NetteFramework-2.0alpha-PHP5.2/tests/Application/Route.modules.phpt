<?php

/**
 * Test: NRoute with Modules
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Route.inc';



$route = new NRoute('<presenter>', array(
	'module' => 'module:submodule',
));

testRouteIn($route, '/abc', 'module:submodule:Abc', array(
	'test' => 'testvalue',
), '/abc?test=testvalue');

testRouteIn($route, '/');
Assert::null( testRouteOut($route, 'Homepage') );
Assert::null( testRouteOut($route, 'Module:Homepage') );
Assert::same( 'http://example.com/homepage', testRouteOut($route, 'Module:Submodule:Homepage') );



$route = new NRoute('<presenter>', array(
	'module' => 'Module:Submodule',
	'presenter' => 'Default',
));

testRouteIn($route, '/', 'Module:Submodule:Default', array(
	'test' => 'testvalue',
), '/?test=testvalue');

Assert::null( testRouteOut($route, 'Homepage') );
Assert::null( testRouteOut($route, 'Module:Homepage') );
Assert::same( 'http://example.com/homepage', testRouteOut($route, 'Module:Submodule:Homepage') );



$route = new NRoute('<module>/<presenter>', array(
	'presenter' => 'AnyDefault',
));

testRouteIn($route, '/module.submodule', 'Module:Submodule:AnyDefault', array(
	'test' => 'testvalue',
), '/module.submodule/?test=testvalue');

Assert::null( testRouteOut($route, 'Homepage') );
Assert::same( 'http://example.com/module/homepage', testRouteOut($route, 'Module:Homepage') );
Assert::same( 'http://example.com/module.submodule/homepage', testRouteOut($route, 'Module:Submodule:Homepage') );



$route = new NRoute('<module>/<presenter>', array(
	'module' => 'Module:Submodule',
	'presenter' => 'Default',
));

testRouteIn($route, '/module.submodule', 'Module:Submodule:Default', array(
	'test' => 'testvalue',
), '/?test=testvalue');

Assert::null( testRouteOut($route, 'Homepage') );
Assert::same( 'http://example.com/module/homepage', testRouteOut($route, 'Module:Homepage') );
Assert::same( 'http://example.com/module.submodule/homepage', testRouteOut($route, 'Module:Submodule:Homepage') );