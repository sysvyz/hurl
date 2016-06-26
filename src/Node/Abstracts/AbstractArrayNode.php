<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 26.06.16
 * Time: 03:01
 */

namespace Hurl\Node\Abstracts;


use Hurl\Node\ArrayNode;
use Hurl\Node\Container\ContainerTrait;
use Hurl\Node\Container\ContainerTraitInterface;
use Hurl\Node\Math\MathNode;
use Type\AbstractArrayEach;
use Type\AbstractArrayMap;
use Type\AbstractArrayMerge;
use Type\AbstractArraySort;

abstract class AbstractArrayNode extends AbstractNode
{


	/**
	 * @param callable $do
	 * @return AbstractNode
	 */
	public function call(callable $do)
	{
		return new class($this, $do) extends AbstractArrayNode implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param callable $do
	 * @return AbstractArrayEach
	 */
	public function each(callable $do)
	{
		return new class($this, ArrayNode::each($do)) extends AbstractArrayEach implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param callable $callable
	 * @return AbstractArrayMap
	 */
	public function map(callable $callable)
	{
		return new class($this, ArrayNode::map($callable)) extends AbstractArrayMap implements ContainerTraitInterface
		{
			use ContainerTrait;
		};

	}

	/**
	 * @param \callable[] ...$callable
	 * @return AbstractArraySort
	 */
	public function sort(callable ...$callable)
	{
		return new class($this, ArrayNode::sort(...$callable)) extends AbstractArraySort implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

	/**
	 * @param \callable[] ...$callable
	 * @return AbstractArraySort
	 */
	public function merge()
	{
		return new class($this, ArrayNode::merge()) extends AbstractArrayMerge implements ContainerTraitInterface
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

	public function values()
	{
		return new class($this, ArrayNode::values()) extends AbstractArrayNode implements ContainerTraitInterface
		{
			use ContainerTrait;
		};
	}

}