<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node;


use Hurl\Node\Abstracts\AbstractFilterNode;
use Hurl\Node\Abstracts\AbstractNode;
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
require 'Type/filter.php';


class FilterNode
{
	/**
	 * @return AbstractFilterNode
	 */
	public static function isEmpty()
	{
		return new class() extends AbstractIsEmptyFilter
		{
			public function __invoke(...$data)
			{
				$val = $data[0];
				if(is_string($val)){
					return strlen($val)==0;
				}
				if(is_array($val)){
					return empty($val);
				}
				if(is_null($val)){
					return true;
				}

				return false;
			}
		};
	}

	/**
	 * @return AbstractIsNumericFilter
	 */
	public static function isNumeric()
	{
		return new class() extends AbstractIsNumericFilter
		{
			public function __invoke(...$data)
			{
				return is_numeric($data[0]);
			}
		};
	}

	/**
	 * @return AbstractIsIntegerFilter
	 */
	public static function isInt()
	{
		return new class() extends AbstractIsIntegerFilter
		{
			public function __invoke(...$data)
			{
				return is_int($data[0]);
			}
		};
	}

	/**
	 * @return AbstractIsStringFilter
	 */
	public static function isString()
	{
		return new class() extends AbstractIsStringFilter
		{
			public function __invoke(...$data)
			{
				return is_string($data[0]);
			}
		};
	}

	/**
	 * @return AbstractIsArrayFilter
	 */
	public static function isArray()
	{
		return new class() extends AbstractIsArrayFilter
		{
			public function __invoke(...$data)
			{
				return is_array($data[0]);
			}
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
		return new class() extends AbstractIsEvenFilter
		{
			public function __invoke(...$data)
			{


				return is_numeric($data[0])&& $data[0] % 2 == 0;

			}
		};
	}

	/**
	 * @return AbstractIsOddFilter
	 */
	public static function isOdd()
	{
		return new class() extends AbstractIsOddFilter
		{
			public function __invoke(...$data)
			{


				return is_numeric($data[0])&& $data[0] % 2 != 0;

			}
		};
	}
	/**
	 * @return AbstractGreaterThanFilter
	 */
	public static function isGreaterThan($value)
	{
		return new class($value) extends AbstractGreaterThanFilter
		{

			public function __invoke(...$data)
			{

				return is_numeric($data[0])&& $data[0] > $this->value;
			}
		};
	}
	/**
	 * @return AbstractLessThanFilter
	 */
	public static function isLessThan($value)
	{
		return new class($value) extends AbstractLessThanFilter
		{
		

			public function __invoke(...$data)
			{

				return is_numeric($data[0])&& $data[0] < $this->value;
			}
		};
	}
	/**
	 * @return AbstractGreaterOrEqualFilter
	 */
	public static function isGreaterOrEqual($value)
	{
		return new class($value) extends AbstractGreaterOrEqualFilter
		{


			public function __invoke(...$data)
			{

				return is_numeric($data[0])&& $data[0] >= $this->value;
			}
		};
	}
	/**
	 * @return AbstractLessOrEqualFilter
	 */
	public static function isLessOrEqual($value)
	{
		return new class($value) extends AbstractLessOrEqualFilter
		{



			public function __invoke(...$data)
			{

				return is_numeric($data[0])&& $data[0] <= $this->value;
			}
		};
	}
	/**
	 * @return AbstractIsEqualFilter
	 */
	public static function isEqual($value)
	{
		return new class($value) extends AbstractIsEqualFilter
		{

			public function __invoke(...$data)
			{
				return $data[0] == $this->value;
			}
		};
	}
	/**
	 * @return AbstractIsNotEqualFilter
	 */
	public static function isNotEqual($value)
	{
		return new class($value) extends AbstractIsNotEqualFilter
		{

			public function __invoke(...$data)
			{

				return $data[0] != $this->value;
			}
		};
	}


}