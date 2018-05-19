<?php

/**
 * Test: NTemplateFilters::removePhp()
 *
 * @author     David Grudl
 * @package    Nette\Templates
 * @subpackage UnitTests
 */

require dirname(__FILE__) . '/../bootstrap.php';

require dirname(__FILE__) . '/Template.inc';



$template = new MockTemplate;
$template->registerFilter(array('NTemplateFilters', 'removePhp'));

Assert::match(<<<EOD
Hello World!

<?php doEvil(); ?>
EOD

, $template->render(<<<EOD
Hello<?php echo '?>hacked!'; ?> World!

<<?php ?>?php doEvil(); ?>

EOD
));
