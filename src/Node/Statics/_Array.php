<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 27.05.16
 * Time: 17:40
 */

namespace Hurl\Node\Statics;

use Hurl\Node\Abstracts\AbstractArray;
use Hurl\Node\Abstracts\AbstractNode;
use Hurl\Node\Abstracts\AbstractStringNode;
use Hurl\Node\Abstracts\Arrays\ArrayEach;
use Hurl\Node\Abstracts\Arrays\StringExplode;
use Hurl\Node\Abstracts\Arrays\ArrayFilter;
use Hurl\Node\Abstracts\Arrays\ArrayFold;
use Hurl\Node\Abstracts\Arrays\ArrayMap;
use Hurl\Node\Abstracts\Arrays\ArrayMerge;
use Hurl\Node\Abstracts\Arrays\ArrayRecursiveMerge;
use Hurl\Node\Abstracts\Arrays\ArraySort;
use Hurl\Node\Abstracts\Arrays\ArrayStableSort;
use Hurl\Node\Abstracts\Arrays\ArrayValues;
use Hurl\Node\Abstracts\Strings\ArrayImplode;
use Hurl\Node\Interfaces\CollectionNodeInterface;
use Hurl\Node\Traits\ArrayTrait;

final class _Array
{

	/**
	 * _Array constructor.
	 * @codeCoverageIgnore
	 */
	private final function __construct()
	{
	}

	/**
	 * @param callable $mapping
	 * @return ArrayMap
	 */
	public static function map(callable $mapping = null)
	{
		return new class($mapping) extends ArrayMap
		{
			use ArrayTrait;
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
	 * @return ArrayFold
	 */
	public static function fold(callable $callable, $init = null)
	{
		return new class($callable, $init) extends ArrayFold
		{
			use ArrayTrait;
		};
	}

	/**
	 * @param callable $callable
	 * @return ArraySort
	 */
	public static function sort(callable ...$callable)
	{
		return new class(...$callable) extends ArraySort
		{
			use ArrayTrait;
		};
	}
	/**
	 * @param callable $callable
	 * @return ArraySort
	 */
	public static function stableSort(callable ...$callable)
	{
		return new class(...$callable) extends ArrayStableSort
		{
			use ArrayTrait;
		};
	}

	/**
	 * @param callable $callable
	 * @return ArrayFilter
	 */
	public static function filter(callable $callable = null)
	{
		return new class($callable) extends ArrayFilter
		{
			use ArrayTrait;
		};
	}

	/**
	 * @param $do
	 * @return ArrayEach
	 */
	public static function each(callable $do)
	{
		return new class($do) extends ArrayEach
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
		return new class($delimiter) extends StringExplode{};

	}


	/**
	 * @param $glue
	 * @return AbstractStringNode
	 */
	public static function implode($glue)
	{
		return new ArrayImplode($glue);
	}

	/**
	 * @return ArrayMerge
	 */
	public static function merge()
	{
		return new class() extends ArrayMerge
		{
			use ArrayTrait;

		};
	}

	/**
	 * @return ArrayValues
	 */
	public static function values()
	{
		return new class() extends ArrayValues
		{
			use ArrayTrait;
		};
	}


	/**
	 * @return CollectionNodeInterface
	 */
	public static function recursiveMerge()
	{
		return new class() extends ArrayRecursiveMerge
		{
			use ArrayTrait;

		};
	}
}
