<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use lukaszmakuch\PropertySetter\SettingStrategy\CallSetterMethod;
use lukaszmakuch\PropertySetter\TargetSpecifier\PickByClass;
use lukaszmakuch\PropertySetter\ValueSource\UseDirectly;
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
                new CallSetterMethod("setFirstParam"), 
                new UseDirectly("firstInput")
            ))
            ->add(new SimplePropertySetter(
                new PickByClass(TestClass::class), 
                new CallSetterMethod("setSecondParam"), 
                new UseDirectly("secondInput")
            ))
        ;
        $target = new TestClass();
        $chainedSetters->setPropertiesOf($target);
        $this->assertEquals("firstInput", $target->firstParamSetBySetter);
        $this->assertEquals("secondInput", $target->secondParamSetBySetter);
    }
}
