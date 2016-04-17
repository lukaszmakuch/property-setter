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
 * It tries to set properties of an object using all of its setters.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ChainOfPropertySetters implements PropertySetter
{
    /**
     * @var PropertySetter[]
     */
    private $chainedSetters = [];

    /**
     * @param PropertySetter $actualSetter
     * 
     * @return ChainOfPropertySetters self
     */
    public function add(PropertySetter $actualSetter)
    {
        $this->chainedSetters[] = $actualSetter;
        return $this;
    }

    public function setPropertiesOf($object)
    {
        foreach ($this->chainedSetters as $oneOfActualSetters) {
            $oneOfActualSetters->setPropertiesOf($object);
        }
    }
}
