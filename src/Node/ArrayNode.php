<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 17:40
 */

namespace Hurl\Node;
include "Type/array.php";

use Hurl\Node\Abstracts\AbstractArrayNode;
use Hurl\Node\Abstracts\AbstractComparatorNode;
use Hurl\Node\Abstracts\AbstractNode;
use Hurl\Node\Abstracts\AbstractStringNode;
use Hurl\Node\Container\ComparatorContainerTrait;
use Type\AbstractArrayEach;
use Type\AbstractArrayFilter;
use Type\AbstractArrayFold;
use Type\AbstractArrayMap;
use Type\AbstractArrayMerge;
use Type\AbstractArraySort;
use Type\AbstractArrayValues;

class ArrayNode
{
	/**
	 * @param callable $mapping
	 * @return AbstractArrayMap
	 */
	public static function map(callable $mapping = null)
	{
		return new class($mapping) extends AbstractArrayMap
		{
			private $mapping;

			public function __construct($mapping)
			{
				$this->mapping = $mapping;
			}

			public function __invoke(...$data)
			{
				return array_map($this->mapping, ...$data);
			}
		};
	}

	/**
	 * @return AbstractNode
	 */
	public static function length()
	{
		return new class() extends AbstractNode
		{

			public function __invoke(...$data)
			{
				return count($data[0]);
			}
		};
	}

	/**
	 * @param callable $callable
	 * @return AbstractArrayFold
	 */
	public static function fold(callable $callable, $init = null)
	{
		return new class($callable, $init) extends AbstractArrayFold
		{
			/**
			 * @var callable
			 */
			private $callable;
			/**
			 * @var
			 */
			private $init;

			/**
			 *  constructor.
			 * @param $callable
			 * @param $init
			 */
			public function __construct(callable $callable, $init)
			{
				$this->callable = $callable;
				$this->init = $init;
			}

			public function __invoke(...$data)
			{
				return array_reduce($data[0], $this->callable, $this->init);
			}
		};
	}

	/**
	 * @param callable $callable
	 * @return AbstractArraySort
	 */
	public static function sort(callable ...$callable)
	{
		return new class(...$callable) extends AbstractArraySort
		{
			/**
			 * @var callable
			 */
			private $callable;


			/**
			 *  constructor.
			 * @param $callable
			 */
			public function __construct(callable ...$callables)
			{

				$callable = $callables[0];


				if (count($callables) > 1) {
					for ($int = 1; $int < count($callables); $int++) {
						$callable = new class($callable, $callables[$int]) extends AbstractComparatorNode
						{
							use ComparatorContainerTrait;
						};
					}


				}
				$this->callable = $callable;

			}

			public function __invoke(...$data)
			{

				usort($data[0], $this->callable);
				return $data[0];
			}
		};
	}

	/**
	 * @param callable $callable
	 * @return AbstractArrayFilter
	 */
	public static function filter(callable $callable = null)
	{
		return new class($callable) extends AbstractArrayFilter
		{
			/**
			 * @var callable
			 */
			private $callable;


			/**
			 *  constructor.
			 * @param $callable
			 */
			public function __construct(callable $callable = null)
			{
				$this->callable = $callable;
			}

			public function __invoke(...$data)
			{
//var_dump($this->callable);die;

				if ($this->callable) {
					return array_filter($data[0], $this->callable);
				}
				return array_filter($data[0]);
			}
		};
	}

	/**
	 * @param $do
	 * @return AbstractArrayEach
	 */
	public static function each(callable $do)
	{
		return new class($do) extends AbstractArrayEach
		{
			private $do;

			public function __construct($do)
			{
				$this->do = $do;
			}

			public function __invoke(...$data)
			{
				array_walk($data[0], $this->do);
				return $data;
			}
		};
	}


	/**
	 * @param $delimiter
	 * @return AbstractArrayNode
	 */
	public static function explode($delimiter)
	{
		return StringNode::explode($delimiter);
	}

	/**
	 * @param $glue
	 * @return AbstractStringNode
	 */
	public static function implode($glue)
	{
		return new class($glue) extends AbstractStringNode
		{
			private $glue;

			public function __construct($glue)
			{
				$this->glue = $glue;
			}

			public function __invoke(...$data)
			{
				return implode($this->glue, $data[0]);
			}
		};
	}

	/**
	 * @return AbstractArrayMerge
	 */
	public static function merge()
	{
		return new class() extends AbstractArrayMerge
		{
			public function __invoke(...$data)
			{
				return array_merge(...$data);
			}
		};
	}

	/**
	 * @return AbstractArrayValues
	 */
	public static function values()
	{
		return new class() extends AbstractArrayValues
		{
			public function __invoke(...$data)
			{
				return array_merge(...$data);
			}
		};
	}


	/**
	 * @return AbstractArrayNode
	 */
	public static function recursiveMerge()
	{
		return new class() extends AbstractArrayNode
		{
			private function _mergeRecursive(...$data)
			{
				$r = array_map(function ($elem) {
					if (is_array($elem)) {
						return $this->_mergeRecursive(... $elem);
					}
					return [$elem];
				}, $data);
				return array_merge(...$r);
			}

			public function __invoke(...$data)
			{
				return $this->_mergeRecursive(...$data);
			}
		};
	}
}
