<?php

/**
 * Test: NPaginator without itemCount
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$paginator = new NPaginator;
$paginator->itemsPerPage = 6;
$paginator->base = 0;
$paginator->page = 3;

Assert::same( 3, $paginator->page );
Assert::same( NULL, $paginator->pageCount );
Assert::same( 0, $paginator->firstPage );
Assert::same( NULL, $paginator->lastPage );
Assert::same( 18, $paginator->offset );
Assert::same( NULL, $paginator->countdownOffset );
Assert::same( 6, $paginator->length );
