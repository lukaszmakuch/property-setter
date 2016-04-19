<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter\SettingStrategy;

use lukaszmakuch\PropertySetter\Exception\UnableToSetProperty;
use lukaszmakuch\PropertySetter\SettingStrategy\CallSetterMethod;
use lukaszmakuch\PropertySetter\SettingStrategy\SettingStrategy;
use ReflectionClass;
use ReflectionMethod;

/**
 * Calls the only method of a class (or an interface) as it were a setter.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class CallOnlyMethodAsSetter implements SettingStrategy
{
    /**
     * @var SettingStrategy|null if null, no property may be set 
     */
    private $settingStrategyOrNull;

    /**
     * @param String $classContainingOneMethod
     */
    public function __construct($classContainingOneMethod)
    {
        $this->settingStrategyOrNull = $this->getSettingStrategyOrNull($classContainingOneMethod);
    }
    
    public function setAsProperty($value, $targetObject)
    {
        if (is_null($this->settingStrategyOrNull)) {
            throw new UnableToSetProperty("impossible to obtain a setter method");
        }
        
        $this->settingStrategyOrNull->setAsProperty($value, $targetObject);
    }
    
    /**
     * @param String $class
     * @return SettingStrategy|null 
     */
    private function getSettingStrategyOrNull($class)
    {
        $setterMethodName = $this->getNameOfTheOnlyMethodOrNull($class);
        if (is_null($setterMethodName)) {
            return null;
        }
        
        return new CallSetterMethod($setterMethodName);
    }

    /**
     * @param String $class full class path
     * @return String|null null if the class has no only one public method
     */
    private function getNameOfTheOnlyMethodOrNull($class)
    {
        $reflectedClass = new ReflectionClass($class);
        $publicMethods = $reflectedClass->getMethods(ReflectionMethod::IS_PUBLIC);
        if (count($publicMethods) != 1) {
            return null;
        }

        /* @var $supposedSetterMethod ReflectionMethod */
        $supposedSetterMethod = reset($publicMethods);
        return $supposedSetterMethod->getName();
    }
}
