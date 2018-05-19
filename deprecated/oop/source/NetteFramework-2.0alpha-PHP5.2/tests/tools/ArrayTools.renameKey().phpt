<?php

/**
 * Test: NArrayTools::renameKey()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$arr  = array(
	NULL => 'first',
	FALSE => 'second',
	1 => 'third',
	7 => 'fourth'
);

Assert::same( array(
	'' => 'first',
	0 => 'second',
	1 => 'third',
	7 => 'fourth',
), $arr );


NArrayTools::renameKey($arr, '1', 'new1');
NArrayTools::renameKey($arr, 0, 'new2');
NArrayTools::renameKey($arr, NULL, 'new3');
NArrayTools::renameKey($arr, '', 'new4');
NArrayTools::renameKey($arr, 'undefined', 'new5');

Assert::same( array(
	'new3' => 'first',
	'new2' => 'second',
	'new1' => 'third',
	7 => 'fourth',
), $arr );
