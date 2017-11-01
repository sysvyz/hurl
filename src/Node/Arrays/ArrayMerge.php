<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:19
 */

namespace Hurl\Node\Arrays;


use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Interfaces\Traits\ArrayTraitInterface;
use Hurl\Node\Traits\ArrayTrait;

class ArrayMerge extends AbstractArray implements ArrayTraitInterface
{
    use ArrayTrait;

    public function apply(...$data)
    {
        return array_merge(...$data);
    }
}