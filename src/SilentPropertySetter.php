<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use lukaszmakuch\PropertySetter\Exception\UnsupportedTarget;

/**
 * It doesn't throw an exception if some object is not supported.
 */
class SilentPropertySetter implements PropertySetter
{
    /**
     * @var PropertySetter 
     */
    private $decoratedSetter;
    
    /**
     * @param PropertySetter $decoratedSetter
     */
    public function __construct(PropertySetter $decoratedSetter)
    {
        $this->decoratedSetter = $decoratedSetter;
    }


    public function setPropertiesOf($object)
    {
        try {
            $this->decoratedSetter->setPropertiesOf($object);
        } catch (UnsupportedTarget $e) {
            // ignore it
        }
    }
}
