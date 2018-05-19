<?php

/**
 * Test: NString::match()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::null( NString::match('hello world!', '#([E-L])+#') );

Assert::same( array('hell',	'l'), NString::match('hello world!', '#([e-l])+#') );

Assert::same( array('hell'), NString::match('hello world!', '#[e-l]+#') );

Assert::same( array(array('hell', 0)), NString::match('hello world!', '#[e-l]+#', PREG_OFFSET_CAPTURE) );

Assert::same( array('ll'), NString::match('hello world!', '#[e-l]+#', NULL, 2) );
