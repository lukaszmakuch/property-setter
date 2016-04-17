<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use lukaszmakuch\PropertySetter\PropertySetter;

/**
 * It tries to set properties of an object using added setters.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
interface ChainOfPropertySetters extends PropertySetter
{
    /**
     * @param PropertySetter $actualSetter
     * 
     * @return ChainOfPropertySetters self
     */
    public function add(PropertySetter $actualSetter);

    public function setPropertiesOf($object);
}
