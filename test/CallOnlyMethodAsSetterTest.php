<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use lukaszmakuch\PropertySetter\SettingStrategy\CallOnlyMethodAsSetter;
use PHPUnit_Framework_TestCase;

class ProperTargetForCallingTheOnlyMethod
{
    public $passedValue;
    public function setParam($param) { $this->passedValue = $param; }
}

class ClassWithNoMethods
{
}

class ClassWithNoPublicMethod
{
    protected function theOneThatDoesNotCount() {}
}

class ClassWithMoreThanOneMethod
{
    public function firstSetter($param) {}
    public function anotherSetter($param) {}
}

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class CallOnlyMethodAsSetterTest extends PHPUnit_Framework_TestCase
{
    public function testCallingTheOnlyMethod()
    {
        $obj = new ProperTargetForCallingTheOnlyMethod();
        (new CallOnlyMethodAsSetter(ProperTargetForCallingTheOnlyMethod::class))
            ->setAsProperty("abc", $obj);
        $this->assertSame("abc", $obj->passedValue);
    }
    
    /**
     * @expectedException  lukaszmakuch\PropertySetter\Exception\UnableToSetProperty
     * @expectedExceptionMessage impossible to obtain a setter method
     */
    public function testExceptionIfNoMethods()
    {
        (new CallOnlyMethodAsSetter(ClassWithNoMethods::class))
            ->setAsProperty("abc", new \stdClass());
    }
    
    /**
     * @expectedException  lukaszmakuch\PropertySetter\Exception\UnableToSetProperty
     * @expectedExceptionMessage impossible to obtain a setter method
     */
    public function testExceptionIfNoPublicMethods()
    {
        (new CallOnlyMethodAsSetter(ClassWithNoPublicMethod::class))
            ->setAsProperty("abc", new \stdClass());
    }
    
    /**
     * @expectedException  lukaszmakuch\PropertySetter\Exception\UnableToSetProperty
     * @expectedExceptionMessage impossible to obtain a setter method
     */
    public function testExceptionIfMoreThanOneMethod()
    {
        (new CallOnlyMethodAsSetter(ClassWithMoreThanOneMethod::class))
            ->setAsProperty("abc", new \stdClass());
    }
}
