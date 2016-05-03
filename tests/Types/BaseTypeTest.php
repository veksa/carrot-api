<?php
namespace Veksa\Carrot\Tests\Types;

class BaseTypeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        include_once('tests/_fixtures/TestBaseType.php');
    }

    public function testValidate()
    {
        $this->assertTrue(\TestBaseType::validate(array()));
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\UnknownPropertyException
     */
    public function testSetPropException1()
    {
        $type = new \TestBaseType;
        $type->unknown_prop = 'test';
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\UnknownPropertyException
     */
    public function testSetPropException2()
    {
        $type = new \TestBaseType;
        $type->testProp = 'test';
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\UnknownPropertyException
     */
    public function testGetPropException1()
    {
        $type = new \TestBaseType;
        $type->unknown_prop;
    }

    /**
     * @expectedException \Veksa\Carrot\Exceptions\UnknownPropertyException
     */
    public function testGetPropException2()
    {
        $type = new \TestBaseType;
        $type->testValue;
    }
}
