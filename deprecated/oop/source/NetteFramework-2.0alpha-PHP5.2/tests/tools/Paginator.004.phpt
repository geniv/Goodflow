<?php

/**
 * Test: NPaginator Base:1 test.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$paginator = new NPaginator;
$paginator->itemCount = 7;
$paginator->itemsPerPage = 6;
$paginator->base = 1;
$paginator->page = 3;

Assert::same( 2, $paginator->page );
Assert::same( 2, $paginator->pageCount );
Assert::same( 1, $paginator->firstPage );
Assert::same( 2, $paginator->lastPage );
Assert::same( 6, $paginator->offset );
Assert::same( 0, $paginator->countdownOffset );
Assert::same( 1, $paginator->length );