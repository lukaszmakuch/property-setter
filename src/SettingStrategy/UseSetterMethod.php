<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter\SettingStrategy;

use lukaszmakuch\PropertySetter\Exception\UnableToSetProperty;

/**
 * Uses a setter in order to set a property.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class UseSetterMethod implements SettingStrategy
{
    private $setterMethodName;

    /**
     * @param String $setterMethodName name of the method that is going to be invoked
     */
    public function __construct($setterMethodName)
    {
        $this->setterMethodName = $setterMethodName;
    }

    public function setAsProperty($value, $targetObject)
    {
        $callableMethod = [$targetObject, $this->setterMethodName];
        if (!is_callable($callableMethod)) {
            throw new UnableToSetProperty("impossible to get a callable");
        }
        
        try {
            $setterCalled = call_user_func(
                $callableMethod, 
                $value
            );
            if (false === $setterCalled) {
                throw new UnableToSetProperty("error while calling {$this->setterMethodName}");
            }
        } catch (\Exception $e) {
            throw new UnableToSetProperty("", 0, $e);
        }
    }
}
