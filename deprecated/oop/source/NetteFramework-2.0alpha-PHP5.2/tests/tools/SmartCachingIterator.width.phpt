<?php

/**
 * Test: NSmartCachingIterator width.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$arr = array('The', 'Nette', 'Framework');

$iterator = new NSmartCachingIterator($arr);
$iterator->rewind();

$iterator->rewind();
Assert::true( $iterator->valid() );
Assert::true( $iterator->isFirst(0) );
Assert::false( $iterator->isLast(0) );
Assert::true( $iterator->isFirst(1) );
Assert::true( $iterator->isLast(1) );
Assert::true( $iterator->isFirst(2) );
Assert::false( $iterator->isLast(2) );

$iterator->next();
Assert::true( $iterator->valid() );
Assert::false( $iterator->isFirst(0) );
Assert::false( $iterator->isLast(0) );
Assert::true( $iterator->isFirst(1) );
Assert::true( $iterator->isLast(1) );
Assert::false( $iterator->isFirst(2) );
Assert::true( $iterator->isLast(2) );

$iterator->next();
Assert::true( $iterator->valid() );
Assert::false( $iterator->isFirst(0) );
Assert::true( $iterator->isLast(0) );
Assert::true( $iterator->isFirst(1) );
Assert::true( $iterator->isLast(1) );
Assert::true( $iterator->isFirst(2) );
Assert::true( $iterator->isLast(2) );

$iterator->next();
Assert::false( $iterator->valid() );


$iterator = new NSmartCachingIterator(array());
Assert::same( FALSE,  $iterator->isFirst(0) );
Assert::same( TRUE,  $iterator->isLast(0) );
Assert::same( FALSE,  $iterator->isFirst(1) );
Assert::same( TRUE,  $iterator->isLast(1) );
Assert::same( FALSE,  $iterator->isFirst(2) );
Assert::same( TRUE,  $iterator->isLast(2) );