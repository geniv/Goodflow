<?php

/**
 * Test: NPaginator Base:0 Page:-1 PerPage:7 test.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$paginator = new NPaginator;
$paginator->itemCount = 7;
$paginator->itemsPerPage = 7;
$paginator->base = 0;
$paginator->page = -1;

Assert::same( 0, $paginator->page );
Assert::same( 1, $paginator->pageCount );
Assert::same( 0, $paginator->firstPage );
Assert::same( 0, $paginator->lastPage );
Assert::same( 0, $paginator->offset );
Assert::same( 0, $paginator->countdownOffset );
Assert::same( 7, $paginator->length );
