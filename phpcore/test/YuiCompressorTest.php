<?php
namespace classes;

/**
 * phpunit-skelgen --bootstrap ../loader.php --test -- "classes\YuiCompressor" yuicompressor.php
 * mv -v YuiCompressorTest.php ../test/
 */

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-01-05 at 11:23:21.
 */
class YuiCompressorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var YuiCompressor
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new YuiCompressor;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers classes\YuiCompressor::convertJS
     * @todo   Implement testConvertJS().
     */
    public function testConvertJS()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers classes\YuiCompressor::convertCSS
     * @todo   Implement testConvertCSS().
     */
    public function testConvertCSS()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
