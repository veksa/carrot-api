<?php
namespace Veksa\Carrot\Tests\Types;

use Veksa\Carrot\Types\ArrayOfAttachment;
use Veksa\Carrot\Types\Conversation;
use Veksa\Carrot\Types\Message;
use Veksa\Carrot\Types\User;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testSetId()
    {
        $item = new Message;
        $item->id = 1;
        $this->assertAttributeEquals(1, 'id', $item);
    }

    public function testGetId()
    {
        $item = new Message;
        $item->id = 1;
        $this->assertEquals(1, $item->id);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetIdException()
    {
        $item = new Message;
        $item->id = 's';
    }

    public function testSetCreated()
    {
        $item = new Message;
        $item->created = 159456;
        $this->assertAttributeEquals(159456, 'created', $item);
    }

    public function testGetCreated()
    {
        $item = new Message;
        $item->created = 159456;
        $this->assertEquals(159456, $item->created);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetCreatedException()
    {
        $item = new Message;
        $item->created = 's';
    }

    public function testSetFirst()
    {
        $item = new Message;
        $item->first = true;
        $this->assertAttributeEquals(true, 'first', $item);
    }

    public function testIsFirst()
    {
        $item = new Message;
        $item->first = true;
        $this->assertTrue($item->isFirst());
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetFirstException()
    {
        $item = new Message;
        $item->first = 's';
    }

    public function testSetConversation()
    {
        $item = new Message;
        $conversation = Conversation::fromResponse(array(
            'id' => 1
        ));
        $item->conversation = $conversation;
        $this->assertAttributeEquals($conversation, 'conversation', $item);
    }

    public function testGetConversation()
    {
        $item = new Message;
        $conversation = Conversation::fromResponse(array(
            'id' => 1
        ));
        $item->conversation = $conversation;
        $this->assertInstanceOf(Conversation::class, $item->conversation);
        $this->assertEquals($conversation, $item->conversation);
    }

    public function testSetBody()
    {
        $item = new Message;
        $item->body = 'test message';
        $this->assertAttributeEquals('test message', 'body', $item);
    }

    public function testGetBody()
    {
        $item = new Message;
        $item->body = 'test message';
        $this->assertEquals('test message', $item->body);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetBodyException()
    {
        $item = new Message;
        $item->body = array();
    }

    public function testSetDirection()
    {
        $item = new Message;
        $item->direction = 'ltr';
        $this->assertAttributeEquals('ltr', 'direction', $item);
    }

    public function testGetDirection()
    {
        $item = new Message;
        $item->direction = 'ltr';
        $this->assertEquals('ltr', $item->direction);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetDirectionException()
    {
        $item = new Message;
        $item->direction = array();
    }

    public function testSetFrom()
    {
        $item = new Message;
        $from = User::fromResponse(array(
            'id' => 1
        ));
        $item->from = $from;
        $this->assertAttributeEquals($from, 'from', $item);
    }

    public function testGetFrom()
    {
        $item = new Message;
        $from = User::fromResponse(array(
            'id' => 1
        ));
        $item->from = $from;
        $this->assertInstanceOf(User::class, $item->from);
        $this->assertEquals($from, $item->from);
    }

    public function testSetRead()
    {
        $item = new Message;
        $item->read = true;
        $this->assertAttributeEquals(true, 'read', $item);
    }

    public function testIsRead()
    {
        $item = new Message;
        $item->read = true;
        $this->assertTrue($item->isRead());
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetReadException()
    {
        $item = new Message;
        $item->read = 's';
    }

    public function testSetType()
    {
        $item = new Message;
        $item->type = 'reply_user';
        $this->assertAttributeEquals('reply_user', 'type', $item);
    }

    public function testGetType()
    {
        $item = new Message;
        $item->type = 'reply_user';
        $this->assertEquals('reply_user', $item->type);
    }

    public function testGetTypes()
    {
        $this->assertEquals([
            'reply_admin',
            'reply_user',
            'reply_django_user',
            'note',
            'tag_added',
            'tag_deleted',
            'assigned',
            'closed',
            'opened',
            'service'
        ], Message::getTypes());
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetTypeException()
    {
        $item = new Message;
        $item->type = 's';
    }

    public function testSetSentVia()
    {
        $item = new Message;
        $item->sentVia = 'email_admin';
        $this->assertAttributeEquals('email_admin', 'sentVia', $item);
    }

    public function testGetSentVia()
    {
        $item = new Message;
        $item->sentVia = 'email_admin';
        $this->assertEquals('email_admin', $item->sentVia);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetSentViaException()
    {
        $item = new Message;
        $item->sentVia = 's';
    }

    public function testSetInboundEmail()
    {
        $item = new Message;
        $item->inboundEmail = 'test emails';
        $this->assertAttributeEquals('test emails', 'inboundEmail', $item);
    }

    public function testGetInboundEmail()
    {
        $item = new Message;
        $item->inboundEmail = 'test emails';
        $this->assertEquals('test emails', $item->inboundEmail);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetInboundEmailException()
    {
        $item = new Message;
        $item->inboundEmail = array();
    }

    public function testSetAttachments()
    {
        $item = new Message;
        $attachments = ArrayOfAttachment::fromResponse(array(
            array(
                'id' => 1
            )
        ));
        $item->attachments = $attachments;
        $this->assertAttributeEquals($attachments, 'attachments', $item);
    }

    public function testGetAttachments()
    {
        $item = new Message;
        $attachments = ArrayOfAttachment::fromResponse(array(
            array(
                'id' => 1
            )
        ));
        $item->attachments = $attachments;
        $this->assertEquals($attachments, $item->attachments);
    }
}
