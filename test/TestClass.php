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
    public $firstParamSetBySetter;
    public $secondParamSetBySetter;
    public function setFirstParam($v) { $this->firstParamSetBySetter = $v; }
    public function setSecondParam($v) { $this->secondParamSetBySetter = $v; }
}