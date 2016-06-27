<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node;


use Hurl\Node\Abstracts\Filters\Comparator\GreaterOrEqualFilter;
use Hurl\Node\Abstracts\Filters\Comparator\GreaterThanFilter;
use Hurl\Node\Abstracts\Filters\Comparator\IsEqualFilter;
use Hurl\Node\Abstracts\Filters\Comparator\IsNotEqualFilter;
use Hurl\Node\Abstracts\Filters\Comparator\LessOrEqualFilter;
use Hurl\Node\Abstracts\Filters\Comparator\LessThanFilter;
use Hurl\Node\Abstracts\Filters\IsArrayFilter;
use Hurl\Node\Abstracts\Filters\IsEmptyFilter;
use Hurl\Node\Abstracts\Filters\IsStringFilter;
use Hurl\Node\Abstracts\Filters\Logic\AndFilter;
use Hurl\Node\Abstracts\Filters\Logic\OrFilter;
use Hurl\Node\Abstracts\Filters\Number\IsEvenFilter;
use Hurl\Node\Abstracts\Filters\Number\IsIntegerFilter;
use Hurl\Node\Abstracts\Filters\Number\IsNumericFilter;
use Hurl\Node\Abstracts\Filters\Number\IsOddFilter;
use Hurl\Node\Interfaces\ComparatorFilterTraitInterface;
use Hurl\Node\Interfaces\FilterTraitInterface;
use Hurl\Node\Traits\ComparatorFilterTrait;
use Hurl\Node\Traits\FilterContainerTrait;
use Hurl\Node\Traits\FilterTrait;

require 'Type/filter.php';


class FilterNode
{
	/**
	 * @return IsEmptyFilter
	 */
	public static function isEmpty()
	{
		return new class() extends IsEmptyFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return IsNumericFilter
	 */
	public static function isNumeric()
	{
		return new class() extends IsNumericFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return IsIntegerFilter
	 */
	public static function isInt()
	{
		return new class() extends IsIntegerFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return IsStringFilter
	 */
	public static function isString()
	{
		return new class() extends IsStringFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return IsArrayFilter
	 */
	public static function isArray()
	{
		return new class() extends IsArrayFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return AndFilter
	 */
	public static function and (...$filters)
	{
		return new class(...$filters) extends AndFilter
		{

			use FilterContainerTrait;

		};
	}

	/**
	 * @return OrFilter
	 */
	public static function or (...$filters)
	{
		return new class(...$filters) extends OrFilter
		{

			use FilterContainerTrait;
		};
	}

	/**
	 * @return IsEvenFilter
	 */
	public static function isEven()
	{
		return new class() extends IsEvenFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return IsOddFilter
	 */
	public static function isOdd()
	{
		return new class() extends IsOddFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return GreaterThanFilter
	 */
	public static function isGreaterThan($value)
	{
		return new class($value) extends GreaterThanFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}

	/**
	 * @return LessThanFilter
	 */
	public static function isLessThan($value)
	{
		return new class($value) extends LessThanFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}

	/**
	 * @return GreaterOrEqualFilter
	 */
	public static function isGreaterOrEqual($value)
	{
		return new class($value) extends GreaterOrEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}

	/**
	 * @return LessOrEqualFilter
	 */
	public static function isLessOrEqual($value)
	{
		return new class($value) extends LessOrEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}

	/**
	 * @return IsEqualFilter
	 */
	public static function isEqual($value)
	{
		return new class($value) extends IsEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}

	/**
	 * @return IsNotEqualFilter
	 */
	public static function isNotEqual($value)
	{
		return new class($value) extends IsNotEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}


}