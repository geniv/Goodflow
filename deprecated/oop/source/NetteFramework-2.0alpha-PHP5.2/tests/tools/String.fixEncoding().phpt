<?php

/**
 * Test: NString::fixEncoding()
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



Assert::same( "\xc5\xbea\x01bcde", NString::fixEncoding("\xc5\xbea\x01b\xed\xa0\x80c\xef\xbb\xbfd\xf4\x90\x80\x80e") );