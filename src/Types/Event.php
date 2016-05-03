<?php
namespace Veksa\Carrot\Types;

use Veksa\Carrot\Exceptions\InvalidArgumentException;

/**
 * Class Event
 *
 * @package Veksa\Carrot
 */
class Event extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    static protected $map = [
        'id' => true,
        'created' => true,
        'type' => EventType::class,
        'props' => true
    ];

    /**
     * Unique user identifier
     *
     * @var int
     */
    protected $id;

    /**
     * Date the event was created in Unix time
     *
     * @var int
     */
    protected $created;

    /**
     * Type of event
     *
     * @var EventType
     */
    protected $type;

    /**
     * Array of properties
     *
     * @var array
     */
    protected $props;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param array $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
