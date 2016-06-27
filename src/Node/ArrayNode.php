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
use Hurl\Node\Abstracts\AbstractNode;
use Hurl\Node\Abstracts\AbstractStringNode;
use Hurl\Node\Abstracts\Arrays\AbstractArrayEach;
use Hurl\Node\Abstracts\Arrays\AbstractArrayFilter;
use Hurl\Node\Abstracts\Arrays\AbstractArrayFold;
use Hurl\Node\Abstracts\Arrays\AbstractArrayMap;
use Hurl\Node\Abstracts\Arrays\AbstractArrayMerge;
use Hurl\Node\Abstracts\Arrays\AbstractArraySort;
use Hurl\Node\Abstracts\Arrays\AbstractArrayValues;
use Hurl\Node\Interfaces\CollectionNodeInterface;
use Hurl\Node\Traits\ArrayTrait;

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
			public function __invoke(...$data)
			{
				return $this->apply(...$data);
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
			public function __invoke(...$data)
			{
				return $this->apply(...$data);
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
			public function __invoke(...$data)
			{
				return $this->apply(...$data);
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
			use ArrayTrait;
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
			use ArrayTrait;
		};
	}


	/**
	 * @param $delimiter
	 * @return CollectionNodeInterface
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
			use ArrayTrait;

		};
	}

	/**
	 * @return AbstractArrayValues
	 */
	public static function values()
	{
		return new class() extends AbstractArrayValues
		{
			use ArrayTrait;
		};
	}


	/**
	 * @return CollectionNodeInterface
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
