<?php namespace Hurl\Node\Abstracts\Comparator;

namespace Hurl\Node\Comparator;

use Cofi\Comparator\ComparatorFunction;
use Hurl\Node\Abstracts\AbstractComparator;

abstract class NumericComparator extends AbstractComparator
{
    private $delta = 0;

    /**
     * NumericComparator constructor.
     * @param int $delta
     */
    public function __construct($delta = 0)
    {
        $this->delta = $delta;
    }

    /**
     * @param $a
     * @param $b
     * @return int
     */
    public function compare($a, $b)
    {
        $f = ComparatorFunction::number($this->delta);
        return $f($a, $b);

    }
}