<?php

/**
 * Test: NFinder multiple sources.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



function export($iterator)
{
	$arr = array();
	foreach ($iterator as $key => $value) $arr[] = strtr($key, '\\', '/');
	return $arr;
}



// recursive
$finder = NFinder::find('*')->from('files/subdir/subdir2', 'files/images');
Assert::same(array(
	'files/subdir/subdir2/file.txt',
	'files/images/logo.gif',
), export($finder));


$finder = NFinder::find('*')->from(array('files/subdir/subdir2', 'files/images'));
Assert::same(array(
	'files/subdir/subdir2/file.txt',
	'files/images/logo.gif',
), export($finder));

try {
	NFinder::find('*')->from('files/subdir/subdir2')->from('files/images');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', '', $e );
}



// non-recursive
$finder = NFinder::find('*')->in('files/subdir/subdir2', 'files/images');
Assert::same(array(
	'files/subdir/subdir2/file.txt',
	'files/images/logo.gif',
), export($finder));


$finder = NFinder::find('*')->in(array('files/subdir/subdir2', 'files/images'));
Assert::same(array(
	'files/subdir/subdir2/file.txt',
	'files/images/logo.gif',
), export($finder));

try {
	NFinder::find('*')->in('files/subdir/subdir2')->in('files/images');
	Assert::fail('Expected exception');
} catch (Exception $e) {
	Assert::exception('InvalidStateException', '', $e );
}
