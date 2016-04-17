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
class ChainOfPropertySettersTest extends PHPUnit_Framework_TestCase
{
    public function testChaining()
    {
        $chainedSetters = (new ChainOfPropertySetters())
            ->add(new SimplePropertySetter(
                new ByClass(TestClass::class), 
                new SetterMethod("setFirstParam"), 
                new Directly("firstInput")
            ))
            ->add(new SimplePropertySetter(
                new ByClass(TestClass::class), 
                new SetterMethod("setSecondParam"), 
                new Directly("secondInput")
            ))
        ;
        $target = new TestClass();
        $chainedSetters->setPropertiesOf($target);
        $this->assertEquals("firstInput", $target->firstParamSetBySetter);
        $this->assertEquals("secondInput", $target->secondParamSetBySetter);
    }
}
