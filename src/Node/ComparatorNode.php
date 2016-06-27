<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node;
include "Type/comparator.php";


use AbstractAlphaNumericComparatorNode;
use AbstractBooleanComparatorNode;
use AbstractNumericComparatorNode;
use AbstractStringLengthComparatorNode;
use Hurl\Node\Abstracts\AbstractComparatorNode;

abstract class ComparatorNode
{
	/**
	 * @return AbstractComparatorNode
	 */
	public static function numeric()
	{
		return new class() extends AbstractNumericComparatorNode
		{
		};
	}

	/**
	 * @return AbstractAlphaNumericComparatorNode
	 */
	public static function alphaNumeric()
	{
		return new class() extends AbstractAlphaNumericComparatorNode
		{
		};
	}

	/**
	 * @return AbstractComparatorNode
	 */
	public static function stringLength()
	{
		return new class() extends AbstractStringLengthComparatorNode
		{
		};
	}

	/**
	 * @return AbstractComparatorNode
	 */
	public static function boolean()
	{
		return new class() extends AbstractBooleanComparatorNode
		{
		};
	}

}
