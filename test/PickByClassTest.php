<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use DateTime;
use lukaszmakuch\PropertySetter\TargetSpecifier\PickByClass;
use PHPUnit_Framework_TestCase;

/**
 * Tests picking by class.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class PickByClassTest extends PHPUnit_Framework_TestCase
{
    public function testPickingByClass()
    {
        $specifier = new PickByClass(DateTime::class);
        $this->assertTrue($specifier->isTarget(new \DateTime()));
        $this->assertFalse($specifier->isTarget(new \stdClass()));
        $this->assertFalse($specifier->isTarget("not an object"));
    }
}
