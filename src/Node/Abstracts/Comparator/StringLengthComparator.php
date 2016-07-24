<?php namespace Hurl\Node\Abstracts\Comparator;

use Cofi\Comparator\ComparatorFunction;
use Hurl\Node\Abstracts\AbstractComparator;

abstract class StringLengthComparator extends AbstractComparator
{
	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		$f = ComparatorFunction::stringLength();
		return $f($a, $b);
	}
}
