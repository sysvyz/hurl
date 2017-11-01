<?php namespace Hurl\Node\Abstracts\Comparator;

namespace Hurl\Node\Comparator;


use Cofi\Comparator\ComparatorFunction;
use Hurl\Node\Abstracts\AbstractComparator;

abstract class StringComparator extends AbstractComparator
{
    /**
     * @param $a
     * @param $b
     * @return int
     */
    public function compare($a, $b)
    {
        $f = ComparatorFunction::string();
        return $f($a, $b);
    }
}
