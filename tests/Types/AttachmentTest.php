<?php
namespace Veksa\Carrot\Tests\Types;

use Veksa\Carrot\Types\Attachment;

class AttachmentTest extends \PHPUnit_Framework_TestCase
{
    public function testSetId()
    {
        $item = new Attachment;
        $item->id = 1;
        $this->assertAttributeEquals(1, 'id', $item);
    }

    public function testGetId()
    {
        $item = new Attachment;
        $item->id = 1;
        $this->assertEquals(1, $item->id);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetIdException()
    {
        $item = new Attachment;
        $item->id = 's';
    }

    public function testSetType()
    {
        $item = new Attachment;
        $item->type = 'jpeg';
        $this->assertAttributeEquals('jpeg', 'type', $item);
    }

    public function testGetType()
    {
        $item = new Attachment;
        $item->type = 'jpeg';
        $this->assertEquals('jpeg', $item->type);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetTypeException()
    {
        $item = new Attachment;
        $item->type = array();
    }

    public function testSetSize()
    {
        $item = new Attachment;
        $item->size = 600;
        $this->assertAttributeEquals(600, 'size', $item);
    }

    public function testGetSize()
    {
        $item = new Attachment;
        $item->size = 600;
        $this->assertEquals(600, $item->size);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetSizeException()
    {
        $item = new Attachment;
        $item->size = 's';
    }

    public function testSetFileName()
    {
        $item = new Attachment;
        $item->fileName = 'testfile';
        $this->assertAttributeEquals('testfile', 'fileName', $item);
    }

    public function testGetFileName()
    {
        $item = new Attachment;
        $item->fileName = 'testfile';
        $this->assertEquals('testfile', $item->fileName);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetFileNameException()
    {
        $item = new Attachment;
        $item->fileName = array();
    }

    public function testSetMimeType()
    {
        $item = new Attachment;
        $item->mimeType = 'image/jpeg';
        $this->assertAttributeEquals('image/jpeg', 'mimeType', $item);
    }

    public function testGetMimeType()
    {
        $item = new Attachment;
        $item->mimeType = 'image/jpeg';
        $this->assertEquals('image/jpeg', $item->mimeType);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetMimeTypeException()
    {
        $item = new Attachment;
        $item->mimeType = array();
    }

    public function testSetUrl()
    {
        $item = new Attachment;
        $item->url = 'http://google.ru';
        $this->assertAttributeEquals('http://google.ru', 'url', $item);
    }

    public function testGetUrl()
    {
        $item = new Attachment;
        $item->url = 'http://google.ru';
        $this->assertEquals('http://google.ru', $item->url);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetUrlException()
    {
        $item = new Attachment;
        $item->url = array();
    }
}
