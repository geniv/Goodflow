<?php
namespace classes;

/**
 * phpunit-skelgen --test -- "classes\DateAndTime" dateandtime.php
 * mv -v DateAndTimeTest.php ../test/
 * phpunit --bootstrap ../classes/dateandtime.php DateAndTimeTest
 */

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-09-25 at 14:25:35.
 */
class DateAndTimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DateAndTime
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        //$this->object = new DateAndTime;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers DateAndTime::from
     */
    public function testFrom()
    {
        $this->assertEquals(date('Y-m-d H:i:s', strtotime('+5 day')), DateAndTime::from('+5 day'));

        DateAndTime::setDateTimezone('Europe/Berlin');
        $this->assertEquals('Europe/Berlin', DateAndTime::getDateTimezone());

        $this->assertEquals(date('Y-m-d H:i:s', strtotime('+5 day +2 hour')), DateAndTime::from('+5 day +2 hour'));
        $this->assertEquals(date('d.m.Y H:i:s', strtotime('+5 day +2 hour')), DateAndTime::from('+5 day +2 hour')->format('d.m.Y H:i:s'));
    }

    /**
     * @covers DateAndTime::different
     */
    public function testDifferent()
    {
        $diff = DateAndTime::different('-5 days');
        $this->assertEquals(5, $diff->days);
        $this->assertEquals(5, $diff->d);
        $this->assertEquals(5, $diff->format('%d'));
        $this->assertEquals(5, $diff->format('%a'));

        $diff = DateAndTime::different('-5 days', '+10 days');
        $this->assertEquals(15, $diff->days);
        $this->assertEquals(15, $diff->d);
        $this->assertEquals(15, $diff->format('%d'));
        $this->assertEquals(15, $diff->format('%a'));
    }

    /**
     * @covers DateAndTime::__toString
     */
    public function test__toString()
    {
        $d = new DateAndTime('now');
        $this->assertEquals(date('Y-m-d H:i:s'), $d);
    }

    /**
     * @covers DateAndTime::modilyClone
     */
    public function testModilyClone()
    {
        $d = new DateAndTime('now');
        $this->assertEquals(date('Y-m-d H:i:s', strtotime('+2 day')), $d->modilyClone('+2 day'));
    }

    /**
     * @covers DateAndTime::different
     * @covers DateAndTime::toSeconds
     */
    public function testToSeconds()
    {
        $diff = DateAndTime::different('+50 seconds');
        $this->assertEquals(50, DateAndTime::toSeconds($diff));

        $diff = DateAndTime::different('+123254 seconds');
        $this->assertEquals(123254, DateAndTime::toSeconds($diff));

        $diff = DateAndTime::different('1 year 4 month 19 days 15 hours 43 minutes 10 seconds');
        $this->assertEquals(43602190, DateAndTime::toSeconds($diff));
    }

    /**
     * @covers DateAndTime::different
     * @covers DateAndTime::toSeconds
     * @covers DateAndTime::toHours
     */
    public function testToHours()
    {
        $diff = DateAndTime::different('1 year 4 month 19 days 15 hours 43 minutes 10 seconds');
        $hours = DateAndTime::toHours(DateAndTime::toSeconds($diff));
        $this->assertEquals(12111.72, $hours);
    }

    /**
     * @covers DateAndTime::different
     * @covers DateAndTime::toSeconds
     * @covers DateAndTime::toHours
     * @covers DateAndTime::correct
     */
    public function testCorrect()
    {
        $diff = DateAndTime::different('1 year 4 month 19 days 15 hours 43 minutes 10 seconds');
        $hours = DateAndTime::toHours(DateAndTime::toSeconds($diff));
        $this->assertEquals(12111.72, $hours);
        $this->assertEquals(12111.43, DateAndTime::correct($hours));
    }
}