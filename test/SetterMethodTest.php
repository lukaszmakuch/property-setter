<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use DateTime;
use lukaszmakuch\PropertySetter\SettingStrategy\SetterMethod;
use PHPUnit_Framework_TestCase;
use RuntimeException;

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class SetterMethodTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectFlow()
    {
        $passedToSetter = "passed to setter";
        $obj = new TestClass;
        $strategy = new SetterMethod("setFirstParam");
        $strategy->setAsProperty($passedToSetter, $obj);
        $this->assertSame($passedToSetter, $obj->firstParamSetBySetter);
    }

    /**
     * @expectedException \lukaszmakuch\PropertySetter\Exception\UnableToSetProperty
     */
    public function testErrorWhileCallingSetter()
    {
        $strategy = new SetterMethod("setParam");
        $strategy->setAsProperty(123, new DateTime());
    }

    public function testCallThatCausesException()
    {
        $exceptionThrownByCallingSetter = new RuntimeException();
        $strategy = new SetterMethod("setFirstParam");
        $obj = $this->getMock(TestClass::class);
        $obj->method("setFirstParam")
            ->will($this->throwException($exceptionThrownByCallingSetter));
        $caughtException = null;
        try {
            $strategy->setAsProperty(123, $obj);
        } catch (Exception\UnableToSetProperty $e) {
            $caughtException = $e->getPrevious();
        }

        $this->assertSame($caughtException, $exceptionThrownByCallingSetter);
    }
}
