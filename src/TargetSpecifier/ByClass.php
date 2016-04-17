<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter\TargetSpecifier;

/**
 * Selects targets by their classes.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ByClass implements TargetSpecifier
{
    /**
     * @var String
     */
    private $supportedClass;
    
    public function __construct($supportedClass)
    {
        $this->supportedClass = $supportedClass;
    }
    
    public function isTarget($object)
    {
        if (!is_object($object)) {
            return false;
        }
        
        return $object instanceof $this->supportedClass;
    }
}
