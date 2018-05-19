<?php

/**
 * Test: NTemplateFilters::netteLinks()
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 */

require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Template.inc';



class MockPresenterComponent extends NPresenterComponent
{
	function link($destination, $args = array())
	{
		$args = http_build_query($args);
		return "LINK($destination $args)";
	}

}



$template = new MockTemplate;
$template->registerFilter(array('NTemplateFilters', 'netteLinks'));
$template->registerHelper('escape', 'NTemplateHelpers::escapeHtml');
$template->control = new MockPresenterComponent;

Assert::match(<<<EOD
<a href="LINK(action?id=10 )">link</a>

<a href="LINK(this! )">link</a>

<a href="LINK(this! )#fragment">link</a>

<a href='LINK(this! )'>link</a>

<a href='LINK(this! )#fragment'>link</a>
EOD

, $template->render(<<<EOD
<a href="nette:action?id=10">link</a>

<a href="nette:">link</a>

<a href="nette:#fragment">link</a>

<a href='nette:'>link</a>

<a href='nette:#fragment'>link</a>
EOD
));
