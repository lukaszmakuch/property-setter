<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use lukaszmakuch\PropertySetter\Exception\UnsupportedTarget;
use lukaszmakuch\PropertySetter\PropertySetter;
use lukaszmakuch\PropertySetter\SettingStrategy\SettingStrategy;
use lukaszmakuch\PropertySetter\TargetSpecifier\TargetSpecifier;
use lukaszmakuch\PropertySetter\ValueSource\ValueSource;

/**
 * Injects values obtained from a value source to objects described by a target
 * specifier using some property setting strategy.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class SimplePropertySetter implements PropertySetter
{
    /**
     * @var TargetSpecifier 
     */
    private $targetSpecifier;
    
    /**
     * @var SettingStrategy 
     */
    private $settingStrategy;
    
    /**
     * @var ValueSource 
     */
    private $valueSource;
    
    /**
     * @param TargetSpecifier $targetSpecifier
     * @param SettingStrategy $settingStrategy
     * @param ValueSource $valueSource
     * 
     * @return PropertySetter self
     */
    public function __construct(
        TargetSpecifier $targetSpecifier,
        SettingStrategy $settingStrategy,
        ValueSource $valueSource
    ) {
        $this->targetSpecifier = $targetSpecifier;
        $this->settingStrategy = $settingStrategy;
        $this->valueSource = $valueSource;
    }
    
    public function setPropertiesOf($object)
    {
        if (!$this->targetSpecifier->isTarget($object)) {
            throw new UnsupportedTarget();
        }

        $this->settingStrategy->setAsProperty(
            $this->valueSource->getValue(),
            $object
        );
    }
}
