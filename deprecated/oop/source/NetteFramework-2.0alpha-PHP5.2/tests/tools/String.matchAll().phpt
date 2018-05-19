<?php

/**
 * Test: NString::matchAll()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( array(), NString::matchAll('hello world!', '#([E-L])+#') );

Assert::same( array(
	array('hell', 'l'),
	array('l', 'l'),
), NString::matchAll('hello world!', '#([e-l])+#') );

Assert::same( array(
	array('hell'),
	array('l'),
), NString::matchAll('hello world!', '#[e-l]+#') );

Assert::same( array(
	array(
		array('hell', 0),
	),
	array(
		array('l', 9),
	),
), NString::matchAll('hello world!', '#[e-l]+#', PREG_OFFSET_CAPTURE) );

Assert::same( array(array('ll',	'l')), NString::matchAll('hello world!', '#[e-l]+#', PREG_PATTERN_ORDER, 2) );
