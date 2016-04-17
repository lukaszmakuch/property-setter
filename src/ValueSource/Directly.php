<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter\ValueSource;

/**
 * Simply holds some value that is returned when getValue is called.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class Directly implements ValueSource
{
    /**
     * @var mixed
     */
    private $valueToReturn;

    /**
     * @param mixed $valueToReturn will be returned
     */
    public function __construct($valueToReturn)
    {
        $this->valueToReturn = $valueToReturn;
    }

    public function getValue()
    {
        return $this->valueToReturn;
    }
}
