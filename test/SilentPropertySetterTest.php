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
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class SilentPropertySetterTest extends PHPUnit_Framework_TestCase
{
    private $setter;
    private $setParamValue = 123;

    public function setUp()
    {
        $this->setter = new SilentPropertySetter(new SimplePropertySetter(
            new ByClass(TestClass::class),
            new SetterMethod("setFirstParam"),
            new Directly($this->setParamValue)
        ));
    }

    public function testCorrectFlow()
    {
        $target = new TestClass();
        $this->setter->setPropertiesOf($target);
        $this->assertEquals($this->setParamValue, $target->firstParamSetBySetter);
    }

    public function testIgnoranceOfTargetMismatch()
    {
        $this->setter->setPropertiesOf(new \DateTime());
    }
}