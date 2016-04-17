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
 * Describes how a value is set as a property of an object.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
interface SettingStrategy
{
    /**
     * Sets the given value as a property of the given target object.
     * 
     * @param mixed $value any value
     * @param mixed $targetObject any object
     * 
     * @return null
     * @throws UnableToSetProperty
     */
    public function setAsProperty($value, $targetObject);
}
