<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

/**
 * Ignores situation when some setters doesn't support objects of some type.
 * 
 * Tries to set properties using all of its setters.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class SilentChainOfPropertySetters implements ChainOfPropertySetters
{
    /**
     * @var ChainOfPropertySetters 
     */
    private $decoratedChain;
    
    public function __construct(ChainOfPropertySetters $decoratedChain)
    {
        $this->decoratedChain = $decoratedChain;
    }
    
    public function add(PropertySetter $actualSetter)
    {
        return $this->decoratedChain->add(new SilentPropertySetter($actualSetter));
    }

    public function setPropertiesOf($object)
    {
        $this->decoratedChain->setPropertiesOf($object);
    }
}
