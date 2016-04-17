<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter\ValueSource;

use lukaszmakuch\PropertySetter\Exception\UnableToGetValue;

/**
 * Provides values that are set as properties of objects.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
interface ValueSource
{
    /**
     * @return mixed the value
     * @throws UnableToGetValue
     */
    public function getValue();
}
