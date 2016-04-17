<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use lukaszmakuch\PropertySetter\SettingStrategy\UseSetterMethod;
use lukaszmakuch\PropertySetter\TargetSpecifier\PickByClass;
use lukaszmakuch\PropertySetter\ValueSource\Directly;
use PHPUnit_Framework_TestCase;

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class SimpleChainOfPropertySettersTest extends PHPUnit_Framework_TestCase
{
    public function testChaining()
    {
        $chainedSetters = (new SimpleChainOfPropertySetters())
            ->add(new SimplePropertySetter(
                new PickByClass(TestClass::class), 
                new UseSetterMethod("setFirstParam"), 
                new Directly("firstInput")
            ))
            ->add(new SimplePropertySetter(
                new PickByClass(TestClass::class), 
                new UseSetterMethod("setSecondParam"), 
                new Directly("secondInput")
            ))
        ;
        $target = new TestClass();
        $chainedSetters->setPropertiesOf($target);
        $this->assertEquals("firstInput", $target->firstParamSetBySetter);
        $this->assertEquals("secondInput", $target->secondParamSetBySetter);
    }
}
