<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use lukaszmakuch\PropertySetter\Exception\UnableToSetProperty;

/**
 * Sets properties of already existing objects
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
interface PropertySetter
{
    /**
     * @param mixed $object 
     * 
     * @throws UnableToSetProperty
     * @return PropertySetter self
     */
    public function setPropertiesOf($object);
}
