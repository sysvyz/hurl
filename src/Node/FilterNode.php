<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node;


use Hurl\Node\Interfaces\ComparatorFilterTraitInterface;
use Hurl\Node\Interfaces\FilterTraitInterface;
use Hurl\Node\Traits\ComparatorFilterTrait;
use Hurl\Node\Traits\FilterTrait;
use Type\AndFilter;
use Type\GreaterOrEqualFilter;
use Type\GreaterThanFilter;
use Type\IsArrayFilter;
use Type\IsEmptyFilter;
use Type\IsEqualFilter;
use Type\IsEvenFilter;
use Type\IsIntegerFilter;
use Type\IsNotEqualFilter;
use Type\IsNumericFilter;
use Type\IsOddFilter;
use Type\IsStringFilter;
use Type\LessOrEqualFilter;
use Type\LessThanFilter;
use Type\OrFilter;

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
			/**
			 * @var callable[]
			 */
			private $filters;

			/**
			 *  constructor.
			 * @param $filters
			 */
			public function __construct(callable ...$filters)
			{
				$this->filters = $filters;
			}

			public function __invoke(...$data)
			{
				foreach ($this->filters as $callable) {
					if (!$callable($data[0])) {

						return false;
					}
				}
				return true;
			}
		};
	}

	/**
	 * @return OrFilter
	 */
	public static function or (...$filters)
	{
		return new class(...$filters) extends OrFilter
		{
			/**
			 * @var callable[]
			 */
			private $filters;

			/**
			 *  constructor.
			 * @param $filters
			 */
			public function __construct(callable ...$filters)
			{
				$this->filters = $filters;
			}


			public function __invoke(...$data)
			{
				foreach ($this->filters as $callable) {
					if ($callable($data[0])) {
						return true;
					}
				}
				return false;
			}
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