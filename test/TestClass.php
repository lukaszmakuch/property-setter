<?php

/**
 * This file is part of the PropertySetter library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\PropertySetter;

/**
 * Created for testing purposes.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class TestClass
{
    public $setBySetter;
    public function setParam($v) { $this->setBySetter = $v; }
}