<?php
use Veksa\Carrot\Types\BaseType;

/**
 * Class TestBaseType
 *
 * @package Veksa\Carrot
 */
class TestBaseType extends BaseType
{
    protected $testProp;
    protected $testValue;

    public function getTestProp()
    {
        return $this->testProp;
    }
}
