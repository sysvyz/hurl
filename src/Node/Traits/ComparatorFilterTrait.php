<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 04:25
 */

namespace Hurl\Node\Traits;


trait ComparatorFilterTrait
{
    protected $value;

    abstract public function compare($that, $other);

    public function __invoke(...$data)
    {
        return $this->compare($this->value, $data[0]);
    }
}