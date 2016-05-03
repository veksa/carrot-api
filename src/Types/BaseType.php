<?php
namespace Veksa\Carrot\Types;

use Veksa\Carrot\Exceptions\InvalidArgumentException;
use Veksa\Carrot\Exceptions\UnknownPropertyException;

/**
 * Class BaseType
 * Base class for Veksa\Carrot\Types
 *
 * @package Veksa\Carrot
 */
abstract class BaseType
{
    /**
     * Array of required data params for type
     *
     * @var array
     */
    protected static $requiredParams = [];

    /**
     * Map of input data
     *
     * @var array
     */
    protected static $map = [];

    /**
     * Validate input data
     *
     * @param array $data
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public static function validate($data)
    {
        return true;
    }

    /**
     * Make object fields by map from input data request
     *
     * @param array
     */
    public function map($data)
    {
        foreach (static::$map as $key => $item) {
            if (isset($data[$key]) && (!is_array($data[$key]) || (is_array($data[$key]) && !empty($data[$key])))) {
                $method = 'set' . self::toCamelCase($key);
                if ($item === true) {
                    $this->$method($data[$key]);
                } else {
                    $this->$method($item::fromResponse($data[$key]));
                }
            }
        }
    }

    /**
     * Make camel case string from input string
     *
     * @param string $str
     *
     * @return string
     */
    protected static function toCamelCase($str)
    {
        return str_replace(" ", "", ucwords(str_replace("_", " ", $str)));
    }

    /**
     * Cretate object from data
     *
     * @param array $data
     *
     * @return TypeInterface
     */
    public static function fromResponse($data)
    {
        self::validate($data);
        $instance = new static();
        $instance->map($data);

        return $instance;
    }

    /**
     * Override method __get
     *
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        $errorMessage = 'Error get property ' . $name . ', not found in class ' . get_class($this);

        if (!property_exists($this, $name)) {
            throw new UnknownPropertyException($errorMessage);
        }

        $method = 'get' . self::toCamelCase($name);
        if (!method_exists($this, $method)) {
            throw new UnknownPropertyException($errorMessage);
        }

        return $this->$method();
    }

    /**
     * Override method __set
     *
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    public function __set($name, $value)
    {
        $errorMessage = 'Error set property ' . $name . ', not found in class ' . get_class($this);

        if (!property_exists($this, $name)) {
            throw new UnknownPropertyException($errorMessage);
        }

        $method = 'set' . self::toCamelCase($name);
        if (!method_exists($this, $method)) {
            throw new UnknownPropertyException($errorMessage);
        }

        return $this->$method($value);
    }
}
