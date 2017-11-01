<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:20
 */

namespace Hurl\Node\Arrays;


use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Interfaces\Traits\ArrayTraitInterface;
use Hurl\Node\Traits\ArrayTrait;

class ArrayFilter extends AbstractArray implements ArrayTraitInterface
{
    use ArrayTrait;
    /**
     * @var callable
     */
    protected $callable;

    /**
     *  constructor.
     * @param $callable
     */
    public function __construct(callable $callable = null)
    {
        $this->callable = $callable;
    }

    public function apply(...$data)
    {
        if ($this->callable) {
            return array_filter($data[0], $this->callable);
        }
        return array_filter($data[0]);
    }

}