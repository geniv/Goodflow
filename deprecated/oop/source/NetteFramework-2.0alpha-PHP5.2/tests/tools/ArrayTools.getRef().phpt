<?php

/**
 * Test: NArrayTools::getRef()
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

$dolly = $arr;
$item = & NArrayTools::getRef($dolly, NULL);
$item = 'changed';
Assert::same( array(
	'' => 'changed',
	1 => 'second',
	7 => array(
		'item' => 'third',
	),
), $dolly );


$dolly = $arr;
$item = & NArrayTools::getRef($dolly, 'undefined');
$item = 'changed';
Assert::same( array(
	'' => 'first',
	1 => 'second',
	7 => array(
		'item' => 'third',
	),
	'undefined' => 'changed',
), $dolly );



// Traversing

$dolly = $arr;
$item = & NArrayTools::getRef($dolly, array());
$item = 'changed';
Assert::same( 'changed', $dolly );


$dolly = $arr;
$item = & NArrayTools::getRef($dolly, array(7, 'item'));
$item = 'changed';
Assert::same( array(
	'' => 'first',
	1 => 'second',
	7 => array(
		'item' => 'changed',
	),
), $dolly );



// Error

try {
	$dolly = $arr;
	$item = & NArrayTools::getRef($dolly, array(7, 'item', 3));
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidArgumentException', 'Traversed item is not an array.', $e );
}