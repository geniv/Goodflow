<?php

/**
 * Test: NSimpleRouter and modules.
 *
 * @author     David Grudl
 * @package    Nette\Application
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



$router = new NSimpleRouter(array(
	'module' => 'main:sub',
));

$uri = new NUriScript('http://nette.org/file.php');
$uri->setScriptPath('/file.php');
$uri->setQuery(array(
	'presenter' => 'myPresenter',
));
$httpRequest = new NHttpRequest($uri);

$req = $router->match($httpRequest);
Assert::same( 'main:sub:myPresenter',  $req->getPresenterName() );

$url = $router->constructUrl($req, $httpRequest->uri);
Assert::same( 'http://nette.org/file.php?presenter=myPresenter',  $url );

$req = new NPresenterRequest(
	'othermodule:presenter',
	NHttpRequest::GET,
	array()
);
$url = $router->constructUrl($req, $httpRequest->uri);
Assert::null( $url );
