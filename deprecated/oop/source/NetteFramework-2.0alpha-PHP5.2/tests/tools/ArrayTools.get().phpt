<?php

/**
 * Test: NArrayTools::get()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$arr  = array(
	NULL => 'first',
	1 => 'second',
	7 => array(
		'item' => 'third',
	),
);

// Single item

Assert::same( 'first', NArrayTools::get($arr, NULL) );
Assert::same( 'second', NArrayTools::get($arr, 1) );
Assert::same( 'second', NArrayTools::get($arr, 1, 'x') );
Assert::same( 'x', NArrayTools::get($arr, 'undefined', 'x') );
Assert::null( NArrayTools::get($arr, 'undefined') );



// Traversing

Assert::same( array(
	'' => 'first',
	1 => 'second',
	7 => array(
		'item' => 'third',
	),
), NArrayTools::get($arr, array()) );


Assert::same( 'third', NArrayTools::get($arr, array(7, 'item')) );
