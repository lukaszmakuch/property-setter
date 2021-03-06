<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use DateTime;
use lukaszmakuch\PropertySetter\SettingStrategy\CallSetterMethod;
use PHPUnit_Framework_TestCase;
use RuntimeException;

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class CallSetterMethodTest extends PHPUnit_Framework_TestCase
{
    public function testCallingSetter()
    {
        $passedToSetter = "passed to setter";
        $obj = new TestClass;
        $strategy = new CallSetterMethod("setFirstParam");
        $strategy->setAsProperty($passedToSetter, $obj);
        $this->assertSame($passedToSetter, $obj->firstParamSetBySetter);
    }

    /**
     * @expectedException \lukaszmakuch\PropertySetter\Exception\UnableToSetProperty
     */
    public function testErrorWhileCallingSetter()
    {
        $strategy = new CallSetterMethod("setParam");
        $strategy->setAsProperty(123, new DateTime());
    }

    public function testCallThatCausesException()
    {
        $exceptionThrownByCallingSetter = new RuntimeException();
        $strategy = new CallSetterMethod("setFirstParam");
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
