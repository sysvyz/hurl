<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 07:11
 */

namespace Hurl\Node\Traits;


trait ArrayTrait
{
    abstract public function apply(...$data);

    public function __invoke(...$data)
    {
        return $this->apply(...$data);
    }
}