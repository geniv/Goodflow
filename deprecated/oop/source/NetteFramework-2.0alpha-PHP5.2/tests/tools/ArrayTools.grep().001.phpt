<?php

/**
 * Test: NArrayTools::grep()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( array(
	1 => '1',
), NArrayTools::grep(array('a', '1', 'c'), '#\d#') );

Assert::same( array(
	0 => 'a',
	2 => 'c',
), NArrayTools::grep(array('a', '1', 'c'), '#\d#', PREG_GREP_INVERT) );
