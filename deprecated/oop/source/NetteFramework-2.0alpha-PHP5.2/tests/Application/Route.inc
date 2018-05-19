<?php

/**
 * Common code for NRoute test cases.
 */



function testRouteIn(NRoute $route, $uri, $expectedPresenter=NULL, $expectedParams=NULL, $expectedUri=NULL)
{
	// ==> $uri

	$uri = new NUriScript("http://example.com$uri");
	$uri->appendQuery(array(
		'test' => 'testvalue',
		'presenter' => 'querypresenter',
	));

	$httpRequest = new NHttpRequest($uri);

	$request = $route->match($httpRequest);

	if ($request) { // matched
		$params = $request->getParams();
		//asort($params);
		Assert::same( $expectedPresenter, $request->getPresenterName() );
		Assert::same( $expectedParams, $params );

		unset($params['extra']);
		$request->setParams($params);
		$result = $route->constructUrl($request, $uri);
		$result = strncmp($result, 'http://example.com', 18) ? $result : substr($result, 18);
		Assert::same( $expectedUri, $result );

	} else { // not matched
		// not matched
		Assert::null( $expectedPresenter );
	}
}



function testRouteOut(NRoute $route, $link, $params = array())
{
	$uri = new NUri('http://example.com');
	$request = new NPresenterRequest($link, 'GET', $params);
	return $route->constructUrl($request, $uri);
}
