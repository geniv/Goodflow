<?php

/**
 * Test: Annotations file parser.
 *
 * @author     David Grudl
 * @package    Nette\Reflection
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/files/annotations.php';



// temporary directory
define('TEMP_DIR', dirname(__FILE__) . '/tmp');
TestHelpers::purge(TEMP_DIR);


NAnnotationsParser::$useReflection = FALSE;


// AnnotatedClass1

$rc = new ReflectionClass('AnnotatedClass1');
Assert::same( array(
	'author' => array('john'),
), NAnnotationsParser::getAll($rc) );

Assert::same( array(
	'var' => array('a'),
), NAnnotationsParser::getAll($rc->getProperty('a')), '$a' );

Assert::same( array(
	'var' => array('b'),
), NAnnotationsParser::getAll($rc->getProperty('b')), '$b' );

Assert::same( array(
	'var' => array('c'),
), NAnnotationsParser::getAll($rc->getProperty('c')), '$c' );

Assert::same( array(
	'var' => array('d'),
), NAnnotationsParser::getAll($rc->getProperty('d')), '$d' );

Assert::same( array(
	'var' => array('e'),
), NAnnotationsParser::getAll($rc->getProperty('e')), '$e' );

Assert::same( array(), NAnnotationsParser::getAll($rc->getProperty('f')), '$f' );

// NAnnotationsParser::getAll($rc->getProperty('g')), '$g' ); // ignore due PHP bug #50174
Assert::same( array(
	'return' => array('a'),
), NAnnotationsParser::getAll($rc->getMethod('a')), 'a()' );

Assert::same( array(
	'return' => array('b'),
), NAnnotationsParser::getAll($rc->getMethod('b')), 'b()' );

Assert::same( array(
	'return' => array('c'),
), NAnnotationsParser::getAll($rc->getMethod('c')), 'c()' );

Assert::same( array(
	'return' => array('d'),
), NAnnotationsParser::getAll($rc->getMethod('d')), 'd()' );

Assert::same( array(
	'return' => array('e'),
), NAnnotationsParser::getAll($rc->getMethod('e')), 'e()' );

Assert::same( array(), NAnnotationsParser::getAll($rc->getMethod('f')), 'f()' );

Assert::same( array(
	'return' => array('g'),
), NAnnotationsParser::getAll($rc->getMethod('g')), 'g()' );


// AnnotatedClass2

$rc = new ReflectionClass('AnnotatedClass2');
Assert::same( array(
	'author' => array('jack'),
), NAnnotationsParser::getAll($rc) );


// AnnotatedClass3

$rc = new ReflectionClass('AnnotatedClass3');
Assert::same( array(), NAnnotationsParser::getAll($rc) );
