<?php

/**
 * Test: NRoute with FilterTable
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Route.inc';



NRoute::addStyle('#xlat', 'presenter');
NRoute::setStyleProperty('#xlat', NRoute::FILTER_TABLE, array(
	'produkt' => 'Product',
	'kategorie' => 'Category',
	'zakaznik' => 'Customer',
	'kosik' => 'Basket',
));

$route = new NRoute(' ? action=<presenter #xlat>', array());

testRouteIn($route, '/?action=kategorie', 'Category', array(
	'test' => 'testvalue',
), '/?test=testvalue&action=kategorie');
