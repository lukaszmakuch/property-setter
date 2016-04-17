<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter\TargetSpecifier;

/**
 * Tells whether an object is a target for setting a property.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
interface TargetSpecifier
{
    /**
     * @param mixed $object
     * 
     * @return boolean true if the given object is a target for setting a property
     */
    public function isTarget($object);
}
