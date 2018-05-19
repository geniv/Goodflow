<?php

/**
 * Test: NString::split()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( array(
	'a',
	',',
	'b',
	',',
	'c',
), NString::split('a, b, c', '#(,)\s*#') );

Assert::same( array(
	'a',
	',',
	'b',
	',',
	'c',
), NString::split('a, b, c', '#(,)\s*#', PREG_SPLIT_NO_EMPTY) );
