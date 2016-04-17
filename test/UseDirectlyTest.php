<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

use lukaszmakuch\PropertySetter\ValueSource\UseDirectly;
use PHPUnit_Framework_TestCase;

/**
 * Tests using the given value directly.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class UseDirectlyTest extends PHPUnit_Framework_TestCase
{
    public function testUsingDirectly()
    {
        $value = "it's value";
        $valueSource = new UseDirectly($value);
        $this->assertSame($value, $valueSource->getValue());
    }
}
