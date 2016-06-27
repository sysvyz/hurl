<?php
use Hurl\Node\Abstracts\AbstractComparatorNode;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.06.16
 * Time: 04:36
 */
abstract class AbstractAlphaNumericComparatorNode extends AbstractComparatorNode
{
	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		return strcmp($a, $b);
	}
}


abstract class AbstractNumericComparatorNode extends AbstractComparatorNode
{
	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		return $a - $b;
	}
}


abstract class AbstractStringLengthComparatorNode extends AbstractComparatorNode
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

abstract class AbstractBooleanComparatorNode extends AbstractComparatorNode
{
	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public function compare($a, $b)
	{
		return +($a) - +($b);
	}
}
