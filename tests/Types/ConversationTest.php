<?php
namespace Veksa\Carrot\Tests\Types;

use Veksa\Carrot\Types\Admin;
use Veksa\Carrot\Types\Conversation;
use Veksa\Carrot\Types\Message;
use Veksa\Carrot\Types\User;

class ConversationTest extends \PHPUnit_Framework_TestCase
{
    public function testSetId()
    {
        $item = new Conversation;
        $item->id = 1;
        $this->assertAttributeEquals(1, 'id', $item);
    }

    public function testGetId()
    {
        $item = new Conversation;
        $item->id = 1;
        $this->assertEquals(1, $item->id);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetIdException()
    {
        $item = new Conversation;
        $item->id = 's';
    }

    public function testSetCreated()
    {
        $item = new Conversation;
        $item->created = 1;
        $this->assertAttributeEquals(1, 'created', $item);
    }

    public function testGetCreated()
    {
        $item = new Conversation;
        $item->created = 1;
        $this->assertEquals(1, $item->created);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetCreatedException()
    {
        $item = new Conversation;
        $item->created = 's';
    }

    public function testSetUser()
    {
        $item = new Conversation;
        $user = User::fromResponse(array(
            'id' => 1
        ));
        $item->user = $user;
        $this->assertAttributeEquals($user, 'user', $item);
    }

    public function testGetUser()
    {
        $item = new Conversation;
        $user = User::fromResponse(array(
            'id' => 1
        ));
        $item->user = $user;
        $this->assertInstanceOf(User::class, $item->user);
        $this->assertEquals($user, $item->user);
    }

    public function testSetRead()
    {
        $item = new Conversation;
        $item->read = true;
        $this->assertAttributeEquals(true, 'read', $item);
    }

    public function testIsRead()
    {
        $item = new Conversation;
        $item->read = true;
        $this->assertTrue($item->isRead());
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetReadException()
    {
        $item = new Conversation;
        $item->read = 's';
    }

    public function testSetReplied()
    {
        $item = new Conversation;
        $item->replied = true;
        $this->assertAttributeEquals(true, 'replied', $item);
    }

    public function testIsReplied()
    {
        $item = new Conversation;
        $item->replied = true;
        $this->assertTrue($item->isReplied());
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetRepliedException()
    {
        $item = new Conversation;
        $item->replied = 's';
    }

    public function testSetClicked()
    {
        $item = new Conversation;
        $item->clicked = true;
        $this->assertAttributeEquals(true, 'clicked', $item);
    }

    public function testIsClicked()
    {
        $item = new Conversation;
        $item->clicked = true;
        $this->assertTrue($item->isClicked());
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetClickedException()
    {
        $item = new Conversation;
        $item->clicked = 's';
    }

    public function testSetUnsubscribed()
    {
        $item = new Conversation;
        $item->unsubscribed = true;
        $this->assertAttributeEquals(true, 'unsubscribed', $item);
    }

    public function testIsUnsubscribed()
    {
        $item = new Conversation;
        $item->unsubscribed = true;
        $this->assertTrue($item->isUnsubscribed());
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetUnsubscribedException()
    {
        $item = new Conversation;
        $item->unsubscribed = 's';
    }

    public function testSetClosed()
    {
        $item = new Conversation;
        $item->closed = true;
        $this->assertAttributeEquals(true, 'closed', $item);
    }

    public function testIsClosed()
    {
        $item = new Conversation;
        $item->closed = true;
        $this->assertTrue($item->isClosed());
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetClosedException()
    {
        $item = new Conversation;
        $item->closed = 's';
    }

    public function testSetMessage()
    {
        $item = new Conversation;
        $message = Message::fromResponse(array(
            'id' => 1
        ));
        $item->message = $message;
        $this->assertAttributeEquals($message, 'message', $item);
    }

    public function testGetMessage()
    {
        $item = new Conversation;
        $message = Message::fromResponse(array(
            'id' => 1
        ));
        $item->message = $message;
        $this->assertInstanceOf(Message::class, $item->message);
        $this->assertEquals($message, $item->message);
    }

    public function testSetType()
    {
        $item = new Conversation;
        $item->type = 'popup_small';
        $this->assertAttributeEquals('popup_small', 'type', $item);
    }

    public function testGetType()
    {
        $item = new Conversation;
        $item->type = 'popup_small';
        $this->assertEquals('popup_small', $item->type);
    }

    public function testGetTypes()
    {
        $this->assertEquals([
            'email',
            'popup_small',
            'popup_big',
            'popup_chat'
        ], Conversation::getTypes());
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetTypeException()
    {
        $item = new Conversation;
        $item->type = 's';
    }

    public function testSetReplyType()
    {
        $item = new Conversation;
        $item->replyType = 'email';
        $this->assertAttributeEquals('email', 'replyType', $item);
    }

    public function testGetReplyType()
    {
        $item = new Conversation;
        $item->replyType = 'email';
        $this->assertEquals('email', $item->replyType);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetReplyTypeException()
    {
        $item = new Conversation;
        $item->replyType = 's';
    }

    public function testSetPartLast()
    {
        $item = new Conversation;
        $message = Message::fromResponse(array(
            'id' => 1
        ));
        $item->partLast = $message;
        $this->assertAttributeEquals($message, 'partLast', $item);
    }

    public function testGetPartLast()
    {
        $item = new Conversation;
        $message = Message::fromResponse(array(
            'id' => 1
        ));
        $item->partLast = $message;
        $this->assertInstanceOf(Message::class, $item->partLast);
        $this->assertEquals($message, $item->partLast);
    }

    public function testSetPartsCount()
    {
        $item = new Conversation;
        $item->partsCount = 1;
        $this->assertAttributeEquals(1, 'partsCount', $item);
    }

    public function testGetPartsCount()
    {
        $item = new Conversation;
        $item->partsCount = 1;
        $this->assertEquals(1, $item->partsCount);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetPartsCountException()
    {
        $item = new Conversation;
        $item->partsCount = 's';
    }

    public function testSetAssignee()
    {
        $item = new Conversation;
        $admin = Admin::fromResponse(array(
            'id' => 1
        ));
        $item->assignee = $admin;
        $this->assertAttributeEquals($admin, 'assignee', $item);
    }

    public function testGetAssignee()
    {
        $item = new Conversation;
        $admin = Admin::fromResponse(array(
            'id' => 1
        ));
        $item->assignee = $admin;
        $this->assertInstanceOf(Admin::class, $item->assignee);
        $this->assertEquals($admin, $item->assignee);
    }

    public function testSetUnreadPartsCount()
    {
        $item = new Conversation;
        $item->unreadPartsCount = 1;
        $this->assertAttributeEquals(1, 'unreadPartsCount', $item);
    }

    public function testGetUnreadPartsCount()
    {
        $item = new Conversation;
        $item->unreadPartsCount = 1;
        $this->assertEquals(1, $item->unreadPartsCount);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetUnreadPartsCountException()
    {
        $item = new Conversation;
        $item->unreadPartsCount = 's';
    }

    public function testSetLastAdmin()
    {
        $item = new Conversation;
        $admin = Admin::fromResponse(array(
            'id' => 1
        ));
        $item->lastAdmin = $admin;
        $this->assertAttributeEquals($admin, 'lastAdmin', $item);
    }

    public function testGetLastAdmin()
    {
        $item = new Conversation;
        $admin = Admin::fromResponse(array(
            'id' => 1
        ));
        $item->lastAdmin = $admin;
        $this->assertInstanceOf(Admin::class, $item->lastAdmin);
        $this->assertEquals($admin, $item->lastAdmin);
    }

    public function testSetLastUpdate()
    {
        $item = new Conversation;
        $item->lastUpdate = 1;
        $this->assertAttributeEquals(1, 'lastUpdate', $item);
    }

    public function testGetLastUpdate()
    {
        $item = new Conversation;
        $item->lastUpdate = 1;
        $this->assertEquals(1, $item->lastUpdate);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetLastUpdateException()
    {
        $item = new Conversation;
        $item->lastUpdate = 's';
    }

    public function testSetTags()
    {
        $item = new Conversation;
        $item->tags = array('tag1', 'tag2');
        $this->assertAttributeEquals(array('tag1', 'tag2'), 'tags', $item);
    }

    public function testGetTags()
    {
        $item = new Conversation;
        $item->tags = array('tag1', 'tag2');
        $this->assertEquals(array('tag1', 'tag2'), $item->tags);
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\InvalidArgumentException
     */
    public function testSetTagsException()
    {
        $item = new Conversation;
        $item->tags = 's';
    }
}
