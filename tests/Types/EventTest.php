<?php
namespace Veksa\Carrot\Tests\Types;

use Veksa\Carrot\Types\Event;
use Veksa\Carrot\Types\EventType;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testSetId()
    {
        $item = new Event;
        $item->id = 1;
        $this->assertAttributeEquals(1, 'id', $item);
    }

    public function testGetId()
    {
        $item = new Event;
        $item->id = 1;
        $this->assertEquals(1, $item->id);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetIdException()
    {
        $item = new Event;
        $item->id = 's';
    }

    public function testSetCreated()
    {
        $item = new Event;
        $item->created = 159456;
        $this->assertAttributeEquals(159456, 'created', $item);
    }

    public function testGetCreated()
    {
        $item = new Event;
        $item->created = 159456;
        $this->assertEquals(159456, $item->created);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetCreatedException()
    {
        $item = new Event;
        $item->created = 's';
    }

    public function testSetType()
    {
        $item = new Event;
        $type = EventType::fromResponse(array(
            'id' => 1
        ));
        $item->type = $type;
        $this->assertAttributeEquals($type, 'type', $item);
    }

    public function testGetType()
    {
        $item = new Event;
        $type = EventType::fromResponse(array(
            'id' => 1
        ));
        $item->type = $type;
        $this->assertInstanceOf(EventType::class, $item->type);
        $this->assertEquals($type, $item->type);
    }

    public function testSetProps()
    {
        $item = new Event;
        $item->props = array('prop1' => 'value1');
        $this->assertAttributeEquals(array('prop1' => 'value1'), 'props', $item);
    }

    public function testGetProps()
    {
        $item = new Event;
        $item->props = array('prop1' => 'value1');
        $this->assertEquals(array('prop1' => 'value1'), $item->props);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetPropsException()
    {
        $item = new Event;
        $item->props = 's';
    }
}
