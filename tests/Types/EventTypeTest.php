<?php
namespace Veksa\Carrot\Tests\Types;

use Veksa\Carrot\Types\EventType;

class EventTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testSetId()
    {
        $item = new EventType;
        $item->id = 1;
        $this->assertAttributeEquals(1, 'id', $item);
    }

    public function testGetId()
    {
        $item = new EventType;
        $item->id = 1;
        $this->assertEquals(1, $item->id);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetIdException()
    {
        $item = new EventType;
        $item->id = 's';
    }

    public function testSetName()
    {
        $item = new EventType;
        $item->name = 'test';
        $this->assertAttributeEquals('test', 'name', $item);
    }

    public function testGetName()
    {
        $item = new EventType;
        $item->name = 'test';
        $this->assertEquals('test', $item->name);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetNameException()
    {
        $item = new EventType;
        $item->name = array();
    }

    public function testSetScore()
    {
        $item = new EventType;
        $item->score = 999;
        $this->assertAttributeEquals(999, 'score', $item);
    }

    public function testGetScore()
    {
        $item = new EventType;
        $item->score = 999;
        $this->assertEquals(999, $item->score);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetScoreException()
    {
        $item = new EventType;
        $item->score = array();
    }
}
