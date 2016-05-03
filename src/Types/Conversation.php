<?php
namespace Veksa\Carrot\Types;

use Veksa\Carrot\Exceptions\InvalidArgumentException;

/**
 * Class Conversation
 *
 * @package Veksa\Carrot
 */
class Conversation extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    static protected $map = [
        'id' => true,
        'created' => true,
        'user' => User::class,
        'read' => true,
        'replied' => true,
        'clicked' => true,
        'unsubscribed' => true,
        'closed' => true,
        'message' => true,
        'type' => true,
        'reply_type' => true,
        'part_last' => Message::class,
        'parts_count' => true,
        'assignee' => Admin::class,
        'unread_parts_count' => true,
        'last_admin' => Admin::class,
        'last_update' => true,
        'tags' => true
    ];

    /**
     * Unique dialog identifier
     *
     * @var int
     */
    protected $id;

    /**
     * Date the dialog was created in Unix time
     *
     * @var int
     */
    protected $created;

    /**
     * User, which is a dialog
     *
     * @var User
     */
    protected $user;

    /**
     * Do read the first message
     *
     * @var bool
     */
    protected $read;

    /**
     * Whether the user responded to the dialog
     *
     * @var bool
     */
    protected $replied;

    /**
     * Do user clicked link in first message
     *
     * @var bool
     */
    protected $clicked;

    /**
     * Do user unsubscribed from email in dialog
     *
     * @var bool
     */
    protected $unsubscribed;

    /**
     * Whether the dialogue is closed
     *
     * @var bool
     */
    protected $closed;

    /**
     * ID of message that started dialog
     *
     * @var int
     */
    protected $message;

    /**
     * Type of dialog
     *
     * @var string
     */
    protected $type;

    /**
     * Available types of conversation
     *
     * @var array
     */
    static protected $types = [
        'email',
        'popup_small',
        'popup_big',
        'popup_chat'
    ];

    /**
     * Type of answer on dialog
     *
     * @var string
     */
    protected $replyType;

    /**
     * Available types of answers in conversation
     *
     * @var array
     */
    static protected $replyTypes = [
        'text',
        'email',
        'phone',
        'no'
    ];

    /**
     * Last message in dialog
     *
     * @var Message
     */
    protected $partLast;

    /**
     * Count of messages in dialog
     *
     * @var int
     */
    protected $partsCount;

    /**
     * Administrator is assigned to dialog
     *
     * @var Admin
     */
    protected $assignee;

    /**
     * Count of unread messages by user in dialog
     *
     * @var int
     */
    protected $unreadPartsCount;

    /**
     * Last administrator is answer in dialog
     *
     * @var Admin
     */
    protected $lastAdmin;

    /**
     * Date the dialog was last updated in Unix time
     *
     * @var int
     */
    protected $lastUpdate;

    /**
     * Dialog tags
     *
     * @var array
     */
    protected $tags;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @throws InvalidArgumentException
     */
    public function setId($id)
    {
        if (is_integer($id)) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param int $created
     *
     * @throws InvalidArgumentException
     */
    public function setCreated($created)
    {
        if (is_integer($created)) {
            $this->created = $created;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return TypeInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function isRead()
    {
        return $this->read;
    }

    /**
     * @param bool $read
     *
     * @throws InvalidArgumentException
     */
    public function setRead($read)
    {
        if (is_bool($read)) {
            $this->read = $read;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return bool
     */
    public function isReplied()
    {
        return $this->replied;
    }

    /**
     * @param bool $replied
     *
     * @throws InvalidArgumentException
     */
    public function setReplied($replied)
    {
        if (is_bool($replied)) {
            $this->replied = $replied;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return bool
     */
    public function isClicked()
    {
        return $this->clicked;
    }

    /**
     * @param bool $clicked
     *
     * @throws InvalidArgumentException
     */
    public function setClicked($clicked)
    {
        if (is_bool($clicked)) {
            $this->clicked = $clicked;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return bool
     */
    public function isUnsubscribed()
    {
        return $this->unsubscribed;
    }

    /**
     * @param bool $unsubscribed
     *
     * @throws InvalidArgumentException
     */
    public function setUnsubscribed($unsubscribed)
    {
        if (is_bool($unsubscribed)) {
            $this->unsubscribed = $unsubscribed;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return bool
     */
    public function isClosed()
    {
        return $this->closed;
    }

    /**
     * @param bool $closed
     *
     * @throws InvalidArgumentException
     */
    public function setClosed($closed)
    {
        if (is_bool($closed)) {
            $this->closed = $closed;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return TypeInterface
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param Message $message
     */
    public function setMessage(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public static function getTypes()
    {
        return self::$types;
    }

    /**
     * @param string $type
     *
     * @throws InvalidArgumentException
     */
    public function setType($type)
    {
        if (is_string($type) && in_array($type, self::$types)) {
            $this->type = $type;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return string
     */
    public function getReplyType()
    {
        return $this->replyType;
    }

    /**
     * @param string $replyType
     *
     * @throws InvalidArgumentException
     */
    public function setReplyType($replyType)
    {
        if (is_string($replyType) && in_array($replyType, self::$replyTypes)) {
            $this->replyType = $replyType;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return TypeInterface
     */
    public function getPartLast()
    {
        return $this->partLast;
    }

    /**
     * @param Message $lastMessage
     */
    public function setPartLast(Message $lastMessage)
    {
        $this->partLast = $lastMessage;
    }

    /**
     * @return int
     */
    public function getPartsCount()
    {
        return $this->partsCount;
    }

    /**
     * @param int $countMessages
     *
     * @throws InvalidArgumentException
     */
    public function setPartsCount($countMessages)
    {
        if (is_integer($countMessages)) {
            $this->partsCount = $countMessages;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return TypeInterface
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * @param Admin $assignee
     */
    public function setAssignee(Admin $assignee)
    {
        $this->assignee = $assignee;
    }

    /**
     * @return int
     */
    public function getUnreadPartsCount()
    {
        return $this->unreadPartsCount;
    }

    /**
     * @param int $countUnreadMessages
     *
     * @throws InvalidArgumentException
     */
    public function setUnreadPartsCount($countUnreadMessages)
    {
        if (is_integer($countUnreadMessages)) {
            $this->unreadPartsCount = $countUnreadMessages;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return TypeInterface
     */
    public function getLastAdmin()
    {
        return $this->lastAdmin;
    }

    /**
     * @param Admin $lastAdmin
     */
    public function setLastAdmin(Admin $lastAdmin)
    {
        $this->lastAdmin = $lastAdmin;
    }

    /**
     * @return int
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * @param int $lastUpdate
     *
     * @throws InvalidArgumentException
     */
    public function setLastUpdate($lastUpdate)
    {
        if (is_integer($lastUpdate)) {
            $this->lastUpdate = $lastUpdate;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     *
     * @throws InvalidArgumentException
     */
    public function setTags($tags)
    {
        if (is_array($tags)) {
            $this->tags = $tags;
        } else {
            throw new InvalidArgumentException;
        }
    }
}
