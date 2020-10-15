<?php
namespace Veksa\Carrot\Types;

use Veksa\Carrot\Exceptions\InvalidArgumentException;

/**
 * Class User
 *
 * @package Veksa\Carrot
 */
class User extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    static protected $map = [
        'id' => true,
        'app' => true,
        'user_id' => true,
        'presence' => true,
        'presence_details' => true,
        'props' => true
    ];

    /**
     * Unique system user identifier
     *
     * @var int
     */
    protected $id;

    /**
     * Unique app identifier
     *
     * @var int
     */
    protected $app;

    /**
     * Unique local user identifier
     *
     * @var string
     */
    protected $userId;

    /**
     * User status
     *
     * @var string
     */
    protected $presence;

    /**
     * Available status of user
     *
     * @var array
     */
    static protected $presences = [
        'online',
        'idle',
        'offline'
    ];

    /**
     * User presence props
     *
     * @var array
     */
    protected $presenceDetails;

    /**
     * User system props
     *
     * @var array
     */
    protected $props;

    /**
     * @return int
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param int $app
     *
     * @throws InvalidArgumentException
     */
    public function setApp($app)
    {
        if (is_integer($app)) {
            $this->app = $app;
        } else {
            throw new InvalidArgumentException;
        }
    }

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
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     *
     * @throws InvalidArgumentException
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getPresence()
    {
        return $this->presence;
    }

    /**
     * @return array
     */
    public static function getPresences()
    {
        return self::$presences;
    }

    /**
     * @param string $presense
     *
     * @throws InvalidArgumentException
     */
    public function setPresence($presence)
    {
        if (is_string($presence) && in_array($presence, self::$presences)) {
            $this->presence = $presence;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return array
     */
    public function getPresenceDetails()
    {
        return $this->presenceDetails;
    }

    /**
     * @param array $presenceDetails
     *
     * @throws InvalidArgumentException
     */
    public function setPresenceDetails($presenceDetails)
    {
        if (is_array($presenceDetails)) {
            $this->presenceDetails = $presenceDetails;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return array
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * @param array $props
     *
     * @throws InvalidArgumentException
     */
    public function setProps($props)
    {
        if (is_array($props)) {
            $this->props = $props;
        } else {
            throw new InvalidArgumentException;
        }
    }
}
