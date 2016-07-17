<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 29.06.16
 * Time: 21:42
 */

namespace Hurl\Node\Abstracts\Comparator;

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
		$cmp = $a - $b;
		if (abs($cmp)>$this->delta) {
			if($cmp < 0){
				return -1;
			}
			return 1;
		}
		return 0;
	}
}