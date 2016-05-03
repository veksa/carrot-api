<?php
namespace Veksa\Carrot\Types;

use Veksa\Carrot\Exceptions\InvalidArgumentException;

/**
 * Class EventType
 *
 * @package Veksa\Carrot
 */
class EventType extends BaseType implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    static protected $map = [
        'id' => true,
        'name' => true,
        'score' => true
    ];

    /**
     * Unique event type identifier
     *
     * @var int
     */
    protected $id;

    /**
     * Name of event type
     *
     * @var string
     */
    protected $name;

    /**
     * Rating of event
     *
     * @var int
     */
    protected $score;

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
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param int $score
     *
     * @throws InvalidArgumentException
     */
    public function setScore($score)
    {
        if (is_integer($score)) {
            $this->score = $score;
        } else {
            throw new InvalidArgumentException;
        }
    }
}
