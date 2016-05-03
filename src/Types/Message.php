<?php
namespace Veksa\Carrot\Types;

use Veksa\Carrot\Exceptions\InvalidArgumentException;

/**
 * Class Message
 *
 * @package Veksa\Carrot
 */
class Message extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    static protected $map = [
        'id' => true,
        'created' => true,
        'first' => true,
        'conversation' => Conversation::class,
        'body' => true,
        'direction' => true,
        'from' => User::class,
        'read' => true,
        'type' => true,
        'sent_via' => true,
        'inbound_email' => true,
        'attachments' => ArrayOfAttachment::class
    ];

    /**
     * Unique message identifier
     *
     * @var int
     */
    protected $id;

    /**
     * Date the message was created in Unix time
     *
     * @var int
     */
    protected $created;

    /**
     * Is first message in conversation
     *
     * @var bool
     */
    protected $first;

    /**
     * Conversation the message belongs to
     *
     * @var Conversation
     */
    protected $conversation;

    /**
     * Text of message
     *
     * @var string
     */
    protected $body;

    /**
     * Direction of message - u2a, from user to admin, or a2u - admin to user
     *
     * @var string
     */
    protected $direction;

    /**
     * User the message belongs to
     *
     * @var User
     */
    protected $from;

    /**
     * Whether the user read the message
     *
     * @var bool
     */
    protected $read;

    /**
     * Type of message
     *
     * @var string
     */
    protected $type;

    /**
     * Available types of message
     *
     * @var array
     */
    static protected $types = [
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
    ];

    /**
     * Object type through which the message was sent
     *
     * @var string
     */
    protected $sentVia;

    /**
     * Available source via
     *
     * @var array
     */
    static protected $sentVias = [
        'web_user',
        'web_panel',
        'email_user',
        'email_admin',
        'app_android',
        'app_chrome',
        'app_desktop',
        'message_auto',
        'message_manual'
    ];

    /**
     * If message delivered from email - origin letter
     *
     * @var string
     */
    protected $inboundEmail;

    /**
     * Attachments
     *
     * @var Attachment
     */
    protected $attachments;

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
     * @return bool
     */
    public function isFirst()
    {
        return $this->first;
    }

    /**
     * @param bool $first
     *
     * @throws InvalidArgumentException
     */
    public function setFirst($first)
    {
        if (is_bool($first)) {
            $this->first = $first;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return TypeInterface
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * @param Conversation $conversation
     */
    public function setConversation(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @throws InvalidArgumentException
     */
    public function setBody($body)
    {
        if (is_string($body)) {
            $this->body = $body;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     *
     * @throws InvalidArgumentException
     */
    public function setDirection($direction)
    {
        if (is_string($direction)) {
            $this->direction = $direction;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return TypeInterface
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param User $from
     */
    public function setFrom(User $from)
    {
        $this->from = $from;
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
    public function getSentVia()
    {
        return $this->sentVia;
    }

    /**
     * @param string $sentVia
     *
     * @throws InvalidArgumentException
     */
    public function setSentVia($sentVia)
    {
        if (is_string($sentVia) && in_array($sentVia, self::$sentVias)) {
            $this->sentVia = $sentVia;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return string
     */
    public function getInboundEmail()
    {
        return $this->inboundEmail;
    }

    /**
     * @param string $inboundEmail
     *
     * @throws InvalidArgumentException
     */
    public function setInboundEmail($inboundEmail)
    {
        if (is_string($inboundEmail)) {
            $this->inboundEmail = $inboundEmail;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param array $attachments
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;
    }
}
