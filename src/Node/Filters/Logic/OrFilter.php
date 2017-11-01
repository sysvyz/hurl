<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 06:24
 */

namespace Hurl\Node\Filters\Logic;


abstract class OrFilter extends LogicContainerFilterNode
{
    public function fold($value)
    {
        foreach ($this->filters as $callable) {
            if ($callable($value)) {
                return true;
            }
        }
        return false;
    }
}