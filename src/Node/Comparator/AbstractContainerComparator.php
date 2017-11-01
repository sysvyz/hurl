<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 17.07.16
 * Time: 20:04
 */

namespace Hurl\Node\Comparator;


use Hurl\Node\Abstracts\AbstractComparator;
use Hurl\Node\Exceptions\UndefinedPropertyException;
use Hurl\Node\Interfaces\ComparatorInterface;
use Hurl\Node\Statics\Comparators;

abstract class AbstractContainerComparator extends AbstractComparator
{
    /**
     * @var \Cofi\Comparator\Abstracts\AbstractContainerComparator
     */
    private $comparator;

    /**
     * AbstractContainerComparator constructor.
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->comparator = $this->_getComparator($fields);
    }

    /**
     * @param array $fields
     * @return static
     */
    public static function init(array $fields)
    {
        return new static($fields);
    }

    /**
     * @param $a
     * @param $b
     * @return int
     * @throws UndefinedPropertyException
     * @throws \InvalidArgumentException
     */
    public function compare($a, $b)
    {
        return $this->comparator->compare($a, $b);
    }

    /**
     * @param $fields
     * @return \Cofi\Comparator\Abstracts\AbstractContainerComparator
     */
    abstract protected function _getComparator($fields);
}