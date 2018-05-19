<?php

/**
 * Test: NDebug::dump() basic types in HTML and text mode.
 *
 * @author     David Grudl
 * @package    Nette
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



NDebug::$productionMode = FALSE;



class Test
{
	public $x = array(10, NULL);

	private $y = 'hello';

	protected $z = 30;
}


// HTML mode

NDebug::$consoleMode = FALSE;

Assert::match( '<pre class="nette-dump">NULL
</pre>', NDebug::dump(NULL, TRUE) );

Assert::match( '<pre class="nette-dump">TRUE
</pre>', NDebug::dump(TRUE, TRUE) );

Assert::match( '<pre class="nette-dump">FALSE
</pre>', NDebug::dump(FALSE, TRUE) );

Assert::match( '<pre class="nette-dump">0
</pre>', NDebug::dump(0, TRUE) );

Assert::match( '<pre class="nette-dump">1
</pre>', NDebug::dump(1, TRUE) );

Assert::match( '<pre class="nette-dump">0.0
</pre>', NDebug::dump(0.0, TRUE) );

Assert::match( '<pre class="nette-dump">0.1
</pre>', NDebug::dump(0.1, TRUE) );

Assert::match( '<pre class="nette-dump">""
</pre>', NDebug::dump('', TRUE) );

Assert::match( '<pre class="nette-dump">"0"
</pre>', NDebug::dump('0', TRUE) );

Assert::match( '<pre class="nette-dump">"\\x00"
</pre>', NDebug::dump("\x00", TRUE) );

Assert::match( '<pre class="nette-dump"><span>array</span>(5) <code>[
   0 => 1
   1 => "hello" (5)
   2 => <span>array</span>(0)
   3 => <span>array</span>(2) <code>[
      0 => 1
      1 => 2
   ]</code>
   4 => <span>array</span>(2) <code>{
      1 => 1
      2 => 2
   }</code>
]</code>
</pre>
', NDebug::dump(array(1, 'hello', array(), array(1, 2), array(1 => 1, 2)), TRUE) );

Assert::match( '<pre class="nette-dump"><span>stream resource</span>
</pre>', NDebug::dump(fopen(__FILE__, 'r'), TRUE) );

Assert::match( '<pre class="nette-dump"><span>stdClass</span>(0)
</pre>', NDebug::dump((object) NULL, TRUE) );

$obj = new Test;
Assert::same(NDebug::dump($obj), $obj);


// Text mode

NDebug::$consoleMode = TRUE;

Assert::match( 'NULL', NDebug::dump(NULL, TRUE) );

Assert::match( 'TRUE', NDebug::dump(TRUE, TRUE) );

Assert::match( 'FALSE', NDebug::dump(FALSE, TRUE) );

Assert::match( '0', NDebug::dump(0, TRUE) );

Assert::match( '1', NDebug::dump(1, TRUE) );

Assert::match( '0.0', NDebug::dump(0.0, TRUE) );

Assert::match( '0.1', NDebug::dump(0.1, TRUE) );

Assert::match( '""', NDebug::dump('', TRUE) );

Assert::match( '"0"', NDebug::dump('0', TRUE) );

Assert::match( '"\\x00"', NDebug::dump("\x00", TRUE) );

Assert::match( 'array(5) [
   0 => 1
   1 => "hello" (5)
   2 => array(0)
   3 => array(2) [
      0 => 1
      1 => 2
   ]
   4 => array(2) {
      1 => 1
      2 => 2
   }
]
', NDebug::dump(array(1, 'hello', array(), array(1, 2), array(1 => 1, 2)), TRUE) );

Assert::match( 'stream resource', NDebug::dump(fopen(__FILE__, 'r'), TRUE) );

Assert::match( 'stdClass(0)', NDebug::dump((object) NULL, TRUE) );

Assert::match( 'Test(3) {
   "x" => array(2) [
      0 => 10
      1 => NULL
   ]
   "y" private => "hello" (5)
   "z" protected => 30
}
', NDebug::dump($obj, TRUE) );
