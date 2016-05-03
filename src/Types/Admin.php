<?php
namespace Veksa\Carrot\Types;

use Veksa\Carrot\Exceptions\InvalidArgumentException;

/**
 * Class Admin
 *
 * @package Veksa\Carrot
 */
class Admin extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    static protected $map = [
        'id' => true,
        'type' => true,
        'name' => true,
        'avatar' => true
    ];

    /**
     * Unique admin identifier
     *
     * @var int
     */
    protected $id;

    /**
     * Type of admin
     *
     * @var string
     */
    protected $type;

    /**
     * Available types of admin
     *
     * @var array
     */
    static protected $types = [
        'admin',
        'default_admin',
        'bot'
    ];

    /**
     * Name of admin
     *
     * @var string
     */
    protected $name;

    /**
     * Url avatar
     *
     * @var string
     */
    protected $avatar;

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
    public function getType()
    {
        return $this->type;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @throws InvalidArgumentException
     */
    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;
        } else {
            throw new InvalidArgumentException;
        }
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     *
     * @throws InvalidArgumentException
     */
    public function setAvatar($avatar)
    {
        if (is_string($avatar)) {
            $this->avatar = $avatar;
        } else {
            throw new InvalidArgumentException;
        }
    }
}
