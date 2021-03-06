<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 05:01
 */

namespace Hurl\Node\Filters\Comparator;


use Hurl\Node\Abstracts\AbstractFilter;

abstract class AbstractComparatorFilter extends AbstractFilter
{
    protected $value;

    /**
     *  constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    abstract public function compare($that, $other);

    /**
     * @param $value
     * @return bool
     */
    public function apply($value)
    {
        return $this->compare($this->value, $value);
    }
}