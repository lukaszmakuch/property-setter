<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter\Exception;

/**
 * Thrown when trying to set properties of an object that is not supported.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class UnsupportedTarget extends UnableToSetProperty
{
}
