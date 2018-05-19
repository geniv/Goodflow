<?php

/**
 * Test: NSmartCachingIterator constructor.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



// ==> array

$arr = array('Nette', 'Framework');
$tmp = array();
foreach (new NSmartCachingIterator($arr) as $k => $v) $tmp[] = "$k => $v";
Assert::same( array(
	'0 => Nette',
	'1 => Framework',
), $tmp );



// ==> stdClass

$arr = (object) array('Nette', 'Framework');
$tmp = array();
foreach (new NSmartCachingIterator($arr) as $k => $v) $tmp[] = "$k => $v";
Assert::same( array(
	'0 => Nette',
	'1 => Framework',
), $tmp );



// ==> IteratorAggregate

$arr = new ArrayObject(array('Nette', 'Framework'));
$tmp = array();
foreach (new NSmartCachingIterator($arr) as $k => $v) $tmp[] = "$k => $v";
Assert::same( array(
	'0 => Nette',
	'1 => Framework',
), $tmp );



// ==> Iterator

$tmp = array();
foreach (new NSmartCachingIterator($arr->getIterator()) as $k => $v) $tmp[] = "$k => $v";
Assert::same( array(
	'0 => Nette',
	'1 => Framework',
), $tmp );



// ==> SimpleXMLElement

$arr = new SimpleXMLElement('<feed><item>Nette</item><item>Framework</item></feed>');
$tmp = array();
foreach (new NSmartCachingIterator($arr) as $k => $v) $tmp[] = "$k => $v";
Assert::same( array(
	'item => Nette',
	'item => Framework',
), $tmp );



// ==> object

try {
	$arr = dir('.');
	foreach (new NSmartCachingIterator($arr) as $k => $v);
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidArgumentException', NULL, $e );
}
