<?php namespace Hurl\Node\Comparator;

use Hurl\Node\Abstracts\AbstractComparator;

abstract class BooleanComparator extends AbstractComparator
{
    /**
     * @param $a
     * @param $b
     * @return int
     */
    public function compare($a, $b)
    {
        return ($a ? 1 : 0) - ($b ? 1 : 0);
    }
}
