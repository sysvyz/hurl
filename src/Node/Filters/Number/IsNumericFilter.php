<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:45
 */

namespace Hurl\Node\Filters\Number;


use Hurl\Node\Abstracts\AbstractFilter;

abstract class IsNumericFilter extends AbstractFilter
{
    public function apply($value)
    {
        return is_numeric($value);
    }
}
