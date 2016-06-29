<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 03:01
 */

namespace Hurl\Node\Abstracts;


use Hurl\Node\Abstracts\Arrays\ArrayEach;
use Hurl\Node\Abstracts\Arrays\ArrayMap;
use Hurl\Node\Abstracts\Arrays\ArrayMerge;
use Hurl\Node\Abstracts\Arrays\ArraySort;
use Hurl\Node\Interfaces\CollectionNodeInterface;
use Hurl\Node\Interfaces\ContainerTraitInterface;
use Hurl\Node\Math\MathNode;
use Hurl\Node\Statics\_Array;
use Hurl\Node\Traits\ContainerTrait;

abstract class AbstractArray extends AbstractNode implements CollectionNodeInterface
{

	/**
	 * @param callable $do
	 * @return AbstractNode
	 */
	public function call(callable $do)
	{
		return new class($this, $do) extends AbstractArray implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param callable $do
	 * @return ArrayEach
	 */
	public function each(callable $do)
	{
		return new class($this, _Array::each($do)) extends ArrayEach implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param callable $callable
	 * @return ArrayMap
	 */
	public function map(callable $callable)
	{
		return new class($this, _Array::map($callable)) extends ArrayMap implements ContainerTraitInterface
		{
			use ContainerTrait;
		};

	}

	/**
	 * @param callable $callable
	 * @return ArrayMap
	 */
	public function fold(callable $callable)
	{
		return new class($this, _Array::map($callable)) extends ArrayMap implements ContainerTraitInterface
		{
			use ContainerTrait;
		};

	}

	/**
	 * @param \callable[] ...$callable
	 * @return ArraySort
	 */
	public function sort(callable ...$callable)
	{
		return new class($this, _Array::sort(...$callable)) extends ArraySort implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @return ArraySort
	 */
	public function merge()
	{
		return new class($this, _Array::merge()) extends ArrayMerge implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @return AbstractNode
	 */
	public function sum()
	{
		return new class($this, MathNode::sum()) extends AbstractNode implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @return ArraySort
	 */
	public function values()
	{
		return new class($this, _Array::values()) extends AbstractArray implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param string $glue
	 * @return AbstractNode
	 */
	public function implode(string $glue)
	{
		return $this->call(_Array::implode($glue));
	}
}