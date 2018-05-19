<?php

/**
 * Test: NTemplateFilters::texyElements()
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Template.inc';



class MockTexy
{
	function process($text, $singleLine = FALSE)
	{
		return '<...>';
	}
}


NTemplateFilters::$texy = new MockTexy;

$template = new MockTemplate;
$template->registerFilter(array('NTemplateFilters', 'texyElements'));

Assert::match(<<<EOD
<...>


<...>


<...>
EOD

, $template->render(<<<EOD
<texy>**Hello World**</texy>


<texy>
Multi line
----------

example
</texy>


<texy param="value">
Second multi line
-----------------

example
</texy>
EOD
));
