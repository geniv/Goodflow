<?php

/**
 * Test: NFileJournal basic test.
 *
 * @author     David Grudl
 * @package    Nette\Caching
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



// temporary directory
define('TEMP_DIR', dirname(__FILE__) . '/tmp');
TestHelpers::purge(TEMP_DIR);



function test($result, $condition, $name)
{
	Assert::true($condition, $name . ($condition === TRUE ? '' : 'Count: ' . count($result)));
}



$journal = new NFileJournal(TEMP_DIR);

$journal->write('ok_test1', array(
	NCache::TAGS => array('test:homepage'),
));

$result = $journal->clean(array(NCache::TAGS => array('test:homepage')));
test($result, (count($result) === 1 and $result[0] === 'ok_test1'), 'One tag');

$journal->write('ok_test2', array(
	NCache::TAGS => array('test:homepage', 'test:homepage2'),
));

$result = $journal->clean(array(NCache::TAGS => array('test:homepage2')));
test($result, (count($result) === 1 and $result[0] === 'ok_test2'), 'Two tags');

$journal->write('ok_test2b', array(
	NCache::TAGS => array('test:homepage', 'test:homepage2'),
));

$result = $journal->clean(array(NCache::TAGS => array('test:homepage', 'test:homepage2')));
test($result, (count($result) === 1 and $result[0] === 'ok_test2b'), 'Two tags b');

$journal->write('ok_test2c', array(
	NCache::TAGS => array('test:homepage', 'test:homepage'),
));

$result = $journal->clean(array(NCache::TAGS => array('test:homepage', 'test:homepage')));
test($result, (count($result) === 1 and $result[0] === 'ok_test2c'), 'Two same tags');

$journal->write('ok_test2d', array(
	NCache::TAGS => array('test:homepage'),
	NCache::PRIORITY => 15,
));

$result = $journal->clean(array(NCache::TAGS => array('test:homepage'), NCache::PRIORITY => 20));
test($result, (count($result) === 1 and $result[0] === 'ok_test2d'), 'Tag and priority');

$journal->write('ok_test3', array(
	NCache::PRIORITY => 10,
));

$result = $journal->clean(array(NCache::PRIORITY => 10));
test($result, (count($result) === 1 and $result[0] === 'ok_test3'), 'Priority only');

$journal->write('ok_test4', array(
	NCache::TAGS => array('test:homepage'),
	NCache::PRIORITY => 10,
));

$result = $journal->clean(array(NCache::TAGS => array('test:homepage')));
test($result, (count($result) === 1 and $result[0] === 'ok_test4'), 'Priority and tag (clean by tag)');

$journal->write('ok_test5', array(
	NCache::TAGS => array('test:homepage'),
	NCache::PRIORITY => 10,
));

$result = $journal->clean(array(NCache::PRIORITY => 10));
test($result, (count($result) === 1 and $result[0] === 'ok_test5'), 'Priority and tag (clean by priority)');

for ($i=1;$i<=10;$i++) {
	$journal->write('ok_test6_'.$i,
	 array(
			NCache::TAGS => array('test:homepage', 'test:homepage/'.$i),
			NCache::PRIORITY => $i,
		));
}

$result = $journal->clean(array(NCache::PRIORITY => 5));
test($result, (count($result) === 5 and $result[0] === 'ok_test6_1'), '10 writes, clean priority lower then 5');

$result = $journal->clean(array(NCache::TAGS => array('test:homepage/7')));
test($result, (count($result) === 1 and $result[0] === 'ok_test6_7'), '10 writes, clean tag homepage/7');

$result = $journal->clean(array(NCache::TAGS => array('test:homepage/4')));
test($result, (count($result) === 0), '10 writes, clean non exists tag');

$result = $journal->clean(array(NCache::PRIORITY => 4));
test($result, (count($result) === 0), '10 writes, clean non exists priority');

$result = $journal->clean(array(NCache::TAGS => array('test:homepage')));
test($result, (count($result) === 4 and $result[0] === 'ok_test6_6'), '10 writes, clean other');

$journal->write('ok_test7ščřžýáíé', array(
	NCache::TAGS => array('čšřýýá', 'ýřžčýž/'.$i)
));

$result = $journal->clean(array(NCache::TAGS => array('čšřýýá')));
test($result, (count($result) === 1 and $result[0] === 'ok_test7ščřžýáíé'), 'Special chars');

$journal->write('ok_test_a', array(
	NCache::TAGS => array('homepage')
));

$journal->write('ok_test_a', array(
	NCache::TAGS => array('homepage')
));

$result = $journal->clean(array(NCache::TAGS => array('homepage')));
test($result, (count($result) === 1 and $result[0] === 'ok_test_a'), 'Duplicates: same tags');

$journal->write('ok_test_b', array(
	NCache::PRIORITY => 12
));

$journal->write('ok_test_b', array(
	NCache::PRIORITY => 12
));

$result = $journal->clean(array(NCache::PRIORITY => 12));
test($result, (count($result) === 1 and $result[0] === 'ok_test_b'), 'Duplicates: same priority');

$journal->write('ok_test_ba', array(
	NCache::TAGS => array('homepage')
));

$journal->write('ok_test_ba', array(
	NCache::TAGS => array('homepage2')
));

$result = $journal->clean(array(NCache::TAGS => array('homepage')));
$result2 = $journal->clean(array(NCache::TAGS => array('homepage2')));
test($result, (count($result2) === 1 and count($result) === 0 and $result2[0] === 'ok_test_ba'), 'Duplicates: differenet tags');

$journal->write('ok_test_baa', array(
	NCache::TAGS => array('homepage', 'aąa')
));

$journal->write('ok_test_baa', array(
	NCache::TAGS => array('homepage2', 'aaa')
));

$result = $journal->clean(array(NCache::TAGS => array('homepage')));
$result2 = $journal->clean(array(NCache::TAGS => array('homepage2')));
test($result, (count($result2) === 1 and count($result) === 0 and $result2[0] === 'ok_test_baa'), 'Duplicates: 2 differenet tags');

$journal->write('ok_test_bb', array(
	NCache::PRIORITY => 15
));

$journal->write('ok_test_bb', array(
	NCache::PRIORITY => 20
));

$result = $journal->clean(array(NCache::PRIORITY => 30));
test($result, (count($result) === 1 and $result[0] === 'ok_test_bb'), 'Duplicates: differenet priorities');


$journal->write('ok_test_all_tags', array(
	NCache::TAGS => array('test:all', 'test:all')
));

$journal->write('ok_test_all_priority', array(
	NCache::PRIORITY => 5,
));

$result = $journal->clean(array(NCache::ALL => TRUE));
$result2 = $journal->clean(array(NCache::TAGS => 'test:all'));
test($result, ($result === NULL and empty($result2)), 'Clean ALL');
