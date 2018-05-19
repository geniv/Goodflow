<?php

/**
 * Test: NString::replace()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



class Test
{
	static function cb() {
		return '@';
	}
}

Assert::same( 'hello world!', NString::replace('hello world!', '#([E-L])+#', '#') );
Assert::same( '#o wor#d!', NString::replace('hello world!', '#([e-l])+#', '#') );
Assert::same( '@o wor@d!', NString::replace('hello world!', '#[e-l]+#', callback('Test::cb')) );
Assert::same( '@o wor@d!', NString::replace('hello world!', '#[e-l]+#', array('Test', 'cb')) );
Assert::same( '#@ @@@#d!', NString::replace('hello world!', array(
	'#([e-l])+#' => '#',
	'#[o-w]#' => '@',
)) );
