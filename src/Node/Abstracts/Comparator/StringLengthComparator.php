<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 29.06.16
 * Time: 21:43
 */

namespace Hurl\Node\Abstracts\Comparator;


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
		return strlen($a) - strlen($b);
	}
}
