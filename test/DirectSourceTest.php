<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use lukaszmakuch\PropertySetter\ValueSource\Directly;
use PHPUnit_Framework_TestCase;

/**
 * Tests direct value source.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class DirectSourceTest extends PHPUnit_Framework_TestCase
{
    public function testDirectValueSource()
    {
        $value = "it's value";
        $valueSource = new Directly($value);
        $this->assertSame($value, $valueSource->getValue());
    }
}
