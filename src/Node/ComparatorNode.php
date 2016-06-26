<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node;


use Hurl\Node\Abstracts\AbstractComparatorNode;

abstract class ComparatorNode
{
	/**
	 * @return AbstractComparatorNode
	 */
	public static function numeric()
	{
		return new class() extends AbstractComparatorNode
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
		};
	}

	/**
	 * @return AbstractComparatorNode
	 */
	public static function alphaNumeric()
	{
		return new class() extends AbstractComparatorNode
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

		};
	}

	/**
	 * @return AbstractComparatorNode
	 */
	public static function stringLength()
	{
		return new class() extends AbstractComparatorNode
		{
			public function compare($a, $b)
			{

				return strlen($a) - strlen($b);
			}
		};
	}

}
