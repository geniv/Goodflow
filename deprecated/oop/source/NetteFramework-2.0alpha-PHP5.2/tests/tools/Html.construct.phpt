<?php

/**
 * Test: NHtml::__construct()
 *
 * @author     David Grudl
 * @package    Nette\Web
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( '<a lang="cs" href="#" title="" selected="selected">click</a>', (string) NHtml::el('a lang=cs href="#" title="" selected')->setText('click') );
Assert::same( '<a lang="hello" world="world" href="hello world" title="hello \'world">click</a>', (string) NHtml::el('a lang=hello world href="hello world" title="hello \'world"')->setText('click') );
Assert::same( '<a lang="hello&quot; world" href="hello " world="world" title="0">click</a>', (string) NHtml::el('a lang=\'hello" world\' href="hello "world" title=0')->setText('click') );