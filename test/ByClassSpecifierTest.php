<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use DateTime;
use lukaszmakuch\PropertySetter\TargetSpecifier\ByClass;
use PHPUnit_Framework_TestCase;

/**
 * Tests choosing by class.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ByClassSpecifierTest extends PHPUnit_Framework_TestCase
{
    public function testTargetByClass()
    {
        $specifier = new ByClass(DateTime::class);
        $this->assertTrue($specifier->isTarget(new \DateTime()));
        $this->assertFalse($specifier->isTarget(new \stdClass()));
        $this->assertFalse($specifier->isTarget("not an object"));
    }
}
