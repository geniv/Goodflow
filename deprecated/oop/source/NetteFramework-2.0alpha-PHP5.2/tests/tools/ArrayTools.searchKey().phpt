<?php

/**
 * Test: NArrayTools::searchKey()
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


Assert::same( 2, NArrayTools::searchKey($arr, '1') );
Assert::same( 2, NArrayTools::searchKey($arr, 1) );
Assert::same( 1, NArrayTools::searchKey($arr, 0) );
Assert::same( 0, NArrayTools::searchKey($arr, NULL) );
Assert::same( 0, NArrayTools::searchKey($arr, '') );
Assert::false( NArrayTools::searchKey($arr, 'undefined') );
