<?php
namespace Veksa\Carrot\Tests\Types;

use Veksa\Carrot\Types\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testSetAppId()
    {
        $item = new User;
        $item->appId = 1;
        $this->assertAttributeEquals(1, 'appId', $item);
    }

    public function testGetApp()
    {
        $item = new User;
        $item->appId = 1;
        $this->assertEquals(1, $item->appId);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetAppException()
    {
        $item = new User;
        $item->appId = 's';
    }

    public function testSetId()
    {
        $item = new User;
        $item->id = 1;
        $this->assertAttributeEquals(1, 'id', $item);
    }

    public function testGetId()
    {
        $item = new User;
        $item->id = 1;
        $this->assertEquals(1, $item->id);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetIdException()
    {
        $item = new User;
        $item->id = 's';
    }

    public function testSetUserId()
    {
        $item = new User;
        $item->userId = 1;
        $this->assertAttributeEquals(1, 'userId', $item);
    }

    public function testGetUserId()
    {
        $item = new User;
        $item->userId = 1;
        $this->assertEquals(1, $item->userId);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetUserIdException()
    {
        $item = new User;
        $item->userId = 's';
    }

    public function testSetPresence()
    {
        $item = new User;
        $item->presence = 'idle';
        $this->assertAttributeEquals('idle', 'presence', $item);
    }

    public function testGetPresence()
    {
        $item = new User;
        $item->presence = 'idle';
        $this->assertEquals('idle', $item->presence);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetPresenceException()
    {
        $item = new User;
        $item->presence = 's';
    }

    public function testGetPresences()
    {
        $this->assertEquals([
            'online',
            'idle',
            'offline'
        ], User::getPresences());
    }

    public function testSetPresenceDetails()
    {
        $item = new User;
        $item->presenceDetails = array('presence1' => 'value1');
        $this->assertAttributeEquals(array('presence1' => 'value1'), 'presenceDetails', $item);
    }

    public function testGetPresenceDetails()
    {
        $item = new User;
        $item->presenceDetails = array('presence1' => 'value1');
        $this->assertEquals(array('presence1' => 'value1'), $item->presenceDetails);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetPresenceDetailsException()
    {
        $item = new User;
        $item->presenceDetails = 's';
    }

    public function testSetProps()
    {
        $item = new User;
        $item->props = array('prop1' => 'value1');
        $this->assertAttributeEquals(array('prop1' => 'value1'), 'props', $item);
    }

    public function testGetProps()
    {
        $item = new User;
        $item->props = array('prop1' => 'value1');
        $this->assertEquals(array('prop1' => 'value1'), $item->props);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetPropsException()
    {
        $item = new User;
        $item->props = 's';
    }
}
