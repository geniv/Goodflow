<?php

/**
 * Test: NPaginator Base:0 Page:-1 Count:-1 test.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$paginator = new NPaginator;
$paginator->itemCount = -1;
$paginator->itemsPerPage = 7;
$paginator->base = 0;
$paginator->page = -1;

Assert::same( 0, $paginator->page );
Assert::same( 0, $paginator->pageCount );
Assert::same( 0, $paginator->firstPage );
Assert::same( 0, $paginator->lastPage );
Assert::same( 0, $paginator->offset );
Assert::same( 0, $paginator->countdownOffset );
Assert::same( 0, $paginator->length );
