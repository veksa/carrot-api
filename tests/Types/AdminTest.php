<?php
namespace Veksa\Carrot\Tests\Types;

use Veksa\Carrot\Types\Admin;

class AdminTest extends \PHPUnit_Framework_TestCase
{
    public function testSetId()
    {
        $item = new Admin;
        $item->id = 1;
        $this->assertAttributeEquals(1, 'id', $item);
    }

    public function testGetId()
    {
        $item = new Admin;
        $item->id = 1;
        $this->assertEquals(1, $item->id);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetIdException()
    {
        $item = new Admin;
        $item->id = 's';
    }

    public function testSetType()
    {
        $item = new Admin;
        $item->type = 'admin';
        $this->assertAttributeEquals('admin', 'type', $item);
    }

    public function testGetType()
    {
        $item = new Admin;
        $item->type = 'admin';
        $this->assertEquals('admin', $item->type);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetTypeException()
    {
        $item = new Admin;
        $item->type = 's';
    }

    public function testSetName()
    {
        $item = new Admin;
        $item->name = 'test';
        $this->assertAttributeEquals('test', 'name', $item);
    }

    public function testGetName()
    {
        $item = new Admin;
        $item->name = 'test';
        $this->assertEquals('test', $item->name);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetNameException()
    {
        $item = new Admin;
        $item->name = array();
    }

    public function testSetAvatar()
    {
        $item = new Admin;
        $item->avatar = 'http://google.ru/testimage.jpg';
        $this->assertAttributeEquals('http://google.ru/testimage.jpg', 'avatar', $item);
    }

    public function testGetAvatar()
    {
        $item = new Admin;
        $item->avatar = 'http://google.ru/testimage.jpg';
        $this->assertEquals('http://google.ru/testimage.jpg', $item->avatar);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetAvatarException()
    {
        $item = new Admin;
        $item->avatar = array();
    }
}
