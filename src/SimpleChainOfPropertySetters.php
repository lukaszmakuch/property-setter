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
class SimpleChainOfPropertySetters implements ChainOfPropertySetters
{
    /**
     * @var PropertySetter[]
     */
    private $chainedSetters = [];

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
