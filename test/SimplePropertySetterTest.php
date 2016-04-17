<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use lukaszmakuch\PropertySetter\SettingStrategy\SetterMethod;
use lukaszmakuch\PropertySetter\TargetSpecifier\ByClass;
use lukaszmakuch\PropertySetter\ValueSource\Directly;
use PHPUnit_Framework_TestCase;

/**
 * Test simple implementation of the property setter.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class SimplePropertySetterTest extends PHPUnit_Framework_TestCase
{
    private $setter;
    
    protected function setUp()
    {
        $this->setter = new SimplePropertySetter(
            new ByClass(TestClass::class),
            new SetterMethod("setFirstParam"),
            new Directly(123)
        );
    }

    public function testSettingProperty()
    {
        $target = new TestClass();
        $this->setter->setPropertiesOf($target);
        $this->assertEquals(123, $target->firstParamSetBySetter);
    }
    
    /**
     * @expectedException \lukaszmakuch\PropertySetter\Exception\UnsupportedTarget
     */
    public function testExceptionIfUnsupportedTarget()
    {
        $this->setter->setPropertiesOf(new \DateTime());
    }
}
