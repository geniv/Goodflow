<?php

/**
 * Test: NUriScript parse.
 *
 * @author     David Grudl
 * @package    Nette\Web
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$uri = new NUriScript('http://nette.org:8080/file.php?q=search');
Assert::same( '/', $uri->scriptPath );
Assert::same( 'http://nette.org:8080/',  $uri->baseUri );
Assert::same( '/', $uri->basePath );
Assert::same( 'file.php?q=search',  $uri->relativeUri );
Assert::same( 'file.php',  $uri->pathInfo );
