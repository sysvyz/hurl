<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 04:28
 */

namespace Hurl\Node\Traits;


trait FilterContainerTrait
{
    use FilterTrait;

    abstract public function fold($value);

    /**
     * @param $value
     * @return bool
     */
    public function apply($value)
    {
        return $this->fold($value);
    }
}