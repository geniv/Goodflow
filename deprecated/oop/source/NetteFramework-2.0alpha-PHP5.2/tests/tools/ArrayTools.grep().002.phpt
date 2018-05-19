<?php

/**
 * Test: NArrayTools::grep() errors.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



try {
	NArrayTools::grep(array('a', '1', 'c'), '#*#');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'preg_grep(): Compilation failed: nothing to repeat at offset 0 in pattern: #*#', $e );
}


try {
	NArrayTools::grep(array('a', "1\xFF", 'c'), '#\d#u');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('NRegexpException', 'Malformed UTF-8 data (pattern: #\d#u)', $e );
}
