<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node;


use Hurl\Node\Abstracts\AbstractFilterNode;
use Type\AbstractAndFilter;
use Type\AbstractGreaterOrEqualFilter;
use Type\AbstractGreaterThanFilter;
use Type\AbstractIsArrayFilter;
use Type\AbstractIsEmptyFilter;
use Type\AbstractIsEqualFilter;
use Type\AbstractIsEvenFilter;
use Type\AbstractIsIntegerFilter;
use Type\AbstractIsNotEqualFilter;
use Type\AbstractIsNumericFilter;
use Type\AbstractIsOddFilter;
use Type\AbstractIsStringFilter;
use Type\AbstractLessOrEqualFilter;
use Type\AbstractLessThanFilter;
use Type\AbstractOrFilter;
use Type\ComparatorFilterTrait;
use Type\ComparatorFilterTraitInterface;
use Type\FilterTrait;
use Type\FilterTraitInterface;

require 'Type/filter.php';


class FilterNode
{
	/**
	 * @return AbstractFilterNode
	 */
	public static function isEmpty()
	{
		return new class() extends AbstractIsEmptyFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return AbstractIsNumericFilter
	 */
	public static function isNumeric()
	{
		return new class() extends AbstractIsNumericFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return AbstractIsIntegerFilter
	 */
	public static function isInt()
	{
		return new class() extends AbstractIsIntegerFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return AbstractIsStringFilter
	 */
	public static function isString()
	{
		return new class() extends AbstractIsStringFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return AbstractIsArrayFilter
	 */
	public static function isArray()
	{
		return new class() extends AbstractIsArrayFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return AbstractAndFilter
	 */
	public static function and (...$filters)
	{
		return new class(...$filters) extends AbstractAndFilter
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
	 * @return AbstractOrFilter
	 */
	public static function or (...$filters)
	{
		return new class(...$filters) extends AbstractOrFilter
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
	 * @return AbstractIsEvenFilter
	 */
	public static function isEven()
	{
		return new class() extends AbstractIsEvenFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return AbstractIsOddFilter
	 */
	public static function isOdd()
	{
		return new class() extends AbstractIsOddFilter implements FilterTraitInterface
		{
			use FilterTrait;
		};
	}

	/**
	 * @return AbstractGreaterThanFilter
	 */
	public static function isGreaterThan($value)
	{
		return new class($value) extends AbstractGreaterThanFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}

	/**
	 * @return AbstractLessThanFilter
	 */
	public static function isLessThan($value)
	{
		return new class($value) extends AbstractLessThanFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}

	/**
	 * @return AbstractGreaterOrEqualFilter
	 */
	public static function isGreaterOrEqual($value)
	{
		return new class($value) extends AbstractGreaterOrEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}

	/**
	 * @return AbstractLessOrEqualFilter
	 */
	public static function isLessOrEqual($value)
	{
		return new class($value) extends AbstractLessOrEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}

	/**
	 * @return AbstractIsEqualFilter
	 */
	public static function isEqual($value)
	{
		return new class($value) extends AbstractIsEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}

	/**
	 * @return AbstractIsNotEqualFilter
	 */
	public static function isNotEqual($value)
	{
		return new class($value) extends AbstractIsNotEqualFilter implements ComparatorFilterTraitInterface
		{
			use ComparatorFilterTrait;
		};
	}


}