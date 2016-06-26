<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 20.06.16
 * Time: 22:34
 */

namespace Hurl\Node;


use Hurl\Node\Abstracts\AbstractNode;

class FilterNode
{
	/**
	 * @return AbstractNode
	 */
	public static function isEmpty()
	{
		return new class() extends AbstractNode
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
	 * @return AbstractNode
	 */
	public static function isNumeric()
	{
		return new class() extends AbstractNode
		{
			public function __invoke(...$data)
			{
				return is_numeric($data[0]);
			}
		};
	}

	/**
	 * @return AbstractNode
	 */
	public static function isInt()
	{
		return new class() extends AbstractNode
		{
			public function __invoke(...$data)
			{
				return is_int($data[0]);
			}
		};
	}

	/**
	 * @return AbstractNode
	 */
	public static function isString()
	{
		return new class() extends AbstractNode
		{
			public function __invoke(...$data)
			{
				return is_string($data[0]);
			}
		};
	}

	/**
	 * @return AbstractNode
	 */
	public static function isArray()
	{
		return new class() extends AbstractNode
		{
			public function __invoke(...$data)
			{
				return is_array($data[0]);
			}
		};
	}


	/**
	 * @return AbstractNode
	 */
	public static function and (...$filters)
	{
		return new class(...$filters) extends AbstractNode
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
	 * @return AbstractNode
	 */
	public static function or (...$filters)
	{
		return new class(...$filters) extends AbstractNode
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

	public static function isEven()
	{
		return new class() extends AbstractNode
		{
			public function __invoke(...$data)
			{


				return is_numeric($data[0])&& $data[0] % 2 == 0;

			}
		};
	}

	public static function isOdd()
	{
		return new class() extends AbstractNode
		{
			public function __invoke(...$data)
			{


				return $data[0] % 2 != 0;

			}
		};
	}


}